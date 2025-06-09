<?php
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kebon Dalem | Perpus Digital | logout</title>

        <link href="/project/templates/UI_user/img/icon.png" rel="icon">

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

    </head>

    <body>

        <script>
            if (!sessionStorage.getItem("logoutReloaded")) {
                sessionStorage.setItem("logoutReloaded", "true");

                Swal.fire({
                    title: 'Logout Berhasil!',
                    text: 'Terimakasih telah datang ke perpustakaan.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.reload();
                });

            } else {
                sessionStorage.removeItem("logoutReloaded");
                window.location.href = "/project/index";
            }
        </script>

    </body>
</html>
