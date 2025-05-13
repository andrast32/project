<?php
    if (isset($_GET['id_user']) && is_numeric($_GET['id_user'])) {
        $id_user =$_GET['id_user'];

        $stmt_sel = $mysqli->prepare("SELECT foto FROM user WHERE id_user = ?");
        $stmt_sel->bind_param("i", $id_user);
        $stmt_sel->execute();
        $stmt_sel->bind_result($foto);
        $stmt_sel->fetch();
        $stmt_sel->close();

        $stmt_del = $mysqli->prepare("DELETE FROM user WHERE id_user = ?");
        $stmt_del->bind_param("i", $id_user);

        if ($stmt_del->execute()) {

            $foto_path = "../../templates/uploads/admins/" . $foto;
            if (file_exists($foto_path)) {
                unlink($foto_path);
            }
            echo "
                <script>
                    Swal.fire({
                        icon        : 'success',
                        title       : 'Berhasil!',
                        text        : 'Data pustakawan berhasil dihapus',
                    }). then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '?pustakawan=pustakawan';
                        }
                    });
                </script>
            ";
        } else {
            echo "
                <script>
                    Swal.fire({
                        icon        : 'error',
                        title       : 'Oops..!',
                        text        : 'Data pustakawan gagal dihapus',
                    });
                </script>
            ";
        }
        $stmt_del->close();
    }
?>