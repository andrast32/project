<?php

    if (isset($_GET['settings'])) {
        include ("settings/functions/".$_GET['settings'].".php");
    }
?>