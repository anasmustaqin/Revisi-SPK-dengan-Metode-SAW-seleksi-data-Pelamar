<?php
 session_start();
 include("../koneksi.php");
 $query = "SELECT * FROM tb_user WHERE id_user <> '1' AND jenis_user <> 'administrator'";
 $hasil = mysqli_query($conn,$query);

?>
<html>
  <head>
    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
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
            <a class="nav-link " href="alternatif.php">Alternatif</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kriteria.php">Kriteria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="metode_saw.php">Metode SAW</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="filter_pelamar.php">Hasil Filter Pelamar</a>
          </li>
    </ul>

</nav>
<table align = "right">
<tr>
    <td>
 <?php
    echo "Selamat Datang, <strong>".strtoupper($_SESSION["nama"])."</strong>&nbsp;";
    echo "<a href='../action.php?act=logout' \" class = 'btn btn-outline-secondary btn-sm''>Logout </a>";
  ?>
</td>
 </tr>
 </table>
<br><br><br>
<h3 align = "center">DAFTAR PENGGUNA </h3>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong><br>
<a href="adduser.php" class="btn btn-success btn-sm" title="Menambahkan Pengguna Baru (Staff / Supervisor)">Tambah Pengguna Baru</a>
<table id="datatables" class="display">
  	<thead>
  		<tr>
        <th>No</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Jenis</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>	
  	</thead>
   <tbody>
<?php
$nomor=1;
while($data=mysqli_fetch_array($hasil)){ ?>
   <tr>
    <!-- <td><?php echo $data['id_user'];?></td> -->
 <td><?php echo $nomor;?></td>
    <td><?php echo $data['username'];?> </td>
    <td><?php echo ucwords(strtolower($data['nama']));?></td>
    <td><?php echo ucwords(strtolower($data['jenis_user']));?></td>
    <td><?php
            if ($data['status'] == 'y') {
                echo $status = "Aktif"; $button = "Nonaktifkan"; $buttitle = "Pengguna akan dinonaktifkan";
            }
            else { echo $status = "Nonaktif"; $button = "Aktifkan"; $buttitle = "Pengguna akan diaktifkan";}
     ?></td>
    <td width="250">
      <!-- <a href="action_admin.php?act=UbahUser&id=<?=$data['id_user']?>" class="btn btn-primary" title = "<?=$buttitle?>"
        onclick="return confirm ('Yakin <?=$button?> Pengguna Ini?')"><?=$button?></a> -->
        <a href="manageuser.php?id=<?=$data['id_user']?>" class="btn btn-primary" title = "Edit data pengguna"> Edit </a>
      <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?=$data['id_user']?>" class="btn btn-danger" title = "Pengguna akan dihapus"> Hapus </a>
</td>
</tr>
<!-- MODAL untuk Input Password (Hapus Pelamar) -->
<div class="modal fade" id="staticBackdrop<?=$data['id_user']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengguna "<?=ucwords(strtolower($data['nama']));?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="action_admin.php?act=HapusUser&id=<?=$data['id_user']?>">
                <div class="modal-body">
                    Input Password Anda:
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
<?php $nomor++;} ?>
</tbody>
</table>
</div>
  </body>
</html>