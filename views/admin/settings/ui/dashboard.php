<?php


    $jumlah_anggota             = $mysqli->query("SELECT * FROM anggota");
    $a                          = mysqli_num_rows($jumlah_anggota);

    $jumlah_guru                = $mysqli->query("SELECT * FROM guru");
    $g                          = mysqli_num_rows($jumlah_guru);

    $jumlah_buku                = $mysqli->query("SELECT * FROM data_buku");
    $b                          = mysqli_num_rows($jumlah_buku);

    $jumlah_kunjungan_anggota   = $mysqli->query("SELECT * FROM kunjungan_anggota");
    $ka                         = mysqli_num_rows($jumlah_kunjungan_anggota);

    $jumlah_kunjungan_guru      = $mysqli->query("SELECT * FROM kunjungan_guru");
    $kg                         = mysqli_num_rows($jumlah_kunjungan_guru);

    $jumlah_peminjaman_anggota  = $mysqli->query("SELECT * FROM peminjaman_anggota");
    $pa                         = mysqli_num_rows($jumlah_peminjaman_anggota);

    $jumlah_peminjaman_guru     = $mysqli->query("SELECT * FROM peminjaman_guru");
    $pg                         = mysqli_num_rows($jumlah_peminjaman_guru);

?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">

                    <div class="inner">
                        <h3>Anggota</h3>
                        <h4><?php echo $a + $g ?></h4>
                    </div>

                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">

                    <div class="inner">
                        <h3>Buku</h3>
                        <h4><?php echo $b ?></h4>
                    </div>

                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">

                    <div class="inner">
                        <h2>Kunjungan</h2>
                        <h4><?php echo $ka + $kg ?></h4>
                    </div>

                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">

                    <div class="inner">
                        <h2>Peminjaman</h2>
                        <h4><?php echo $pa + $pg ?></h4>
                    </div>

                    <div class="icon">
                        <i class="fas fa-book-open"></i>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="container-fluid">
        <div class="row">

        <div class="col-md-6">
            <div class="card-body">
                <div class="card card-widget widget-user">

                    <div class="widget-user-header" style="background: url('/project/templates/UI_user/img/bg.jpg');">
                        <h3 class="text-left text-white">
                            <b>Kebon Dalem</b> | Perpustakaan Digital
                        </h3>
                    </div>

                    <div class="widget-user-image">
                        <img src="/project/templates/UI_user/img/logo.png" class="img-circle elevation-2" style="width: 100px; height: 100px;" alt="User Avatar">
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            "Perpustakaan adalah pintu menuju ilmu pengetahuan yang tak terbatas." <br><code class="text-dark"> <b> Elizabeth Fama </b> </code>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-body">

                    <div class="carousel slide" id="foto" data-ride="carousel">

                        <ol class="carousel-indicators">
                            <?php
                                $buku = $mysqli->query("SELECT * FROM data_buku ORDER BY id_buku");
                                $i = 0;
                                while ($db = mysqli_fetch_array($buku)) {
                                    $active = ($i == 0) ? 'active' : '';
                                    echo "<li data-target='#foto' data-slide-to='$i' class='$active'></li>";
                                    $i++;
                                }
                            ?>
                        </ol>

                        <div class="carousel-inner">
                            <?php
                                $buku = $mysqli->query("SELECT * FROM data_buku ORDER BY id_buku");
                                $i = 0;
                                while ($dt_buku = mysqli_fetch_array($buku)) {
                                    $active = ($i == 0) ? 'active' : '';
                                    echo '
                                    <div class="carousel-item '.$active.'">
                                        <img src="/project/templates/uploads/buku/'.$dt_buku['foto'].'" class="d-block img-fluid w-100 object-fit-cover" alt="Cover of the book titled '.$dt_buku['judul'].' by '.$dt_buku['penulis'].'. The cover is displayed in a digital library carousel with a welcoming and educational atmosphere. If any text appears on the cover, it is not transcribed here." style="max-height: 700px !important;">
                                    </div>';
                                    $i++;
                                }
                            ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        </div>
    </div>
