<?php
    include '../config/db.php';
    if($_GET['act']== 'tambah'){
        $nosis = $_POST['nosis'];
        $namsis = $_POST['namsis'];
        $nissis = $_POST['nissis'];
        $hpsis = $_POST['hpsis'];
        $asal = $_POST['asal'];
        $penempatan = $_POST['penempatan'];
        $tglmsis = $_POST['tglmsis'];
        $tglasis = $_POST['tglasis'];
        $ket = $_POST['ket'];
        
    
        if($_FILES['filesis']['name']==''){
            mysqli_query($conn, "INSERT INTO tb_siswa VALUES (NULL, '$nosis', '$namsis', '$nissis', '$hpsis', '$asal', '$penempatan','$tglmsis', '$tglasis', 'TIDAK ADA FILE', '$ket')");
                    echo "<script language='javascript'>alert('Berhasil menambah data'); document.location.href='../siswa.php';</script>";
        } else {
            $rand = rand();
            $ekstensi =  array('png','jpg','jpeg');
            $filename = $_FILES['filesis']['name'];
            $ukuran = $_FILES['filesis']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!in_array($ext,$ekstensi) ) {
                echo "<script language='javascript'>alert('Ekstensi File tidak diperbolehkan');  document.location.href='../siswa.php';</script>". mysqli_error($conn);
            }else{
                if($ukuran < 5044070){ //5Mb		
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesis']['tmp_name'], '../file/siswa/'.$rand.'_'.$filename);
                    mysqli_query($conn, "INSERT INTO tb_siswa VALUES (NULL, '$nosis', '$namsis', '$nissis', '$hpsis', '$asal', '$penempatan', '$tglmsis', '$tglasis', '$xx', '$ket')");
                    echo "<script language='javascript'>alert('Berhasil Menambah data'); document.location.href='../siswa.php';</script>";
                }else{
                    echo "<script language='javascript'>alert('Ukuran File terlalu besar'); document.location.href='../siswa.php';</script>". mysqli_error($conn);
                }
            }
        }
    }
    elseif ($_GET['act'] == 'hapus'){
        $id = $_GET['id'];
        

        $sqlc = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE id_siswa ='$id'");
        $b = mysqli_fetch_array($sqlc);
        if($b['file_siswa']=="TIDAK ADA FILE"){
            $queryhapus = mysqli_query($conn, "DELETE FROM tb_siswa WHERE id_siswa = '$id'");
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../siswa.php'; </script>";
        } else {
            unlink("../file/siswa/$b[file_siswa]");
            //query hapus
            $queryhapus = mysqli_query($conn, "DELETE FROM tb_siswa WHERE id_siswa = '$id'");
    
        if ($queryhapus) {
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../siswa.php'; </script>";
        }
        else{
            echo "<script language='javascript'>alert('Gagal Menghapus Data');". mysqli_error($conn);
        }
        }
        mysqli_close($conn);
    }
    elseif($_GET['act']=='edit'){
        $id = $_POST['id'];
        $nosis = $_POST['nosis'];
        $namsis= $_POST['namsis'];
        $nissis= $_POST['nissis'];
        $hpsis = $_POST['hpsis'];
        $asal = $_POST['asal'];
        $penempatan = $_POST['penempatan'];
        $tglmsis = $_POST['tglmsis'];
        $tglasis = $_POST['tglasis'];
        $ket = $_POST['ket'];
        $filelama = $_POST['filelama'];
    
        if($_FILES['filesis']['name']==''){
            mysqli_query($conn, "UPDATE tb_siswa SET no_siswa='$nosis', nama_siswa='$namsis', nis_siswa='$nissis', hp_siswa='$hpsis', sekolah_siswa='$asal', penempatan='$penempatan', tglmulai_siswa='$tglmsis', tglakhir_siswa='$tglasis', ket_siswa='$ket', file_siswa='$filelama' WHERE id_siswa='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../siswa.php';</script>";
        } else {
            $rand = rand();
            $ekstensi =  array('png','jpg','jpeg');
            $filename = $_FILES['filesis']['name'];
            $ukuran = $_FILES['filesis']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!in_array($ext,$ekstensi) ) {
                echo "<script language='javascript'>alert('Ekstensi File tidak diperbolehkan');  document.location.href='../siswa.php';</script>". mysqli_error($conn);
            }else{
                if($ukuran < 5044070){ //5Mb	
                    $sqlc = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE id_siswa ='$id'");
                    $b = mysqli_fetch_array($sqlc);	
                    if($b['file_siswa']=='TIDAK ADA FILE'){
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesis']['tmp_name'], '../file/siswa/'.$rand.'_'.$filename);
                    mysqli_query($conn, "UPDATE tb_siswa SET no_siswa='$nosis', nama_siswa='$namsis', nis_siswa='$nissis', hp_siswa='$hpsis', sekolah_siswa='$asal', penempatan='$penempatan', tglmulai_siswa='$tglmsis', tglakhir_siswa='$tglasis', ket_siswa='$ket', file_siswa='$xx' WHERE id_siswa='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../siswa.php';</script>";
                    } else {
                    unlink("../file/siswa/$b[file_siswa]");
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesis']['tmp_name'], '../file/siswa/'.$rand.'_'.$filename);
                    mysqli_query($conn, "UPDATE tb_siswa SET no_siswa='$nosis', nama_siswa='$namsis',nis_siswa='$nissis', hp_siswa='$hpsis', sekolah_siswa='$asal', penempatan='$penempatan', tglmulai_siswa='$tglmsis', tglakhir_siswa='$tglasis', ket_siswa='$ket', file_siswa='$xx' WHERE id_siswa='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../siswa.php';</script>";
                    }
                }else{
                    echo "<script language='javascript'>alert('Ukuran File terlalu besar'); document.location.href='../siswa.php';</script>". mysqli_error($conn);
                }
            }
        }
    }
?>