<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('role_id', '!=', 5)->with('role')->paginate(10);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        $roles = Role::where('id', '!=', 5)->orderBy('name')->get();
        return view('admin.staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:roles,id', function ($attribute, $value, $fail) {
                if ($value == 5) {
                    $fail('لا يمكن تعيين دور العميل للموظفين.');
                }
            }],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'تم إضافة الموظف بنجاح.');
    }

    public function edit(User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'لا يمكن تعديل بيانات العملاء.');
        }

        $roles = Role::where('id', '!=', 5)->orderBy('name')->get();
        return view('admin.staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'لا يمكن تعديل بيانات العملاء.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $staff->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:roles,id', function ($attribute, $value, $fail) {
                if ($value == 5) {
                    $fail('لا يمكن تعيين دور العميل للموظفين.');
                }
            }],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'تم تحديث بيانات الموظف بنجاح.');
    }

    public function toggleStatus(User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'لا يمكن تغيير حالة العملاء.');
        }

        $staff->is_active = !$staff->is_active;
        $staff->save();

        return redirect()->route('admin.staff.index')->with('success', 'تم تغيير حالة الموظف بنجاح.');
    }

    public function destroy(User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'لا يمكن حذف العملاء.');
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'تم حذف الموظف بنجاح.');
    }
}
