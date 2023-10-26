<?php
  session_start();
?>

<!doctype html>
<html>
<head>
      <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
  <h1 align="center">Ganti Password</h1>
   
      <form method="POST" action="action.php?act=gantiPassw">
      <table align="center" width="500px">
        <tr>
          <td colspan="2"><small id="passwordHelpBlock" class="form-text text-muted">
        Anda Akan mengubah Password.</small></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input type="text" name="username" class="form-control form-control-sm"></td>
        </tr>
        <tr>
          <td>Password Baru</td>
          <td><input type="password" name="password" class="form-control form-control-sm"></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" value="Ubah Password" class="btn btn-success btn-sm"></td>
          <td colspan="2"><input type="button" value="Kembali" onclick="location.href='index.php'" class="btn btn-dark btn-sm"></td>
        </tr>
        <tr>
          <td colspan="2">
        <?=$_SESSION["pesan"];
          $_SESSION["pesan"]="";
        ?>
      </td>
      </tr>
      </table>

    </form>
</div>
  </body>


</html>