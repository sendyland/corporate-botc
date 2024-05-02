<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Corporate Blueocean</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="landing/assets/img/botc-logo.png" rel="icon">
    <link href="landing/assets/img/botc-logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="landing/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="landing/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="landing/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="landing/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="landing/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Variables CSS Files. Uncomment your preferred color scheme -->
    <link href="landing/assets/css/variables.css" rel="stylesheet">
    <!-- <link href="landing/assets/css/variables-blue.css" rel="stylesheet"> -->
    <!-- <link href="landing/assets/css/variables-green.css" rel="stylesheet"> -->
    <!-- <link href="landing/assets/css/variables-orange.css" rel="stylesheet"> -->
    <!-- <link href="landing/assets/css/variables-purple.css" rel="stylesheet"> -->
    <!-- <link href="landing/assets/css/variables-red.css" rel="stylesheet"> -->
    <!-- <link href="landing/assets/css/variables-pink.css" rel="stylesheet"> -->

    <!-- Template Main CSS File -->
    <link href="landing/assets/css/main.css" rel="stylesheet">
    <style>
        header#header {
            background: #0ea2bd5c;
        }

        a.nav-link.scrollto {
            color: white;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="{{ route('welcome') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="landing/assets/img/logo-header.png" class="logo-header">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="index.html#home">Home</a></li>
                    <li><a class="nav-link scrollto" href="https://learning.blueocean-tc.com/about-us/">About</a></li>
                    <li><a class="nav-link scrollto" href="https://learning.blueocean-tc.com">Learning</a></li>
                    <li><a class="nav-link scrollto" href="https://info.blueocean-tc.com">Check Certificate</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><!-- .navbar -->

            <a class="btn-getstarted scrollto" href="{{ route('register') }}">Register Now</a>

        </div>
    </header><!-- End Header -->

    <section id="hero-fullscreen" class="hero-fullscreen d-flex align-items-center">
        <div class="container d-flex flex-column align-items-center position-relative" data-aos="zoom-out">
            <h2>Welcome to <span>Blueocean Corporate</span></h2>
            <p>Blueocean Training Center For Corporate</p>
            <div class="d-flex">
                <a href="{{ route('register') }}" class="btn-get-started scrollto">Register Now</a>
                <a href="https://youtu.be/mgqMCNi_rZg" class="glightbox btn-watch-video d-flex align-items-center"><i
                        class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
        </div>
    </section>

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-activity icon"></i></div>
                            <h4><a href="" class="stretched-link">Daftar</a></h4>
                            <p>Langkah awal cukup daftarkan dulu perusahaan mu di website ini</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                            <h4><a href="" class="stretched-link">Course</a></h4>
                            <p>Pilih Course yang di inginkan lalu pilih</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                            <h4><a href="" class="stretched-link">Peserta</a></h4>
                            <p>Tentukan jumlah peserta yang diinginkan</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-broadcast icon"></i></div>
                            <h4><a href="" class="stretched-link">Transaksi</a></h4>
                            <p>Lakukan transaksi sesuai jumlah yang suka di tentukan.</p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>
        </section><!-- End Featured Services Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>About Us</h2>
                    <p>Blueocean Training Center Corporate Ini adalah sebuah program yang di buat untuk perusahaan yang
                        ingin upgrade skill karyawan nya dengan harga yang murah tetapi berkualitas.</p>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container" data-aos="zoom-out">

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="landing/assets/img/clients/client-1.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="landing/assets/img/clients/client-2.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="landing/assets/img/clients/client-3.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="landing/assets/img/clients/client-4.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="landing/assets/img/clients/client-5.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="landing/assets/img/clients/client-6.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="landing/assets/img/clients/client-7.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="landing/assets/img/clients/client-8.png"
                                class="img-fluid" alt=""></div>
                    </div>
                </div>

            </div>
        </section><!-- End Clients Section -->

        <!-- ======= Call To Action Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-out">

                <div class="row g-5">

                    <div
                        class="col-lg-8 col-md-6 content d-flex flex-column justify-content-center order-last order-md-first">
                        <h3>Alias sunt quas <em>Cupiditate</em> oluptas hic minima</h3>
                        <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                            mollit anim id est laborum.</p>
                        <a class="cta-btn align-self-start" href="#">Call To Action</a>
                    </div>

                    <div class="col-lg-4 col-md-6 order-first order-md-last d-flex align-items-center">
                        <div class="img">
                            <img src="landing/assets/img/cta.jpg" alt="" class="img-fluid">
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Call To Action Section -->

        <!-- ======= On Focus Section ======= -->
        <section id="onfocus" class="onfocus">
            <div class="container-fluid p-0" data-aos="fade-up">

                <div class="row g-0">
                    <div class="col-lg-6 video-play position-relative">
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                    </div>
                    <div class="col-lg-6">
                        <div class="content d-flex flex-column justify-content-center h-100">
                            <h3>Voluptatem dignissimos provident quasi corporis</h3>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</li>
                                <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in
                                    voluptate velit.</li>
                                <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                                    storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                            <a href="#" class="read-more align-self-start"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End On Focus Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Our Services</h2>
                    <p>
                    <p>Belajar langsung dari para ahli dibidang Tata Boga dan Bahasa Asing dengan Kurikulum Standar
                        Nasional dan Internasional yang dikemas dengan <strong>Sistematis, Terukur dan Efektif</strong>
                    </p>
                    </p>
                </div>

                <div class="row gy-5">

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item">
                            <div class="img">
                                <img src="landing/assets/img/services-1.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>ShipCook Training</h3>
                                </a>
                                <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus
                                    dolores iure perferendis.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="service-item">
                            <div class="img">
                                <img src="landing/assets/img/services-2.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-broadcast"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Steward Training</h3>
                                </a>
                                <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque
                                    eum hic non ut nesciunt dolorem.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="service-item">
                            <div class="img">
                                <img src="landing/assets/img/services-3.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-easel"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Food Handling</h3>
                                </a>
                                <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id
                                    voluptas adipisci eos earum corrupti.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->
                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">

                <div class="testimonials-slider swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="landing/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>

                                    I wanted to place a review since their support helped me within a day or so, which
                                    is nice! Thanks and 5 stars!
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="landing/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>

                                    ThemeMove deserves 5 star for theme's features, design quality, flexibility, and
                                    support service!
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="landing/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>

                                    Very good and fast support during the week. They know what you need, exactly when
                                    you need it.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="landing/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>

                                    I wanted to place a review since their support helped me within a day or so, which
                                    is nice! Thanks and 5 stars!
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <h3>Blueocean</h3>
                            <p>
                                Jl. Bekasi Timur Raya No.33A, RT.1/RW.1
                                <br>Jatinegara Kaum, Kec. Pulo Gadung, Kota Jakarta Timur
                                <br>Daerah Khusus Ibukota Jakarta 13250<br><br>
                                <strong>Phone:</strong> (+62) 21 478 677 54<br>
                                <strong>Email:</strong> botcjkt@gmail.com<br>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a
                                    href="https://learning.blueocean-tc.com/course-center/">Cookies Course</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a
                                    href="https://learning.blueocean-tc.com/course-center/">Language Course</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a
                                    href="https://learning.blueocean-tc.com/course-center/">UMKM Couse</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a
                                    href="https://learning.blueocean-tc.com/course-center/">Training Course</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a
                                    href="https://learning.blueocean-tc.com/course-center/">All Program</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        {{-- <h4>Our Newsletter</h4>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form> --}}

                    </div>

                </div>
            </div>
        </div>

        <div class="footer-legal text-center">
            <div
                class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span>Blueocean TC</span></strong>. All Rights Reserved
                    </div>
                </div>

                <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>

            </div>
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="landing/assets/vendor/aos/aos.js"></script>
    <script src="landing/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="landing/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="landing/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="landing/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="landing/assets/js/main.js"></script>

</body>

</html>
