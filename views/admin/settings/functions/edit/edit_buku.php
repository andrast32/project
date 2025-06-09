<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id_buku'])
            && isset($_POST['kode_buku'])
            && isset($_POST['judul'])
            && isset($_POST['kategori'])
            && isset($_POST['deskripsi'])
            && isset($_POST['penulis'])
            && isset($_POST['penerbit'])
            && isset($_POST['tahun_terbit'])
            && isset($_POST['kode_rak'])
            && isset($_POST['stok'])) {

                $id_buku        = $_POST['id_buku'];
                $kode_buku      = $_POST['kode_buku'];
                $judul          = $_POST['judul'];
                $kategori       = $_POST['kategori'];
                $deskripsi      = $_POST['deskripsi'];
                $penulis        = $_POST['penulis'];
                $penerbit       = $_POST['penerbit'];
                $tahun_terbit   = $_POST['tahun_terbit'];
                $kode_rak       = $_POST['kode_rak'];
                $stok           = $_POST['stok'];
                $foto           = isset($_FILES['foto']) ? $_FILES['foto']['name']: '';
                $tempFoto       = isset($_FILES['foto']) ? $_FILES['foto']['tmp_name']: '';

                $stmt_cek = $mysqli->prepare("SELECT COUNT(*) FROM data_buku WHERE kode_buku = ? AND id_buku != ?");
                $stmt_cek->bind_param("si", $kode_buku, $id_buku);
                $stmt_cek->execute();
                $stmt_cek->bind_result($count);
                $stmt_cek->fetch();
                $stmt_cek->close();

                if ($count > 0) {
                    echo "
                        <script>
                            Swal.fire({
                                icon                : 'error',
                                title               : 'Oops...',
                                text                : 'Kode buku sudah digunakan oleh buku lain!',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function() {
                                window.location.href = '?buku=data_buku';
                            });
                        </script>
                    ";
                    exit;
                }

                $stmt = $mysqli->prepare("UPDATE data_buku SET kode_buku = ?, judul = ?, kategori = ?, deskripsi = ?, penulis = ?, penerbit = ?, tahun_terbit = ?, kode_rak = ?, stok = ? WHERE id_buku = ?");
                $stmt->bind_param("sssssssssi", $kode_buku, $judul, $kategori, $deskripsi, $penulis, $penerbit, $tahun_terbit, $kode_rak, $stok, $id_buku);

                if ($stmt->execute()) {

                    if($foto) {

                        $newFotoName = $id_buku . '.' . pathinfo($foto, PATHINFO_EXTENSION);
                        $target = "../../templates/uploads/buku/" . $newFotoName;

                        if (move_uploaded_file($tempFoto, $target)) {
                            $stmt = $mysqli->prepare("UPDATE data_buku SET foto = ? WHERE id_buku = ?");
                            $stmt->bind_param("si", $newFotoName, $id_buku);
                            $stmt->execute();
                        }
                    }
                    echo "
                        <script>
                            Swal.fire({
                                icon                : 'success',
                                title               : 'Berhasil',
                                text                : 'Data buku berhasil diedit!',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function() {
                                window.location.href = '?buku=data_buku';
                            });
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                icon                : 'error',
                                title               : 'Oops...',
                                text                : 'Data buku gagal diedit!',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function() {
                                window.location.href = '?buku=data_buku';
                            });
                        </script>
                    ";
                }
                $stmt->close();
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon                : 'error',
                            title               : 'Oops...',
                            text                : 'Lengkapi data yang anda input!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = '?buku=data_buku';
                        });
                    </script>
                ";
            }
    } else {
        echo "
            <script>
                Swal.fire({
                    icon                :   'error',
                    title               :   'Oops..',
                    text                :   'Metode tidak Valid!',
                    showConfirmButton   :   false,
                    timer               :   1500
                });
            </script>
        ";
    }
?>