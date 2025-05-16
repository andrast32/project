<section id="blog-posts-2" class="blog-posts-2 section">

    <div class="container">

        <div class="row gy-5">

            <?php
                $buku = $mysqli->query("SELECT * FROM data_buku ORDER BY id_buku");
                while ($data = mysqli_fetch_array($buku)) {
            ?>
                <div class="col-lg-4 col-md-6">
                    <article>

                        <div class="post-img">
                            <img src="../../templates/uploads/buku/<?php echo $data['foto']?>" alt="" class="img-fluid">
                        </div>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><a href="blog-details.html"><?php echo $data['penerbit'] ?></a></li>

                                <li class="d-flex align-items-center"><i class="bi bi-dot"></i> <a href="blog-details.html"><?php echo $data['penulis']?></a></li>
                            </ul>
                        </div>

                        <h2 class="title">
                            <a href="?page=detail&id_buku=<?php echo $data['id_buku']; ?>">
                                <?php echo $data ['kode_buku'] ?> |
                                <?php echo $data ['judul'] ?>
                            </a>
                        </h2>

                    </article>
                </div>
            <?php } ?>

        </div>

    </div>

</section>