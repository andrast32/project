<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nis'])
            && isset($_POST['id_buku'])
            && isset($_POST['jumlah'])
            && isset($_POST['status'])) {

                $nis                = htmlspecialchars($_POST['nis']);
                $id_buku            = htmlspecialchars($_POST['id_buku']);
                $tanggal_pinjam     = date('Y-m-d');
                $tanggal_kembali    = date('Y-m-d', strtotime($tanggal_pinjam . ' +9 days'));
                $jumlah             = htmlspecialchars($_POST['jumlah']);
                $status             = htmlspecialchars($_POST['status']);

                $stmt = $mysqli->prepare("SELECT stok FROM data_buku WHERE id_buku = ?");
                $stmt->bind_param("s", $id_buku);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row['stok'] < $jumlah) {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops ...',
                                text: 'Stok buku tidak mencukupi!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = '?peminjaman_anggota=peminjaman_anggota';
                            });
                        </script>
                    ";
                } else {
                    $stmt = $mysqli->prepare("INSERT INTO peminjaman_anggota(nis, id_buku, tanggal_pinjam, tanggal_kembali, jumlah, status) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $nis, $id_buku, $tanggal_pinjam, $tanggal_kembali, $jumlah, $status);

                    if ($stmt->execute()) {
                        $stmt_update = $mysqli->prepare("UPDATE data_buku SET stok = stok - ? WHERE id_buku = ?");
                        $stmt_update->bind_param("is", $jumlah, $id_buku);
                        $stmt_update->execute();
                        
                        echo "
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Anggota berhasil meminjam buku',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    window.location.href = '?peminjaman_anggota=peminjaman_anggota';
                                });
                            </script>
                        ";
                    } else {
                        echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops ...',
                                    text: 'Anggota gagal meminjam buku!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    window.location.href = '?peminjaman_anggota=peminjaman_anggota';
                                });
                            </script>
                        ";
                    }
                }
                $stmt->close();
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data tidak lengkap!',   
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = '?peminjaman_anggota=peminjaman_anggota';
                        });
                    </script>
                ";
            }
    } else {
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data tidak lengkap!',
                    showConfirmButton: false,
                    timer: 1000
                }).then(function() {
                    window.location.href = '?peminjaman_anggota=peminjaman_anggota';
                });
            </script>
        ";
    }
?>
