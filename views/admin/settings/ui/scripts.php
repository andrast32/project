<script src="/project/templates/UI_admin/plugins/jquery/jquery.min.js"></script>

<script src="/project/templates/UI_admin/plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="/project/templates/UI_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/project/templates/UI_admin/plugins/chart.js/Chart.min.js"></script>

<script src="/project/templates/UI_admin/plugins/sparklines/sparkline.js"></script>

<script src="/project/templates/UI_admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/project/templates/UI_admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script src="/project/templates/UI_admin/plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="/project/templates/UI_admin/plugins/moment/moment.min.js"></script>
<script src="/project/templates/UI_admin/plugins/daterangepicker/daterangepicker.js"></script>

<script src="/project/templates/UI_admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="/project/templates/UI_admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="/project/templates/UI_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="/project/templates/UI_admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/project/templates/UI_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/project/templates/UI_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/project/templates/UI_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/project/templates/UI_admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/project/templates/UI_admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/project/templates/UI_admin/plugins/jszip/jszip.min.js"></script>
<script src="/project/templates/UI_admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/project/templates/UI_admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/project/templates/UI_admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/project/templates/UI_admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/project/templates/UI_admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="/project/templates/UI_admin/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="/project/templates/UI_admin/dist/js/adminlte.js"></script>

<script>
    $(function() {
        $("#data").DataTable({
            "paging"        : true,
            "searching"     : true,
            "responsive"    : true,
            "lengthChange"  : true,
            "ordering"      : true,
            "info"          : true,
            "autoWidth"     : false,
        });

        $("#laporan").DataTable({
            "paging"        : true,
            "searching"     : true,
            "responsive"    : true,
            "lengthChange"  : true,
            "ordering"      : true,
            "info"          : true,
            "autoWidth"     : false,
            "buttons"       : ["copy", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#laporan_wrapper .col-md-6:eq(0)');
    })
</script>

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
                    window.location.href = '../controller/logout.php';
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
        if (idleTime >= 1200) { // 20 minutes
            Swal.fire({
                icon                : 'warning',
                title               : 'Sesi Berakhir',
                text                : 'Sesi anda telah berakhir. Silakan login kembali.',
                showConfirmButton   : true
            }).then(function() {
                window.location.href = '../controller/logout.php';
            });
        }
    }, 1000);
</script>

</body>

</html>