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
                        $sqlmhs = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa='$id'");
                        $t = mysqli_fetch_assoc($sqlmhs);
                    ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user-md"></i> Data Mahasiswa Magang</h1>

    <a href="mahasiswa.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Detail Mahasiswa Magang #<?= $t['no_mahasiswa'] ?></h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="30%" class="bg-light">Nomor Mahasiswa</th>
                <td><?= $t['no_mahasiswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Nama Mahasiswa</th>
                <td><?= $t['nama_mahasiswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">NIM</th>
                <td><?= $t['nim_mahasiswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">No HP Mahasiswa</th>
                <td><?= $t['hp_mahasiswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Universitas / Jurusan</th>
                <td><?= $t['sekolah_mahasiswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Penempatan</th>
                <td><?= $t['penempatan'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Tanggal Mulai Magang</th>
                <td><?= $t['tglmulai_mahasiswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Tanggal Selesai Magang</th>
                <td><?= $t['tglakhir_mahasiswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Keterangan</th>
                <td><?= $t['ket_mahasiswa'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">File</th>
                <td>
                    <?php
                    if ($t['file_mahasiswa'] == 'TIDAK ADA FILE') {
                        echo "<b>Tidak Ada File</b>";
                    } else {
                         ?>
                    <a href="fmhs.php?id=<?= $t['id_mahasiswa'] ?>" ><img style="border:1px solid #ddd" src='file/mahasiswa/<?= $t['file_mahasiswa'] ?>' alt='<?= $t['file_mahasiswa'] ?>' width='30%'></a><br>
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