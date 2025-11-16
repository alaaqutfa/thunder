@extends('web.layout.app')

@section('title', 'About us')

@push('css')
@endpush

@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>About Us</h2>
            <p>AlRaad stands out as your premier partner for full-spectrum advertising and production services.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-3">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('public/assets/img/about.jpg') }}" alt="AlRaad Advertising" class="img-fluid">
                </div>

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="about-content ps-0 ps-lg-3">
                        <h3>Transforming ideas into reality with creativity and expertise.</h3>
                        <p class="fst-italic">
                            With extensive experience in branding, events, signage, printing, and interior design,
                            we deliver
                            innovative,
                            all-in-one solutions paired with creative consultancy to make a lasting impact.
                        </p>
                        <ul>
                            <li>
                                <i class="bi bi-diagram-3"></i>
                                <div>
                                    <h4>Comprehensive Services</h4>
                                    <p>From signboards and furniture to booths, kiosks, and digital printing, we
                                        cover it all.</p>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-fullscreen-exit"></i>
                                <div>
                                    <h4>Nationwide Coverage</h4>
                                    <p>Our teams operate across Iraq, ensuring consistent quality and support
                                        wherever you are.</p>
                                </div>
                            </li>
                        </ul>
                        <p>
                            At AlRaad, every project reflects our commitment to excellence, creativity, and customer
                            satisfaction.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Skills Section -->
    <section id="skills" class="skills section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row skills-content skills-animation">

                <div class="col-lg-6">

                    <div class="progress">
                        <span class="skill"><span>Branding & Digital Printing</span> <i class="val">95%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div><!-- End Skills Item -->

                    <div class="progress">
                        <span class="skill"><span>Events & Launches</span> <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div><!-- End Skills Item -->

                    <div class="progress">
                        <span class="skill"><span>Signboards & Outdoor Advertising</span> <i class="val">85%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div><!-- End Skills Item -->

                </div>

                <div class="col-lg-6">

                    <div class="progress">
                        <span class="skill"><span>Interior Design & Decoration</span> <i class="val">80%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div><!-- End Skills Item -->

                    <div class="progress">
                        <span class="skill"><span>Booths & Kiosks</span> <i class="val">75%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div><!-- End Skills Item -->

                    <div class="progress">
                        <span class="skill"><span>Creative Consultancy</span> <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div><!-- End Skills Item -->

                </div>

            </div>

        </div>

    </section><!-- /Skills Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Happy Clients</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Completed Projects</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Hours of Support</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Team Members</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->
@endsection

@push('script')
@endpush
