<?php

    if (isset($_GET['id_buku'])) {
        $id_buku = $_GET['id_buku'];

        $buku = $mysqli->query("SELECT * FROM data_buku WHERE id_buku='$id_buku'");

        if ($data = mysqli_fetch_array($buku)) {
?>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <a href="?page=data_buku" class="bi bi-arrow-left-circle-fill"> Kembali</a>
                        <section id="blog-details" class="blog-details section">
                            <div class="container">
                                <article class="article">
                                    <div class="post-img">
                                        <img src="/project/templates/uploads/buku/<?php echo $data['foto']?>" alt="foto buku" class="img-fluid"/>
                                    </div>

                                    <h2 class="title">
                                        <?php echo $data['kode_buku']?> | <?php echo $data['judul']?>
                                    </h2>

                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-person"></i>
                                                <a href="#"><?php echo $data['penulis']?></a>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-book"></i>
                                                <a href="#"><?php echo $data['penerbit']?></a>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-clock"></i>
                                                <a href="#"><?php echo $data['tahun_terbit']?></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="content">
                                        <p>
                                            <?php 
                                                $deskripsi = str_replace(".", "<br>", $data['deskripsi']);
                                                echo substr($deskripsi, 0, 541) . ' ...';
                                            ?>
                                        </p>
                                    </div>
                                </article>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

<?php
    } else {
        echo "Buku tidak ditemukan!";
    }
} else {
    echo "ID buku tidak ada!";
}
?>