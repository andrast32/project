<?php

    session_start();

    include "views/controller/connect.php";

    $jumlah_anggota = $mysqli->query("SELECT * FROM anggota");
    $a = mysqli_num_rows($jumlah_anggota);

    $jumlah_guru = $mysqli->query("SELECT * FROM guru");
    $g = mysqli_num_rows($jumlah_guru);

    $jumlah_buku = $mysqli->query("SELECT * FROM data_buku");
    $b = mysqli_num_rows($jumlah_buku);

    $jumlah_peminjaman_anggota = $mysqli->query("SELECT * FROM peminjaman_anggota");
    $pa = mysqli_num_rows($jumlah_peminjaman_anggota);

    $jumlah_kunjungan_anggota= $mysqli->query("SELECT * FROM kunjungan_anggota");
    $ka = mysqli_num_rows($jumlah_kunjungan_anggota);

    $jumlah_peminjaman_guru = $mysqli->query("SELECT * FROM peminjaman_guru");
    $pg = mysqli_num_rows($jumlah_peminjaman_guru);

    $jumlah_kunjungan_guru= $mysqli->query("SELECT * FROM kunjungan_guru");
    $kg = mysqli_num_rows($jumlah_kunjungan_guru);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Kebon Dalem | Perpus Digital</title>
        <meta content="Kebon Dalem | Perpus Digital" name="description">
        <meta content="Kebon Dalem | Perpus Digital" name="keywords">

        <!-- icon -->
        <link href="templates/UI_user/img/icon.png" rel="icon">
        <link href="templates/UI_user/img/icon.png" rel="apple-touch-icon">

        <!-- fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="templates/UI_admin/plugins/fontawesome-free/css/all.min.css">

        <!-- vendor css file -->
        <link href="templates/UI_user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="templates/UI_user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="templates/UI_user/vendor/aos/aos.css" rel="stylesheet">
        <link href="templates/UI_user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="templates/UI_user/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

        <!-- main css file -->
        <link href="templates/UI_user/css/main.css" rel="stylesheet">

    </head>

    <body class="index-page">

        <header id="header" class="header d-flex align-items-center sticky-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

                <a href="https://kebondalem.sch.id/" class="logo d-flex align-items-center" target="_blank">
                    <img src="templates/UI_user/img/logo.png" alt="icon">
                    <h1 class="sitename"><b class="text" style="color: #8b0420;">Kebon Dalem </b> | Perpustakaan Digital.</h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="/project/" class="active"><i class="fas fa-home" style="margin-right: 5px;"></i> Home</a></li>
                        <li><a href="/project/views/daftar_buku"><i class="fas fa-book-open" style="margin-right: 5px;"></i> Daftar Buku</a></li>
                        <li><a href="/project/views/login"><i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i> Login</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>
        </header>

        <main class="main">

            <!-- About Section -->
            <section id="about" class="about section">

                <div class="container">
                    <div class="row align-items-center justify-content-between">

                        <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2" data-aos="fade-up" data-aos-delay="400">

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
                                        "slidesPerView": 1,
                                        "spaceBetween": 1
                                        }
                                    }
                                    }
                                </script>

                                <div class="swiper-wrapper">
                                    <?php
                                        $buku = $mysqli->query ("SELECT * FROM data_buku ORDER BY id_buku");
                                        while ($dt_buku = mysqli_fetch_array($buku)) {
                                    ?>
                                        <div class="swiper-slide">
                                        <img src="templates/uploads/buku/<?php echo $dt_buku['foto']?>" alt="Image" class="img-fluid lg-2" style="height: 550px; width: 500px; margin-left: 100px;">
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="swiper-pagination"></div>

                            </div>

                        </div>

                        <div class="col-lg-4 order-lg-1">
                            <h1 class="mb-4" data-aos="fade-up">
                                <b class="text" style="color: #8b0420;">Perpus</b>takaan
                            </h1>
                            <p data-aos="fade-up">
                                Perpustakaan adalah tempat yang penuh dengan ilmu pengetahuan, cerita, dan inspirasi. Deretan rak-rak berisi berbagai jenis buku, mulai dari fiksi, non-fiksi, buku pelajaran, hingga ensiklopedia. Suasana perpustakaan yang tenang dan nyaman, menciptakan lingkungan yang ideal untuk belajar dan membaca. Di sudut-sudutnya, terdapat meja-meja dan kursi yang disediakan untuk membaca atau mengerjakan tugas. Bagi banyak orang, perpustakaan adalah tempat yang tak hanya menyediakan buku, tetapi juga menjadi sumber inspirasi dan tempat pelarian dari dunia nyata melalui halaman-halaman yang ada di dalamnya.
                            </p>
                        </div>

                    </div>
                </div>

            </section>
            <!-- /About Section -->

            <!-- About 2 Section -->
            <section id="about-2" class="about-2 section light-background">

                <div class="container">
                    <div class="content">
                        <div class="row justify-content-center">

                            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 order-lg-2 offset-xl-1 mb-4">
                                <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                                    <div class="swiper mySwiper">
                                        <div class="swiper-wrapper">

                                            <div class="swiper-slide">
                                                <img src="templates/UI_user/img/bg1.jpg" alt="Image" class="img-fluid">
                                            </div>

                                            <div class="swiper-slide">
                                                <img src="templates/UI_user/img/bg2.jpg" alt="Image" class="img-fluid">
                                            </div>

                                            <div class="swiper-slide">
                                                <img src="templates/UI_user/img/bg3.jpg" alt="Image" class="img-fluid">
                                            </div>

                                            <div class="swiper-slide">
                                                <img src="templates/UI_user/img/bg4.jpg" alt="Image" class="img-fluid">
                                            </div>

                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="offset-md-0 offset-lg-1 col-sm-12 col-md-5 col-lg-5 col-xl-4" data-aos="fade-up">
                                <div class="px-3">

                                    <h2 class="content-title text-start">
                                        <b class="text" style="color: #8b0420;">Dengan membaca</b>, kita bisa menjelajahi dunia tanpa meninggalkan tempat duduk.
                                    </h2>

                                    <p class="lead">
                                        Dengan membaca, kita bisa menjelajahi dunia tanpa meninggalkan tempat duduk karena buku membuka jendela ke berbagai tempat, waktu, dan pengalaman. 
                                    </p>

                                    <p class="mb-5">
                                        Buku-buku membawa kita ke lokasi-lokasi jauh dan eksotis, menggambarkan sejarah dan budaya berbeda, dan memungkinkan kita untuk merasakan kehidupan orang lain. Melalui membaca, kita mengembangkan imajinasi, memperluas pengetahuan, dan mengembangkan empati, semuanya tanpa perlu berpindah tempat.
                                    </p>

                                    <p>
                                        <a href="/project/views/login" class="btn-get-started">Get Started</a>
                                    </p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- /About 2 Section -->
        
            <!-- Stats Section -->
            <section id="stats" class="stats section light-background">

                <div class="container">

                    <div class="row gy-4 justify-content-center">

                        <div class="col-lg-5">
                            <div class="images-overlap">
                                <img src="templates/UI_user/img/bg4.jpg" alt="student" class="img-fluid img-1" data-aos="fade-up">
                            </div>
                        </div>

                        <div class="col-lg-4 ps-lg-5">

                            <h2 class="content-title"><b class="text" style="color: #8b0420;">Berkunjunglah</b> ke perpustakaan</h2>
                            <p class="lead">
                                dan jadilah murid yang jenius dengan belajar lebih di perpustakaan
                            </p>

                            <div class="row mb-5 count-numbers">

                                <!-- Start Stats Item -->
                                <div class="col-4 counter" data-aos="fade-up" data-aos-delay="100">
                                    <span data-purecounter-separator="true" data-purecounter-start="0" data-purecounter-end="<?php echo $a + $g?>" data-purecounter-duration="1" class="purecounter number"></span>
                                    <span class="d-block">Anggota Perpustakaan</span>
                                </div>
                                <!-- End Stats Item -->

                                <!-- Start Stats Item -->
                                <div class="col-4 counter" data-aos="fade-up" data-aos-delay="200">
                                    <span data-purecounter-separator="true" data-purecounter-start="0" data-purecounter-end="<?php echo $b?>" data-purecounter-duration="1" class="purecounter number"></span>
                                    <span class="d-block">Buku</span>
                                </div>
                                <!-- End Stats Item -->

                                <!-- Start Stats Item -->
                                <div class="col-4 counter" data-aos="fade-up" data-aos-delay="300">
                                    <span data-purecounter-separator="true" data-purecounter-start="0" data-purecounter-end="<?php echo $ka + $kg?>" data-purecounter-duration="1" class="purecounter number"></span>
                                    <span class="d-block">Kunjungan</span>
                                </div>
                                <!-- End Stats Item -->

                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!-- /Stats Section -->

        </main>

        <footer id="footer" class="footer light-background">
            <div class="container">

            <div class="copyright d-flex flex-column flex-md-row align-items-center justify-content-md-between">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">Perpustakaan</strong><span>| Digital</span></p>
                <div class="credits">
                Designed by <a href="#">Kelompok 2</a>
                </div>
            </div>
            </div>
        </footer>

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="templates/UI_user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="templates/UI_user/vendor/php-email-form/validate.js"></script>
        <script src="templates/UI_user/vendor/aos/aos.js"></script>
        <script src="templates/UI_user/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="templates/UI_user/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="templates/UI_user/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="templates/UI_user/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
        <script src="templates/UI_user/vendor/isotope-layout/isotope.pkgd.min.js"></script>

        <!-- Main JS File -->
        <script src="templates/UI_user/js/main.js"></script>

        <script>
            var swiper = new Swiper(".mySwiper", {
                    loop: true,
                    spaceBetween: 20,
                    slidesPerView: 1, // bisa ganti jadi 2 atau 3 sesuai kebutuhan
                    pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
            });
        </script>


    </body>

</html>