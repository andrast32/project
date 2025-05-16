<?php

    session_start();
    if (!isset($_SESSION['nis'])) {
        header("Location: /project/views/login.php");
        exit();
    }

    if ($_SESSION['level'] != 'anggota') {
        header("Location: /project/404.php");
        exit();
    }

    $id_user_session = $_SESSION['nis'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title><?php echo $title; ?></title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <link href="/project/templates/UI_user/img/icon.png" rel="icon">

        <!-- fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/fontawesome-free/css/all.min.css">


        <!-- vendor css file -->
        <link href="/project/templates/UI_user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/project/templates/UI_user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="/project/templates/UI_user/vendor/aos/aos.css" rel="stylesheet">
        <link href="/project/templates/UI_user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="/project/templates/UI_user/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

        <!-- main css file -->
        <link href="/project/templates/UI_user/css/main.css" rel="stylesheet">

        
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/project/templates/UI_admin/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    </head>

    <body class="index-page">

        <header id="header" class="header d-flex align-items-center sticky-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

                <a href="#" class="logo d-flex align-items-center" style="text-decoration: none;">
                    <img src="/project/templates/UI_user/img/logo.png" alt="">
                    <h1 class="sitename"><b style="color: #8b0420;">Perpustakaan</b> Digital | <?php echo $h1; ?></h1>
                </a>