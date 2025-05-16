<?php 

    $id_user_session = $_SESSION['id_guru'];


    $kunjungan_query = $mysqli->query("SELECT COUNT(*) AS total_kunjungan FROM kunjungan_guru WHERE id_guru = '$id_user_session'");
    $kunjungan = $kunjungan_query->fetch_assoc();
    $poin_kunjungan = $kunjungan['total_kunjungan'] * 2;

    $peminjaman_query = $mysqli->query("SELECT COUNT(*) AS total_peminjaman FROM peminjaman_guru WHERE id_guru = '$id_user_session'");
    $peminjaman = $peminjaman_query->fetch_assoc();
    $poin_peminjaman = $peminjaman['total_peminjaman'] * 5;

    $total = $poin_kunjungan + $poin_peminjaman;
?>

<main class="main">
    <div class="page-title light-background"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <article>
                                    <div class="col-lg-15 sidebar">
                                        <div class="widgets-container">
                                            <div class="blog-author-widget widget-item">
                                                <div class="d-flex flex-column">
                                                    <h2 class="text-center border-bottom">Profile</h2>
                                                    <img src="../../templates/uploads/guru/<?php echo $_SESSION['foto']?>" class="rounded-circle flex-shrink-0" style="margin-left: 11rem;" alt="Foto">
                                                    <h4 style="margin-left: 4rem; text-transform: capitalize;">
                                                        <?php echo $_SESSION['nama_guru']?>
                                                    </h4>
                                                    <p style="margin-left: 4rem;">
                                                        <i class="far fa-id-badge"></i> 
                                                        id guru:
                                                        <?php echo $_SESSION['id_guru']?>
                                                    </p>
                                                    <p style="margin-left: 4rem;">
                                                        <i class="fas fa-at"></i> 
                                                        NIP: 
                                                        <?php echo $_SESSION['nip']?>
                                                    </p>
                                                    <p style="margin-left: 4rem;">
                                                        <i class="fas fa-phone"></i> 
                                                        No Telp:
                                                        <?php echo $_SESSION['no_telp']?>
                                                    </p>
                                                    <p style="margin-left: 4rem;">
                                                        <strong><i class="fas fa-coins"></i> Total Poin: </strong>
                                                        <?php echo $total ?> 
                                                        poin
                                                    </p>
                                                    <button class="btn btn-info mt-2" data-toggle="modal" data-target="#change-pass" style="margin-left: 13px;">
                                                            Change password
                                                    </button>
                                                    <button class="btn btn-success mt-2" data-toggle="modal" data-target="#cetak" style="margin-left: 13px;">
                                                            cetak kartu
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div id="book-container" class="col-lg-4 mt-3 blog-pagination section"></div>

        </div>
    </div>
</main>

<div class="modal" id="change-pass">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Ubah password</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="?settings=reset_pw" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="nip" id="nip" value="<?php echo $_SESSION['nip']?>" readonly>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" id="nip" class="form-control" value="<?php echo $_SESSION['nip']?>" readonly>
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

<script>
    function loadBooks(page = 1) {
        $.ajax({
            url: 'settings/function/fetch_books.php',
            type: 'POST',
            data: { page: page },
            success: function(data) {
                $('#book-container').html(data);
            }
        });
    }

    $(document).ready(function() {
        loadBooks();
    });
</script>

<?php
    $guru = $mysqli->query("SELECT * FROM guru WHERE id_guru = '$id_user_session'");
    while ($data = mysqli_fetch_array($guru)) {
        $id_modal = "cetak-" . $data['id_guru'];
        $id_print = "print-area-" . $data['id_guru'];
?>
<div class="modal fade" id="cetak">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Kartu Anggota - <?php echo $data['nama_guru'] ?></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body" id="<?php echo $id_print; ?>">
                <div style="width: 12cm; height: 6.5cm; border: 2px solid #333; padding: 20px; font-family: Arial, sans-serif; background: #fff; position: relative;">

                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <img src="/project/templates/UI_user/img/logo.png" width="50" style="margin-right: 10px;">
                        <div>
                            <div style="font-size: 14px; font-weight: bold;">KARTU ANGGOTA PERPUSTAKAAN</div>
                            <div style="font-size: 12px;">TK SD SMA Kebon Dalem</div>
                        </div>
                    </div>

                    <hr>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                        
                        <div style="font-size: 13px; line-height: 1.5;">
                            <p><strong>nip:</strong> <?php echo $data['nip'] ?></p>
                            <p><strong>Nama:</strong> <?php echo $data['nama_guru'] ?></p>
                            <p><strong>No. Telp:</strong> <?php echo $data['no_telp'] ?></p>
                        </div>

                        <div>
                            <img src="../../templates/uploads/guru/<?php echo $data['foto'] ?>" style="width: 100px; height: 110px; object-fit: cover; border: 1.5px solid #333;">
                        </div>
                    </div>

                    <div style="position: absolute; top: 70px; right: 20px; font-size: 12px; color: #555;">
                        ID: <?php echo $data['id_guru'] ?>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button onclick="printAndClose('<?php echo $id_print; ?>', '<?php echo $id_modal; ?>')" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>

        </div>
    </div>
</div>
<?php } ?>


<script>
    function printAndClose(printId, modalId) {
        // Ambil isi yang akan dicetak
        var printContents = document.getElementById(printId).innerHTML;
        var originalContents = document.body.innerHTML;

        // Ganti body dengan isi cetakan
        document.body.innerHTML = printContents;
        window.print();

        // Kembalikan isi halaman
        document.body.innerHTML = originalContents;

        // Reload ulang agar tampilan normal + tutup modal
        setTimeout(function () {
            $('#' + modalId).modal('hide'); // Tutup modal spesifik
            location.reload(); // reload agar tampilan kembali seperti semula
        }, 500);
    }
</script>
