{{-- @dd($data) --}}
@extends('web.layout.app')

@section('title', $data['project']->name)

@push('css')
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $data['project']->name }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">{{ $data['project']->name }}</li>
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
                <div class="swiper-wrapper align-items-center rounded-lg cursor-pointer">
                    <div class="swiper-slide flex justify-center items-center" style="background-color: rgba(0,0,0,0.05);">
                        <img src="{{ asset('public/storage/' . $data['project']['main_image']) }}" class="object-contain"
                            style="max-height:60vh; width:auto; z-index:2;" alt="{{ $data['project']->name }} main image">
                    </div>

                    @foreach ($data['project']->gallery_images as $img)
                        <div class="swiper-slide flex justify-center items-center rounded-lg cursor-pointer"
                            style="background-color: rgba(0,0,0,0.05);">
                            <img src="{{ asset('public/storage/' . $img) }}" class="object-contain"
                                style="max-height:60vh; width:auto; z-index:2; transition:0.3s;"
                                alt="{{ $data['project']->name }} gallery image">
                        </div>
                    @endforeach

                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="row justify-content-between gy-4 mt-4">

                <div class="col-lg-8" data-aos="fade-up">
                    <div class="portfolio-description">
                        <h2>{{ $data['project']->name }}</h2>
                        <p>
                            {{ $data['project']->description }}
                        </p>

                        {{-- <div class="testimonial-item">
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>“AlRaad transformed our business front with professional signage and branding. The
                                    results
                                    exceeded expectations and attracted more customers.”</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <div>
                                <img src="{{ asset('public/assets/img/testimonials/testimonials-5.jpg') }}"
                                    class="testimonial-img" alt="Client Testimonial">
                                <h3>Ahmed Saleh</h3>
                                <h4>Retail Business Owner</h4>
                            </div>
                        </div>

                        <p>
                            Every detail was carefully executed to reflect the client’s vision. The project demonstrates
                            AlRaad’s commitment to excellence, creativity, and customer satisfaction.
                        </p> --}}
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="portfolio-info">
                        <h3>Project Information</h3>
                        <ul>
                            <li><strong>Category</strong> {{ $data['project']->service->name }}</li>
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
