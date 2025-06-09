<?php
    include "controller/auth.php"
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kebon Dalem | Perpus Digital | Login</title>

        <link href="/project/templates/UI_user/img/icon.png" rel="icon">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="/project/templates/UI_admin/dist/css/adminlte.min.css">

    </head>

    <body class="hold-transition login-page">

        <div class="login-box">

            <div class="login-logo">
                <a href="https://kebondalem.sch.id/" target="_blank">
                    <b class="text" style="color: #8b0420;">Kebon Dalem </b> |
                    <span>Perpustakaan Digital</span>
                </a>
                <br>
                <img src="/project/templates/UI_user/img/logo.png" alt="logo" style="width: 150px; margin: 0.5rem 0;">
            </div>

            <div class="card">
                <div class="card-body login-card-body">

                    <p class="login-box-msg">Sign In</p>

                    <?php if (isset($error_message)) :?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif ;?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="input-group mb-3">
                            <input type="text" name="username" placeholder="Masukan Username" class="form-control" required>
                            <div class="input-group-append">
                                <div class="input-group-text"></div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Masukan Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="checkbox" class="mr-1" onclick="togglePasswordVisibility('password')">  Show password
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6">
                                <a href="/project/" class="btn btn-block">
                                    Kembali <i class="fas fa-backward"></i>
                                </a>
                            </div>

                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Sign In <i class="fas fa-sign-in-alt"></i> 
                                </button>
                            </div>

                        </div>

                    </form>

                    <p class="mb-1 mt-2">
                        <a href="https://api.whatsapp.com/send?phone=6281224034906=&text= hallo pak Saya lupa password akun perpustakaan saya berikut data saya sesuai dengan kartu anggota %0A%0A Id  : %0A NIS : %0A Nama : %0A Kelas : %0A No telp : %0A%0A Sekian Terimakasih" class="nav-link" target="_blank"">I forgot my password</a>
                    </p>

                </div>
            </div>

        </div>

        <script src="/project/templates/js/show.js"></script>

        <script src="/project/templates/UI_admin/plugins/jquery/jquery.min.js"></script>
        <script src="/project/templates/UI_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/project/templates/UI_admin/dist/js/adminlte.min.js"></script>
        <script src="/project/templates/UI_admin/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="/project/templates/UI_admin/plugins/toastr/toastr.min.js"></script>

    </body>

</html>