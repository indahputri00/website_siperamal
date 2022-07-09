<?php
    include '../config/db.php';
    if($_GET['act']== 'tambah'){
        $nomhs = $_POST['nomhs'];
        $namamhs = $_POST['namamhs'];
        $nimmhs = $_POST['nimmhs'];
        $hpmhs = $_POST['hpmhs'];
        $asal = $_POST['asal'];
        $penempatan = $_POST['penempatan'];
        $tglmmhs = $_POST['tglmmhs'];
        $tglamhs = $_POST['tglamhs'];
        $ket = $_POST['ket'];
        
    
        if($_FILES['filemhs']['name']==''){
            mysqli_query($conn, "INSERT INTO tb_mahasiswa VALUES (NULL, '$nomhs', '$namamhs', '$nimmhs', '$hpmhs', '$asal','$penempatan','$tglmmhs', '$tglamhs', 'TIDAK ADA FILE', '$ket')");
                    echo "<script language='javascript'>alert('Berhasil menambah data'); document.location.href='../mahasiswa.php';</script>";
        } else {
            $rand = rand();
            $ekstensi =  array('png','jpg','jpeg');
            $filename = $_FILES['filemhs']['name'];
            $ukuran = $_FILES['filemhs']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!in_array($ext,$ekstensi) ) {
                echo "<script language='javascript'>alert('Ekstensi File tidak diperbolehkan');  document.location.href='../mahasiswa.php';</script>". mysqli_error($conn);
            }else{
                if($ukuran < 5044070){ //5Mb		
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filemhs']['tmp_name'], '../file/mahasiswa/'.$rand.'_'.$filename);
                    mysqli_query($conn, "INSERT INTO tb_mahasiswa VALUES (NULL, '$nomhs', '$namamhs', '$nimmhs', '$hpmhs', '$asal', '$penempatan', '$tglmmhs', '$tglamhs', '$xx', '$ket')");
                    echo "<script language='javascript'>alert('Berhasil Menambah data'); document.location.href='../mahasiswa.php';</script>";
                }else{
                    echo "<script language='javascript'>alert('Ukuran File terlalu besar'); document.location.href='../mahasiswa.php';</script>". mysqli_error($conn);
                }
            }
        }
    }
    elseif ($_GET['act'] == 'hapus'){
        $id = $_GET['id'];
        

        $sqlc = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa ='$id'");
        $b = mysqli_fetch_array($sqlc);
        if($b['file_mahasiswa']=="TIDAK ADA FILE"){
            $queryhapus = mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE id_mahasiswa = '$id'");
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../mahasiswa.php'; </script>";
        } else {
            unlink("../file/mahasiswa/$b[file_mahasiswa]");
            //query hapus
            $queryhapus = mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE id_mahasiswa = '$id'");
    
        if ($queryhapus) {
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../mahasiswa.php'; </script>";
        }
        else{
            echo "<script language='javascript'>alert('Gagal Menghapus Data');". mysqli_error($conn);
        }
        }
        mysqli_close($conn);
    }
    elseif($_GET['act']=='edit'){
        $id = $_POST['id'];
        $nomhs = $_POST['nomhs'];
        $namamhs= $_POST['namamhs'];
        $nimmhs= $_POST['nimmhs'];
        $hpmhs = $_POST['hpmhs'];
        $asal = $_POST['asal'];
        $penempatan = $_POST['penempatan'];
        $tglmmhs = $_POST['tglmmhs'];
        $tglamhs = $_POST['tglamhs'];
        $ket = $_POST['ket'];
        $filelama = $_POST['filelama'];
    
        if($_FILES['filemhs']['name']==''){
            mysqli_query($conn, "UPDATE tb_mahasiswa SET no_mahasiswa='$nomhs', nama_mahasiswa='$namamhs', nim_mahasiswa='$nimmhs', hp_mahasiswa='$hpmhs', sekolah_mahasiswa='$asal', penempatan='$penempatan', tglmulai_mahasiswa='$tglmmhs', tglakhir_mahasiswa='$tglamhs', ket_mahasiswa='$ket', file_mahasiswa='$filelama' WHERE id_mahasiswa='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../mahasiswa.php';</script>";
        } else {
            $rand = rand();
            $ekstensi =  array('png','jpg','jpeg');
            $filename = $_FILES['filemhs']['name'];
            $ukuran = $_FILES['filemhs']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!in_array($ext,$ekstensi) ) {
                echo "<script language='javascript'>alert('Ekstensi File tidak diperbolehkan');  document.location.href='../mahasiswa.php';</script>". mysqli_error($conn);
            }else{
                if($ukuran < 5044070){ //5Mb	
                    $sqlc = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa ='$id'");
                    $b = mysqli_fetch_array($sqlc);	
                    if($b['file_mahasiswa']=='TIDAK ADA FILE'){
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filemhs']['tmp_name'], '../file/mahasiswa/'.$rand.'_'.$filename);
                    mysqli_query($conn, "UPDATE tb_mahasiswa SET no_mahasiswa='$nomhs', nama_mahasiswa='$namamhs', nim_mahasiswa='$nimmhs', hp_mahasiswa='$hpmhs', sekolah_mahasiswa='$asal', penempatan='$penempatan', tglmulai_mahasiswa='$tglmmhs', tglakhir_mahasiswa='$tglamhs', ket_mahasiswa='$ket', file_mahasiswa='$xx' WHERE id_mahasiswa='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../mahasiswa.php';</script>";
                    } else {
                    unlink("../file/mahasiswa/$b[file_mahasiswa]");
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filemhs']['tmp_name'], '../file/mahasiswa/'.$rand.'_'.$filename);
                    mysqli_query($conn, "UPDATE tb_mahasiswa SET no_mahasiswa='$nomhs', nama_mahasiswa='$namamhs', nim_mahasiswa='$nimmhs', hp_mahasiswa='$hpmhs', sekolah_mahasiswa='$asal', penempatan='$penempatan', tglmulai_mahasiswa='$tglmmhs', tglakhir_mahasiswa='$tglamhs', ket_mahasiswa='$ket', file_mahasiswa='$xx' WHERE id_mahasiswa='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../mahasiswa.php';</script>";
                    }
                }else{
                    echo "<script language='javascript'>alert('Ukuran File terlalu besar'); document.location.href='../mahasiswa.php';</script>". mysqli_error($conn);
                }
            }
        }
    }
?>