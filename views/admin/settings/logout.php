<?php 
session_start();

$backup_root = '../../../database/';


// Folder untuk backup manual & auto backup
$backup_folder_manual = $backup_root . "backup/";
$backup_folder_auto = $backup_root . "/";

// Cek apakah sudah ada backup manual hari ini
$backup_today = is_dir($backup_folder_manual) && count(glob($backup_folder_manual . "*.sql")) > 0;

if (!$backup_today) {
    // Kalau belum ada backup manual, backup ke auto-backup
    exportDatabase('localhost', 'root', '', 'cp', $backup_folder_auto);
}

// Setelah backup, baru logout
session_destroy();
header("Location: /project/index.php");
exit;

function exportDatabase($host, $user, $pass, $dbname, $backup_folder) {
    $return = '';
    $link = mysqli_connect($host, $user, $pass, $dbname);

    if (!$link) {
        die("Gagal koneksi ke database: " . mysqli_connect_error());
    }

    // Dapatkan semua tabel
    $tables = [];
    $result = mysqli_query($link, 'SHOW TABLES');
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }

    foreach ($tables as $table) {
        $result = mysqli_query($link, 'SELECT * FROM ' . $table);
        $num_fields = mysqli_num_fields($result);

        $return .= 'DROP TABLE IF EXISTS ' . $table . ";\n";
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE ' . $table));
        $return .= "\n" . $row2[1] . ";\n\n";

        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysqli_fetch_row($result)) {
                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = preg_replace("/\n/", "\\n", $row[$j]);
                    $return .= isset($row[$j]) ? '"' . $row[$j] . '"' : '""';
                    if ($j < ($num_fields - 1)) {
                        $return .= ',';
                    }
                }
                $return .= ");\n";
            }
        }
        $return .= "\n\n";
    }

    // Buat nama file backup
    $nama_file = "backup.sql";
    $backup_file = $backup_folder . $nama_file;

    // Simpan file backup
    if (!is_dir($backup_folder)) {
        mkdir($backup_folder, 0777, true);
    }

    $handle = fopen($backup_file, 'w+');
    fwrite($handle, $return);
    fclose($handle);
}
?>
