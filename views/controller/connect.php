<?php
    // localhost
    $host   = 'localhost';
    $user   = 'andrast';
    $pass   = 'Kakang.132';
    $db     = 'cp';

    $mysqli = new mysqli($host, $user, $pass, $db);

    if ($mysqli->connect_error) {
        die("Koneksi database gagal :" . $mysqli->connect_error);
    }
?>