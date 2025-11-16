@extends('web.layout.app')

@section('title', 'Project Details')

@push('css')
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Portfolio Details</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Portfolio Details</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

        <div class="container" data-aos="fade-up">

            <div class="portfolio-details-slider swiper init-swiper">
                <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "navigation": {
            "nextEl": ".swiper-button-next",
            "prevEl": ".swiper-button-prev"
          },
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          }
        }
      </script>
                <div class="swiper-wrapper align-items-center">

                    <div class="swiper-slide">
                        <img src="{{ asset('public/assets/img/portfolio/1.jpg') }}" alt="Signboard Project">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{ asset('public/assets/img/portfolio/2.jpg') }}" alt="Furniture Project">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{ asset('public/assets/img/portfolio/3.jpg') }}" alt="Branding Project">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{ asset('public/assets/img/portfolio/4.jpg') }}" alt="Booth Project">
                    </div>

                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="row justify-content-between gy-4 mt-4">

                <div class="col-lg-8" data-aos="fade-up">
                    <div class="portfolio-description">
                        <h2>Branding & Signage Project</h2>
                        <p>
                            This project highlights AlRaad’s expertise in delivering impactful branding and signage
                            solutions.
                            From concept to execution, our team designed and installed high-quality signboards that enhanced
                            visibility and strengthened the client’s brand presence.
                        </p>
                        <p>
                            The project also included digital printing and creative consultancy, ensuring consistency across
                            all marketing materials. Our innovative approach helped the client stand out in a competitive
                            market.
                        </p>

                        <div class="testimonial-item">
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>“AlRaad transformed our business front with professional signage and branding. The
                                    results
                                    exceeded expectations and attracted more customers.”</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <div>
                                <img src="{{ asset('public/assets/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img"
                                    alt="Client Testimonial">
                                <h3>Ahmed Saleh</h3>
                                <h4>Retail Business Owner</h4>
                            </div>
                        </div>

                        <p>
                            Every detail was carefully executed to reflect the client’s vision. The project demonstrates
                            AlRaad’s commitment to excellence, creativity, and customer satisfaction.
                        </p>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="portfolio-info">
                        <h3>Project Information</h3>
                        <ul>
                            <li><strong>Category</strong> Branding & Signage</li>
                            <li><strong>Client</strong> Local Retail Business</li>
                            <li><strong>Project Date</strong> 15 June, 2024</li>
                            <li><strong>Project Location</strong> Baghdad, Iraq</li>
                            <li><strong>Project URL</strong> <a href="#">www.alraad-project.com</a></li>
                            <li><a href="#" class="btn-visit align-self-start">Visit Website</a></li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Details Section -->
@endsection

@push('script')
@endpush
