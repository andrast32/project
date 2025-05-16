<?php 
    if (isset($_GET['settings'])) {
        include ("settings/function/".$_GET['settings'].".php");
    }
    else if (isset($_GET['page'])) {
        include ("page/".$_GET['page'].".php");
    } else {
        include "settings/ui/dashboard.php";
    }

?>