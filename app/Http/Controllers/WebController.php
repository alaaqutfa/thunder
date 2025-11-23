<?php
namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BusinessSetting;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $data = [
            'companyName'      => BusinessSetting::getValue('company_name'),
            'identity_name'    => BusinessSetting::getValue('identity_name'),
            'tagline'          => BusinessSetting::getValue('tagline'),
            'aboutTitle'       => BusinessSetting::getValue('about_title'),
            'aboutContent'     => BusinessSetting::getValue('about_content'),
            'missionTitle'     => BusinessSetting::getValue('mission_title'),
            'missionContent'   => BusinessSetting::getValue('mission_content'),
            'services'         => Service::active()->ordered()->get(),
            'featuredProjects' => Project::with('service')
                ->active()
                ->ordered()
                ->paginate(6),
            'contactPhone'     => BusinessSetting::getValue('contact_phone'),
            'contactEmail'     => BusinessSetting::getValue('contact_email'),
            'brands'           => Brand::where('status', 1)
                ->orderBy('id', 'ASC')
                ->get(),
        ];

        return view('web.home', compact('data'));
    }

    public function about()
    {
        $data = [
            'companyName'     => BusinessSetting::getValue('company_name'),
            'aboutTitle'      => BusinessSetting::getValue('about_title'),
            'aboutContent'    => BusinessSetting::getValue('about_content'),
            'missionTitle'    => BusinessSetting::getValue('mission_title'),
            'missionContent'  => BusinessSetting::getValue('mission_content'),
            'coverageTitle'   => BusinessSetting::getValue('coverage_title'),
            'coverageContent' => BusinessSetting::getValue('coverage_content'),
        ];

        return view('web.about', $data);
    }

    public function contact()
    {
        $data = [
            'companyName'  => BusinessSetting::getValue('company_name'),
            'contactPhone' => BusinessSetting::getValue('contact_phone'),
            'contactEmail' => BusinessSetting::getValue('contact_email'),
        ];

        return view('web.contact', $data);
    }

    public function projects(Request $request)
    {
        $query = Project::with('service')->active()->ordered();

        // فلترة حسب الخدمة إذا كانت موجودة
        if ($request->has('service') && $request->service) {
            $query->whereHas('service', function ($q) use ($request) {
                $q->where('slug', $request->service);
            });
        }

        // البحث إذا كان موجوداً
        if ($request->has('search') && $request->search) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        $data = [
            'projects'       => $query->paginate(12),
            'services'       => Service::active()->ordered()->get(),
            'currentService' => $request->service,
            'searchTerm'     => $request->search,
        ];

        return view('web.projects.gallery', compact('data'));
    }

    public function project($id)
    {
        $project = Project::with('service')
            ->active()
            ->findOrFail($id);

        // المشاريع المشابهة (بنفس الخدمة)
        $relatedProjects = Project::with('service')
            ->active()
            ->where('service_id', $project->service_id)
            ->where('id', '!=', $project->id)
            ->ordered()
            ->limit(4)
            ->get();

        $data = [
            'project'         => $project,
            'relatedProjects' => $relatedProjects,
        ];

        return view('web.projects.single', compact('data'));
    }

    public function services()
    {
        $data = [
            'services'      => Service::active()->ordered()->get(),
            'projectsCount' => Project::active()->count(),
        ];

        return view('web.services.list', $data);
    }

    public function servicesDetails($slug)
    {
        $service = Service::active()->where('slug', $slug)->firstOrFail();

        // المشاريع المرتبطة بهذه الخدمة
        $projects = Project::with('service')
            ->active()
            ->where('service_id', $service->id)
            ->ordered()
            ->paginate(8);

        // خدمات أخرى (للقائمة الجانبية)
        $otherServices = Service::active()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->get();

        $data = [
            'service'       => $service,
            'projects'      => $projects,
            'otherServices' => $otherServices,
            'totalProjects' => $projects->total(),
        ];

        return view('web.services.details', compact('data'));
    }

    /**
     * دالة مساعدة للبحث في الموقع
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('q');

        $results = [
            'services' => Service::active()
                ->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                ->get(),
            'projects' => Project::with('service')
                ->active()
                ->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                ->get(),
        ];

        $data = [
            'searchTerm'   => $searchTerm,
            'results'      => $results,
            'totalResults' => $results['services']->count() + $results['projects']->count(),
        ];

        return view('web.search', $data);
    }

    /**
     * دالة لجلب بيانات الموقع العامة (للاستخدام في الـ Layout)
     */
    public static function getSiteData()
    {
        return [
            'companyName'  => BusinessSetting::getValue('company_name'),
            'tagline'      => BusinessSetting::getValue('tagline'),
            'contactPhone' => BusinessSetting::getValue('contact_phone'),
            'contactEmail' => BusinessSetting::getValue('contact_email'),
            'services'     => Service::active()->ordered()->get(),
        ];
    }
}
