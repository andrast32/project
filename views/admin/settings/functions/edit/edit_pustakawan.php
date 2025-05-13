<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id_user'])
            && isset($_POST['nama_user'])) {

            $id_user            = $_POST['id_user'];
            $nama_user          = $_POST['nama_user'];
            $foto               = isset($_FILES['foto']) ? $_FILES['foto']['name']: '';
            $tempFoto           = isset($_FILES['foto']) ? $_FILES['foto']['tmp_name']: '';

            $stmt = $mysqli->prepare("UPDATE user SET nama_user = ? WHERE id_user = ?");
            $stmt->bind_param("si", $nama_user, $id_user);

            if ($stmt->execute()) {

                if ($foto) {
                    $newFotoName = $id_user . '.' . pathinfo($foto, PATHINFO_EXTENSION);
                    $target = "../../templates/uploads/admins/" . $newFotoName;

                    if (move_uploaded_file($tempFoto, $target)) {
                        $stmt = $mysqli->prepare("UPDATE user SET foto = ? WHERE id_user = ?");
                        $stmt->bind_param("si", $newFotoName, $id_user);
                        $stmt->execute();
                    }
                }
                
                echo "
                    <script>
                        Swal.fire({
                            icon                : 'success',
                            title               : 'Berhasil',
                            text                : 'Pustakawan berhasil diedit!',
                            showConfirmButton   : false,
                            timer               : 1500
                        }).then(function() {
                            window.location.href = '?pustakawan=pustakawan';
                        });
                    </script>
                ";
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon                :   'error',
                            title               :   'Oops...',
                            text                :   'Pustakawan gagal diedit!',
                            showConfirmButton   :  false,
                            timer               :  1500
                        }).then(function() {
                            window.location.href = '?pustakawan=pustakawan';
                        });
                    </script>"
                ;
            }
            $stmt->close();
        } else {
            echo "
                <script>
                    Swal.fire({
                        icon                :   'error',
                        title               :   'Oops...',
                        text                :   'Pustakawan gagal diedit!',
                        showConfirmButton   :  false,
                        timer               :  1500
                    }).then(function() {
                        window.location.href = '?pustakawan=pustakawan';
                    });
                </script>
            ";
        }
    }
?>