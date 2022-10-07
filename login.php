<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/sweetalert2.min.css">
  <title>Login</title>
  <?php include 'code crud/logo.php'; ?>
  <link rel="shortcut icon" href="logo/<?php echo $logo_sekolah; ?>" type="image/x-icon">
</head>

<body style="background-image: url(images/orange.png); background-size: cover;">
  <div class="container">
    <div class="card mt-5 shadow" style="border-radius: 20px;">
      <div class="card-body">
        <div class="row img-login">
          <div class="col">
            <img src="images/orange.png" alt="" class="float-left">
          </div>
          <div class="col">
            <div class="form-login">
              <form action="" method="post">
                <h1>Form Login</h1>
                <div class="form-group mt-5">
                  <input type="text" name="username" class="form-control" placeholder="Masukan Username Anda">
                </div>
                <div class="form-group mt-4">
                  <input type="password" name="password" class="form-control" placeholder="Masukan Password Anda">
                </div>
                <div class="form-group mt-4">
                  <input type="submit" name="login" id="btn-login" class="btn btn-primary" value="Login">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="js/sweetalert2.min.js"></script>
</body>

</html>
<?php
error_reporting(0);
session_start();
include 'code crud/config.php';
if (isset($_POST['login'])) {
  $cek = mysqli_query($connect, "SELECT * FROM user_login
  WHERE username ='" . htmlspecialchars($_POST['username']) . "' AND password = 
  '" . MD5(htmlspecialchars($_POST['password'])) . "' ");

  if (mysqli_num_rows($cek) > 0) {
    $a = mysqli_fetch_object($cek);

    $_SESSION['stat_login'] = true;
    $_SESSION['user_login'] = $a->username;
?>
    <script>
      swal({
        title: "Login Berhasil ",
        text: "",
        type: "success"
      }).then(okay => {
        if (okay) {
          window.location.href = "dashboard";
        }
      });
    </script>
  <?php
  } elseif (empty($_POST['username'])) {
  ?>
    <script>
      swal({
        title: "Username Kosong !!",
        text: "Silahhkan di cek kembali..",
        type: "warning"
      }).then(okay => {
        if (okay) {
          //window.location.href = "login";
        }
      });
    </script>
  <?php
  } elseif (empty($_POST['password'])) {
  ?>
    <script>
      swal({
        title: "Password Kosong !",
        text: "Silahkan di cek kembali..",
        type: "warning"
      }).then(okay => {
        if (okay) {
          //window.location.href = "login";
        }
      });
    </script>
  <?php
  } elseif ($cek > 0) {
  ?>
    <script>
      swal({
        title: "Login Gagal !",
        text: "Password atau Username yang anda masukan salah ..",
        type: "error"
      }).then(okay => {
        if (okay) {
          //window.location.href = "login";
        }
      });
    </script>
<?php }
}  ?>
