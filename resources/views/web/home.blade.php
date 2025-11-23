{{-- @dd($data) --}}
@extends('web.layout.app')

@section('title', 'Home')

@push('css')
@endpush

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{ asset($data['heroImg'] ?? 'public/assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

        <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>{{ $data['identity_name'] }}</h2>
                    <p>{{ $data['tagline'] }}</p>
                    <a href="{{ $data['contactPhone'] }}"
                        class="btn-get-started">{{ $data['heroBtnText'] ?? 'Book Appointment' }}</a>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- What We Do Section -->
    <section id="what-we-do" class="what-we-do section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $data['aboutTitle'] }}</h2>
            <p>
                {{ $data['aboutContent'] }}
            </p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-box">
                        <h3>{{ $data['missionTitle'] }}</h3>
                        <p>
                            {{ $data['missionContent'] }}
                        </p>
                        <div class="text-center">
                            <a href="{{ $data['contactPhone'] }}" class="more-btn">
                                <span>Learn More</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Why Box -->

                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-lightbulb"></i>
                                <h4>Innovative Branding</h4>
                                <p>We craft creative branding and digital printing solutions that transform ideas
                                    into impactful
                                    visuals.</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-building"></i>
                                <h4>Spaces that Inspire</h4>
                                <p>From booths and kiosks to furniture and civil work, we design environments that
                                    engage and impress.
                                </p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-globe"></i>
                                <h4>Nationwide Reach</h4>
                                <p>Our teams cover every corner of Iraq, delivering consistent quality and support
                                    wherever you are.
                                </p>
                            </div>
                        </div><!-- End Icon Box -->

                    </div>
                </div>

            </div>

        </div>

    </section><!-- /What We Do Section -->

    <!-- Video -->
    <article data-aos="fade-up">
        <video autoplay muted loop id="heroVideo" style="width:100%; object-fit:cover;">
            <source src="{{ asset($data['heroVideo'] ?? 'public/assets/video/thunder-motion.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </article><!-- End Video -->

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
                    @foreach ($data['featuredProjects'] as $project)
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item {{ $project->service->slug }}">
                            <img src="{{ asset('public/storage/' . $project->main_image) }}"
                                class="img-fluid object-contain" style="max-height:300px; width:auto; transition:0.3s;"
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

                {{ $data['featuredProjects']->links() }}

            </div>

        </div>

    </section><!-- /Portfolio Section -->

    <!-- Video -->
    <article data-aos="fade-up">
        <video autoplay muted loop id="heroVideo" style="width:100%; object-fit:cover;">
            <source src="{{ asset($data['heroVideo'] ?? 'public/assets/video/thunder-print.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </article><!-- End Video -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimonials</h2>
            <p>What our clients say about AlRaad’s services and expertise.</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 40
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 10
            }
          }
        }
      </script>
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('public/assets/img/testimonials/testimonials-1.jpg') }}"
                                class="testimonial-img" alt="Client Testimonial">
                            <h3>Ahmed Saleh</h3>
                            <h4>Retail Business Owner</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>AlRaad transformed our store with stunning signboards and branding. Customers
                                    immediately
                                    noticed the difference!</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('public/assets/img/testimonials/testimonials-3.jpg') }}"
                                class="testimonial-img" alt="Client Testimonial">
                            <h3>Layla Hassan</h3>
                            <h4>Event Manager</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Their booths and kiosks were a highlight of our exhibition. Professional,
                                    creative, and
                                    delivered on time.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('public/assets/img/testimonials/testimonials-4.jpg') }}"
                                class="testimonial-img" alt="Client Testimonial">
                            <h3>Omar Khalid</h3>
                            <h4>Marketing Director</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>AlRaad’s digital printing and branding services gave our campaign a fresh,
                                    modern look that
                                    resonated with our audience.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Testimonials Section -->

    <!-- Partners Section -->
    <section id="partners" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Partners</h2>
            <p>
                Brands who trust AlRaad to deliver quality and innovation.
            </p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 4000,
              "autoplay": {
                "delay": 0,
                "disableOnInteraction": false
              },
              "slidesPerView": "auto",
              "centeredSlides": false,
              "spaceBetween": 30,
              "freeMode": true
            }
            </script>

                <div class="swiper-wrapper">

                    @foreach ($data['brands'] as $brand)
                        <div class="swiper-slide"
                            style="width:120px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('storage/app/public/' . $brand->logo) }}" alt="{{ $brand->name }}"
                                style="max-height:55px; width:auto; opacity:0.8; transition:0.3s;"
                                onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                        </div>
                    @endforeach

                    {{-- تكرار الشعارات لعمل تأثير الحركة المستمرة --}}
                    @foreach ($data['brands'] as $brand)
                        <div class="swiper-slide"
                            style="width:120px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('storage/app/public/' . $brand->logo) }}" alt="{{ $brand->name }}"
                                style="max-height:55px; width:auto; opacity:0.8; transition:0.3s;"
                                onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

    </section>
    <!-- /Partners Section -->

    <!-- Team Section -->
    <section class="team-15 team section light-background" id="team">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Team</h2>
            <p>Meet the professionals behind AlRaad’s success in advertising and contracting.</p>
        </div><!-- End Section Title -->

        <div class="content">

            <div class="container">

                <div class="row">

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="person">
                            <figure>
                                <img src="{{ asset('public/assets/img/team/team-1.png') }}" alt="Joshua Stefan"
                                    class="img-fluid">
                                <div class="social">
                                    <a href="#"><span class="bi bi-facebook"></span></a>
                                    <a href="#"><span class="bi bi-twitter-x"></span></a>
                                    <a href="#"><span class="bi bi-linkedin"></span></a>
                                </div>
                            </figure>
                            <div class="person-contents">
                                <h3>Mohamed Raad Mohamed</h3>
                                <span class="position">CEO & Owner</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="person">
                            <figure>
                                <img src="{{ asset('public/assets/img/team/team-2.png') }}" alt="Sheena Anderson"
                                    class="img-fluid">
                                <div class="social">
                                    <a href="#"><span class="bi bi-facebook"></span></a>
                                    <a href="#"><span class="bi bi-twitter-x"></span></a>
                                    <a href="#"><span class="bi bi-linkedin"></span></a>
                                </div>
                            </figure>
                            <div class="person-contents">
                                <h3>Fadi Debs</h3>
                                <span class="position">COO & Co Founder</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="person">
                            <figure>
                                <img src="{{ asset('public/assets/img/team/team-3.png') }}" alt="Evan Smith"
                                    class="img-fluid">
                                <div class="social">
                                    <a href="#"><span class="bi bi-facebook"></span></a>
                                    <a href="#"><span class="bi bi-twitter-x"></span></a>
                                    <a href="#"><span class="bi bi-linkedin"></span></a>
                                </div>
                            </figure>
                            <div class="person-contents">
                                <h3>Ahmad Khayat</h3>
                                <span class="position">Art Director</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section><!-- /Team Section -->
@endsection

@push('script')
@endpush
