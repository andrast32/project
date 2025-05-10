<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['kode_buku'])
            && isset($_POST['judul'])
            && isset($_POST['deskripsi'])
            && isset($_POST['penulis'])
            && isset($_POST['penerbit'])
            && isset($_POST['tahun_terbit'])
            && isset($_POST['kode_rak'])
            && isset($_POST['stok'])
            && isset($_FILES['foto'])) {

                $kode_buku        = $_POST['kode_buku'];
                $judul          = $_POST['judul'];
                $deskripsi      = $_POST['deskripsi'];
                $penulis        = $_POST['penulis'];
                $penerbit       = $_POST['penerbit'];
                $tahun_terbit   = $_POST['tahun_terbit'];
                $kode_rak       = $_POST['kode_rak'];
                $stok           = $_POST['stok'];
                $foto           = $_FILES['foto']['name'];
                $tempFoto       = $_FILES['foto']['tmp_name'];

                $stmt_cek = $mysqli->prepare("SELECT COUNT(*) FROM data_buku WHERE kode_buku = ?");
                $stmt_cek->bind_param("s", $kode_buku);
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
                                text                : 'kode buku sudah dipakai, silahkan periksa kembali',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function(){
                                window.location.href = '?buku=data_buku';
                            });
                        </script>
                    ";
                } else {
                    $stmt = $mysqli->prepare("INSERT INTO data_buku (kode_buku, judul, deskripsi, penulis,  penerbit, tahun_terbit, kode_rak, stok, foto) VALUES (?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("sssssssss", $kode_buku, $judul, $deskripsi, $penulis, $penerbit, $tahun_terbit, $kode_rak, $stok, $foto);

                    if ($stmt->execute()) {

                        $id_buku = $mysqli->insert_id;

                        $extension = pathinfo($foto, PATHINFO_EXTENSION);
                        $newFotoBuku = $id_buku . '.' . $extension;
                        $target = "../../templates/uploads/buku/" . $newFotoBuku;

                        if (move_uploaded_file($tempFoto, $target)) {
                            $stmt = $mysqli->prepare("UPDATE data_buku SET foto = ? WHERE id_buku = ?");
                            $stmt->bind_param("ss", $newFotoBuku, $id_buku);
                            $stmt->execute();

                            echo "
                                <script>
                                    Swal.fire({
                                        icon                :   'success',
                                        title               :   'Berhasil',
                                        text                :   'Data buku berhasil ditambahkan!',
                                        showConfirmButton   :   false,
                                        timer               :   1500
                                    }).then(function() {
                                        window.location.href = '?buku=data_buku';
                                    });
                                </script>"
                            ;

                        } else {
                            echo "
                                <script>
                                    Swal.fire({
                                        icon                :   'error',
                                        title               :   'Oops...',
                                        text                :   'Gagal upload foto buku!',
                                        showConfirmButton   :   false,
                                        timer               :   1500
                                    }).then(function() {
                                        window.location.href = '?buku=data_buku';
                                    });
                                </script>"
                            ;
                        }
                    } else {
                        echo "
                            <script>
                                Swal.fire({
                                    icon                :   'error',
                                    title               :   'Oops...',
                                    text                :   'Data buku gagal ditambahkan',
                                    showConfirmButton   :   false,
                                    timer               :   1500
                                }).then(function() {
                                    window.location.href = '?buku=data_buku';
                                });
                            </script>"
                        ;
                    }
                    $stmt->close();
                }
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon                :   'error',
                            title               :   'Oops...',
                            text                :   'Lengkapi data yang anda input!',
                            showConfirmButton   :   false,
                            timer               :   1500
                        }).then(function() {
                            window.location.href = '?buku=data_buku';
                        });
                    </script>"
                ;
            }
    } else {
        echo "
            <script>
                Swal.fire({
                    icon                : 'error',
                    title               : 'Oops..',
                    text                : 'Metode tidak Valid!',
                    showConfirmButton   : false,
                    timer               : 1500
                });
            </script>"
        ;
    }
?>