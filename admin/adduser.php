<?php
 session_start();
 include("../koneksi.php");
 $query = "SELECT id_user FROM tb_user ORDER BY id_user DESC LIMIT 1";
 $hasil = mysqli_query($conn,$query);
?>
<html>
  <head>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <title>E-Recruitment</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <script src="../media/js/jquery.js" type="text/javascript"></script>
        <script src="../media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="StyleSheet" href="../css/style.css" type="text/css" />
        <style type="text/css">
            @import "../media/css/demo_table_jui.css";
            @import "../media/themes/smoothness/jquery-ui-1.8.4.custom.css";
        </style>
        
        <style>
            *{
                font-family: arial;
            }
        </style>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $('#datatables').dataTable({
                    "sPaginationType":"full_numbers",
                    "aaSorting":[[2, "desc"]],
                    "bJQueryUI":true
                });
            })
            
        </script>
         <style>
            h1 {
                background-color: #E0FFFF;
            }
        </style>

  </head>

  <body>
    <div class="wrap">
    <img src="../img/Header-GG.PNG" alt="Welcome" width="100%" height="200px">
   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="../popper.min.js"></script>
    <script src="../bootstrap.min.js"></script>
    

<nav class="navbar navbar-expand-lg navbar-black bg-light">

     <!-- MENU -->   

    <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" href="home_admin.php">Data Pelamar</a>
          </li>
           <li class="nav-item">
            <a class="nav-link active" href="listuser.php">Data Pengguna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Kelola Bobot</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Filter Kandidat</a>
          </li>
    </ul>

</nav>
<table align = "right">
<tr>
    <td>
 <?php
    echo "Selamat Datang, <strong>".strtoupper($_SESSION["nama"])."</strong>&nbsp;";
    echo "<a href='../action.php?act=logout' \" class = 'btn btn-outline-secondary btn-sm'>Logout </a>";
  ?>
</td>
 </tr>
 </table>
<br><br><br>
<h3 align = "center">TAMBAH PENGGUNA BARU </h3>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong>
<br>
<form action="action_admin.php?act=adduser" method="POST">
<table class="table">
<?php
$idbaru = mysqli_fetch_array($hasil);
?>
    <tr>
        <td>ID</td>
        <td><input type="text" name="idnew" class="form-control-plaintext" value = "<?=$idbaru['id_user']+1?>" readonly></td>
    </tr>
	<tr>
        <td>Username</td>
        <td><input type="text" name="username" class="form-control form-control-sm" placeholder="huruf kecil & tanpa spasi" required></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td><input type="text" name="nama" class="form-control form-control-sm" required></td>
    </tr>
    <tr>
        <td>Jenis Pengguna</td>
        <td><input type="radio" name="jenis" value = "staff" class="form-check-input" required>Staff
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="jenis" value = "supervisor" class="form-check-input"> Supervisor
    </tr>
    <tr>
        <td colspan="2"><small id="passwordHelpBlock" class="form-text text-muted">
        Password sudah di set by default oleh sistem yaitu qwe123.
</small>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="submit" class="btn btn-primary" value="Tambahkan">
            <input type="reset" class="btn btn-warning" value="Reset"/>
            <a class="btn btn-dark" onclick="location.href='listuser.php'">Kembali</a>
        </td>
</table>
</form>
</div>
  </body>
</html>