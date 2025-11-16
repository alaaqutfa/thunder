@extends('web.layout.app')

@section('title', 'Services List')

@push('css')
@endpush

@section('content')
    <!-- Services Section -->
    <section id="services" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Services</h2>
            <p>We provide innovative advertising and production solutions tailored to your brand and vision.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-signpost"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Signboards</h3>
                        </a>
                        <p>High-quality signage solutions that make your brand visible and memorable across all
                            locations.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-house-door"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Furniture & Interior Design</h3>
                        </a>
                        <p>Custom furniture and decoration services to create inspiring spaces for your business and
                            events.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-brush"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Branding & Digital Printing</h3>
                        </a>
                        <p>Creative branding and advanced printing solutions that bring your ideas to life with
                            precision.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Booths & Kiosks</h3>
                        </a>
                        <p>Design and construction of booths and kiosks that attract attention and engage your
                            audience.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-display"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Stands & Gondolas</h3>
                        </a>
                        <p>Functional and stylish stands that showcase your products effectively in exhibitions and
                            retail spaces.
                        </p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Creative Consultancy</h3>
                        </a>
                        <p>Expert guidance to transform your vision into impactful campaigns and memorable customer
                            experiences.
                        </p>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Services Section -->
@endsection

@push('script')
@endpush
