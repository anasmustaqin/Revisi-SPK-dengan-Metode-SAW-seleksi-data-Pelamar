<?php
  session_start();

?>

<!doctype html>
<html>
<head>
      <title>E-Recruitment</title>
<style>
  h1 {background-color: Light Cyan}
</style> 
</head>
  <body>

  <h1 align="center">E-Recruitment PT Gudang Garam, Tbk.</h1>
      <form method="POST" action="action.php?act=login">
      <table align="center" width="500px">
        <tr>
          <td>Username</td>
          <td><input type="text" name="username"></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password"></td>
        </tr>
        <tr>
          <td colspan="2"><a href="ubahpassword.php"><font size="3"><strong>Lupa Password</strong></font></a></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" value="Login"></td>
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

  </body>


</html>