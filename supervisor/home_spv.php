<?php
 session_start();
 include("../koneksi.php");
 $query = "SELECT * FROM tb_pelamar";
 $hasil = mysqli_query($conn,$query);
 if(!isset($_SESSION["id"]))
{
    $_SESSION['pesan'] = "kesalahan sistem";
	header("Location: ../index.php");
}
// ambil data pengguna
$usersql = "SELECT * FROM tb_user WHERE id_user = ".$_SESSION['id'];
$hasiluser=mysqli_query($conn,$usersql);
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

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="../popper.min.js"></script>
    <script src="../bootstrap.min.js"></script>
    

<nav class="navbar navbar-expand-lg navbar-black bg-light">

     <!-- MENU -->   

    <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" href="#">Data Pelamar</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="manageakun_spv.php">Kelola Akun</a>
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
<h3 align = "center">DAFTAR PELAMAR </h3>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong>
<br>
<table id="datatables" class="display">
  	<thead>
  		<tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Alamat Tinggal</th>
        <th>Aksi</th>
      </tr>	
  	</thead>
   <tbody>
<?php
$nomor=1;
while($data=mysqli_fetch_array($hasil)){ ?>
   <tr>
    <!-- <td><?php echo $data['id'];?></td> -->
 <td><?php echo $nomor;?></td>
    <td><?php echo ucwords(strtolower($data['nama']));?> </td>
    <td><?php echo ucwords(strtolower($data['templahir']));?></td>
    <td><?php echo date('d F Y', strtotime($data['tgllahir']));?></td>
    <td><?php echo ucwords(strtolower($data['alamat_tinggal']));?></td>
    <td width="250">
      <button type="button" class="btn btn-primary" value="Detail" onclick="location.href='details_spv.php?id=<?=$data['id_pelamar']?>'">Detail</button>
      <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?=$data['id_pelamar']?>" class="btn btn-danger"> Hapus </a>
</td>
<!-- MODAL untuk Input Password (Hapus Pelamar) -->
<div class="modal fade" id="staticBackdrop<?=$data['id_pelamar']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Hapus Pelamar "<?=ucwords(strtolower($data['nama']));?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="action_spv.php?act=HapusPelamar&id=<?=$data['id_pelamar']?>">
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
<! -- END MODAL -->
<?php $nomor++;} ?>
</tbody>
</table>
</div>
  </body>
</html>