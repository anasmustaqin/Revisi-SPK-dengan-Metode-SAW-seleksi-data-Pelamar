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
            <a class="nav-link " href="home_admin.php">Data Pelamar</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="listuser.php">Data Pengguna</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link active" href="alternatif.php">Kriteria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kriteria.php">Bobot</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="metode_saw.php">Metode SAW</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="filter_pelamar.php">Hasil Filter Pelamar</a>
          </li> -->
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
<h3 align = "center">RANKING KRITERIA</h3>

<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong><br>
<!-- <a href="addalternatif.php" class="btn btn-success btn-sm" title="Menambahkan Pengguna Baru (Staff / Supervisor)">Tambah Alternatif</a> -->
    <hr>
    <br>
        <div class="table-responsive">
            <table class ="table table-bordered"> 
                             
  	<thead>
  	  <tr>
        <th class="text-center">Nomor</th>
        <th class="text-center">Nama Alternatif</th>
        <th class="text-center">Nilai SAW</th>
        <th class="text-center">Ranking</th>
      </tr>	
  	</thead>
<?php
$sqlaternatif = "SELECT * FROM tb_alternatif";
$dataalter=mysqli_query($conn,$sqlaternatif);
$nomor=1;

while ($a=mysqli_fetch_array($dataalter)) {
?>
    <tr>
        <td class="text-center"><?php echo $a['id_alternatif'];?> </td>
        <td class="text-center"><?php echo $a['nama_alternatif'];?> </td>
        <td class="text-center"><?php if ($a['nilai_saw']==1) { echo "Benefit"; }
        else { echo "Cost";}
    ?> </td>
        <td class="text-center"><?php echo $a['rangking']; ?> </td>
        <!--<td class="text-center">  
        <a href="manageuser.php?id=<?=$a['id_alternatif']?>" class="btn btn-primary" title = "Edit data pengguna">Edit </a>
        <a href="#" class="btn btn-danger" title = "Data dihapus">Hapus</a>

          
      </td>-->
    </tr>

<?php 
};
?>

</tbody>
 <?php $nomor++; ?>
</table>

</div>
  </body>
</html>