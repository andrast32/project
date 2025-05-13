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

<?php 
    $user = $mysqli->query("SELECT * FROM user ORDER BY id_user");
    while ($u = mysqli_fetch_array($user)) {
?>

    <div class="modal" id="change-pass-<?php echo $u['id_user']?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Ubah password</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="?settings=reset/pw" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_user']?>" readonly>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo $_SESSION['username']?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="current_password">Password saat ini <span class="text-danger">*</span></label>
                            <input type="password" name="current_pass" id="current_pass" class="form-control" placeholder="Masukan password saat ini" required>
                            <input type="checkbox" onclick="togglePasswordVisibility('current_pass')"> Show password
                        </div>

                        <div class="form-group">
                            <label for="new_password">Password baru <span class="text-danger">*</span></label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Masukan password baru" required>
                            <input type="checkbox" onclick="togglePasswordVisibility('new_password')"> Show password
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm password baru <span class="text-danger">*</span></label>
                            <input type="password" name="confrim_pass" id="confrim_pass" class="form-control" placeholder="Konfirmasi password baru" required>
                            <input type="checkbox" onclick="togglePasswordVisibility('confrim_pass')"> Show password
                        </div>

                        <div class="modal-footer">
                            <input type="reset" value="Reset" class="btn btn-primary float-right">
                            <input type="submit" value="Submit" class="btn btn-warning float-right">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

<?php } ?>