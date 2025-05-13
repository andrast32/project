<?php

    if (isset($_GET['id_siswa']) && is_numeric($_GET['id_siswa'])) {
        $id_siswa = $_GET['id_siswa'];

        $stmt_sel = $mysqli->prepare("SELECT foto FROM anggota WHERE id_siswa = ?");
        $stmt_sel->bind_param("i", $id_siswa);
        $stmt_sel->execute();
        $stmt_sel->bind_result($foto);
        $stmt_sel->fetch();
        $stmt_sel->close();

        $stmt_del = $mysqli->prepare("DELETE FROM anggota WHERE id_siswa = ?");
        $stmt_del->bind_param("i", $id_siswa);

        if ($stmt_del->execute()) {

            $foto_path = "../../templates/uploads/anggota/" . $foto;
            if (file_exists($foto_path)) {
                unlink($foto_path);
            }

            echo "
                <script>
                    Swal.fire({
                        icon        : 'success',
                        title       : 'Berhasil!',
                        text        : 'Data anggota berhasil dihapus',
                    }). then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '?anggota=anggota';
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
                        text        : 'Data anggota gagal dihapus',
                    });
                </script>
            ";
        }
        $stmt_del->close();
    }
?>