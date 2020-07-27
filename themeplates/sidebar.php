<?php 
if($page == 'pengguna') {
  $penggunaAktif = 'active';
} 

if($page == 'tahun') {
  $masterAktif1 = 'menu-open';
  $masterAktif2 = 'active';
  $tahunAktif = 'active';
}

if($page == 'kelas') {
  $masterAktif1 = 'menu-open';
  $masterAktif2 = 'active';
  $kelasAktif = 'active';
}

if($page == 'siswa') {
  $masterAktif1 = 'menu-open';
  $masterAktif2 = 'active';
  $siswaAktif = 'active';
}

?>
<!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Administrator</li>
          <li class="nav-item has-treeview <?= $masterAktif1; ?>">
            <a href="#" class="nav-link <?= $masterAktif2; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=tahun" class="nav-link <?= $tahunAktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Tahun Ajaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?p=kelas" class="nav-link <?= $kelasAktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?p=siswa" class="nav-link <?= $siswaAktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Siswa</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="?p=pengguna" class="nav-link <?= $penggunaAktif; ?>">
              <i class="nav-icon far fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>