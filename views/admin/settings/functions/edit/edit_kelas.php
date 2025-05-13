<?php

    if (isset($_POST['id_kelas'],$_POST['kelas'], $_POST['indeks_kelas'], $_POST['id_guru'])) {
        
        $id_kelas          = $_POST['id_kelas'];
        $kelas             = $_POST['kelas'];
        $indeks_kelas      = $_POST['indeks_kelas'];
        $id_guru           = $_POST['id_guru'];

        $stmt = $mysqli->prepare("UPDATE data_kelas SET kelas = ?, indeks_kelas = ?, id_guru = ? WHERE id_kelas = ?");
        $stmt->bind_param("ssss", $kelas, $indeks_kelas, $id_guru, $id_kelas);

        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon                : 'success',
                        title               : 'Berhasil',
                        text                : 'Kelas berhasil diubah!',
                        showConfirmButton   : false,
                        timer               : 1500
                    }).then(function() {
                        window.location.href = '?kelas=kelas';
                    });
                </script>
            ";
        } else {
            echo "
                <script>
                    Swal.fire({
                        icon                : 'error',
                        title               : 'Oops...',
                        text                : 'Kelas gagal diubah!',
                        showConfirmButton   : false,
                        timer               : 1500
                    }).then(function() {
                        window.location.href = '?kelas=kelas';
                    });
                </script>
            ";
        }
        $stmt->close();
    } else {

        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data tidak lengkap!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?kelas=kelas';
                });
            </script>
        ";
}
?>