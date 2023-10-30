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
            <a class="nav-link" href="listuser.php">Data Pengguna</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="alternatif.php">Kriteria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="kriteria.php">Bobot</a>
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

<h3 align = "center">Bobot</h3>
<br>

<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong><br>
<!-- <a href="addalternatif.php" class="btn btn-success btn-sm" title="Menambahkan Pengguna Baru (Staff / Supervisor)">Tambah Alternatif</a> -->
    <hr>
        <div class="table-responsive">
<table class ="table table-bordered">                        
    <thead>
      <tr>
        <th hidden class="text-center">ID Kriteria</th>
        <th class="text-center">Kriteria</th>
        <th class="text-center">Range Dari</th>
        <th class="text-center">Range Sampai / Fix</th>
        <th class="text-center">Bobot</th>
        <th class="text-center">Model SAW</th>
        <th hidden class="text-center">Ranking</th>
      </tr> 
    </thead>
<?php
$sqlaternatif = "select krit.id_kriteria,alt.nama_alternatif, krit.alt_from,krit.alt_to,krit.bobot,alt.nilai_saw, alt.rangking ". 
                "from tb_alternatif alt,tb_kriteria krit ".
                "where alt.id_alternatif=krit.id_alternatif order by alt.nama_alternatif,cast(krit.alt_from as integer) desc;";

$dataalter=mysqli_query($conn,$sqlaternatif);
$nomor=1;

while ($a=mysqli_fetch_array($dataalter)) {
?>
    <tr>
        <td hidden class="text-center"><?php echo $a['id_kriteria'];?> </td>
        <td class="text-center"><?php echo ucwords($a['nama_alternatif']);?> </td>
        <td class="text-center"><?php echo $a['alt_from'];?> </td>
        <td class="text-center "><?php echo $a['alt_to'];?> </td>
        <td class="text-center"><?php echo $a['bobot'];?> </td>
        <td class="text-center"><?php if ($a['nilai_saw']==1) {echo "Benefit";} else { echo "Cost";}?>
        <td hidden class="text-center"><?php echo $a['rangking'];?> </td>
    </tr>
<?php 
}
?>
</td>
</tr>
</table>
</div>
  </body>
</html>