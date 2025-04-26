<?php
    include "controller/connect.php";

    // Mendapatkan id_buku dari URL
    if (isset($_GET['id_buku'])) {
        $id_buku = $_GET['id_buku'];

        // Query untuk mengambil data buku berdasarkan id_buku
        $buku = $mysqli->query("SELECT * FROM data_buku WHERE id_buku='$id_buku'");

        // Cek apakah data ditemukan
        if ($data = mysqli_fetch_array($buku)) {
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
                    <link href="../templates/UI_user/img/icon.png" rel="icon">

                    <!-- fonts -->
                    <link href="https://fonts.googleapis.com" rel="preconnect">
                    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

                    <link rel="stylesheet" href="../templates/UI_admin/plugins/fontawesome-free/css/all.min.css">

                    <!-- vendor css file -->
                    <link href="../templates/UI_user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                    <link href="../templates/UI_user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
                    <link href="../templates/UI_user/vendor/aos/aos.css" rel="stylesheet">
                    <link href="../templates/UI_user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
                    <link href="../templates/UI_user/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

                    <!-- main css file -->
                    <link href="../templates/UI_user/css/main.css" rel="stylesheet">

                </head>

                <body class="index-page">

                    <header id="header" class="header d-flex align-items-center sticky-top">
                        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

                            <a href="https://kebondalem.sch.id/" class="logo d-flex align-items-center" target="_blank">
                                <img src="../templates/UI_user/img/logo.png" alt="icon">
                                <h1 class="sitename"><b class="text" style="color: #8b0420;">Kebon Dalem </b> | Perpustakaan Digital.</h1>
                            </a>

                            <nav id="navmenu" class="navmenu">
                                <ul>
                                    <li><a href="../index.php"><i class="fas fa-home" style="margin-right: 5px;"></i> Home</a></li>
                                    <li><a href="#" class="active"><i class="fas fa-book-open" style="margin-right: 5px;"></i> Daftar Buku</a></li>
                                    <li><a href="login.php"><i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i> Login</a></li>
                                </ul>
                                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                            </nav>

                        </div>
                    </header>

                    <main class="main">

                        <div class="page-title light-background">
                            <div class="container">
                                <a href="daftar_buku.php" class="bi bi-arrow-left-circle-fill"> Kembali</a>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-lg">
                                    <section id="blog-details" class="blog-details section">
                                        <div class="container">
                                            <article class="article">

                                                <div class="post-img">
                                                    <img src="../templates/uploads/buku/<?php echo $data['foto']?>" alt="Foto Buku" class="img-fluid"/>
                                                </div>

                                                <h2 class="title">
                                                    <?php echo $data['kode_buku']?> | <?php echo $data['judul']?>
                                                </h2>

                                                <div class="meta-top">
                                                    <ul>
                                                        <li class="d-flex align-items-center">
                                                            <i class="bi bi-person"></i>
                                                            <a href="#"><?php echo $data['penulis']?></a>
                                                        </li>
                                                        <li class="d-flex align-items-center">
                                                            <i class="bi bi-book"></i>
                                                            <a href="#"><?php echo $data['penerbit']?></a>
                                                        </li>
                                                        <li class="d-flex align-items-center">
                                                            <i class="bi bi-clock"></i>
                                                            <a href="#"><?php echo $data['tahun_terbit']?></a>
                                                        </li>
                                                        <li class="d-flex align-items-center">
                                                            <i class="bi bi-collection"></i>
                                                            <a href="#"><?php echo $data['stok']?></a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="content">
                                                    <p>
                                                        <?php 
                                                            $deskripsi = str_replace(".", "<br>", $data['deskripsi']);
                                                            echo substr($deskripsi, 0, 541) . ' ...';
                                                        ?>
                                                    </p>
                                                </div>

                                                <a href="login.php" class="btn btn-success" style="margin-left: 85%;"><i class="bi bi-book"></i> Pinjam Buku</a>

                                            </article>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                    </main>

                    <footer id="footer" class="footer light-background">
                        <div class="container">

                            <div class="copyright d-flex flex-column flex-md-row align-items-center justify-content-md-between">
                                <p>© <span>Copyright</span> <strong class="px-1 sitename">Perpustakaan</strong><span>| Digital</span></p>
                                <div class="credits">
                                    Designed by <a href="https://kebondalem.sch.id/" target="_blank">Kebon Dalem</a>
                                </div>
                            </div>

                        </div>
                    </footer>

                    <!-- Scroll Top -->
                    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

                    <!-- Preloader -->
                    <div id="preloader"></div>

                    <!-- Vendor JS Files -->
                    <script src="../templates/UI_user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="../templates/UI_user/vendor/php-email-form/validate.js"></script>
                    <script src="../templates/UI_user/vendor/aos/aos.js"></script>
                    <script src="../templates/UI_user/vendor/swiper/swiper-bundle.min.js"></script>
                    <script src="../templates/UI_user/vendor/purecounter/purecounter_vanilla.js"></script>
                    <script src="../templates/UI_user/vendor/glightbox/js/glightbox.min.js"></script>
                    <script src="../templates/UI_user/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
                    <script src="../templates/UI_user/vendor/isotope-layout/isotope.pkgd.min.js"></script>

                    <!-- Main JS File -->
                    <script src="../templates/UI_user/js/main.js"></script>

                </body>

            </html>

    <?php 
        } else {
            echo "Buku tidak ditemukan!";
        } 
    } else {
        echo "ID buku tidak ada!";
    }
    $mysqli->close();
?>