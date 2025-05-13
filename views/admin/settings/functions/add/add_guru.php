<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nip'])
            && isset($_POST['password'])
            && isset($_POST['nama_guru'])
            && isset($_POST['alamat'])
            && isset($_POST['no_telp'])
            && isset($_FILES['foto'])
            && isset($_POST['level'])) {

                $nip            = $_POST['nip'];
                $password       = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $nama_guru      = $_POST['nama_guru'];
                $alamat         = $_POST['alamat'];
                $no_telp        = $_POST['no_telp'];
                $foto           = $_FILES['foto']['name'];
                $tempFoto       = $_FILES['foto']['tmp_name'];
                $level          = $_POST['level'];

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
                } else {

                    $stmt = $mysqli->prepare("INSERT INTO guru (nip, password, nama_guru, alamat,no_telp, foto, level) VALUES (?,?,?,?,?,?,?)");
                    $stmt->bind_param("sssssss", $nip, $password, $nama_guru, $alamat, $no_telp, $foto, $level);
                    
                    if ($stmt->execute()) {

                        $extension = pathinfo($foto, PATHINFO_EXTENSION);
                        $newFotoGuru = $nip . '.' . $extension;
                        $target = "../../templates/uploads/guru/" . $newFotoGuru;
                        
                        if (move_uploaded_file($tempFoto, $target)) {
                            $stmt = $mysqli->prepare("UPDATE guru SET foto = ? WHERE nip = ?");
                            $stmt->bind_param("si", $newFotoGuru, $nip);
                            $stmt->execute();
                            
                            echo "
                                <script>
                                    Swal.fire({
                                        icon                : 'success',
                                        title               : 'Berhasil',
                                        text                : 'Guru berhasil ditambahkan!',
                                        showConfirmButton   : false,
                                        timer               : 1500
                                    }).then(function() {
                                        window.location.href = '?guru=guru';
                                    });
                                </script>"
                            ;

                        } else {
                            echo "
                                <script>
                                    Swal.fire({
                                        icon                :   'error',
                                        title               :   'Oops...',
                                        text                :   'Gagal upload foto guru!',
                                        showConfirmButton   :   false,
                                        timer               :   1500
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
                                    icon                    :   'error',
                                    title                   :   'Oops...',
                                    text                    :   'Guru gagal ditambahkan',
                                    showConfirmButton       :   false,
                                    timer                   :   1500
                                }).then(function() {
                                    window.location.href = '?guru=guru';
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