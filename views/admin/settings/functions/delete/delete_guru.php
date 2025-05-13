<?php 

    if (isset($_GET['id_guru']) && is_numeric($_GET['id_guru'])) {
        $id_guru = $_GET['id_guru'];

        $stmt_sel = $mysqli->prepare("SELECT foto FROM guru WHERE id_guru = ?");
        $stmt_sel->bind_param("i", $id_guru);
        $stmt_sel->execute();
        $stmt_sel->bind_result($foto);
        $stmt_sel->fetch();
        $stmt_sel->close();

        $stmt_del = $mysqli->prepare("DELETE FROM guru WHERE id_guru = ?");
        $stmt_del->bind_param("i", $id_guru);

        if ($stmt_del->execute()) {

            $foto_path = "../../templates/uploads/guru/" . $foto;
            if (file_exists($foto_path)) {
                unlink($foto_path);
            }

            echo "
                <script>
                    Swal.fire({
                        icon        : 'success',
                        title       : 'Berhasil!',
                        text        : 'Data guru berhasil dihapus',
                    }). then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '?guru=guru';
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
                        text        : 'Data guru gagal dihapus',
                    });
                </script>
            ";
        }
        $stmt_del->close();
    }
?>
