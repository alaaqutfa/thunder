@extends('web.layout.app')

@section('title', 'Services')

@push('css')
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Service Details</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Service Details</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

        <div class="container">

            <div class="row gy-5">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

                    <div class="service-box">
                        <h4>Services List</h4>
                        <div class="services-list">
                            <a href="#" class="active"><i
                                    class="bi bi-arrow-right-circle"></i><span>Signboards</span></a>
                            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Furniture & Interior
                                    Design</span></a>
                            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Decoration & Civil
                                    Work</span></a>
                            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Booths & Kiosks</span></a>
                            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Branding & Digital
                                    Printing</span></a>
                            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Stands & Gondolas</span></a>
                        </div>
                    </div><!-- End Services List -->

                    <div class="service-box">
                        <h4>Download Catalog</h4>
                        <div class="download-catalog">
                            <a href="assets/catalog/AlRaad-Catalog.pdf"><i class="bi bi-filetype-pdf"></i><span>Catalog
                                    PDF</span></a>
                            <a href="assets/catalog/AlRaad-Catalog.doc"><i class="bi bi-file-earmark-word"></i><span>Catalog
                                    DOC</span></a>
                        </div>
                    </div><!-- End Download Catalog -->

                    <div class="help-box d-flex flex-column justify-content-center align-items-center">
                        <i class="bi bi-headset help-icon"></i>
                        <h4>Have a Question?</h4>
                        <p class="d-flex align-items-center mt-2 mb-0">
                            <i class="bi bi-telephone me-2"></i> <span>+964 772 223 4030</span>
                        </p>
                        <p class="d-flex align-items-center mt-1 mb-0">
                            <i class="bi bi-envelope me-2"></i>
                            <a href="mailto:swatalraadoffice@gmail.com">swatalraadoffice@gmail.com</a>
                        </p>
                    </div><!-- End Help Box -->

                </div>

                <!-- يمكنك إضافة تفاصيل الخدمة في العمود الآخر -->
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-details-content">
                        <h3>Our Expertise</h3>
                        <p>AlRaad delivers innovative advertising and contracting solutions across Iraq. From creative
                            branding
                            and digital printing to booths, kiosks, and interior design, our team ensures every project
                            reflects
                            excellence and impact.</p>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Service Details Section -->
@endsection

@push('script')
@endpush
