<?php

    $page = isset($_GET['page']) ? $_GET['page'] : 'index';

    switch($page) {
        case 'data_buku':
            $title = "Kebon Dalem | Perpus Digital | Data Buku";
            $h1 = "Data Buku";
        break;
        default:
            $title = "Kebon Dalem | Perpus Digital | Dashboard";
            $h1 = "Dashboard";
        break;
    }

    include "../controller/connect.php";
    include "settings/ui/head.php";
    include "settings/ui/navbar.php";
    include "settings/function/control_page.php";
    include "settings/ui/footer.php";
    include "settings/ui/script.php";
?>