<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id_guru'])
            && isset($_POST['nip'])
            && isset($_POST['nama_guru'])
            && isset($_POST['alamat'])
            && isset($_POST['no_telp'])) {

                $id_guru        = $_POST['id_guru'];
                $nip            = $_POST['nip'];
                $nama_guru      = $_POST['nama_guru'];
                $alamat         = $_POST['alamat'];
                $no_telp        = $_POST['no_telp'];
                $foto           = isset($_FILES['foto']) ? $_FILES['foto']['name'] : '';
                $tempFoto       = isset($_FILES['foto']) ? $_FILES['foto']['tmp_name'] : '';

                $stmt_cek = $mysqli->prepare("SELECT COUNT(*) FROM guru WHERE nip = ?");
                $stmt_cek->bind_param("s", $nip);
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
                                text                : 'NIP sudah dipakai, silahkan gunakan NIP lain, atau hubungi admin untuk memperbaikinya',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function() {
                                window.location.href = '?guru=guru';
                            });
                        </script>
                    ";
                    exit;
                }

                $stmt = $mysqli->prepare("UPDATE guru SET nama_guru = ?, alamat = ?, no_telp = ?, nip = ? WHERE id_guru = ?");
                $stmt->bind_param("ssssi", $nama_guru, $alamat, $no_telp, $nip, $id_guru);

                if ($stmt->execute()) {

                    if ($foto) {
                        $newFotoName = $nip . '.' . pathinfo($foto, PATHINFO_EXTENSION);
                        $target = "../../templates/uploads/guru/" . $newFotoName;

                        if (move_uploaded_file($tempFoto, $target)) {
                            $stmt = $mysqli->prepare("UPDATE guru SET foto = ? WHERE nip = ?");
                            $stmt->bind_param("si", $newFotoName, $nip);
                            $stmt->execute();
                        }
                    }
                    
                    echo "
                        <script>
                            Swal.fire({
                                icon                : 'success',
                                title               : 'Berhasil',
                                text                : 'Guru berhasil diedit!',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function() {
                                window.location.href = '?guru=guru';
                            });
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                icon                :   'error',
                                title               :   'Oops...',
                                text                :   'Guru gagal diedit!',
                                showConfirmButton   :  false,
                                timer               :  1500
                            }).then(function() {
                                window.location.href = '?guru=guru';
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
                        window.location.href = '?guru=guru';
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
