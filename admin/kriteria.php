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
            <a class="nav-link" href="alternatif.php">Alternatif</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="kriteria.php">Kriteria</a>
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
<h3 align = "center">PENENTUAN KRITERIA</h3>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong><br>
<table border = "0" style = "font-size:small;" width = "950px" align="center" class="table">
<tr>
<td>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="left: 0px; top: 0px; width: 100%">Jurusan</strong></button></h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="1" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">
                      <?php
                    $sqljurusan = "SELECT * FROM tb_kriteria WHERE id_alternatif = 1";
                    $hasiljurusan = mysqli_query($conn,$sqljurusan);
                    while ($jurusan = mysqli_fetch_array($hasiljurusan)){
                    ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?=ucwords(strtolower($jurusan['to']))?>, <strong>Bobot: </strong><?=$jurusan['bobot']?></li>
                        </ul>
                    <?php } ?>
                    </td></tr>
                    
                </table>
                </div>
            </div>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo" style="left: 0px; top: 0px; width: 100%">Pengalaman Kerja</strong></button></h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="1" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">
                        <?php
                    $sqlpeng = "SELECT * FROM tb_kriteria WHERE id_alternatif = 2";
                    $hasilpeng = mysqli_query($conn,$sqlpeng);
                    while ($pengalaman = mysqli_fetch_array($hasilpeng)){
                    ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?=ucwords(strtolower($pengalaman['to']))?>, <strong>Bobot: </strong><?=$pengalaman['bobot']?></li>
                        </ul>
                    <?php } ?></td></tr>
                </table>
                </div>
            </div>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseThree" style="left: 0px; top: 0px; width: 100%">Jenis Kelamin</strong></button></h2>
            <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="1" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">
                        <?php
                    $sqlkel = "SELECT * FROM tb_kriteria WHERE id_alternatif = 3";
                    $hasilkel = mysqli_query($conn,$sqlkel);
                    while ($kelamin = mysqli_fetch_array($hasilkel)){
                    ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?=ucwords(strtolower($kelamin['to']))?>, <strong>Bobot: </strong><?=$kelamin['bobot']?></li>
                        </ul>
                    <?php } ?></td></tr>
                </table>
                </div>
            </div>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseFour" style="left: 0px; top: 0px; width: 100%">Rentang IPK</strong></button></h2>
            <div id="collapseFour" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="1" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">
                        <?php
                    $sqlipk = "SELECT * FROM tb_kriteria WHERE id_alternatif = 4";
                    $hasilipk = mysqli_query($conn,$sqlipk);
                    while ($ipk = mysqli_fetch_array($hasilipk)){
                    ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?=$ipk['from']?> - <?=$ipk['to']?>, <strong>Bobot: </strong><?=$ipk['bobot']?></li>
                        </ul>
                    <?php } ?></td></tr>
                </table>
                </div>
            </div>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseFive" style="left: 0px; top: 0px; width: 100%">Rentang Gaji</strong></button></h2>
            <div id="collapseFive" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="1" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">
                        <?php
                    $sqlgaji = "SELECT * FROM tb_kriteria WHERE id_alternatif = 5";
                    $hasilgaji = mysqli_query($conn,$sqlgaji);
                    while ($gaji = mysqli_fetch_array($hasilgaji))
                    {
                    ?><ul class="list-group list-group-flush">
                            <li class="list-group-item"><?=$gaji['from']?> - <?=$gaji['to']?>, <strong>Bobot: </strong><?=$gaji['bobot']?></li>
                        </ul>
                    <?php } ?></td></tr>
                </table>
                </div>
            </div>
        </div>
    </div>
</td>
</tr>
</table>
</div>
  </body>
</html>