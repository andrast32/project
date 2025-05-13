<?php    
    $item_guru   = null;
    $nip         = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['cek_guru'])) {
            $nip = $_POST['nip'];

            $stmt = $mysqli->prepare("SELECT * FROM guru WHERE nip = ?");
            $stmt->bind_param("s", $nip);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $item_guru = $result->fetch_assoc();
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon                : 'error',
                            title               : 'Oops...',
                            text                : 'nip tidak ditemukan, pastikan guru sudah menjadi anggota perpustakaan!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = '?peminjaman_guru=peminjaman_guru';
                        });
                    </script>
                ";
            }
            $stmt->close();
        } elseif (isset($_POST['kembalikan'])) {
            $id_peminjaman              = $_POST['id_peminjaman'];
            $tanggal_kembali_sekarang   = date('Y-m-d');
    
            $stmt_pinjam = $mysqli->prepare("SELECT jumlah, id_buku FROM peminjaman_guru WHERE id_peminjaman = ?");
            $stmt_pinjam->bind_param("i", $id_peminjaman);
            $stmt_pinjam->execute();
            $result_pinjam = $stmt_pinjam->get_result();

            if ($data_pinjam = $result_pinjam->fetch_assoc()) {
                $stmt_stok = $mysqli->prepare("UPDATE data_buku SET stok = stok + ? WHERE id_buku = ?");
                $stmt_stok->bind_param("is", $data_pinjam['jumlah'], $data_pinjam['id_buku']);
                $stmt_stok->execute();

                $stmt_kembali = $mysqli->prepare("UPDATE peminjaman_guru SET status = 'kembali', tanggal_kembali_buku = ? WHERE id_peminjaman = ?");
                $stmt_kembali->bind_param("si", $tanggal_kembali_sekarang, $id_peminjaman);

                if ($stmt_kembali->execute()) {
    
                    echo "
                        <script>
                            Swal.fire({
                                icon : 'success',
                                title : 'Berhasil.',
                                text : 'Buku berhasil dikembalikan. Terima kasih sudah mengembalikan buku ke perpustakaan!',
                                showConfirmButton : true
                            }).then(function() {
                                window.location.href = '?peminjaman_guru=peminjaman_guru';
                            });
                        </script>";
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal.',
                                text: 'Buku gagal dikembalikan!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = '?peminjaman_guru=peminjaman_guru';
                            });
                        </script>";
                }
                $stmt_kembali->close();
            }
            $stmt_pinjam->close();
        } elseif (isset($_POST['delete_pa'])) {
            $stmt = $mysqli->prepare("DELETE FROM peminjaman_guru WHERE status != 'pinjam'");
            if ($stmt->execute()) {
                $deleted_rows = $stmt->affected_rows;

                echo "
                    <script>
                        Swal.fire({
                            icon                : 'success',
                            title               : 'Berhasil',
                            text                : '$deleted_rows peminjaman guru berhasil dihapus!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = '?peminjaman_guru=peminjaman_guru';
                        });
                    </script>
                ";
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon        : 'error',
                            title       : 'Oops...',
                            text        : 'Gagal menghapus data peminjaman!',
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
                            <?php echo $h1; ?> |
                            <button class="btn btn-info" data-toggle="modal" data-target="#add">
                                <i class="fas fa-search"></i>
                            </button>
                        </h3>

                        <button class="btn btn-danger float-right" onclick="delete_pa()">
                            <i class="fas fa-trash"></i>
                        </button>

                    </div>

                    <div class="card-body">

                        <?php if ($item_guru): ?>
                            <div class="col-md-6" style="margin: 0 15rem;">
                                <div class="card-body">
                                    <div class="card card-widget widget-user">
                                        <div class="widget-user-header" style="background: url('../../templates/ui_user/img/foto2.jpg');"></div>
    
                                        <div class="widget-user-image">
                                            <img src="../../templates/uploads/guru/<?php echo htmlspecialchars($item_guru['foto'])?>" alt="Avatar" class="img-circle">
                                        </div>
    
                                        <div class="card-footer">
                                            <div class="row">
                                                
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Nama</h5>
                                                        <span class="description-text">
                                                            <?php echo htmlspecialchars($item_guru['nama_guru']) ?>
                                                        </span>
                                                    </div>
                                                </div>
    
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">NIP</h5>
                                                        <span class="description-text">
                                                            <?php echo htmlspecialchars($item_guru['nip']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                
    
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">No Telp</h5>
                                                        <span class="description-text">
                                                            <?php echo htmlspecialchars($item_guru['no_telp']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <?php
                                                $id_guru = $item_guru['id_guru'];

                                                $stmt_pinjam = $mysqli->prepare("
                                                    SELECT data_buku.judul, data_buku.kode_buku, peminjaman_guru.id_peminjaman, peminjaman_guru.tanggal_pinjam, peminjaman_guru.jumlah 
                                                    FROM peminjaman_guru 
                                                    JOIN data_buku ON peminjaman_guru.id_buku = data_buku.id_buku 
                                                    WHERE peminjaman_guru.id_guru = ? AND peminjaman_guru.status = 'pinjam'
                                                ");
                                                $stmt_pinjam->bind_param("s", $id_guru);
                                                $stmt_pinjam->execute();

                                                $result_pinjam = $stmt_pinjam->get_result();

                                                if ($result_pinjam->num_rows > 0) {
                                                    echo '
                                                        <div class="row">
                                                            <div class="col mt-4 border-top">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">Data Buku yang Dipinjam</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                }

                                                while ($data_pinjam = $result_pinjam->fetch_assoc()) {
                                                    ?>
        
                                                        <div class="row">
                                                            <div class="col-sm-4 mt-4 border-right border-top border-bottom border-left">
                                                                <div class="description-block">
                                                                    <h5 class="description-header mb-3">judul buku</h5>
                                                                    <span class="description-text">
                                                                        <?php echo htmlspecialchars($data_pinjam['kode_buku']) ?>
                                                                        <br>
                                                                        <?php echo htmlspecialchars($data_pinjam['judul']) ?>
                                                                    </span>
                                                                </div>
                                                            </div>
        
                                                            <div class="col-sm-4 mt-4 border-right border-top border-bottom">
                                                                <div class="description-block">
                                                                    <h5 class="description-header mb-3">Tanggal_pinjam</h5>
                                                                    <span class="description-text">
                                                                        <?php echo htmlspecialchars($data_pinjam['tanggal_pinjam']) ?>
                                                                    </span>
                                                                </div>
                                                            </div>
        
                                                            <div class="col-sm-4 mt-4 border-right border-top border-bottom">
                                                                <div class="description-block">
                                                                    <h5 class="description-header mb-3">jumlah</h5>
                                                                    <span class="description-text">
                                                                        <?php echo htmlspecialchars($data_pinjam['jumlah']) ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <form action="" method="post" class="mt-2">
                                                                <input type="hidden" name="id_peminjaman" value="<?php echo $data_pinjam['id_peminjaman']?>">
                                                                <button type="submit" class="btn btn-outline-info" name="kembalikan">kembalikan buku</button>
                                                            </form>
                                                        </div>
        
                                            <?php } ?>

                                            <?php
                                                $stmt_check_pinjam = $mysqli->prepare("SELECT COUNT(*) as total FROM peminjaman_guru WHERE id_guru = ? AND status = 'pinjam'");
                                                $stmt_check_pinjam->bind_param("s", $id_guru);
                                                $stmt_check_pinjam->execute();
                                                $result_check_pinjam = $stmt_check_pinjam->get_result();
                                                $cek = $result_check_pinjam->fetch_assoc();
                                            ?>

                                            <?php if ($cek['total'] == 0): ?>
                                                <button class="btn btn-info float-right" data-toggle="modal" data-target="#modal-pinjam">
                                                    Pinjam Buku
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal-pinjam">
                                <div class="modal-dialog">
                                    <div class="modal-content">
            
                                        <div class="modal-header">
                                            <h3 class="modal-title">Pinjam Buku</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="?settings=add/add_peminjaman_guru" method="post" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label for="nip">nip <span class="text-danger">*</span></label>
                                                    <input type="hidden" name="id_guru" id="id_guru" class="form-control" value="<?php echo htmlspecialchars($item_guru['id_guru'])?>" required readonly>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($item_guru['nip'])?>" required readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nip">Buku yang akan di pinjam <span class="text-danger">*</span></label>
                                                    <select name="id_buku" id="id_buku" class="form-control" required>
                                                        <option value="">Pilih buku</option>
                                                        <?php
                                                            $b = $mysqli->query("SELECT * FROM data_buku WHERE stok > 0 ORDER BY id_buku");
                                                            while ($db = mysqli_fetch_array($b)) {
                                                        ?>
                                                            <option value="<?php echo $db['id_buku'] ?>">
                                                                <?php echo $db['judul'] ?>
                                                            </option>
                                                        <?php }?>
                                                    </select>
                                                </div>

                                                

                                                <div class="form-group">
                                                    <label for="jumlah">jumlah <span class="text-danger">*</span></label>
                                                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="1" placeholder="Masukan jumlah buku yang di pinjam" required>
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" name="status" id="status" class="form-control" value="pinjam">
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="reset" value="Reset" class="btn btn-warning">
                                                    <input type="submit" value="Submit" class="btn btn-info">
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>

                        <table id="laporan" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th style="width: 20%;">Nama guru</th>
                                    <th style="width: 25%;">Judul buku</th>
                                    <th>tanggal pinjam</th>
                                    <th>rencana tanggal kembali</th>
                                    <th>tanggal kembali</th>
                                    <th>jumlah</th>
                                    <th>status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $a_pinjam = $mysqli->query("SELECT * FROM peminjaman_guru JOIN guru ON peminjaman_guru.id_guru = guru.id_guru JOIN data_buku ON peminjaman_guru.id_buku = data_buku.id_buku");

                                    $no = 0;
                                    while ($data = mysqli_fetch_array($a_pinjam)) {
                                        $no++;
                                ?>

                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td>
                                            <button class="btn" data-toggle="modal" data-target="#guru-<?php echo $data['nip']?>">
                                                <?php echo $data['nama_guru']?>

                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn" data-toggle="modal" data-target="#buku-<?php echo $data['id_buku']?>" style="text-align: left;">
                                                <?php echo $data['judul']?>
                                            </button>
                                        </td>
                                        <td align="center"><?php echo $data['tanggal_pinjam']?></td>
                                        <td align="center"><?php echo $data['tanggal_kembali']?></td>
                                        <td align="center"><?php echo $data['tanggal_kembali_buku']?></td>
                                        <td align="center"><?php echo $data['jumlah']?></td>
                                        <td align="center">
                                            <p class="<?php echo ($data['status'] == 'kembali') ? 'bg-success' : 'bg-warning';?> text-white text-center " style="border-radius: 20%;">
                                                <?php echo $data['status']?>
                                            </p>
                                        </td>
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

<?php
    $b = $mysqli->query("SELECT * FROM data_buku ORDER BY id_buku");
    while ($db = mysqli_fetch_array($b)) {
?>
    <div class="modal fade" id="buku-<?php echo $db['id_buku']?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Data Buku</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-widget widget-user">

                        <div class="widget-user-header" style="background: url('../../templates/ui_user/img/bg.jpg');">
                            <h4 class="text-left text-white" style="text-transform: capitalize; font-weight: bold;"><?php echo $db['judul'] ?></h4>
                            <h4 class="text-left text-white" style="text-transform: capitalize; font-weight: bold;"><?php echo $db['kode_buku'] ?></h4>
                        </div>

                        <div class="widget-user-image">
                            <img src="../../templates/uploads/buku/<?php echo $db['foto']?>" alt="Avatar" class="img-circle">
                        </div>

                        <div class="card-footer">
                            <div class="row">

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            Penulis
                                        </h5>
                                        <span class="description-text"><?php echo $db['penulis'] ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            Penerbit
                                        </h5>
                                        <span class="description-text"> <?php echo $db['penerbit'] ?> </span>
                                    </div>
                                </div>

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            Kode rak
                                        </h5>
                                        <span class="description-text"> <?php echo $db['kode_rak'] ?> </span>
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

<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Cek guru</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nip">nip <span class="text-danger">*</span></label>
                        <input type="text" name="nip" id="nip" class="form-control" required placeholder="Masukan nip guru">
                    </div>

                    <div class="input-group-append">
                        <button class="btn btn-info" name="cek_guru" type="Submit">
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
    });
</script>

<form method="post" id="delete-ka">
    <input type="hidden" name="delete_pa" value="1">
</form>

<script>
    function delete_pa() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-ka').submit();
            }
        });
    }
</script>

<?php
    $a = $mysqli->query("SELECT * FROM guru ORDER BY nip");
    while ($da = mysqli_fetch_array($a)) {
?>
    <div class="modal fade" id="guru-<?php echo $da['nip']?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Data guru</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-widget widget-user">

                        <div class="widget-user-header" style="background: url('../../templates/ui_user/img/bg.jpg');">
                            <h4 class="text-left text-white" style="text-transform: capitalize; font-weight: bold;"><?php echo $da['nama_guru'] ?></h4>
                        </div>

                        <div class="widget-user-image">
                            <img src="../../templates/uploads/guru/<?php echo $da['foto']?>" alt="Avatar" class="img-circle">
                        </div>

                        <div class="card-footer">
                            <div class="row">

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
                                            NIP
                                        </h5>
                                        <span class="description-text"> <?php echo $da['nip'] ?> </span>
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