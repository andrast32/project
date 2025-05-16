<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nis            = $_POST['nis'];
        $current_pass   = $_POST['current_pass'];
        $new_password   = $_POST['new_password'];
        $confrim_pass   = $_POST['confrim_pass'];

        $stmt = $mysqli->prepare("SELECT password FROM anggota WHERE nis = ?");
        $stmt->bind_param("i", $nis);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($current_pass, $hashed_password)) {
            if ($new_password === $confrim_pass) {
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $stmt = $mysqli->prepare("UPDATE anggota SET password = ? WHERE nis = ?");
                $stmt->bind_param("si", $new_hashed_password, $nis);
                if ($stmt->execute()) {
                    echo "
                        <script>
                            Swal.fire({
                                icon                : 'success',
                                title               : 'Berhasil!',
                                text                : 'Password berhasil diubah!',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function() {
                                window.location.href = '/project/views/controller/logout.php';
                            });
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                icon                : 'error',
                                title               : 'Oops...',
                                text                : 'Gagal mengubah password!',
                                showConfirmButton   : false,
                                timer               : 1500
                            }).then(function() {
                                window.location.reload();
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
                            text                : 'Password baru anda salah, pastikan password baru dan konfirmasi password sama!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = 'index.php';
                        });
                    </script>
                ";
            }
        } else {
            echo "
                <script>
                    Swal.fire({
                        icon                : 'error',
                        title               : 'Oops...',
                        text                : 'Password saat ini salah!',
                        showConfirmButton   : false,
                        timer               : 1500
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                </script>
            ";
        }
    } else {
        echo "
            <script>
                Swal.fire({
                    icon                : 'error',
                    title               : 'Oops...',
                    text                : 'Permintaan tidak valid!',
                    showConfirmButton   : false,
                    timer               : 1500
                }).then(function() {
                    window.location.href = 'index.php';
                });
            </script>
        ";
    }
?>