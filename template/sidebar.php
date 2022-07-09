<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-white sidebar sidebar-light accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-fax"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Si Peramal</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>
	  
	  <?php
	  if($_SESSION['level']=='Admin'){
	  ?>
			
	  <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        ADMIN
      </div>
	  
	  <li class="nav-item">
        <a class="nav-link" href="instansi.php">
          <i class="fas fa-fw fa-building"></i>
          <span>Data Instansi</span></a>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="user.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Data Pengguna</span></a>
      </li>
	  
    <li class="nav-item">
        <a class="nav-link" href="klasifikasi.php">
          <i class="fas fa-fw fa-cubes"></i>
          <span>Data Klasifikasi</span></a>
      </li>

	  <?php } ?>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        PENDATAAN
      </div>

	  
	  <li class="nav-item">
        <a class="nav-link" href="suratmasuk.php">
          <i class="fas fa-fw fa-inbox"></i>
          <span>Data Surat Masuk</span></a>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="suratkeluar.php">
          <i class="fas fa-fw fa-archive"></i>
          <span>Data Surat Keluar</span></a>
      </li>
	  
    <li class="nav-item">
        <a class="nav-link" href="mahasiswa.php">
          <i class="fas fa-fw fa-user-md"></i>
          <span>Data Mahasiswa Magang</span></a>
      </li>
    
    <li class="nav-item">
        <a class="nav-link" href="siswa.php">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Data Siswa SMK Magang</span></a>
      </li>
	  <!-- Divider -->
      <hr class="sidebar-divider">
	  
	  <!-- Heading -->
      <div class="sidebar-heading">
        LAPORAN
      </div>
	  
    <li class="nav-item">
        <a class="nav-link" href="laporan.php">
          <i class="fas fa-fw fa-print"></i>
          <span>Laporan</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          
		  <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn text-success d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
			<!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-uppercase mr-2 d-none d-lg-inline text-gray-600 small">
					<?=$_SESSION['user']?>
				</span>
                <img class="img-profile rounded-circle" src="assets/img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="profil.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-external-link-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
		
		<div class="container-fluid">