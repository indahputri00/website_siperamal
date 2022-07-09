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
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-archive"></i> Data Surat Keluar</h1>

    <?php if($_SESSION['level']=="Admin"){?>
    <a href="#" data-toggle="modal" data-target="#tambahsk" class="btn btn-dark"> <i class="fa fa-plus-circle"></i> Tambah Data </a>
    <?php }?>
</div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Daftar Data Surat Keluar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-dark text-white">
                                        <tr align="center">
                                            <th width="5%">No</th>
                                            <th>No. Surat Keluar</th>
                                            <th>Perihal Surat</th>
                                            <th>Tujuan Surat</th>
                                            <th>Tanggal Surat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = mysqli_query($conn, "SELECT * FROM tb_suratkeluar");
                                            $no = 1;
                                            while($row=mysqli_fetch_assoc($sql)){
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $row['no_suratkeluar'] ?></td>
                                            <td><?= $row['isi_surat'] ?></td>
                                            <td><?= $row['tujuan_surat'] ?></td>
                                            <td class="text-center"><?php 
                                                $newDate = date("d-m-Y", strtotime($row['tgl_surat']));  
                                                echo $newDate;
                                                ?>
                                            </td>
                                            <td class="text-center">                                                
                                                <div class="btn-group" role="group">
                                                    
                                                    <a title="Detail" href="detail_sk.php?id=<?= $row['id_suratkeluar'] ?>" class="btn btn-success btn-sm"><i class="fa fa-list-ul"></i> Detail</a>
                                                    
                                                    <?php if($_SESSION['level']=="Admin"){?>                                                    
                                                    <a title="Edit" href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?php echo $row['id_suratkeluar']; ?>"><i class="fa fa-edit"></i> Edit</a>
                                                    
                                                    <a title="Hapus" href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $row['id_suratkeluar']; ?>"><i class="fa fa-trash"></i> Hapus</a>
                                                    <?php }?>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        
                                        
                                        
                                        <!-- hapus Modal-->
                                        <div class="modal fade" id="hapus<?php echo $row['id_suratkeluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Mengahpus Data?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Pilih "Hapus" untuk menghapus data surat <?= $row['no_suratkeluar'] ?>.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
                                                        <a href="data/data_sk.php?act=hapus&id=<?php echo $row['id_suratkeluar']; ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash mr-1"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- editidk Modal-->
                                        <div class="modal fade bd-example-modal-lg" id="edit<?php echo $row['id_suratkeluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-edit mr-1"></i> Edit Data</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="data/data_sk.php?act=edit" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <?php
                                                            $id=$row['id_suratkeluar'];
                                                            $sqledit=mysqli_query($conn, "SELECT * FROM tb_suratkeluar WHERE id_suratkeluar='$id'");
                                                            while($rowe=mysqli_fetch_assoc($sqledit)){
                                                        ?>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="id" value="<?= $rowe['id_suratkeluar'] ?>">
                                                                <input type="hidden" name="filelama" value="<?= $rowe['file_suratkeluar'] ?>" id="">
                                                                
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Nomor Surat Keluar</label>
                                                                    <input autocomplete="off" type="text" name="nosk" required class="form-control" value="<?= $rowe['no_suratkeluar'] ?>"/>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Nomor Agenda Surat Keluar</label>
                                                                    <input autocomplete="off" type="text" name="noag" required class="form-control" value="<?= $rowe['no_agenda'] ?>"/>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Tujuan Surat</label>
                                                                    <input autocomplete="off" type="text" name="tujuan" required class="form-control" value="<?= $rowe['tujuan_surat'] ?>"/>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Isi Ringkas/Perihal</label>
                                                                    <textarea name="isi" class="form-control" required><?= $rowe['isi_surat'] ?></textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">File Surat</label>
                                                                    <br />
                                                                    <span class="text-danger">Format: jpg/jpeg/png (5Mb)</span>

                                                                    <div class="input-group mb-3">
                                                                        <div class="custom-file">
                                                                            <input type="file" name="filesk" class="custom-file-input" id="inputGroupFile01" />
                                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                        if($rowe['file_suratkeluar']=='TIDAK ADA FILE'){
                                                                            echo "<b>Tidak Ada File</b>";
                                                                        } else {
                                                                            ?>
                                                                            <a href="fsk.php?id=<?= $rowe['id_suratkeluar'] ?>" class="btn btn-success btn-sm">Lihat Full</a>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Kode Klasifikasi Surat</label>
                                                                    <select name="kla" class="form-control">
                                                                    <option value="">--Pilih Klasifikasi--</option>
                                                                    <?php
                                                                    $tampil=mysqli_query($conn, "SELECT * FROM tb_klasifikasi");
                                                                    while($row=mysqli_fetch_assoc($tampil))
                                                                    {
                                                                        if ($row[kode_klasifikasi]==$rowe[kode_klasifikasi]) {
                                                                            echo "<option value='$row[kode_klasifikasi]' selected>$row[kode_klasifikasi] - $row[judul_klasifikasi]</option>";
                                                                        } else {
                                                                            echo "<option value='$row[kode_klasifikasi]'>$row[kode_klasifikasi] - $row[judul_klasifikasi]</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Tanggal Surat</label>
                                                                    <input value="<?= $rowe['tgl_surat'] ?>" type="date" name="tglsk" required class="form-control" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Tanggal Keluar</label>
                                                                    <input value="<?= $rowe['tgl_keluar'] ?>" type="date" name="tglk" required class="form-control" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Keterangan Surat</label>
                                                                    <textarea name="ket" class="form-control"><?= $rowe['ket_suratkeluar'] ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
                                                        <button class="btn btn-success" type="submit"><i class="fas fa-fw fa-check mr-1"></i> Update</button>
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


<!-- tambahsk Modal-->
<div class="modal fade bd-example-modal-lg" id="tambahsk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus mr-1"></i> Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="data/data_sk.php?act=tambah" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Surat Keluar</label>
                                <input autocomplete="off" type="text" name="nosk" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Agenda Surat Keluar</label>
                                <input autocomplete="off" type="text" name="noag" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tujuan Surat</label>
                                <input autocomplete="off" type="text" name="tujuan" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Isi Ringkas/Perihal</label>
                                <textarea name="isi" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">File Surat</label>
                                <br />
                                <span class="text-danger">Format: jpg/jpeg/png (5Mb)</span>

                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="filesk" class="custom-file-input" id="inputGroupFile01" />
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Klasifikasi Surat</label>
                                <select name="kla" class="form-control">
                                    <option value="">--Pilih Klasifikasi--</option>
                                    <?php
                                        $tampil=mysqli_query($conn, "SELECT * FROM tb_klasifikasi");
                                        while($row=mysqli_fetch_assoc($tampil))
                                        {
                                        ?>
                                    <option value="<?=$row['kode_klasifikasi'] ?>">
                                        <?= $row['kode_klasifikasi'] ?>
                                        -
                                        <?= $row['judul_klasifikasi'] ?>
                                    </option>

                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Surat</label>
                                <input value="<?= date('Y-m-d') ?>" type="date" name="tglsk" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Keluar</label>
                                <input value="<?= date('Y-m-d') ?>" type="date" name="tglk" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Keterangan Surat</label>
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