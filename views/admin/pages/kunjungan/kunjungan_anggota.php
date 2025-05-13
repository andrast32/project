<?php
    $item_anggota = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['cek_anggota'])) {
            $nis = $_POST['nis'];

            $stmt = $mysqli->prepare("SELECT * FROM anggota JOIN data_kelas ON anggota.id_kelas = data_kelas.id_kelas WHERE nis = ?");
            $stmt->bind_param("s", $nis);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $item_anggota = $result->fetch_assoc();
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon                : 'error',
                            title               : 'Oops...',
                            text                : 'NIS tidak ditemukan, pastikan siswa sudah menjadi anggota perpustakaan!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = '?kunjungan_anggota=kunjungan_anggota';
                        });
                    </script>
                ";
            }
            $stmt->close();
        } elseif (isset($_POST['berkunjung'])) {
            $id_siswa = $_POST['id_siswa'];
            $hari = $_POST['hari'];
            $tanggal = $_POST['tanggal'];
            $jam = $_POST['jam'];

            $stmt = $mysqli->prepare("INSERT INTO kunjungan_anggota (id_siswa, hari, tanggal, jam) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $id_siswa, $hari, $tanggal, $jam);

            if ($stmt->execute()) {
                echo "
                    <script>
                        Swal.fire({
                            icon                : 'success',
                            title               : 'Berhasil',
                            text                : 'Siswa berhasil melakukan kunjungan!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = '?kunjungan_anggota=kunjungan_anggota';
                        });
                    </script>
                ";
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon                : 'error',
                            title               : 'Oops...',
                            text                : 'Gagal melakukan kunjungan!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                                window.location.href = '?kunjungan_anggota=kunjungan_anggota';
                        });
                    </script>
                ";
            }
            $stmt->close();

        } elseif (isset($_POST['delete_ka'])) {
            $stmt = $mysqli->prepare("DELETE FROM kunjungan_anggota");

            if ($stmt->execute()) {
                $deleted_rows = $stmt->affected_rows;

                echo "
                    <script>
                        Swal.fire({
                            icon                : 'success',
                            title               : 'Berhasil',
                            text                : '$deleted_rows data kunjungan anggota berhasil dihapus!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = '?kunjungan_anggota=kunjungan_anggota';
                        });
                    </script>
                ";
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon        : 'error',
                            title       : 'Oops...',
                            text        : 'Gagal menghapus data kunjungan!',
                        });
                    </script>
                ";
            }
            $stmt->close();
        }
    }
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header">
                        
                        <h3 class="card-title">
                            <?php echo $h1?> |
                            <button class="btn btn-info" data-toggle="modal" data-target="#add">
                                <i class="fas fa-search"></i>
                            </button>
                        </h3>

                        <button class="btn btn-danger float-right" onclick="delete_ka()">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div class="card-body">

                        <?php if ($item_anggota): ?>
                            <div class="col-md-6" style="margin: 0 15rem;">
                                <div class="card-body">
                                    <div class="card card-widget widget-user">
                                        <div class="widget-user-header" style="background: url('/project/templates/ui_user/img/foto2.jpg');"></div>

                                        <div class="widget-user-image">
                                            <img src="/project/templates/uploads/anggota/<?php echo htmlspecialchars($item_anggota['foto'])?>" alt="Avatar" class="img-circle">
                                        </div>

                                        <div class="card-footer">
                                            <div class="row">

                                                <div class="col-sm-4 border-right border-bottom">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Nama</h5>
                                                        <span class="description-text">
                                                            <?php echo htmlspecialchars($item_anggota['nama_anggota']) ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4 border-right border-bottom">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Kelas</h5>
                                                        <span class="description-text">
                                                            <?php echo htmlspecialchars($item_anggota['kelas']) ?>
                                                            <?php echo htmlspecialchars($item_anggota['indeks_kelas']) ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4 border-right border-bottom">
                                                    <div class="description-block">
                                                        <h5 class="description-header">No Telp</h5>
                                                        <span class="description-text">
                                                            <?php echo htmlspecialchars($item_anggota['no_telp']) ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 mt-2">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_siswa" id="id_siswa" value="<?php echo htmlspecialchars($item_anggota['id_siswa'])?>" readonly>
                                                        <input type="hidden" name="tanggal" id="tanggal" readonly>
                                                        <input type="hidden" name="hari" id="hari" readonly>
                                                        <input type="hidden" class="form-control" name="jam" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('H:i') ; ?>" readonly>
                                                        <button type="submit" name="berkunjung" class="btn btn-info float-right">Berkunjung</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <table id="laporan" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $kunjungan = $mysqli->query("SELECT * FROM kunjungan_anggota JOIN anggota ON kunjungan_anggota.id_siswa = anggota.id_siswa");

                                    $no = 0;
                                    while ($data = mysqli_fetch_array($kunjungan)) {
                                        $no++;
                                ?>
                                    <tr align="center">
                                        <td><?php echo $no ?></td>
                                        <td align="justify">
                                            <button class="btn" data-toggle="modal" data-target="#anggota-<?php echo $data['nis']?>">
                                                <?php echo $data['nama_anggota']?>
                                            </button>
                                        </td>
                                        <td align="justify"><?php echo $data['hari']?></td>
                                        <td><?php echo $data['tanggal'] ?></td>
                                        <td><?php echo $data['jam']?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Cek Anggota</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nis">NIS <span class="text-danger">*</span></label>
                        <input type="text" name="nis" id="nis" class="form-control" required placeholder="Masukan NIS anggota">
                    </div>

                    <div class="input-group-append">
                        <button class="btn btn-info" name="cek_anggota" type="Submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const year = today.getFullYear();

        const formattedDate = `${year}-${month}-${day}`;
        document.getElementById('tanggal').value = formattedDate;

        const days_in_indonesia = {
            'Monday': 'Senin',
            'Tuesday': 'Selasa',
            'Wednesday': 'Rabu',
            'Thursday': 'Kamis',
            'Friday': 'Jumat',
            'Saturday': 'Sabtu',
            'Sunday': 'Minggu'
        };

        const day_english = today.toLocaleString('en-us', { weekday: 'long' });

        const hari_indonesia = days_in_indonesia[day_english];

        document.getElementById('hari').value = hari_indonesia;
    });
</script>

<form method="post" id="delete-ka">
    <input type="hidden" name="delete_ka" id="1">
</form>

<script>
    function delete_ka() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data kunjungan anggota akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-ka').submit();
            }
        });
    }
</script>


<?php
    $a = $mysqli->query("SELECT * FROM anggota JOIN data_kelas ON anggota.id_kelas = data_kelas.id_kelas ORDER BY nis");
    while ($da = mysqli_fetch_array($a)) {
?>
    <div class="modal fade" id="anggota-<?php echo $da['nis']?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Data Anggota</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-widget widget-user">

                        <div class="widget-user-header" style="background: url('/project/templates/ui_user/img/bg.jpg');">
                            <h4 class="text-left text-white" style="text-transform: capitalize; font-weight: bold;"><?php echo $da['nama_anggota'] ?></h4>
                            <h5 class="text-right text-white" style="text-transform: capitalize; font-weight: 500;">
                                <?php echo $da['nis'] ?>
                            </h5>
                        </div>

                        <div class="widget-user-image">
                            <img src="/project/templates/uploads/anggota/<?php echo $da['foto']?>" alt="Avatar" class="img-circle">
                        </div>

                        <div class="card-footer">
                            <div class="row">

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            Kelas
                                        </h5>
                                        <span class="description-text"><?php echo $da['kelas'] ?></span>
                                        <span class="description-text"><?php echo $da['indeks_kelas'] ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            Alamat
                                        </h5>
                                        <span class="description-text"><?php echo $da['alamat'] ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            No Telp
                                        </h5>
                                        <span class="description-text"> <?php echo $da['no_telp'] ?> </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php }?>