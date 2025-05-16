    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <script src="/project/templates/UI_user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/project/templates/UI_user/vendor/php-email-form/validate.js"></script>
    <script src="/project/templates/UI_user/vendor/aos/aos.js"></script>
    <script src="/project/templates/UI_user/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/project/templates/UI_user/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/project/templates/UI_user/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/project/templates/UI_user/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/project/templates/UI_user/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <script src="/project/templates/UI_user/js/main.js"></script>

    <script src="/project/templates/UI_admin/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="/project/templates/UI_admin/dist/js/adminlte.js"></script>
    <script src="/project/templates/js/show.js"></script>

<?php
    if (isset($_GET['session_expired']) && $_GET['session_expired'] == 'true') {
        echo "
            <script>
                Swal.fire({
                    icon                : 'warning',
                    title               : 'Session Berakhir',
                    text                : 'Session Anda telah berakhir. Silakan login kembali.',
                    showConfirmButton   : true
                }).then(function() {
                    window.location.href = '/project/views/controller/logout.php';
                });
            </script>
        ";
    }
?>

<script>
    let idleTime = 0;

    document.onmousemove    = resetTimer;
    document.onkeypress     = resetTimer;
    document.ontouchstart   = resetTimer;
    document.ontouchmove    = resetTimer;

    function resetTimer() {
        idleTime = 0;
    }

    setInterval(function () {
        idleTime++;
        if (idleTime >= 1200) {
            Swal.fire({
                icon                : 'warning',
                title               : 'Sesi Berakhir',
                text                : 'Sesi anda telah berakhir. Silakan login kembali.',
                showConfirmButton   : true
            }).then(function() {
                window.location.href = '/project/views/controller/logout.php';
            });
        }
    }, 1000);
</script>