<?php
  session_start();

?>

<!doctype html>
<html>
<head>
  <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title>E-Recruitment</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <script src="media/js/jquery.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="StyleSheet" href="css/style.css" type="text/css" />
        <style type="text/css">
            @import "media/css/demo_table_jui.css";
            @import "media/themes/smoothness/jquery-ui-1.8.4.custom.css";
        </style>
        
        <style>
            *{
                font-family: arial;
            }
        </style> 
</head>
  <body>
<div class="wrap">
<img src="img/Header-GG.PNG" alt="Welcome" width="100%" height="200px"> <br><br>
  <h1 align="center">E-Recruitment PT Gudang Garam, Tbk.</h1>
      <form method="POST" action="action.php?act=login">
      <table align="center" width="600px">
        <tr>
          <td>Username</td>
          <td><input type="text" name="username" class="form-control form-control-sm"></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password" class="form-control form-control-sm"></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="submit" value="Login" class="btn btn-success btn-sm" title = "Login Khusus Admin, Staff & Supervisor">
            <a href="register.php" title = "Pendaftaran Pelamar" class="btn btn-info btn-sm">Register On-Line</a>
          </td>
        </tr>
        <!-- FITUR LUPA PASSWORD HANYA PADA SAAT USER SUDAH LOGIN, APABILA STAFF / SUPERVISOR LUPA, BISA DI RESET PASSWORD OLEH ADMIN
        <tr>
          <td colspan="2" align="center"><a href="ubahpassword.php" class="btn btn-warning btn-sm">Lupa Password</a></td>
        </tr>
          -->
        <tr>
          <td colspan="2" align="center">
        <?php if (isset($_SESSION["pesan"])) {
          echo $_SESSION["pesan"];
          $_SESSION["pesan"] = "";
        }
        else {  $_SESSION["pesan"]="";    }
        ?>
          </td>
        </tr>
      </table>

    </form>
</div>
  </body>


</html>