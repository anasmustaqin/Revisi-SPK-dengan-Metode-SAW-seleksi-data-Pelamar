<?php
 session_start();
 include("../koneksi.php");
 $query = "SELECT * FROM tb_user WHERE id_user = ".$_SESSION['id'];
 $hasil = mysqli_query($conn,$query);
 // ambil data pengguna
$hasiluser=mysqli_query($conn,$query);
$user=mysqli_fetch_array($hasiluser);
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

    <!-- Option 2: Separate Popper and Bootstrap JS 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>-->
    <script src="../popper.min.js"></script>
    <script src="../bootstrap.min.js"></script>
    
<nav class="navbar navbar-expand-lg navbar-black bg-light">

     <!-- MENU -->   

    <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" href="home_spv.php">Data Pelamar</a>
          </li>
           <li class="nav-item">
            <a class="nav-link active" href="#">Kelola Akun</a>
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
    echo "Selamat Datang, <strong>".strtoupper($user["nama"])." (".ucwords(strtolower($user["jenis_user"])).")</strong>&nbsp;";
    echo "<a href='../action.php?act=logout' \" class = 'btn btn-outline-secondary btn-sm'>Logout </a>";
  ?>
</td>
 </tr>
 </table>

<br><br><br>
<h3 align = "center">AKUN ANDA </h3>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong>
<br>
<table class="table">
    <?php
    while($row = mysqli_fetch_assoc($hasil))
    {
    ?>
    <tr>
        <td>Username</td>
        <td><?=$row['username']?></td>        
    </tr>
    <tr>
        <td>nama</td>
        <td><?=ucwords(strtolower($row['nama']))?></td>
    </tr>
    <tr>
        <td>Jenis</td>
        <td><?=ucwords(strtolower($row['jenis_user']))?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?php
            if ($row['status'] == 'y') { echo $status = "Aktif"; }
            else { echo $status = "Nonaktif";}
     ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <a href="#" class="btn btn-warning" title = "Edit Akun" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Akun</a>
            <a class="btn btn-dark" onclick="location.href='home_spv.php'">Kembali</a>
        </td>
    </tr>
<!-- MODAL untuk Edit Data -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../action.php?act=EditAkun2&id=<?=$row['id_user']?>">
            <div class="modal-body">
                Nama
                <input type="text" class="form-control" name="nama" value="<?=ucwords(strtolower($row['nama']))?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
                Password Lama
                <input type="password" class="form-control" name="passwlama" placeholder="diisi apabila ingin ganti password">
                Password Baru
                <input type="password" class="form-control" minlength="5" id="passw" name = "passwbaru" placeholder="min 5 karakter">
                Ulangi Password Baru
                <input type="password" class="form-control" id="conf_passw" placeholder="harus sama dengan password baru">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
        <! -- END MODAL -->
<?php } ?>
</table>
</div>

<script type="text/javascript">
    
var password = document.getElementById("passw");
var confirm_password = document.getElementById("conf_passw");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Password Tidak Sama");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
  </body>
</html>