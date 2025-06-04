<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <?php echo $h1; ?> |
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
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Kode Rak</th>
                                    <th>Stok</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $no = 1;
                                    $buku = $mysqli->query("SELECT * FROM data_buku ORDER BY id_buku ASC");
                                    while ($data = mysqli_fetch_array($buku)) {
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $no++?></td>
                                        <td align="center"><?php echo $data['kode_buku']?></td>
                                        <td style="width: 50px;"><?php echo $data['judul']?></td>
                                        <td style="width: 50px;"><?php echo $data['kategori']?></td>
                                        <td style="width: 150px;"><?php echo $data['penulis']?></td>
                                        <td>
                                            <?php echo $data['penerbit']?> <br>
                                            <?php echo $data['tahun_terbit']?>
                                        </td>
                                        <td align="center" style="width: 10px;"><?php echo $data['kode_rak']?></td>
                                        <td align="center" style="width: 10px;"><?php echo $data['stok']?></td>
                                        <td align="center" style="width: 10px;">
                                            <img src="/project/templates/uploads/buku/<?php echo $data['foto']?>" alt="<?php echo $data['foto']?>" width="80px" height="auto">
                                        <td align="center" style="width: 10px;">
                                            <button class="btn btn-warning mt-2 mr-1" data-toggle="modal" data-target="#edit-<?php echo $data['id_buku']?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger mt-2 mr-1" onclick="deleteBuku(<?php echo $data['id_buku']?>)">
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

<!--popup add start -->
    <div class="modal fade" id="add">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Tambah Buku</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="?settings=add/add_buku" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="kode">Kode Buku <span class="text-danger">*</span></label>
                            <input type="text" name="kode_buku" id="kode_buku" class="form-control" placeholder="Masukkan Kode Buku" required>
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan Judul Buku" required>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategori" class="form-control" required>

                                <option value="">Pilih Kategori buku</option>
                                <option value="Modul Ajar">Modul Ajar</option>
                                <option value="Komik">Komik</option>
                                <option value="Novel">Novel</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" style="resize: none;" placeholder="Masukan Deskripsi Buku" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="penulis">Penulis <span class="text-danger">*</span></label>
                            <input type="text" name="penulis" id="penulis" class="form-control" placeholder="Masukkan Penulis" required>
                        </div>

                        <div class="form-group">
                            <label for="penerbit">Penerbit <span class="text-danger">*</span></label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control" placeholder="Masukkan Penerbit" required>
                        </div>

                        <div class="form-group">
                            <label for="tahun_terbit">Tahun Terbit <span class="text-danger">*</span></label>
                            <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" placeholder="Masukkan Tahun Terbit" required>
                        </div>

                        <div class="form-group">
                            <label for="rak">Kode Rak <span class="text-danger">*</span></label>
                            <select name="kode_rak" id="kode_rak" class="form-control" required>

                                <option value="">Pilih Kode Rak</option>
                                <option value="A 01">A 01</option>
                                <option value="A 02">A 02</option>
                                <option value="B 01">B 01</option>
                                <option value="B 02">B 02</option>
                                <option value="C 01">C 01</option>
                                <option value="C 02">C 02</option>
                                <option value="D 01">D 01</option>
                                <option value="D 02">D 02</option>
                                <option value="E 01">E 01</option>
                                <option value="E 02">E 02</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" id="stok" class="form-control" placeholder="Masukkan Stok" required>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto <span class="text-danger">*</span></label>
                            <input type="file" name="foto" id="foto" class="form-control" accept=".jpg, .jpeg, .png" required>
                        </div>

                        <div class="modal-footer">

                            <input type="reset" value="Reset" class="btn btn-warning float-right">
                            <input type="submit" value="Simpan" class="btn btn-info float-right">
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
<!--popup add end -->

<!-- popup edit start -->
    <?php
        $buku = $mysqli->query("SELECT * FROM data_buku ORDER BY id_buku");
        while ($e = mysqli_fetch_array($buku)) {
    ?>

        <div class="modal fade" id="edit-<?php echo $e['id_buku']?>">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h3 class="modal-title">Edit Buku</h3>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="?settings=edit/edit_buku" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id_buku" id="id_buku" class="form-control" value="<?php echo $e['id_buku']?>" required readonly>

                            <div class="form-group">
                                <label for="kode">Kode Buku <span class="text-danger">*</span></label>
                                <input type="text" name="kode_buku" id="kode_buku" class="form-control" value="<?php echo $e['kode_buku']?>" placeholder="Masukkan Kode Buku" required>
                            </div>

                            <div class="form-group">
                                <label for="judul">Judul Buku <span class="text-danger">*</span></label>
                                <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $e['judul']?>" placeholder="Masukkan Judul Buku" required>
                            </div>

                            <div class="form-group">
                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategori" class="form-control" required>

                                <option value="">Pilih Kategori buku</option>
                                <option value="Modul Ajar" <?php if($e['kategori'] == 'Modul Ajar') echo 'selected'; ?> >Modul Ajar</option>
                                <option value="Komik" <?php if($e['kategori'] == 'Komik') echo 'selected'; ?> >Komik</option>
                                <option value="Novel" <?php if($e['kategori'] == 'Novel') echo 'selected'; ?> >Novel</option>

                            </select>
                        </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" style="resize: none;" placeholder="Masukan Deskripsi Buku" required><?php echo $e['deskripsi']?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="penulis">Penulis <span class="text-danger">*</span></label>
                                <input type="text" name="penulis" id="penulis" class="form-control" value="<?php echo $e['penulis']?>" placeholder="Masukkan Penulis" required>
                            </div>

                            <div class="form-group">
                                <label for="penerbit">Penerbit <span class="text-danger">*</span></label>
                                <input type="text" name="penerbit" id="penerbit" class="form-control" value="<?php echo $e['penerbit']?>" placeholder="Masukkan Penerbit" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun_terbit">Tahun Terbit <span class="text-danger">*</span></label>
                                <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" value="<?php echo $e['tahun_terbit']?>" placeholder="Masukkan Tahun Terbit" required>
                            </div>

                            <div class="form-group">
                                <label for="rak">Kode Rak <span class="text-danger">*</span></label>
                                <select name="kode_rak" id="kode_rak" class="form-control" required>
                                    
                                    <option value="">Pilih Kode Rak</option>
                                    <option value="A 01" <?php if($e['kode_rak'] == 'A 01') echo 'selected'; ?> >A 01</option>
                                    <option value="A 02" <?php if($e['kode_rak'] == 'A 02') echo 'selected'; ?> >A 02</option>
                                    <option value="B 01" <?php if($e['kode_rak'] == 'B 01') echo 'selected'; ?> >B 01</option>
                                    <option value="B 02" <?php if($e['kode_rak'] == 'B 02') echo 'selected'; ?> >B 02</option>
                                    <option value="C 01" <?php if($e['kode_rak'] == 'C 01') echo 'selected'; ?> >C 01</option>
                                    <option value="C 02" <?php if($e['kode_rak'] == 'C 02') echo 'selected'; ?> >C 02</option>
                                    <option value="D 01" <?php if($e['kode_rak'] == 'D 01') echo 'selected'; ?> >D 01</option>
                                    <option value="D 02" <?php if($e['kode_rak'] == 'D 02') echo 'selected'; ?> >D 02</option>
                                    <option value="E 01" <?php if($e['kode_rak'] == 'E 01') echo 'selected'; ?> >E 01</option>
                                    <option value="E 02" <?php if($e['kode_rak'] == 'E 02') echo 'selected'; ?> >E 02</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stok" id="stok" class="form-control" value="<?php echo $e['stok']?>" placeholder="Masukkan Stok" required>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto <span class="text-danger">*</span></label>
                                <input type="file" name="foto" id="foto" class="form-control" accept=".jpg, .jpeg, .png">
                                <small class="text-danger">* Kosongkan jika tidak ingin mengubah foto</small>
                                <br>
                                <p class="text-info">Foto Sebelum Di edit</p>
                                <img src="/project/templates/uploads/buku/<?php echo $e['foto']?>" alt="<?php echo $e['foto']?>" width="175px" height="auto">
                            </div>

                            <div class="modal-footer">
                                <input type="reset" value="Reset" class="btn btn-warning float-right">
                                <input type="submit" value="Simpan" class="btn btn-info float-right">
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    <?php }?>
<!-- popup edit end -->

<!-- popup delete start -->
    <script>
        function deleteBuku(id_buku) {
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
                    window.location.href = "?settings=delete/delete_buku&id_buku=" + id_buku;
                }
            });
        }
    </script>
<!-- popup delete end -->