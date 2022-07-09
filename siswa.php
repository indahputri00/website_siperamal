<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        echo "<script language='javascript'>alert('Silahkan masuk sebagai User untuk melihat pendataan!'); document.location.href='login.php';</script>";
    } else {
    include 'config/db.php';
    include 'template/header.php';
	include 'template/sidebar.php';
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list-alt"></i> Data Siswa SMK Magang</h1>

    <?php if($_SESSION['level']=="Admin"){?>
	<a href="#" data-toggle="modal" data-target="#tambahsiswa" class="btn btn-dark"> <i class="fa fa-plus-circle"></i> Tambah Data </a>
	<?php }?>
</div>


<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Daftar Data Siswa SMK Magang</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr align="center">
                        <th width="5%">No</th>
						<th>No. Surat Siswa</th>
						<th>Nama Siswa</th>
						<th>Asal Sekolah</th>
						<th>Tanggal Mulai Magang</th>
						<th>Tanggal Selesai Magang</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql = mysqli_query($conn, "SELECT * FROM tb_siswa");
						$no = 1;
						while($row=mysqli_fetch_assoc($sql)){
					?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td class="text-center"><?= $row['no_siswa'] ?></td>
						<td><?= $row['nama_siswa'] ?></td>
						<td><?= $row['sekolah_siswa'] ?></td>
						<td class="text-center"><?php 
							$newDate = date("d-m-Y", strtotime($row['tglmulai_siswa']));  
							echo $newDate;
							?>
						</td>
						<td class="text-center"><?php 
							$newDate = date("d-m-Y", strtotime($row['tglakhir_siswa']));  
							echo $newDate;
							?>
						</td>
						<td class="text-center">
							<div class="btn-group" role="group">
								<a title="Detail" href="detail_siswa.php?id=<?= $row['id_siswa'] ?>" class="btn btn-success btn-sm"><i class="fa fa-list-ul"></i> Detail</a>
								
								<?php if($_SESSION['level']=="Admin"){?>

								<a title="Edit" href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?php echo $row['id_siswa']; ?>"><i class="fa fa-edit"></i> Edit</a>
								
                                <a title="Hapus" href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $row['id_siswa']; ?>"><i class="fa fa-trash"></i> Hapus</a>
								<?php }?>
                            </div>
						</td>
					</tr>
						<!-- hapus Modal-->
						<div class="modal fade" id="hapus<?php echo $row['id_siswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Yakin ingin Menghapus Data?</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">Pilih "Hapus" untuk menghapus data siswa <?= $row['no_siswa'] ?>.</div>
									<div class="modal-footer">
										<button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
										<a href="data/data_siswa.php?act=hapus&id=<?php echo $row['id_siswa']; ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash mr-1"></i> Hapus</a>
									</div>
								</div>
							</div>
						</div>

						<!-- editidk Modal-->
						<div class="modal fade bd-example-modal-lg" id="edit<?php echo $row['id_siswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-edit mr-1"></i> Edit Data</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form action="data/data_siswa.php?act=edit" method="POST" enctype="multipart/form-data">
										<div class="modal-body">
											<?php
												$id=$row['id_siswa'];
												$sqledit=mysqli_query($conn, "SELECT * FROM tb_siswa WHERE id_siswa='$id'");
												while($rowe=mysqli_fetch_assoc($sqledit)){
											?>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="font-weight-bold">Nomor Siswa</label>
														<input autocomplete="off" type="text" name="nosis" required class="form-control" value="<?= $rowe['no_siswa'] ?>"/>
													</div>
												
													<div class="form-group">
														<label class="font-weight-bold">Nama Siswa SMK Magang</label>
														<input autocomplete="off" type="text" name="namsis" required class="form-control" value="<?= $rowe['nama_siswa'] ?>"/>
													</div>

													<div class="form-group">
														<label class="font-weight-bold">NIS</label>
														<input autocomplete="off" type="text" name="nissis" required class="form-control" value="<?= $rowe['nis_siswa'] ?>"/>
													</div>
												
													<div class="form-group">
														<label class="font-weight-bold">No HP Siswa SMK</label>
														<input autocomplete="off" type="text" name="hpsis" required class="form-control" value="<?= $rowe['hp_siswa'] ?>"/>
													</div>
												
													<div class="form-group">
														<label class="font-weight-bold">Asal Sekolah</label>
														<input autocomplete="off" type="text" name="asal" required class="form-control" value="<?= $rowe['sekolah_siswa'] ?>"/>
													</div>
													
													<div class="form-group">
													<label class="font-weight-bold">Penempatan</label>
													<select name="penempatan" class="form-control" required>
														<option hidden value="<?= $rowe['penempatan'] ?>"><?= $rowe['penempatan'] ?></option>
														<option value="Biro Organisasi">Biro Organisasi</option>
														<option value="Biro Umum">Biro Umum</option>
														<option value="Biro Hukum">Biro Hukum</option>
														<option value="Biro Pem. Otonomi Daerah dan Kerjasama">Biro Pem. Otonomi Daerah dan Kerjasama</option>
														<option value="Biro Kesejahteraan Rakyat">Biro Kesejahteraan Rakyat</option>
														<option value="Biro Adm. Pembangunan Daerah">Biro Adm. Pembangunan Daerah</option>
														<option value="Biro Adm. Pengadaan Barang/Jasa">Biro Adm. Pengadaan Barang/Jasa</option>
														<option value="Biro Perekonomian">Biro Perekonomian</option>
														<option value="Biro Infrastruktur dan Sumber Daya Alam">Biro Biro Infrastruktur dan Sumber Daya Alam</option>
													</select>
													</div>

													<div class="form-group">
														<label class="font-weight-bold">File Siswa</label>
														<br/><span class="text-danger">Format: jpg/jpeg/png (5Mb)</span>
														
														<div class="input-group mb-3">
														  <div class="custom-file">
															<input type="file" name="filesis" class="custom-file-input" id="inputGroupFile01">
															<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
														  </div>
														</div>
														<?php
															if($rowe['file_siswa']=='TIDAK ADA FILE'){
																echo "<b>Tidak Ada File</b>";
															} else {
																?>
																<a href="fsis.php?id=<?= $rowe['id_siswa'] ?>" class="btn btn-success btn-sm">Lihat File</a>
																<?php
															}
														?>
													</div>

													<div class="form-group">
														<label class="font-weight-bold">Tanggal Mulai Magang</label>
														<input value="<?= $rowe['tglmulai_siswa'] ?>" type="date" name="tglmsis" required class="form-control" value="<?= $rowe['tglmulai_siswa'] ?>" />
													</div>
													
													<div class="form-group">
														<label class="font-weight-bold">Tanggal Selesai Magang</label>
														<input value="<?= $rowe['tglakhir_siswa'] ?>" type="date" name="tglasis" required class="form-control" value="<?= $rowe['tglakhir_siswa'] ?>" />
													</div>
													
													<div class="form-group">
														<label class="font-weight-bold">Keterangan Surat</label>
														<textarea name="ket" class="form-control"><?= $rowe['ket_siswa'] ?></textarea>
													</div>
													<input type="hidden" name="id" value="<?= $rowe['id_siswa'] ?>">
													<input type="hidden" name="filelama" value="<?= $rowe['file_siswa'] ?>" id="">
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
											<button class="btn btn-success" type="submit"><i class="fas fa-fw fa-check mr-1"></i> Simpan</button>
										</div>
									</form>
									<?php } ?>
								</div>
							</div>
						</div>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
	
	
<!-- tambahsm Modal-->
<div class="modal fade bd-example-modal-lg" id="tambahsiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus mr-1"></i> Tambah Data</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				 </button>
			</div>
			<form action="data/data_siswa.php?act=tambah" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">Nomor Siswa SMK Magang</label>
								<input autocomplete="off" type="text" name="nosis" required class="form-control" />
							</div>
						
							<div class="form-group">
								<label class="font-weight-bold">Nama Siswa SMK Magang</label>
								<input autocomplete="off" type="text" name="namsis" required class="form-control" />
							</div>

							<div class="form-group">
								<label class="font-weight-bold">NIS</label>
								<input autocomplete="off" type="text" name="nissis" required class="form-control" />
							</div>
						
							<div class="form-group">
								<label class="font-weight-bold">No HP Siswa</label>
								<input autocomplete="off" type="text" name="hpsis" required class="form-control" />
							</div>
						
							<div class="form-group">
								<label class="font-weight-bold">Asal Sekolah</label>
								<textarea name="asal" class="form-control" required></textarea>
							</div>

							<div class="form-group">
													<label class="font-weight-bold">Penempatan</label>
													<select name="penempatan" class="form-control" required>
														<option hidden value="<?= $rowe['penempatan'] ?>"><?= $rowe['penempatan'] ?></option>
														<option value="Biro Organisasi">Biro Organisasi</option>
														<option value="Biro Umum">Biro Umum</option>
														<option value="Biro Hukum">Biro Hukum</option>
														<option value="Biro Pem. Otonomi Daerah dan Kerjasama">Biro Pem. Otonomi Daerah dan Kerjasama</option>
														<option value="Biro Kesejahteraan Rakyat">Biro Kesejahteraan Rakyat</option>
														<option value="Biro Adm. Pembangunan Daerah">Biro Adm. Pembangunan Daerah</option>
														<option value="Biro Adm. Pengadaan Barang/Jasa">Biro Adm. Pengadaan Barang/Jasa</option>
														<option value="Biro Perekonomian">Biro Perekonomian</option>
														<option value="Biro Infrastruktur dan Sumber Daya Alam">Biro Biro Infrastruktur dan Sumber Daya Alam</option>
													</select>
													</div>

							<div class="form-group">
								<label class="font-weight-bold">File Siswa SMK</label>
								<br/><span class="text-danger">Format: jpg/jpeg/png (5Mb)</span>
								
								<div class="input-group mb-3">
								  <div class="custom-file">
									<input type="file" name="filesis" class="custom-file-input" id="inputGroupFile01">
									<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
								  </div>
								</div>
							</div>
						
							<div class="form-group">
								<label class="font-weight-bold">Tanggal Mulai Magang</label>
								<input value="<?= date('Y-m-d') ?>" type="date" name="tglmsis" required class="form-control" />
							</div>
							
							<div class="form-group">
								<label class="font-weight-bold">Tanggal Selesai Magang</label>
								<input value="<?= date('Y-m-d') ?>" type="date" name="tglasis" required class="form-control" />
							</div>
							
							<div class="form-group">
								<label class="font-weight-bold">Keterangan</label>
								<textarea name="ket" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
                    <button class="btn btn-success" type="submit"><i class="fas fa-fw fa-check mr-1"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php }
    include 'template/footer.php';
?>