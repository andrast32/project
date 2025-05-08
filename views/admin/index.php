<?php

    $page = isset($_GET['buku']) ? $_GET['buku'] :
            (isset($_GET['kunjungan_anggota']) ? $_GET['kunjungan_anggota'] :
            (isset($_GET['kunjungan_guru']) ? $_GET['kunjungan_guru'] :
            (isset($_GET['peminjaman_anggota']) ? $_GET['peminjaman_anggota'] :
            (isset($_GET['peminjaman_guru']) ? $_GET['peminjaman_guru'] :
            (isset($_GET['pustakawan']) ? $_GET['pustakawan'] :
            (isset($_GET['guru']) ? $_GET['guru'] :
            (isset($_GET['anggota']) ? $_GET['anggota'] :
            (isset($_GET['kelas']) ? $_GET['kelas'] : 'index'))))))));

    switch($page) {
        case 'data_buku':
            $title = "Kebon Dalem | Perpus Digital | Data Buku";
            $h1 = "Data Buku";
            break;
        case 'kunjungan_anggota':
            $title = "Kebon Dalem | Perpus Digital | Kunjungan Anggota";
            $h1 = "Kunjungan Anggota";
            break;
        case 'kunjungan_guru':
            $title = "Kebon Dalem | Perpus Digital | Kunjungan Guru";
            $h1 = "Kunjungan Guru";
            break;
        case 'peminjaman_anggota':
            $title = "Kebon Dalem | Perpus Digital | Peminjaman Anggota";
            $h1 = "Peminjaman Anggota";
            break;
        case 'peminjaman_guru':
            $title = "Kebon Dalem | Perpus Digital | Peminjaman Guru";
            $h1 = "Peminjaman Guru";
            break;
        case 'pustakawan':
            $title = "Kebon Dalem | Perpus Digital | Pustakawan";
            $h1 = "Pustakawan";
            break;
        case 'guru':
            $title = "Kebon Dalem | Perpus Digital | Guru";
            $h1 = "Guru";
            break;
        case 'anggota':
            $title = "Kebon Dalem | Perpus Digital | Anggota";
            $h1 = "Anggota";
            break;
        case 'kelas':
            $title = "Kebon Dalem | Perpus Digital | Kelas";
            $h1 = "Kelas";
            break;
        default:
            $title = "Kebon Dalem | Perpus Digital | Dashboard";
            $h1 = "Dashboard";
            break;
    }

    include "../controller/connect.php";
    include "settings/ui/header.php";
    include "settings/ui/navbar.php";
    include "settings/ui/sidebar.php";
    ?>

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <?php
                        $titleParts = explode('|', $title);
                        $lastTitle = trim(end($titleParts));
                    ?>

                    <h1 class="m-0">
                        <b class="text" style="color: #8b0420;">Perpustakaan</b> Digital | <?php echo $lastTitle; ?>
                    </h1>

                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <?php
            include "settings/functions/control_page.php";
            ?>
        </section>

    </div>

    <!-- export database start -->
    <div class="modal fade" id="export-db">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Backup Database</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <a href="/project/database/backup.sql" class="btn btn-success float-right">
                        <i class="fas fa-download"></i>
                        Download Database
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- export database end -->

    <!-- Modal Import Database -->
    <div class="modal fade" id="import-db" tabindex="-1" role="dialog" aria-labelledby="importDbLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="?settings=sql/import" method="POST" enctype="multipart/form-data">
                <div class="modal-content">

                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="importDbLabel">Import Database</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih file SQL</label>
                            <input type="file" name="file" id="file" class="form-control" required accept=".sql">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <?php
    include "settings/ui/footer.php";
    include "settings/ui/scripts.php";
?>