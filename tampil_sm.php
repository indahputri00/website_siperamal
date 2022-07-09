<?php
    include 'config/db.php';
    include 'template/header.php';
?>

<div class="navbar-collapse">
	<div class="container">
        <div class="row mt-3">
            <div class="col-md-2">
            </div>
            <div class="col-md-9">
                <h2 class="text-center font-weight-bold">Data Surat Masuk</h2><br/>
            </div>
			<div class="col-md-1"></div>
        </div>
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Daftar Data Surat Masuk</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr align="center">
                        <th width="5%">No</th>
						<th>No. Surat Masuk</th>
						<th>Perihal Surat</th>
						<th>Asal Surat</th>
						<th>Kota Surat</th>
						<th>Jenis Surat</th>
						<th>Tanggal Surat</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql = mysqli_query($conn, "SELECT * FROM tb_suratmasuk");
						$no = 1;
						while($row=mysqli_fetch_assoc($sql)){
					?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td class="text-center"><?= $row['no_suratmasuk'] ?></td>
						<td><?= $row['isi_surat'] ?></td>
						<td><?= $row['asal_surat'] ?></td>
						<td><?= $row['kota_surat'] ?></td>
						<td><?= $row['jenis_surat'] ?></td>
						<td class="text-center"><?php 
							$newDate = date("d-m-Y", strtotime($row['tgl_surat']));  
							echo $newDate;
							?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<a href="welcome.php#services" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
			</a>
			<div class="col-md-3"></div>
			<div class="card-header py-3">
       		<h6 class="text-center font-weight-bold"> Silahkan <a href="login.php">masuk</a> untuk mengetahui detail pendataan!</h6>
    		</div>
		</div>
	</div>
</div>
	</div>
