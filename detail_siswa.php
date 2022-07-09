<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        echo "<script language='javascript'>alert('Anda harus login terlebih dahulu!!!'); document.location.href='login.php';</script>";
    } else {
    include 'config/db.php';
    include 'template/header.php';
    include 'template/sidebar.php';
?>
                    <?php
                        $id = $_GET['id'];
                        $sqlsis = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE id_siswa='$id'");
                        $t = mysqli_fetch_assoc($sqlsis);
                    ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list-alt"></i> Data Siswa SMK Magang</h1>

    <a href="siswa.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Detail Siswa SMK Magang #<?= $t['no_siswa'] ?></h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="30%" class="bg-light">Nomor Siswa</th>
                <td><?= $t['no_siswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Nama Siswa</th>
                <td><?= $t['nama_siswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">NIS</th>
                <td><?= $t['nis_siswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">No HP Siswa</th>
                <td><?= $t['hp_siswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Asal Sekolah</th>
                <td><?= $t['sekolah_siswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Penempatan</th>
                <td><?= $t['penempatan'] ?></td>
            </tr>
            
            <tr>
                <th class="bg-light">Tanggal Mulai Magang</th>
                <td><?= $t['tglmulai_siswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Tanggal Selesai Magang</th>
                <td><?= $t['tglakhir_siswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Keterangan</th>
                <td><?= $t['ket_siswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">File</th>
                <td>
                    <?php
                    if ($t['file_siswa'] == 'TIDAK ADA FILE') {
                        echo "<b>Tidak Ada File</b>";
                    } else {
                         ?>
                    <a href="fsis.php?id=<?= $t['id_siswa'] ?>" ><img style="border:1px solid #ddd" src='file/siswa/<?= $t['file_siswa'] ?>' alt='<?= $t['file_siswa'] ?>' width='30%'></a><br>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>


<?php }
    include 'template/footer.php';
?>