<?php

    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: /project/views/login.php");
        exit();
    }

    if ($_SESSION['level'] != 'Admin') {
        header("Location: /project/404.php");
    }

    $id_user_session = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>

        <link href="/project/templates/UI_user/img/icon.png" rel="icon">
        <link href="/project/templates/UI_user/img/icon.png" rel="apple-touch-icon">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/fontawesome-free/css/all.min.css">
    
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/jqvmap/jqvmap.min.css">

        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/summernote/summernote-bs4.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/project/templates/UI_admin/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="/project/templates/js/show.js"></script>

    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
