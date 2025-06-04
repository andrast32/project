<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <?php echo $h1?> |
                            <button class="btn btn-info" data-toggle="modal" data-target="#add">
                                <i class="fas fa-plus"></i>
                            </button>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="data" class="table table-bordered table-hover">

                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $user = $mysqli->query ("SELECT * FROM user ORDER BY id_user ASC");

                                    $no = 0;
                                    while ($data = mysqli_fetch_array($user)) {
                                        $no++;
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $no; ?></td>
                                        <td><?php echo $data['nama_user']; ?></td>
                                        <td align="center"><img src="/project/templates/uploads/admins/<?php echo $data['foto']?>" alt="User" width="100"></td>
                                        <td align="center">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit-<?php echo $data['id_user']?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" onclick="deletePustakawan(<?php echo $data['id_user']?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php }  ?>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Add Pustakawan -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h3 class="modal-title">Add pustakawan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="?settings=add/add_pustakawan" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input type="email" name="username" id="username" class="form-control" placeholder="Masukan username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password" required>
                        <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show password
                    </div>

                    <div class="form-group">
                        <label for="nama_user">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" placeholder="Masukan nama pustakawan" required>
                    </div>

                    <input type="hidden" readonly name="level" id="level" value="Admin">

                    <div class="form-group">
                        <label for="foto">Foto <span class="text-danger">*</span></label>
                        <input type="file" name="foto" id="foto" class="form-control" required>
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

<?php
    $user = $mysqli->query("SELECT * FROM user WHERE id_user");
    while ($eu = mysqli_fetch_array($user)) {
?>
    <div class="modal fade" id="edit-<?php echo $eu['id_user']?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Edit pustakawan</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="?settings=edit/edit_pustakawan" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_user" id="id_user" value="<?php echo $eu['id_user']?>">

                        <div class="form-group">
                            <label for="nama_user">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama_user" id="nama_user" class="form-control" placeholder="Masukan nama pustakawan" value="<?php echo $eu['nama_user']?>" required>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto <span class="text-danger">*</span></label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            <br>
                            <p class="text-info">Foto sebelum diedit</p>
                            <img src="/project/templates/uploads/admins/<?php echo $eu['foto']?>" alt="Foto user" width="150">
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
<?php } ?>

<script>
    function deletePustakawan(id_user) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data pustakawan yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?settings=delete/delete_pustakawan&id_user=" + id_user;
            }
        });
    }
</script>