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
$sqlf = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa='$id'");
$h = mysqli_fetch_assoc($sqlf);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user-md"></i> Data Mahasiswa Magang</h1>

    <a href="detail_mahasiswa.php?id=<?= $h['id_mahasiswa'] ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Detail Gambar Mahasiswa Magang #<?= $h['no_mahasiswa'] ?></h6>
    </div>

    <div class="card-body text-center">
        <img src="file/mahasiswa/<?=$h['file_mahasiswa']?>" class="img-fluid" alt="Responsive image" style="border:1px solid #ddd;"/>
    </div>
</div>


<?php }
    include 'template/footer.php';
?>