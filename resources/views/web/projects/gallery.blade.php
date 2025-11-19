@extends('web.layout.app')

@section('title', 'Projects Gallery')

@push('css')
@endpush

@section('content')
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Featured Portfolio</h2>
            <p>Explore our recent projects showcasing creativity, quality, and innovation across Iraq.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach ($data['services'] as $service)
                        <li data-filter=".{{ $service['slug'] }}">{{ $service['name'] }}</li>
                    @endforeach

                </ul><!-- End Portfolio Filters -->

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($data['projects'] as $project)
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item {{ $project->service->slug }}">
                            <img src="{{ asset('public/storage/' . $project->main_image) }}" class="img-fluid"
                                alt="{{ $project->name }} Project">
                            <div class="portfolio-info">
                                <h4>{{ $project->name }}</h4>
                                <p>{{ $project->description }}</p>
                                <a href="{{ asset('public/storage/' . $project->main_image) }}"
                                    title="{{ $project->name }}"
                                    data-gallery="portfolio-gallery-{{ $project->service->slug }}"
                                    class="glightbox preview-link">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="{{ route('project.single', $project->id) }}" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->
                    @endforeach

                </div><!-- End Portfolio Container -->

                {{ $data['projects']->links() }}

            </div>

        </div>

    </section><!-- /Portfolio Section -->
@endsection

@push('script')
@endpush
