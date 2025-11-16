@extends('web.layout.app')

@section('title', 'Home')

@push('css')
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{ asset('public/assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

        <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>AlRaad - Thunder</h2>
                    <p>For Contracting & Advertising</p>
                    <a href="https://wa.me/9647722234030" class="btn-get-started">Book Appointment</a>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- What We Do Section -->
    <section id="what-we-do" class="what-we-do section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Who are we</h2>
            <p>
                AlRaad stands out as your premier partner for full-spectrum advertising and production services. Our
                expertise extends far beyond event execution and direct marketing—we deliver innovative, all-in-one
                solutions
                paired with creative consultancy to transform your ideas into reality.
            </p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-box">
                        <h3>Our Mission</h3>
                        <p>
                            We are dedicated to making a significant impact on our customers, vendors, and employees
                            through our
                            professional skills. With extensive experience in branding, events, launches, signage,
                            printing, and
                            interior design, AlRaad is equipped to handle all your advertising needs. Our deep
                            expertise is evident
                            in every project we complete.
                        </p>
                        <div class="text-center">
                            <a href="https://wa.me/9647722234030" class="more-btn"><span>Learn More</span> <i
                                    class="bi bi-chevron-right"></i></a>
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

    <!-- Team Section -->
    <section class="team-15 team section" id="team">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Team</h2>
            <p>Meet the professionals behind AlRaad’s success in advertising and contracting.</p>
        </div><!-- End Section Title -->

        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="person">
                            <figure>
                                <img src="{{ asset('public/assets/img/team/team-1.jpg') }}" alt="Joshua Stefan"
                                    class="img-fluid">
                                <div class="social">
                                    <a href="#"><span class="bi bi-facebook"></span></a>
                                    <a href="#"><span class="bi bi-twitter-x"></span></a>
                                    <a href="#"><span class="bi bi-linkedin"></span></a>
                                </div>
                            </figure>
                            <div class="person-contents">
                                <h3>Joshua Stefan</h3>
                                <span class="position">Web Development</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="person">
                            <figure>
                                <img src="{{ asset('public/assets/img/team/team-2.jpg') }}" alt="Sheena Anderson"
                                    class="img-fluid">
                                <div class="social">
                                    <a href="#"><span class="bi bi-facebook"></span></a>
                                    <a href="#"><span class="bi bi-twitter-x"></span></a>
                                    <a href="#"><span class="bi bi-linkedin"></span></a>
                                </div>
                            </figure>
                            <div class="person-contents">
                                <h3>Sheena Anderson</h3>
                                <span class="position">Marketing</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="person">
                            <figure>
                                <img src="{{ asset('public/assets/img/team/team-3.jpg') }}" alt="Evan Smith"
                                    class="img-fluid">
                                <div class="social">
                                    <a href="#"><span class="bi bi-facebook"></span></a>
                                    <a href="#"><span class="bi bi-twitter-x"></span></a>
                                    <a href="#"><span class="bi bi-linkedin"></span></a>
                                </div>
                            </figure>
                            <div class="person-contents">
                                <h3>Evan Smith</h3>
                                <span class="position">Content</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="person">
                            <figure>
                                <img src="{{ asset('public/assets/img/team/team-4.jpg') }}" alt="Kaylie Jones"
                                    class="img-fluid">
                                <div class="social">
                                    <a href="#"><span class="bi bi-facebook"></span></a>
                                    <a href="#"><span class="bi bi-twitter-x"></span></a>
                                    <a href="#"><span class="bi bi-linkedin"></span></a>
                                </div>
                            </figure>
                            <div class="person-contents">
                                <h3>Kaylie Jones</h3>
                                <span class="position">Accountant</span>
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
