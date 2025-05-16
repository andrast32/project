<?php
session_start();
include '../../../controller/connect.php';

$id_user_session = $_SESSION['id_siswa'];
$limit = 1; 
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$start_from = ($page - 1) * $limit;

$pinjam = $mysqli->query("
    SELECT peminjaman_anggota.*, anggota.*, data_buku.*
    FROM peminjaman_anggota 
    JOIN anggota ON peminjaman_anggota.id_siswa = anggota.id_siswa
    JOIN data_buku ON peminjaman_anggota.id_buku = data_buku.id_buku
    WHERE anggota.id_siswa = $id_user_session
    AND peminjaman_anggota.status = 'pinjam'
    LIMIT $start_from, $limit
");

$total_query = $mysqli->query("
    SELECT COUNT(*) AS total FROM peminjaman_anggota 
    JOIN anggota ON peminjaman_anggota.id_siswa = anggota.id_siswa
    WHERE anggota.id_siswa = $id_user_session
    AND peminjaman_anggota.status = 'pinjam'
");

$total_row = $total_query->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);
?>

<div class="row">
    <div class="col mt-5">
        <div class="widgets-container">
            <div class="blog-author-widget widget-item">
                <div class="d-flex flex-column">
                    <h2 class="text-center border-bottom">Buku yang Dipinjam</h2>
                    <?php if ($pinjam->num_rows > 0): ?>
                        <?php while ($d = $pinjam->fetch_assoc()) : ?>
                            <img src="/project/templates/uploads/buku/<?php echo $d['foto']?>" class="flex-shrink-0" alt="foto buku" style="width: 100%; height: 100%; margin: 0 auto;">
                            <h4><?php echo $d['kode_buku'] ?> <br> <?php echo $d['judul'] ?></h4>
                            <div class="social-links">
                                <a href="#">Rak: <?php echo $d['kode_rak'] ?></a> |
                                <a href="#"><?php echo $d['kategori'] ?></a>
                            </div>
                            <p>Kembalikan sebelum tanggal <?php echo $d['tanggal_kembali'] ?></p>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Anda belum meminjam buku. Yuk, mulai pinjam buku dari perpustakaan!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="#" onclick="loadBooks(<?php echo $i ?>)"><?php echo $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
