<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if  (isset($_POST['id_siswa'])
            && isset($_POST['nis'])
            && isset($_POST['nama_anggota'])
            && isset($_POST['id_kelas'])
            && isset($_POST['alamat'])
            && isset($_POST['no_telp'])) {
        
                $id_siswa          = $_POST['id_siswa'];
                $nis               = $_POST['nis'];
                $nama_anggota      = $_POST['nama_anggota'];
                $id_kelas          = $_POST['id_kelas'];
                $alamat            = $_POST['alamat'];
                $no_telp           = $_POST['no_telp'];
                $foto              = isset($_FILES['foto']) ? $_FILES['foto']['name']: '';
                $tempFoto          = isset($_FILES['foto']) ? $_FILES['foto']['tmp_name']: '';

                $stmt = $mysqli->prepare("UPDATE anggota SET nama_anggota = ?, id_kelas = ?, alamat = ?, no_telp = ?,nis = ? WHERE id_siswa = ?");
                $stmt->bind_param("sssssi", $nama_anggota, $id_kelas, $alamat, $no_telp, $nis, $id_siswa);

                if ($stmt->execute()) {

                    if ($foto) {
                        $newFotoName = $nis . '.' . pathinfo($foto, PATHINFO_EXTENSION);
                        $target = "../../templates/uploads/anggota/" . $newFotoName;

                        if (move_uploaded_file($tempFoto, $target)) {
                            $stmt = $mysqli->prepare("UPDATE anggota SET foto = ? WHERE nis = ?");
                            $stmt->bind_param("si", $newFotoName, $nis);
                            $stmt->execute();
                        }

                    }
                        echo "
                            <script>
                                Swal.fire({
                                    icon                : 'success',
                                    title               : 'Berhasil',
                                    text                : 'Anggota berhasil diedit!',
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
                                text                :   'Anggota gagal diedit!',
                                showConfirmButton   :  false,
                                timer               :  1500
                            }).then(function() {
                                window.location.href = '?anggota=anggota';
                            });
                        </script>"
                    ;
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
