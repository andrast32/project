    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="index" class="<?php echo ($page == 'index') ? 'active' : ''; ?>">Home</a></li>
            <li><a href="?page=data_buku" class="<?php echo ($page == 'data_buku' || $page == 'detail') ? 'active' : ''; ?>">Daftar Buku</a></li>

            <li class="dropdown"><a href="#"><span>Account</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="#"><?php echo $_SESSION['nama_anggota']?></a></li>
                    <li><a href="/project/views/controller/logout">Logout</a></li>
                </ul>
            </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

</div>
</header>

