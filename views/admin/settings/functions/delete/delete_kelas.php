<?php

    if (isset($_GET['id_kelas'])) {
        $id_kelas = $_GET['id_kelas'];

        $stmt = $mysqli->prepare("SELECT id_kelas FROM data_kelas WHERE id_kelas = ?");
        $stmt->bind_param("s", $id_kelas);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close(); 

            $stmt = $mysqli->prepare("DELETE FROM data_kelas WHERE id_kelas = ?");
            $stmt->bind_param("s", $id_kelas);

            if ($stmt->execute()) {
                echo "
                    <script>
                        Swal.fire({
                            icon        : 'success',
                            title       : 'Berhasil',
                            text        : 'Kelas berhasil dihapus!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '?kelas=kelas';
                            }
                        });
                    </script>
                ";
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon        : 'error',
                            title       : 'Oops...',
                            text        : 'Kelas gagal dihapus!',
                        });
                    </script>
                ";
            }
            $stmt->close();
        } else {
            echo "
                <script>
                    Swal.fire({
                        icon        : 'warning',
                        title       : 'Tidak Ditemukan',
                        text        : 'Kelas dengan ID tersebut tidak ditemukan!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '?kelas=kelas';
                        }
                    });
                </script>
            ";
        }
    }
?>
