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
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-print"></i> Laporan Mahasiswa Magang</h1>

    <a href="laporan.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Pilih Tanggal Laporan Mahasiswa Magang</h6>
    </div>
	
    <form action="" method="POST">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col md-6">
                    <label for="" class="col-form-label font-weight-bold">Tanggal Awal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-1"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" name="tglawm" class="form-control" required />
                    </div>
                </div>
                <div class="col md-6">
                    <label for="" class="col-form-label font-weight-bold">Tanggal Akhir</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-1"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" name="tglakm" class="form-control" required />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <button name="lihat" class="btn btn-dark" type="submit"><i class="fas fa-fw fa-check mr-1"></i> Pilih Tanggal</button>
        </div>
    </form>
</div>

	
<?php
if(isset($_POST['lihat'])){
$tglawm = $_POST['tglawm'];
$tglakm = $_POST['tglakm'];

if($tglawm=="" || $tglakm==""){
header("Location: laporanmahasiswa.php");
die();
} else {
$query = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE tglmulai_mahasiswa BETWEEN '$tglawm' AND '$tglakm'");
?>
<div class="card shadow mb-4">
    <div class="card-header card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Data Laporan Mahasiswa Magang <?=$tglawm?> s/d <?=$tglakm?></h6>
    </div>
	
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-dark text-white">
					<tr align="center">
						<th>Nomor Mahasiswa Magang</th>
						<th>Nama Mahasiswa Magang</th>
						<th>NIM</th>
						<th>No HP mahasiswa</th>
						<th>Asal Sekolah</th>
						<th>Penempatan</th>
						<th>Tanggal Mulai Magang</th>
						<th>Tanggal Selesai Magang</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$no = 1;
				while($row=mysqli_fetch_assoc($query)){
				?>
					<tr align="center">
						<td><?= $row['no_mahasiswa'] ?></td>
						<td><?= $row['nama_mahasiswa'] ?></td>
						<td><?= $row['nim_mahasiswa'] ?></td>
						<td><?= $row['hp_mahasiswa'] ?></td>
						<td><?= $row['sekolah_mahasiswa'] ?></td>
						<td><?= $row['penempatan'] ?></td>
						<td>
							<?php 
							$newDate = date("d-m-Y", strtotime($row['tglmulai_mahasiswa']));  
							echo $newDate;
							?>
						</td>
						<td>
							<?php 
							$newDate2 = date("d-m-Y", strtotime($row['tglakhir_mahasiswa']));  
							echo $newDate2;
							?>
						</td>
						<td><?= $row['ket_mahasiswa'] ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card-footer text-right">
        <a class="btn btn-dark" target="_blank" href="cetaklpmahasiswa.php?tglawm=<?=$tglawm?>&tglakm=<?=$tglakm?>"><i class="fas fa-fw fa-file-pdf mr-1"></i> Cetak Laporan</a>
    </div>
</div>
<?php
}
}
}
    include 'template/footer.php';
?>