<?php
    // localhost
    $host   = 'localhost';
    $user   = 'root';
    $pass   = '';
    $db     = 'perpus_digital';

    $mysqli = new mysqli($host, $user, $pass, $db);

    if ($mysqli->connect_error) {
        die("Koneksi database gagal :" . $mysqli->connect_error);
    }
?>