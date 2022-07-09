<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        echo "<script language='javascript'>alert('Anda harus login terlebih dahulu!!!'); document.location.href='login.php';</script>";
    } else {
    include 'config/db.php';
    include 'template/header.php';
	include 'template/sidebar.php';
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-print"></i> Laporan Pendataan</h1>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Pilih Laporan</h6>
    </div>
	
    <form action="" method="POST">
        <div class="card-body">
            <div class="row mb-3">
            	<tr>
            	<td><div class="col md-6">
                	<div class="container">
                		<a class="btn btn-dark" href="laporansm.php">Laporan Surat Masuk</a>
            		</div>
            	</div>
            	</td>
            	<td>
           	 	<div class="col md-6">
                	<div class="container">
                		<a class="btn btn-dark" href="laporansk.php">Laporan Surat Keluar</a>
            		</div>
           	 	</div>
           	 	</td>
           	 	<td>
           	 	<div class="col md-6">
                	<div class="container">
                		<a class="btn btn-dark" href="laporanmahasiswa.php">Laporan Mahasiswa Magang</a>
            		</div>
           	 	</div>
           	 	</td>
           	 	<td>
           	 	<div class="col md-6">
                	<div class="container">
                		<a class="btn btn-dark" href="laporansiswa.php">Laporan Siswa SMK Magang</a>
            		</div>
           	 	</div>
           	 </td>
             <td>
              <div class="col md-6">
                  <div class="container">
                    <a class="btn btn-dark" href="https://docs.google.com/document/d/1oN-Gi7yksVLn2FYVBj1zpgSvvm8bp_n8nNAAte7R3z8/edit?usp=sharing">Buat Surat Balasan Magang</a>
                </div>
              </div>
             </td>
        </tr>
        </div>
    </div>
    </form>
</div>
<?php }
    include 'template/footer.php';
?>

