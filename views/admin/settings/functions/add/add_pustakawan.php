<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username'])
        && isset($_POST['password'])
        && isset($_POST['nama_user'])
        && isset($_POST['level'])
        && isset($_FILES['foto'])) {

            $username       = $_POST['username'];
            $password       = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $nama_user      = $_POST['nama_user'];
            $level          = $_POST['level'];
            $foto           = $_FILES['foto']['name'];
            $tempFoto       = $_FILES['foto']['tmp_name'];

            $stmt_cek = $mysqli->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
            $stmt_cek->bind_param("s", $username);
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
                            text                :   'Username sudah dipakai, silakan gunakan username yang lain!',
                            showConfirmButton   :   false,
                            timer               :   1500
                        }).then(function() {
                            window.location.href = '?pustakawan=pustakawan';
                        });
                    </script>
                ";
            } else {
                $stmt = $mysqli->prepare("INSERT INTO user (username, password, nama_user, level, foto) VALUES (?,?,?,?,?)");
                $stmt->bind_param("sssss", $username, $password, $nama_user, $level, $foto);

                if ($stmt->execute()) {
                    $id_user = $mysqli->insert_id;

                    $newFotoUser = $id_user . '.' . pathinfo($foto, PATHINFO_EXTENSION);
                    $target = "../../templates/uploads/admins/" . $newFotoUser;

                    if (move_uploaded_file($tempFoto, $target)) {
                        $stmt = $mysqli->prepare("UPDATE user SET foto = ? WHERE id_user = ?");
                        $stmt->bind_param("si", $newFotoUser, $id_user);
                        $stmt->execute();

                        echo "
                            <script>
                                Swal.fire({
                                    icon                : 'success',
                                    title               : 'Berhasil',
                                    text                : 'Pustakawan berhasil ditambahkan!',
                                    showConfirmButton   : false,
                                    timer               : 1500
                                }).then(function() {
                                    window.location.href = '?pustakawan=pustakawan';
                                })
                            </script>
                        ";
                    } else {
                        echo "
                            <script>
                                Swal.fire({
                                    icon                : 'error',
                                    title               : 'Oops..',
                                    text                : 'Gagal upload foto user!',
                                    showConfirmButton   : false,
                                    timer               : 1500
                                }).then(function() {
                                    window.location.href = '?pustakawan=pustakawan';
                                });
                            </script>
                        ";
                    }
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                icon                : 'error',
                                title               : 'Oops..',
                                text                : 'Gagal menambahkan pustakawan!',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function() {
                                window.location.href = '?pustakawan=pustakawan';
                            });
                        </script>
                    ";
            }
        }
        }
    }
?>