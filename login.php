<?php 
    error_reporting(0);
    session_start();
  include 'config/db.php';
    $query2 = mysqli_query($conn, "SELECT * FROM tb_instansi");
    $it = mysqli_fetch_array($query2);
    if(isset($_SESSION['user'])) {
        echo "<script language='javascript'>document.location.href='index.php';</script>";
    } else { 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="loginku/fonts/icomoon/style.css">

    <link rel="stylesheet" href="loginku/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="loginku/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="loginku/css/style.css">
    <link rel="icon" type="image/x-icon" href="dashboard/assets/favicon.ico" />

    <title>Si Peramal - Login</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('loginku/images/jateng2.png');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>Login <strong>Si Peramal</strong></h3>
            <p class="mb-4">Sistem Pendataan Surat Masuk dan Surat Keluar.<br><strong>Biro Organisasi Sekretariat Daerah Provinsi Jawa Tengah</strong></p>
            <form class="user" action="" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" name="username" placeholder="Username" autocomplete="off" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" autocomplete="off" required />
                                            </div>


              <button type="submit" class="btn btn-warning btn-user btn-block" name="login"><i class="fas fa-fw fa-sign-in-alt mr-1"></i> Masuk</button>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="loginku/js/jquery-3.3.1.min.js"></script>
    <script src="loginku/js/popper.min.js"></script>
    <script src="loginku/js/bootstrap.min.js"></script>
    <script src="loginku/js/main.js"></script>
  </body>
</html>
<?php if (isset($_POST['login'])) {
      $username = isset($_POST['username']) ? $_POST['username'] : '';
      $password = isset($_POST['password']) ? $_POST['password'] : '';

      //anti bypass admin
      $user = mysqli_real_escape_string($conn, $username);
      $pass = mysqli_real_escape_string($conn, $password);

      $login = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user' AND password = '$pass'");
      $data = mysqli_fetch_array($login);
      $cek = mysqli_num_rows($login);
      $level = $data['level'];
      $user = $data['nama'];
      $id = $data['id_user'];

      if ($cek > 0) {
          $_SESSION['level'] = $level;
          $_SESSION['user'] = $user;
          $_SESSION['id_user'] = $id;
          $_SESSION['login'] = true;

          echo "<script language='javascript'>document.location.href='index.php'; </script>";
      } else {
          echo "<script language='javascript'>alert('Username atau Password Salah'); document.location.href='login.php'; </script>";
      }
  }
?>

<?php
}
?>