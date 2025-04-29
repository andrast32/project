<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file_tmp  = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];

        // Cek ekstensi file harus .sql atau .csv
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if ($ext != 'sql' && $ext != 'csv') {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'File harus .sql atau .csv',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function(){
                    window.history.back();
                });
            </script>";
            exit();
        }

        // Hapus semua tabel sebelum import
        $mysqli->query("SET FOREIGN_KEY_CHECKS = 0"); // Nonaktifkan foreign key constraint
        $result = $mysqli->query("SHOW TABLES"); 
        while ($row = $result->fetch_array()) {
            $mysqli->query("DROP TABLE IF EXISTS " . $row[0]); 
        }
        $mysqli->query("SET FOREIGN_KEY_CHECKS = 1"); // Aktifkan kembali foreign key constraint

        if ($ext == 'sql') {
            // Baca isi file SQL
            $sql_content = file_get_contents($file_tmp);

            // Gunakan multi_query agar query tidak terpotong
            if ($mysqli->multi_query($sql_content)) {
                do {
                    if ($result = $mysqli->store_result()) {
                        $result->free();
                    }
                } while ($mysqli->more_results() && $mysqli->next_result());

                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Database berhasil diimport dan direset',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        window.history.back();
                    });
                </script>";
            } else {
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Database gagal diimport: " . addslashes($mysqli->error) . "',
                        showConfirmButton: false,
                        timer: 2500
                    }).then(function(){
                        window.history.back();
                    });
                </script>";
            }
        } elseif ($ext == 'csv') {
            // Import dari CSV (Pastikan CSV sesuai dengan struktur tabel)
            $file = fopen($file_tmp, "r");
            $success = true;

            while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
                // Sesuaikan query insert berdasarkan struktur CSV
                $query = "INSERT INTO namatabel (kolom1, kolom2, kolom3) VALUES ('$row[0]', '$row[1]', '$row[2]')";
                
                if (!$mysqli->query($query)) {
                    $success = false;
                    break;
                }
            }

            fclose($file);

            if ($success) {
                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'CSV berhasil diimport dan database direset',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        window.history.back();
                    });
                </script>";
            } else {
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'CSV gagal diimport',
                        showConfirmButton: false,
                        timer: 2500
                    }).then(function(){
                        window.history.back();
                    });
                </script>";
            }
        }
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'File tidak ditemukan',
                showConfirmButton: false,
                timer: 1500
            }).then(function(){
                window.history.back();
            });
        </script>";
    }
}
?>
