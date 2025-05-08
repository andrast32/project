<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="https://kebondalem.sch.id/" class="brand-link" target="_blank">
        <img src="/project/templates/UI_user/img/logo.png" class="brand-image elevation-3" style="opacity: .8;" alt="Logo">
        <span class="brand-text font-weight-light">Kebon Dalem</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                <img src="/project/templates/uploads/admins/<?php echo $_SESSION['foto']?>" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">
                    <?php echo $_SESSION['nama_user']?></a>
                </a>
            </div>

        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo ($page == 'index') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="?buku=data_buku" class="nav-link <?php echo ($page == 'data_buku') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Data Buku</p>
                    </a>
                </li>

                <li class="nav-item <?php echo ($page == 'kunjungan_anggota' || $page == 'kunjungan_guru') ? 'menu-open' : ''; ?>">

                    <a href="#" class="nav-link <?php echo ($page == 'kunjungan_anggota' || $page == 'kunjungan_guru') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Data Kunjungan</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="?kunjungan_anggota=kunjungan_anggota" class="nav-link <?php echo ($page == 'kunjungan_anggota') ? 'active' : ''; ?>">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Kunjungan Anggota</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?kunjungan_guru=kunjungan_guru" class="nav-link <?php echo ($page == 'kunjungan_guru') ? 'active' : ''; ?>">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Kunjungan Guru</p>
                            </a>
                        </li>

                    </ul>

                </li>

                <li class="nav-item <?php echo ($page == 'peminjaman_anggota' || $page == 'peminjaman_guru') ? 'menu-open' : ''; ?>">

                    <a href="#" class="nav-link <?php echo ($page == 'peminjaman_anggota' || $page == 'peminjaman_guru') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>Data Peminjaman</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="?peminjaman_anggota=peminjaman_anggota" class="nav-link <?php echo ($page == 'peminjaman_anggota') ? 'active' : ''; ?>">
                                <i class="fas fa-book-open nav-icon"></i>
                                <p>peminjaman Anggota</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?peminjaman_anggota=peminjaman_guru" class="nav-link <?php echo ($page == 'peminjaman_guru') ? 'active' : ''; ?>">
                                <i class="fas fa-book-open nav-icon"></i>
                                <p>peminjaman guru</p>
                            </a>
                        </li>

                    </ul>

                </li>

                <li class="nav-item <?php echo ($page == 'pustakawan' || $page == 'guru' || $page == 'anggota' || $page == 'kelas') ? 'menu-open' : '' ; ?>">

                    <a href="#" class="nav-link <?php echo ($page == 'pustakawan' || $page == 'guru' || $page == 'anggota' || $page == 'kelas') ? 'active' : '' ; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Keanggotaan</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="?pustakawan=pustakawan" class="nav-link <?php echo ($page == 'pustakawan') ? 'active' : '' ; ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Data Pustakawan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?guru=guru" class="nav-link <?php echo ($page == 'guru') ? 'active' : '' ; ?>">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>Data Guru</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?anggota=anggota" class="nav-link <?php echo ($page == 'anggota') ? 'active' : '' ; ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Data Anggota</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?kelas=kelas" class="nav-link <?php echo ($page == 'kelas') ? 'active' : '' ; ?>">
                                <i class="nav-icon fas fa-school"></i>
                                <p>Data kelas</p>
                            </a>
                        </li>

                    </ul>

                </li>

            </ul>
        </nav>

    </div>

</aside>