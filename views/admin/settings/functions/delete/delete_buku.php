<?php

    if (isset($_GET['id_buku']) && is_numeric($_GET['id_buku'])) {
        $id_buku = $_GET['id_buku'];

        $stmt_sel = $mysqli->prepare("SELECT foto FROM data_buku WHERE id_buku = ?");
        $stmt_sel->bind_param("i", $id_buku);
        $stmt_sel->execute();
        $stmt_sel->bind_result($foto);
        $stmt_sel->fetch();
        $stmt_sel->close();

        $stmt_del = $mysqli->prepare("DELETE FROM data_buku WHERE id_buku = ?");
        $stmt_del->bind_param("i", $id_buku);

        if ($stmt_del->execute()) {

            $foto_path = "../../templates/uploads/buku/" . $foto;
            if (file_exists($foto_path)) {
                unlink($foto_path);
            }

            echo "
                <script>
                    Swal.fire({
                        icon        : 'success',
                        title       : 'Berhasil!',
                        text        : 'Data buku berhasil dihapus',
                    }). then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '?buku=data_buku';
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
                        text        : 'Data buku gagal dihapus',
                    });
                </script>
            ";
        }
        $stmt_del->close();
    }
?>