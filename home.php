<?php
 session_start();
 include("koneksi.php");
 $query = "SELECT * FROM tb_pelamar";
 $hasil = mysqli_query($conn,$query);
 if(!isset($_SESSION["nama"]))
  {
	header("Location: index.php");
  }

?>
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
    <img src="img/Header-GG.PNG" alt="Welcome" width="100%" height="200px">
    <!--<h1>E-Recruitment PT Gudang Garam, Tbk.</h1> -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    

    <nav class="navbar navbar-expand-lg navbar-black bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="home.php">REKAP PELAMAR || </a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <a class="navbar-brand" href="register.php">PENDAFTARAN</a>
            </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>

  </div>

</nav>

 <br>
      <?php
    echo "Selamat Datang <strong>".$_SESSION["nama"]."</strong><br />";
    echo "<input type=\"button\" value=\"Logout\" onclick=\"location.href='action.php?act=logout' \"/>";
  ?>

</br>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong>
<br></br>
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
    <td><?php echo $data['nama'];?> </td>
    <td><?php echo $data['templahir'];?></td>
    <td><?php echo date('d F Y', strtotime($data['tgllahir']));?></td>
    <td><?php echo $data['alamat_tinggal'];?></td>
    <td width="250">
      <button type="button" class="btn btn-info"  value="Detail" onclick="location.href='details.php?id=<?=$data['id_pelamar']?>'">Detail</button>
      <button type="button" class="btn btn-warning" value="Ubah" onclick="location.href='editdata.php?id=<?=$data['id_pelamar']?>'">Ubah</button> 
      <a href="action.php?act=HapusData&id=<?=$data['id_pelamar']?>" onclick="return confirm ('Yakin Hapus Data?')" class="btn btn-danger"> Hapus </a>
</td>
    
<?php $nomor++;} ?>
</tbody>
</table>
</div>
  </body>
</html>