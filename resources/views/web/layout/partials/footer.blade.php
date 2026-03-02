<footer id="footer" class="footer light-background">

    <div class="container footer-top">
        <div class="row gy-4">

            <div class="col-lg-5 col-md-12 footer-about">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                    <span class="sitename">Thunder</span>
                </a>
                <p>Thunder is your trusted partner for contracting & advertising solutions, delivering creative
                    branding,
                    signage, events, and interior design services across Iraq.</p>
                <div class="social-links d-flex mt-4">
                    <a href="https://wa.me/9647722234030" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
                    <a href="https://www.tiktok.com/@thunder.co0" class="tiktok"><i class="bi bi-tiktok"></i></a>
                    <a href="https://www.instagram.com/thunder.co0/" class="instagram">
                        <i class="bi bi-instagram"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100085399755202" class="facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('services.all') }}">Services</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('home') }}">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Our Services</h4>
                <ul>
                    @php($services = get_services())
                    @foreach ($services as $service)
                        <li>
                            <a href="{{ route('services.details', $service->slug) }}">
                                {{ $service->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>Contact Us</h4>
                <p>Baghdad - Al Dawra, Iraq</p>
                <p>Erbil - Gazna Road, Iraq</p>
                <p class="mt-4"><strong>Phone:</strong> <span>+964 772 223 4030</span></p>
                <p><strong>Email:</strong> <span>swatThunderoffice@gmail.com</span></p>
            </div>

        </div>
    </div>

    <div class="container text-center mt-4">
        <p>&copy; 2025 <strong>Thunder</strong>. All Rights Reserved.</p>
    </div>

</footer><!-- /Footer -->
