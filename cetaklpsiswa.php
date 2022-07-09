<?php 
    $tglaws = $_GET['tglaws'];
    $tglaks = $_GET['tglaks'];
	include 'config/db.php';
    $query = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE tglmulai_siswa BETWEEN '$tglaws' AND '$tglaks'");
    $query2 = mysqli_query($conn, "SELECT * FROM tb_instansi");
    $it = mysqli_fetch_array($query2);
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>CETAK LAPORAN SISWA SMK MAGANG <?=$it['nama']?></title>
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	
    <style>
        h1, h2, h5, p, table {
            color: black;
            font-family:'Times New Roman';
        }
        .table td, .table th {
            color: black;
            border: 1px solid black;
        }
        table, tr, th, td {
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-2">
                <img src="assets/logo/<?=$it['logo']?>" alt="<?=$it['logo']?>" width="100%">
            </div>
            <div class="col-md-9">
                <h1 class="text-center"><?=$it['institusi']?></h1>
                <h2 class="text-center"><?=$it['nama']?></h2>
                <p class="text-center"><?=$it['alamat']?><br>
                Telp <?=$it['notelp']?>
                Email <?=$it['email']?></p>
            </div>
			<div class="col-md-1"></div>
        </div>
        <hr style="border:3px solid #000">
        <h5 class="text-center font-weight-bold">LAPORAN SISWA SMK MAGANG</h5>
        <p class="text-center">Laporan Siswa SMK Magang dari tanggal 
        <?php 
        $newDate3 = date("d-m-Y", strtotime($tglaws));  
        echo $newDate3;
        ?> sampai dengan tanggal 
        <?php 
        $newDate3 = date("d-m-Y", strtotime($tglaks));  
        echo $newDate3;
        ?></p>
        <div class="row">
            <table class="table table-bordered text-dark" width="100%">
                <tr align="center">
                        <th>No</th>
                        <th>Nomor Siswa SMK Magang</th>
                        <th>Nama Siswa SMK Magang</th>
                        <th>NIS</th>
                        <th>No HP Siswa</th>
                        <th>Asal Sekolah</th>
                        <th>Penempatan</th>
                        <th>Tanggal Mulai Magang</th>
                        <th>Tanggal Selesai Magang</th>
                        <th>Keterangan</th>
                </tr>
                <?php 
                    $no = 1;
                    while($row=mysqli_fetch_assoc($query)){
                ?>
                <tr align="center">
                    <td><?=$no++?></td>
                    <td><?= $row['no_siswa'] ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nis_siswa'] ?></td>
                        <td><?= $row['hp_siswa'] ?></td>
                        <td><?= $row['sekolah_siswa'] ?></td>
                        <td><?= $row['penempatan'] ?></td>
                        <td>
                            <?php 
                            $newDate = date("d-m-Y", strtotime($row['tglmulai_siswa']));  
                            echo $newDate;
                            ?>
                        </td>
                        <td>
                            <?php 
                            $newDate2 = date("d-m-Y", strtotime($row['tglakhir_siswa']));  
                            echo $newDate2;
                            ?>
                        </td>
                        <td><?= $row['ket_siswa'] ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
    <script>
		window.print();
	</script>
</html>