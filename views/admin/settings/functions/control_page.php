<?php

    if (isset($_GET['settings'])) {
        include ("settings/functions/".$_GET['settings'].".php");
    }

    elseif(isset($_GET['anggota'])) {
        include ("pages/keanggotaan/".$_GET['anggota'].".php");
    }

    elseif (isset($_GET['buku'])) {
        include ("pages/buku/".$_GET['buku'].".php");
    }

    elseif (isset($_GET['guru'])) {
        include ("pages/keanggotaan/".$_GET['guru'].".php");
    }

    elseif (isset($_GET['kelas'])) {
        include ("pages/keanggotaan/".$_GET['kelas'].".php");
    }

    elseif (isset($_GET['kunjungan_anggota'])) {
        include ("pages/kunjungan/".$_GET['kunjungan_anggota'].".php");
    }

    elseif (isset($_GET['kunjungan_guru'])) {
        include ("pages/kunjungan/".$_GET['kunjungan_guru'].".php");
    }

    elseif (isset($_GET['peminjaman_anggota'])) {
        include ("pages/peminjaman/".$_GET['peminjaman_anggota'].".php");
    }

    elseif (isset($_GET['peminjaman_guru'])) {
        include ("pages/peminjaman/".$_GET['peminjaman_guru'].".php");
    }

    elseif (isset($_GET['pustakawan'])) {
        include ("pages/keanggotaan/".$_GET['pustakawan'].".php");
    }

    else {
        include "settings/ui/dashboard.php";
    }

?>