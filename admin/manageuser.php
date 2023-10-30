<?php   
session_start();
include_once("../koneksi.php");
$id = $_GET['id'];
$_SESSION['idpelamar'] = $id;
$query="SELECT * FROM tb_user WHERE id_user = '$id'";

$hasil=mysqli_query($conn,$query);
?>
<!doctype html>
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
    <!--<h1>E-Recruitment PT Gudang Garam, Tbk.</h1> -->

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
<h3 align = "center">DAFTAR PENGGUNA </h3>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong>
<br>
<table border = "0" style = "font-size:small;" width = "950px" align="center" class="table">
    <?php
        while($data=mysqli_fetch_array($hasil)) {
    ?>
    <tr> 
        <td>Username</td>
        <td><?=$data['username']?></td>
    </tr>
    <tr> 
        <td>Nama</td>
        <td><?=ucwords(strtolower($data['nama']))?></td>
    </tr>
    <tr>
        <td>Password</td>
     <td><input type = "password" value="<?=ucwords(strtolower($data['password']))?>" Disabled></td>
    </tr>
    <tr>
        <td>Jenis Pengguna</td>
         <td><?php
            if ($data['jenis_user'] == 'staff') {
                echo $jenis = "Staff"; $button = "Ubah Ke Supervisor"; $buttitle = "Pengguna akan diubah ke Supervisor";
            }
            else { echo $jenis = "Supervisor"; $button = "Ubah Ke Staff"; $buttitle = "Pengguna akan diubah ke Staff";}?>
            </td>
    </tr>
    <tr>
        <td>Status</td>
         <td><?php
            if ($data['status'] == 'y') {
                echo $status = "Aktif"; $button2 = "Nonaktifkan"; $buttitle2 = "Pengguna akan dinonaktifkan";
            }
            else { echo $status = "Nonaktif"; $button2 = "Aktifkan"; $buttitle2 = "Pengguna akan diaktifkan";}
     ?></td>
    </tr>
    <tr>
        <td colspan = "2" align = "center">
            <a href="" class="btn btn-info" title = "<?=$buttitle?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><?=$button?></a>
           <a href="" class="btn btn-primary" title = "<?=$buttitle2?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><?=$button2?></a>
            <a class="btn btn-warning" href="" title = "Password Pengguna akan dikembalikan ke standart" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">Reset Password</a>
            <a class="btn btn-danger" href="" title = "Pengguna akan dihapus" data-bs-toggle="modal" data-bs-target="#staticBackdrop4">Hapus Pengguna</a>
            <a class="btn btn-dark" onclick="location.href='listuser.php'">Kembali</a>
        </td>
    </tr>
        <!-- MODAL untuk Input Password (ubah jenis user) -->
        <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Perubahan Jenis Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="action_admin.php?act=UbahJenisUser&id=<?=$data['id_user']?>">
                <div class="modal-body">
                    <strong>Input Password Anda:</strong>
                    <input type="password" class="form-control" name="passw" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        <! -- END MODAL -->
        <!-- MODAL untuk Input Password (ubah status user) -->
         <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title fs-5" id="exampleModalLabel">Perubahan Status Pengguna</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <form method="POST" action="action_admin.php?act=UbahUser&id=<?=$data['id_user']?>">
                 <div class="modal-body">
                     <strong>Input Password Anda:</strong>
                     <input type="password" class="form-control" name="passw" required>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                     <button type="submit" class="btn btn-primary">Proses</button>
                 </div>
             </form>
             </div>
         </div>
        </div>
        <! -- END MODAL -->
        <!-- MODAL untuk Input Password (Reset Password user) -->
        <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Reset Password Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="action_admin.php?act=resetpass&id=<?=$data['id_user']?>">
                <div class="modal-body">
                    <strong>Input Password Anda:</strong>
                    <input type="password" class="form-control" name="passw" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        <! -- END MODAL -->
        <!-- MODAL untuk Input Password (Hapus user) -->
        <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="action_admin.php?act=HapusUser&id=<?=$data['id_user']?>">
                <div class="modal-body">
                    <strong>Input Password Anda:</strong>
                    <input type="password" class="form-control" name="passw" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        <! -- END MODAL -->
</table>
<?php }?>
</div>
</body>
</html>