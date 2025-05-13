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
                                    <th>nip</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $guru = $mysqli->query("SELECT * FROM guru WHERE id_guru");
                                $no = 0;
                                while ($data = mysqli_fetch_array($guru)) {
                                    $no++
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td style="max-width: 50;"><?php echo $data['nip']?></td>
                                        <td><?php echo $data['nama_guru']?></td>
                                        <td><?php echo $data['alamat']?></td>
                                        <td><?php echo $data['no_telp']?></td>
                                        <td align="center">
                                            <img src="/project/templates/uploads/guru/<?php echo $data['foto']?>" width="100" alt="foto guru">
                                        </td>
                                        <td align="center">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#edit-<?php echo $data['id_guru']?>">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <br>

                                            <button class="btn btn-success mb-2 mt-2" data-toggle="modal" data-target="#print-<?php echo $data['id_guru']?>">
                                                <i class="fas fa-print"></i>
                                            </button>

                                            <br>

                                            <button class="btn btn-warning mt-2 mb-2" onclick="resetPassword(<?php echo $data['id_guru']?>)">
                                                <i class="fas fa-key"></i>
                                            </button>
                                            
                                            <br>
                                            <button class="btn btn-danger" onclick="deleteGuru(<?php echo $data ['id_guru']?>)">
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

<?php
    $guru = $mysqli->query("SELECT * FROM guru");
    while ($data = mysqli_fetch_array($guru)) {
?>
<div class="modal fade" id="print-<?php echo $data['id_guru'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Kartu Anggota - <?php echo $data['nama_guru'] ?></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body" id="print-area-<?php echo $data['id_guru'] ?>">
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
                            <p><strong>NIP:</strong> <?php echo $data['nip'] ?></p>
                            <p><strong>Nama:</strong> <?php echo $data['nama_guru'] ?></p>
                            <p><strong>Alamat:</strong> <?php echo $data['alamat'] ?></p>
                            <p><strong>No. Telp:</strong> <?php echo $data['no_telp'] ?></p>
                        </div>

                        <div>
                            <img src="../../templates/uploads/guru/<?php echo $data['foto'] ?>" style="width: 100px; height: 110px; object-fit: cover; border: 1.5px solid #333;">
                        </div>
                    </div>

                    <!-- Footer Tanggal -->
                    <div style="position: absolute; top: 80px; right: 20px; font-size: 12px; color: #555;">
                        ID: <?php echo $data['id_guru'] ?>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button onclick="printDiv('print-area-<?php echo $data['id_guru'] ?>')" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>

        </div>
    </div>
</div>
<?php } ?>

<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h3 class="modal-title">Add Guru</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="?settings=add/add_guru" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nip">nip <span class="text-danger">*</span></label>
                        <input type="number" name="nip" id="nip" class="form-control" required placeholder="Masukan nip">
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password">
                        <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show password
                    </div>

                    <div class="form-group">
                        <label for="nama_guru">Nama guru <span class="text-danger">*</span></label>
                        <input type="text" name="nama_guru" id="nama_guru" class="form-control" placeholder="Masukan nama guru" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control" required placeholder="Masukan alamat"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="no_telp">No telpon <span class="text-danger">*</span></label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Masukan no telp" required>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto <span class="text-danger">*</span></label>
                        <input type="file" name="foto" id="foto" class="form-control" required>
                    </div>

                    <input type="hidden" id="level" name="level" value="guru" readonly>

                    <div class="modal-footer">
                        <input type="reset" value="Reset" class="btn btn-warning float-right">
                        <input type="submit" value="Submit" class="btn btn-info float-right">
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<?php
    $guru = $mysqli->query("SELECT * FROM guru WHERE id_guru");
    while ($eg = mysqli_fetch_array($guru)) {
    ?>

    <div class="modal fade" id="edit-<?php echo $eg['id_guru']?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Edit guru</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="?settings=edit/edit_guru" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_guru" value="<?php echo $eg['id_guru']?>">

                        <div class="form-group">
                            <label for="nip">nip <span class="text-danger">*</span></label>
                            <input type="number" name="nip" id="nip" class="form-control" required placeholder="Masukan nip" value="<?php echo $eg['nip']?>">
                        </div>

                        <div class="form-group">
                            <label for="nama_guru">Nama guru <span class="text-danger">*</span></label>
                            <input type="text" name="nama_guru" id="nama_guru" class="form-control" placeholder="Masukan nama guru" value="<?php echo $eg['nama_guru']?>" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" id="alamat" class="form-control" required placeholder="Masukan alamat"><?php echo $eg['alamat']?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="no_telp">No telpon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Masukan no telp" value="<?php echo $eg['no_telp']?>" required>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto <span class="text-danger">*</span></label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            <br>
                            <p class="text-info">Foto sebelum di edit</p>
                            <img src="/project/templates/uploads/guru/<?php echo $eg['foto']?>" alt="Foto guru" width="150">
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
    
<?php } ?>

<script>
    function printDiv(divId) {
        var content = document.getElementById(divId).innerHTML;
        var original = document.body.innerHTML;
        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = original;
    }
</script>

<script>
    function resetPassword(id_guru) {
        Swal.fire({
            title                   : "Apakah anda yakin?",
            text                    : "Password akan direset menjadi (guru kebon dalem)!",
            icon                    : "warning",
            showCancelButton        : true,
            confirmButtonColor      : "#3085d6",
            cancleButtonColor       : "#d33",
            confirmButtonText       : "Ya, reset!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url     : '?settings=reset/pw_guru',
                    type    : 'POST',
                    data    : {id_guru: id_guru},
                    success : function(respone) {
                        Swal.fire({
                            icon                : 'success',
                            title               : 'Password direset!',
                            text                : 'Password telah direset menjadi (guru kebon dalem)!',
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
    function deleteGuru(id_guru) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data buku yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?settings=delete/delete_guru&id_guru=" + id_guru;
            }
        });
    }
</script>