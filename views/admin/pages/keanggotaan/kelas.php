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
                                    <th>Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $kelas = $mysqli->query("SELECT * FROM data_kelas join guru ON data_kelas.id_guru = guru.id_guru ORDER BY id_kelas");
                                $no = 0;
                                while ($data = mysqli_fetch_array($kelas)) {
                                    $no++
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td align="center">
                                            <?php echo $data['kelas']?> |
                                            <?php echo $data['indeks_kelas'] ?>
                                        </td>
                                        <td>
                                            <button class="btn" data-toggle="modal" data-target="#modal-tampil-<?php echo $data['id_guru']?>">
                                                <?php echo $data['nama_guru']?>
                                            </button>
                                        </td>
                                        <td align="center">
                                            <buton class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-kelas-<?php echo $data['id_kelas']?>">
                                                <i class="fas fa-edit"></i>
                                            </buton>
                                            <button class="btn btn-danger" onclick="deleteKelas(<?php echo $data['id_kelas']?>)">
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
                <h3 class="modal-title">Add Kelas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="?settings=add/add_kelas" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="kelas">Kelas <span class="text-danger"></span></label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            <option value="">Pilih kelas</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="indeks kelas">Indeks kelas <span class="text-danger">*</span></label>
                        <select name="indeks_kelas" id="indeks_kelas" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                            <option value="J">J</option>
                            <option value="K">K</option>
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="N">N</option>
                            <option value="O">O</option>
                            <option value="P">P</option>
                            <option value="Q">Q</option>
                            <option value="R">R</option>
                            <option value="S">S</option>
                            <option value="T">T</option>
                            <option value="U">U</option>
                            <option value="V">V</option>
                            <option value="W">W</option>
                            <option value="X">X</option>
                            <option value="Y">Y</option>
                            <option value="Z">Z</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="wali kelas">Wali kelas <span class="text-danger">*</span></label>
                        <select name="id_guru" id="id_guru" class="form-control">
                            <option value="">Pilih Walikelas</option>
                            <?php
                                $guru = $mysqli->query("SELECT * FROM guru WHERE id_guru NOT IN (SELECT id_guru FROM data_kelas WHERE id_guru IS NOT NULL) ORDER BY nama_guru");
                                while ($g = mysqli_fetch_array($guru)) {
                            ?>
                                <option value="<?php echo $g['id_guru']?>">
                                    <?php echo $g['nama_guru'] ?>
                                </option>
                            <?php } ?>
                        </select>
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
    $k = $mysqli->query("SELECT * FROM data_kelas JOIN guru ON data_kelas.id_guru = guru.id_guru");
    while ($eke = mysqli_fetch_array($k)) {
    ?>
    <div class="modal fade" id="modal-edit-kelas-<?php echo $eke['id_kelas']?>">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h3 class="modal-title">Edit kelas</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="?settings=edit/edit_kelas" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_kelas" id="id_kelas" value="<?php echo $eke['id_kelas']?>">
                        <div class="form-group">
                            <label for="kelas">Kelas <span class="text-danger"></span></label>
                            <select name="kelas" id="kelas" class="form-control" required>
                                <option value="">Pilih kelas</option>
                                <option value="1" <?php if ($eke['kelas'] == '1') echo 'selected'; ?> >
                                    1
                                </option>
                                <option value="2" <?php if ($eke['kelas'] == '2') echo 'selected'; ?>>
                                    2
                                </option>
                                <option value="3" <?php if ($eke['kelas'] == '3') echo 'selected'; ?>>
                                    3
                                </option>
                                <option value="4" <?php if ($eke['kelas'] == '4') echo 'selected'; ?>>
                                    4
                                </option>
                                <option value="5" <?php if ($eke['kelas'] == '5') echo 'selected'; ?>>
                                    5
                                </option>
                                <option value="6" <?php if ($eke['kelas'] == '6') echo 'selected'; ?>>
                                    6
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="indeks kelas">Indeks kelas <span class="text-danger">*</span></label>
                            <select name="indeks_kelas" id="indeks_kelas" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                <option value="A" <?php if ($eke ['indeks_kelas'] == 'A') echo 'selected'; ?>>A</option>
                                <option value="B" <?php if ($eke ['indeks_kelas'] == 'B') echo 'selected'; ?>>B</option>
                                <option value="C" <?php if ($eke ['indeks_kelas'] == 'C') echo 'selected'; ?>>C</option>
                                <option value="D" <?php if ($eke ['indeks_kelas'] == 'D') echo 'selected'; ?>>D</option>
                                <option value="E" <?php if ($eke ['indeks_kelas'] == 'E') echo 'selected'; ?>>E</option>
                                <option value="F" <?php if ($eke ['indeks_kelas'] == 'F') echo 'selected'; ?>>F</option>
                                <option value="G" <?php if ($eke ['indeks_kelas'] == 'G') echo 'selected'; ?>>G</option>
                                <option value="H" <?php if ($eke ['indeks_kelas'] == 'H') echo 'selected'; ?>>H</option>
                                <option value="I" <?php if ($eke ['indeks_kelas'] == 'I') echo 'selected'; ?>>I</option>
                                <option value="J" <?php if ($eke ['indeks_kelas'] == 'J') echo 'selected'; ?>>J</option>
                                <option value="K" <?php if ($eke ['indeks_kelas'] == 'K') echo 'selected'; ?>>K</option>
                                <option value="L" <?php if ($eke ['indeks_kelas'] == 'L') echo 'selected'; ?>>L</option>
                                <option value="M" <?php if ($eke ['indeks_kelas'] == 'M') echo 'selected'; ?>>M</option>
                                <option value="N" <?php if ($eke ['indeks_kelas'] == 'N') echo 'selected'; ?>>N</option>
                                <option value="O" <?php if ($eke ['indeks_kelas'] == 'O') echo 'selected'; ?>>O</option>
                                <option value="P" <?php if ($eke ['indeks_kelas'] == 'P') echo 'selected'; ?>>P</option>
                                <option value="Q" <?php if ($eke ['indeks_kelas'] == 'Q') echo 'selected'; ?>>Q</option>
                                <option value="R" <?php if ($eke ['indeks_kelas'] == 'R') echo 'selected'; ?>>R</option>
                                <option value="S" <?php if ($eke ['indeks_kelas'] == 'S') echo 'selected'; ?>>S</option>
                                <option value="T" <?php if ($eke ['indeks_kelas'] == 'T') echo 'selected'; ?>>T</option>
                                <option value="U" <?php if ($eke ['indeks_kelas'] == 'U') echo 'selected'; ?>>U</option>
                                <option value="V" <?php if ($eke ['indeks_kelas'] == 'V') echo 'selected'; ?>>V</option>
                                <option value="W" <?php if ($eke ['indeks_kelas'] == 'W') echo 'selected'; ?>>W</option>
                                <option value="X" <?php if ($eke ['indeks_kelas'] == 'X') echo 'selected'; ?>>X</option>
                                <option value="Y" <?php if ($eke ['indeks_kelas'] == 'Y') echo 'selected'; ?>>Y</option>
                                <option value="Z" <?php if ($eke ['indeks_kelas'] == 'Z') echo 'selected'; ?>>Z</option>
                            </select>
                        </div>

                        <div class="form-froup">
                            <label for="wali kelas">Wali kelas <span class="text-danger">*</span></label>
                            <select name="id_guru" id="id_guru" class="form-control" required>
                                <option value="">Pilih Walikelas</option>
                                <option value="<?php echo $eke['id_guru']?>" selected><?php echo $eke['nama_guru']?></option>
                                <?php
                                    $k_guru = $mysqli->query("SELECT * FROM guru WHERE id_guru NOT IN (SELECT id_guru FROM data_kelas WHERE id_guru IS NOT NULL) ORDER BY id_guru");
                                    while ($kg = mysqli_fetch_array($k_guru)) {
                                ?>
                                    <option value="<?php echo $kg['id_guru']?>">
                                        <?php echo $kg['nama_guru'] ?>
                                    </option>
                                <?php } ?>
                            </select>
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

<?php }  ?>

<?php 

    $g = $mysqli->query("SELECT * FROM guru WHERE nip");
    while ($dg = mysqli_fetch_array($g)) {
    ?>

        <div class="modal fade" id="modal-tampil-<?php echo $dg['id_guru']?>">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h3 class="modal-title">Wali kelas</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card card-widget widget-user">

                            <div class="widget-user-header" style="background: url('../../templates/ui_user/img/bg.jpg');">
                                <h4 class="text-left text-white" style="text-transform: capitalize; font-weight: bold;"><?php echo $dg['nama_guru'] ?></h4>
                            </div>

                            <div class="widget-user-image">
                                <img src="../../templates/uploads/guru/<?php echo $dg['foto']?>" alt="Avatar" class="img-circle">
                            </div>

                            <div class="card-footer">
                                <div class="row">

                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                Alamat
                                            </h5>
                                            <span class="description-text"><?php echo $dg['alamat'] ?></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                NIP
                                            </h5>
                                            <span class="description-text"> <?php echo $dg['nip'] ?> </span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">
                                                No Telp
                                            </h5>
                                            <span class="description-text"> <?php echo $dg['no_telp'] ?> </span>
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
    function deleteKelas(id_kelas) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data kelas yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?settings=delete/delete_kelas&id_kelas=" + id_kelas;
            }
        });
    }
</script>