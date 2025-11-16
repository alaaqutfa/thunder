@extends('web.layout.app')

@section('title', 'Projects Gallery')

@push('css')
@endpush

@section('content')
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Portfolio</h2>
            <p>Explore our recent projects showcasing creativity, quality, and innovation across Iraq.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-signboard">Signboards</li>
                    <li data-filter=".filter-furniture">Furniture</li>
                    <li data-filter=".filter-decoration">Decoration</li>
                    <li data-filter=".filter-booths">Booths & Kiosks</li>
                    <li data-filter=".filter-branding">Branding</li>
                    <li data-filter=".filter-stands">Stands & Gondolas</li>
                </ul><!-- End Portfolio Filters -->

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    <!-- Signboard Example -->
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-signboard">
                        <img src="{{ asset('public/assets/img/portfolio/1.jpg') }}" class="img-fluid"
                            alt="Signboard Project">
                        <div class="portfolio-info">
                            <h4>Signboard Project</h4>
                            <p>High-quality outdoor signage for retail visibility.</p>
                            <a href="assets/img/portfolio/1.jpg" title="Signboard Project"
                                data-gallery="portfolio-gallery-signboard" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <!-- Furniture Example -->
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-furniture">
                        <img src="{{ asset('public/assets/img/portfolio/2.jpg') }}" class="img-fluid"
                            alt="Furniture Project">
                        <div class="portfolio-info">
                            <h4>Furniture Design</h4>
                            <p>Custom furniture solutions for modern interiors.</p>
                            <a href="assets/img/portfolio/2.jpg" title="Furniture Design"
                                data-gallery="portfolio-gallery-furniture" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <!-- Decoration Example -->
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-decoration">
                        <img src="{{ asset('public/assets/img/portfolio/3.jpg') }}" class="img-fluid"
                            alt="Decoration Project">
                        <div class="portfolio-info">
                            <h4>Decoration & Civil Work</h4>
                            <p>Creative decoration and civil work for events and spaces.</p>
                            <a href="assets/img/portfolio/3.jpg" title="Decoration Project"
                                data-gallery="portfolio-gallery-decoration" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <!-- Booths Example -->
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-booths">
                        <img src="{{ asset('public/assets/img/portfolio/4.jpg') }}" class="img-fluid" alt="Booth Project">
                        <div class="portfolio-info">
                            <h4>Booths & Kiosks</h4>
                            <p>Engaging booth designs for exhibitions and retail spaces.</p>
                            <a href="assets/img/portfolio/4.jpg" title="Booth Project"
                                data-gallery="portfolio-gallery-booths" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <!-- Branding Example -->
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <img src="{{ asset('public/assets/img/portfolio/5.jpg') }}" class="img-fluid"
                            alt="Branding Project">
                        <div class="portfolio-info">
                            <h4>Branding & Printing</h4>
                            <p>Creative branding and digital printing solutions.</p>
                            <a href="assets/img/portfolio/5.jpg" title="Branding Project"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <!-- Stands Example -->
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-stands">
                        <img src="{{ asset('public/assets/img/portfolio/6.jpg') }}" class="img-fluid" alt="Stands Project">
                        <div class="portfolio-info">
                            <h4>Stands & Gondolas</h4>
                            <p>Functional stands to showcase products effectively.</p>
                            <a href="assets/img/portfolio/6.jpg" title="Stands Project"
                                data-gallery="portfolio-gallery-stands" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->
@endsection

@push('script')
@endpush
