<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header">
                        <?php echo $h1 ?> |
                        <button class="btn btn-info" data-toggle="modal" data-target="#add">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        <table id="data" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Anggota</th>
                                    <th>Kelas</th>
                                    <th>Alamat</th>
                                    <th>No telp</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $anggota = $mysqli->query("SELECT anggota.*, data_kelas.kelas, data_kelas.indeks_kelas FROM anggota LEFT JOIN data_kelas ON anggota.id_kelas = data_kelas.id_kelas ORDER BY anggota.nis ASC");
                                $no = 0;
                                while ($data = mysqli_fetch_array($anggota)) {
                                    $no++
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $no ?></td>
                                        <td align="center"><?php echo $data['nis'] ?></td>
                                        <td style="text-transform: capitalize; text-align: left;"><?php echo $data['nama_anggota'] ?></td>
                                        <td align="center">
                                            <button class="btn" data-toggle="modal" data-target="#kelas-<?php echo $data['id_kelas']?>">
                                                <?php echo $data['kelas'] ?>
                                                <?php echo $data['indeks_kelas'] ?>
                                            </button>
                                        </td>
                                        <td style="width: 150px;"><?php echo $data['alamat'] ?></td>
                                        <td><?php echo $data['no_telp'] ?></td>
                                        <td align="center">
                                            <img src="../../templates/uploads/anggota/<?php echo $data['foto']?>" alt="foto anggota" width="100">
                                        </td>
                                        <td align="center">

                                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-edit-anggota-<?php echo $data['id_siswa']?>">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <br>

                                            <button class="btn btn-success mb-2 mt-2" data-toggle="modal" data-target="#print-<?php echo $data['id_siswa']?>">
                                                <i class="fas fa-print"></i>
                                            </button>

                                            <br>

                                            <button class="btn btn-warning mb-2 mt-2" onclick="resetPass(<?php echo $data ['id_siswa']?>)">
                                                <i class="fas fa-key"></i>
                                            </button>

                                            <br>

                                            <button class="btn btn-danger" onclick="deleteAnggota(<?php echo $data ['id_siswa']?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>

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

<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Add data anggota</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="?settings=add/add_anggota" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nis">NIS <span class="text-danger">*</span></label>
                        <input type="number" name="nis" id="nis" class="form-control" required placeholder="Masukan NIS">
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password" required>
                        <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show password
                    </div>

                    <div class="form-group">
                        <label for="nama_anggota">Nama Anggota <span class="text-danger">*</span></label>
                        <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" placeholder="Masukan nama anggota">
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas <span class="text-danger"></span></label>
                        <select name="id_kelas" id="id_kelas" required class="form-control">
                            <option value="">Pilih Kelas</option>
                            <?php
                                $kelas = $mysqli->query("SELECT * FROM data_kelas ORDER BY kelas ASC, indeks_kelas ASC");
                                while ($k = mysqli_fetch_array($kelas)) {
                            ?>
                                <option value="<?php echo $k['id_kelas']?>">
                                    <?php echo $k['kelas'] ?> |
                                    <?php echo $k['indeks_kelas'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat lengkap" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="no_telp">No telpon <span class="text-danger">*</span></label>
                        <input type="text" name="no_telp" id="no_telp" placeholder="Masukan no telpon" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto <span class="text-danger">*</span></label>
                        <input type="file" name="foto" id="foto" class="form-control" required>
                    </div>

                    <input type="hidden" id="level" name="level" readonly value="anggota">

                    <div class="modal-footer">
                        <input type="reset" value="Reset" class="btn btn-warning">
                        <input type="submit" value="Submit" class="btn btn-info">
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<?php
    $anggota = $mysqli->query("SELECT anggota.*, data_kelas.kelas, data_kelas.indeks_kelas FROM anggota LEFT JOIN data_kelas ON anggota.id_kelas = data_kelas.id_kelas");
    while ($data = mysqli_fetch_array($anggota)) {
?>
<div class="modal fade" id="print-<?php echo $data['id_siswa'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Kartu Anggota - <?php echo $data['nama_anggota'] ?></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body" id="print-area-<?php echo $data['id_siswa'] ?>">
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
                            <p><strong>NIS:</strong> <?php echo $data['nis'] ?></p>
                            <p><strong>Nama:</strong> <?php echo $data['nama_anggota'] ?></p>
                            <p><strong>Kelas:</strong> <?php echo $data['kelas'] ?> <?php echo $data['indeks_kelas'] ?></p>
                            <p><strong>No. Telp:</strong> <?php echo $data['no_telp'] ?></p>
                        </div>

                        <div>
                            <img src="../../templates/uploads/anggota/<?php echo $data['foto'] ?>" style="width: 100px; height: 110px; object-fit: cover; border: 1.5px solid #333;">
                        </div>
                    </div>

                    <!-- Footer Tanggal -->
                    <div style="position: absolute; top: 80px; right: 20px; font-size: 12px; color: #555;">
                        ID: <?php echo $data['id_siswa'] ?>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                    <button onclick="printDiv('print-area-<?php echo $data['id_siswa'] ?>', 'print-<?php echo $data['id_siswa'] ?>')" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>

        </div>
    </div>
</div>
<?php } ?>

<?php 
    $anggota = $mysqli->query("SELECT anggota.*, data_kelas.kelas, data_kelas.indeks_kelas FROM anggota LEFT JOIN data_kelas ON anggota.id_kelas = data_kelas.id_kelas");

    while ($ea = mysqli_fetch_array($anggota)) {
?>

    <div class="modal fade" id="modal-edit-anggota-<?php echo $ea['id_siswa'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Edit data anggota</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="?settings=edit/edit_anggota" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_siswa" id="id_siswa" value="<?php echo $ea['id_siswa']?>">

                        <div class="form-group">
                            <label for="nis">NIS <span class="text-danger">*</span></label>
                            <input type="number" name="nis" id="nis" class="form-control" required placeholder="Masukan NIS" value="<?php echo $ea['nis']?>">
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Anggota <span class="text-danger">*</span></label>
                            <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" placeholder="Masukan nama anggota" value="<?php echo $ea['nama_anggota']?>">
                        </div>

                        <div class="form-group">
                            <label for="kelas">Kelas <span class="text-danger">*</span></label>
                            <select name="id_kelas" id="id_kelas" class="form-control" required>
                                <option value="<?php echo $ea['id_kelas']?>">
                                    <?php echo $ea ['kelas'] ?>
                                    <?php echo $ea ['indeks_kelas'] ?>
                                </option>

                                <?php
                                    $dkelas = $mysqli->query("SELECT * FROM data_kelas ORDER BY kelas ASC, indeks_kelas ASC");
                                    while ($dk = mysqli_fetch_array($dkelas)) {
                                ?>
                                    <option value="<?php echo $dk['id_kelas']?>">
                                        <?php echo $dk['kelas'] ?>
                                        <?php echo $dk['indeks_kelas'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat lengkap" value="<?php echo $ea['alamat']?>">
                        </div>

                        <div class="form-group">
                            <label for="no_telp">no Telp <span class="text-danger">*</span></label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Masukan no_telp" value="<?php echo $ea['no_telp']?>">
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto <span class="text-danger">*</span></label>
                            <input type="file" name="foto" id="foto" class="form-control">
                                <br>
                            <p class="text-info">Foto sebelum diedit</p>
                            <img src="/project/templates/uploads/anggota/<?php echo $ea['foto']?>" alt="Foto anggota" width="150">
                        </div>

                        <div class="modal-footer">
                            <input type="reset" value="Reset" class="btn btn-warning float-right">
                            <input type="submit" value="Submit" class="btn btn-info float-right">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
<?php }  ?>

<?php  

    $k = $mysqli->query("SELECT * FROM data_kelas JOIN guru ON data_kelas.id_guru = guru.id_guru ORDER BY id_kelas");
    while ($dk = mysqli_fetch_array($k)) {
    ?>

        <div class="modal fade" id="kelas-<?php echo $dk['id_kelas']?>">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h3 class="modal-title">Data Kelas</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card card-widget widget-user">

                            <div class="widget-user-header" style="background: url('../../templates/ui_user/img/bg.jpg');">
                                <h4 class="text-left text-white" style="text-transform: capitalize; font-weight: bold;"><?php echo $dk['nama_guru'] ?></h4>
                                <h5 class="text-right text-white" style="text-transform: capitalize; font-weight: 500;">
                                    kelas
                                    <?php echo $dk['kelas'] ?> |
                                    <?php echo $dk['indeks_kelas'] ?>
                                </h5>
                            </div>

                            <div class="widget-user-image">
                                <img src="/project/templates/uploads/guru/<?php echo $dk['foto']?>" alt="Avatar" class="img-circle">
                            </div>

                            <div class="card-footer">
                                <div class="row">

                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                Alamat
                                            </h5>
                                            <span class="description-text"><?php echo $dk['alamat'] ?></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                NIP
                                            </h5>
                                            <span class="description-text"><?php echo $dk['nip'] ?></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                No Telp
                                            </h5>
                                            <span class="description-text"> <?php echo $dk['no_telp'] ?> </span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    <?php 
    }
?>

<script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>

<script>
    function resetPass(id_siswa) {
        Swal.fire({
            title                   : "Apakah anda yakin?",
            text                    : "Password akan direset menjadi (siswa kebon dalem)!",
            icon                    : "warning",
            showCancelButton        : true,
            confirmButtonColor      : "#3085d6",
            cancleButtonColor       : "#d33",
            confirmButtonText       : "Ya, reset!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url     : '?settings=reset/pw_anggota',
                    type    : 'POST',
                    data    : {id_siswa: id_siswa},
                    success : function(respone) {
                        Swal.fire({
                            icon                : 'success',
                            title               : 'Password direset!',
                            text                : 'Password telah direset menjadi (siswa kebon dalem)!',
                            showConfrimButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.reload();
                        });
                    },
                    error   : function() {
                        Swal.fire({
                            icon                : 'error',
                            title               : 'Oops...',
                            text                : 'Gagal mereset password!',
                            showConfrimButton   : false,
                            timer               : 1500
                        });
                    }
                });
            }
        });
    }
</script>

<script>
    function deleteAnggota(id_siswa) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data anggota yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?settings=delete/delete_anggota&id_siswa=" + id_siswa;
            }
        });
    }
</script>