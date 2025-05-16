<nav class="main-header navbar navbar-expand navbar-black navbar-dark">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="nav-link" data-widget="pushmenu" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">

            <a href="#" data-toggle="dropdown" class="nav-link">
                <img src="/project/templates/uploads/admins/<?php echo $_SESSION['foto']?>" alt="Foto User" class="img-size-50 img-circle mr-3" style="max-width: 30px;">
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <span class="dropdown-item dropdown-header">
                    <?php echo $_SESSION['nama_user']; ?>
                </span>

                <div class="dropdown-divider"></div>

                <button class="dropdown-item" data-toggle="modal" data-target="#change-pass-<?php echo $_SESSION['id_user']?>">
                    <i class="fas fa-user-lock mr-2"></i>
                    Change Password
                </button>

                <div class="dropdown-divider"></div>

                <a href="../controller/logout.php" class="dropdown-item">
                    <i class="fas fa-power-off mr-2"></i> Logout
                </a>

            </div>

        </li>

    </ul>

</nav>