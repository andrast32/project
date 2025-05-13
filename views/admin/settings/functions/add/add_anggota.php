<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nis']) 
            && isset($_POST['password']) 
            && isset($_POST['nama_anggota']) 
            && isset($_POST['id_kelas']) 
            && isset($_POST['alamat'])
            && isset($_POST['no_telp'])
            && isset($_FILES['foto'])
            && isset($_POST['level'])) {

                $nis            = $_POST['nis'];
                $password       = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $nama_anggota   = $_POST['nama_anggota'];
                $id_kelas       = $_POST['id_kelas'];
                $alamat         = $_POST['alamat'];
                $no_telp        = $_POST['no_telp'];
                $foto           = $_FILES['foto']['name'];
                $tempFoto       = $_FILES['foto']['tmp_name'];
                $level          = $_POST['level'];

                $stmt_cek = $mysqli->prepare("SELECT COUNT(*) FROM anggota WHERE nis = ?");
                $stmt_cek->bind_param("s", $nis);
                $stmt_cek->execute();
                $stmt_cek->bind_result($count);
                $stmt_cek->fetch();
                $stmt_cek->close();

                if ($count > 0) {

                    echo "
                        <script>
                            Swal.fire({
                                icon                :   'error',
                                title               :   'Oops...',
                                text                :   'NIS sudah dipakai, silakan gunakan NIG yang lain!',
                                showConfirmButton   :   false,
                                timer               :   1500
                            }).then(function() {
                                window.location.href = '?anggota=anggota';
                            });
                        </script>
                    ";
                } else {
                    $stmt = $mysqli->prepare("INSERT INTO anggota (nis, password, nama_anggota, id_kelas, alamat, no_telp, foto, level) VALUES (?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("ssssssss", $nis, $password, $nama_anggota, $id_kelas, $alamat, $no_telp, $foto, $level);

                    if ($stmt->execute()) {

                        $newFotoAnggota = $nis . '.' . pathinfo($foto, PATHINFO_EXTENSION);
                        $target = "../../templates/uploads/anggota/" . $newFotoAnggota;

                        if (move_uploaded_file($tempFoto, $target)) {
                            $stmt = $mysqli->prepare("UPDATE anggota SET foto = ? WHERE nis = ?");
                            $stmt->bind_param("si", $newFotoAnggota, $nis);
                            $stmt->execute();

                            echo "
                                <script>
                                    Swal.fire({
                                        icon                : 'success',
                                        title               : 'Berhasil',
                                        text                : 'Anggota berhasil ditambahkan!',
                                        showConfirmButton   : false,
                                        timer               : 1500
                                    }).then(function() {
                                        window.location.href = '?anggota=anggota';
                                    });
                                </script>
                            ";

                        } else {
                            echo "
                                <script>
                                    Swal.fire({
                                        icon                :   'error',
                                        title               :   'Oops...',
                                        text                :   'Gagal upload foto anggota!',
                                        showConfirmButton   :   false,
                                        timer               :   1500
                                    }).then(function() {
                                        window.location.href = '?anggota=anggota';
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
                                    text                :   'Anggota gagal ditambahkan',
                                    showConfirmButton   :  false,
                                    timer               :  1500
                                }).then(function() {
                                    window.location.href = '?anggota=anggota';
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
                            icon                : 'error',
                            title               : 'Oops...',
                            text                : 'Lengkapi data yang anda input!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = '?anggota=anggota';
                        });
                    </script>"
                ;
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
            </script>"
        ;
    }
?>