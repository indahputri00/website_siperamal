<?php 
    $id=$_GET['id'];
	include 'config/db.php';
    $query = mysqli_query($conn, "SELECT * FROM tb_disposisi, tb_suratmasuk WHERE tb_suratmasuk.id_suratmasuk='$id' AND tb_disposisi.id_suratmasuk=tb_suratmasuk.id_suratmasuk");
    $query2 = mysqli_query($conn, "SELECT * FROM tb_instansi");
    $it = mysqli_fetch_array($query2);
    $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>CETAK DISPOSISI <?=$it['nama']?></title>
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        h1, h2, h5, p, table {
            color: black;
            font-family:'Times New Roman';
        }

        .table {
            border: 1px solid black;
        }
        .table td, .table th {
            color: black;
            border-top: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-2">
                <img src="assets/logo/<?=$it['logo']?>" alt="<?=$it['logo']?>" width="100%">
            </div>
            <div class="col-md-9">
                <h1 class="text-center"><?=$it['institusi']?></h1>
                <h2 class="text-center"><?=$it['nama']?></h2>
                <p class="text-center"><?=$it['alamat']?><br>
                Telp : <?=$it['notelp']?>
                Email : <?=$it['email']?></p>
            </div>
			<div class="col-md-1"></div>
        </div>
        <hr style="border:3px solid #000">
        <h2 class="text-center font-weight-bold">LEMBAR DISPOSISI</h2><br/>
        <div class="row-mt-2">
            <table class="table">
                <tbody>
                    <tr>
                        <td width="100px">Asal Surat</td>
                        <td>: <?=$row['asal_surat']?></td>
                        <td class="text-right">Diterima Tgl.</td>
                        <td>: <?php $n = date("d-m-Y", strtotime($row['tgl_diterima']));  
                            echo $n;?></td>
                    </tr>
                    <tr>
                        <td width="100px">No. Surat</td>
                        <td>: <?=$row['no_suratmasuk']?></td>
                        <td class="text-right">No Agenda.</td>
                        <td>: <?=$row['no_agenda']?></td>
                    </tr>
                    <tr>
                        <td width="100px">Tgl. Surat</td>
                        <td>: <?php $n2 = date("d-m-Y", strtotime($row['tgl_surat']));  
                            echo $n2;?></td>
                        <td class="text-right">Kode</td>
                        <td>: <?=$row['kode_klasifikasi']?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Sifat</td>
                        <td>: <?=$row['sifat']?></td>
                    </tr>
                    <tr>
                        <td width="100px">Perihal</td>
                        <td colspan="3" style="height:100px">: <?=$row['isi_surat']?></td>
                    </tr>
                    <tr>
                        <td width="150px" class="font-weight-bold">Diteruskan Kepada</td>
                        <td>: <?=$row['tujuan']?></td>
                        <td class="text-right font-weight-bold">Isi Disposisi</td>
                        <td>: <?=$row['isi_disposisi']?></td>
                    </tr>
                    <tr>
                        <td width="100px" class="font-weight-bold">Catatan</td>
                        <td style="height:100px">: <?=$row['catatan']?></td>
                        <td class="text-right font-weight-bold">Tanggal Disposisi</td>
                        <td>: <?=$row['tgl_disposisi']?></td>
                    </tr>
                </tbody>
            </table>
			
			<table class="w-100">
				<tr>
					<td width="60%"></td>
					<th><p class="text-center">Koordinator Bagian AKRB
				<br><br><br>
				<?=$it['kepala']?><br>
                NIP. <?=$it['nip']?>
				</p></th>
				</tr>
			</table>
            
        </div>
    </div>
</body>
    <script>
		window.print();
	</script>
</html>