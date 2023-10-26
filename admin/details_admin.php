<?php   
session_start();

include_once("../koneksi.php");
$id = $_GET['id'];
$query="SELECT * FROM tb_pelamar L, tb_pendidikan P WHERE L.id_pelamar = '$id' AND P.id_pelamar = '$id' GROUP BY P.id_pelamar";
$hasil=mysqli_query($conn,$query);

// ambil data keluarga
$querykel="SELECT * FROM tb_keluarga WHERE id_pelamar = '$id' ORDER BY id_keluarga ASC";
$hasilkel=mysqli_query($conn,$querykel);

// ambil data organisasi
$queryorg="SELECT * FROM tb_organisasi WHERE id_pelamar = '$id' ORDER BY id_organisasi ASC";
$hasilorg=mysqli_query($conn,$queryorg);

// ambil data pekerjaan
$queryker="SELECT * FROM tb_pekerjaan WHERE id_pelamar = '$id' ORDER BY id_pekerjaan ASC";
$hasilker=mysqli_query($conn,$queryker);

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
            <a class="nav-link active" href="home_admin.php">Data Pelamar</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="listuser.php">Data Pengguna</a>
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
<h3 align = "center">BIODATA PELAMAR </h3>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong>
<table border = "0" style = "font-size:small;" width = "950px" align="center" class="table">
    <?php
        while($data=mysqli_fetch_array($hasil)) {
    ?>
    <tr>
    	<td align ="center" colspan = "2"><img src="../img/<?php echo $data['foto'];?>" width="150"></td>
    </tr>
    
<tr>
    <td style="width: 874px"> 
    <div class="accordion" id="accordionExample">
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="left: 0px; top: 0px; width: 100%">Data Personal&nbsp;<strong><?=strtoupper($data['nama'])?></strong></button></h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">Nama lengkap </td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($data['nama']));?> </td>
                    </tr>
                    <tr>
                          <td style="width: 874px">Panggilan</td>
                          <td style="width: 435px"><?php echo ucwords(strtolower($data['panggilan']));?></td>
                    </tr>
                     <tr>
					     <td style="width: 874px">Tempat Lahir</td>
					     <td style="width: 435px"><?php echo ucwords(strtolower($data['templahir']));?></td>
				    </tr>
				    <tr>
				        <td style="width: 874px">Tgl Lahir</td>
				        <td style="width: 435px"><?php echo date("d M Y", strtotime($data['tgllahir']));?></td>
				    </tr>
                    <tr>
                        <td style="width: 874px">Jenis Kelamin</td>
                        <td style="width: 435px"><?php if ($data['jenis_kelamin'] == "l") {echo "Laki-Laki";}else { echo "Perempuan";}?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Agama</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($data['agama']));?></td>
                    </tr>
				    <tr>
				        <td style="width: 874px">Alamat Tinggal Saat Ini</td>
				        <td style="width: 435px"><?php echo ucwords(strtolower($data['alamat_tinggal']));?></td>
				    </tr>
				    <tr>
				        <td style="width: 874px">Alamat (KTP)</td>
				        <td style="width: 435px"><?php echo ucwords(strtolower($data['alamat_ktp']));?></td>
				    </tr>
				    <tr>
				        <td style="width: 874px">No HP</td>
				        <td style="width: 435px"><?php echo ucwords(strtolower($data['hp']));?></td>
				    </tr>
				    <tr>
				        <td style="width: 874px">No WhatsApp</td>
				        <td style="width: 435px"><?php echo ucwords(strtolower($data['wa']));?></td>
				    </tr>
				    <tr>
				        <td style="width: 874px">Email</td>
				         <td style="width: 435px"><?php echo $data['email'];?></td>
				    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Data Pendidikan&nbsp;<strong><?=strtoupper($data['nama'])?></strong></button></h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
				        <td style="width: 874px">Jenjang</td>
				        <td style="width: 435px"><?php echo ucwords(strtolower($data['jenjang_pendidikan']));?></td>
				    </tr>
                    <tr>
                        <td style="width: 874px">SMA Asal</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($data['sma']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Masa SMA</td>
                        <td style="width: 435px"><?php echo $data['lulus_sma']-$data['awal_sma']." tahun";?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Jurusan SMA</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($data['jurusan_sma']));?></td>
                    </tr>
				    <tr>
				        <td style="width: 874px">Perguruan Tinggi / Universitas</td>
				         <td style="width: 435px"><?php echo ucwords(strtolower($data['universitas']));?></td>
				    </tr>
                        <tr>
                        <td style="width: 874px">Masa Kuliah</td>
                        <td style="width: 435px"><?php echo $data['lulus_kuliah']-$data['awal_kuliah']." tahun";?></td>
                    </tr>
				    <tr>
				        <td style="width: 874px">Jurusan</td>
				        <td style="width: 435px"><?php echo ucwords(strtolower($data['jurusan_kuliah']));?></td>
				    </tr>
				    <tr>
				        <td style="width: 874px">IPK</td>
				     	<td style="width: 435px"><?php echo $data['ipk'];?></td>
				    </tr>
				    <tr>
				        <td style="width: 874px">Judul Skripsi</td>
				     	<td style="width: 435px"><?php echo ucwords(strtolower($data['judul_skripsi']));?></td>
				    </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Data Pekerjaan&nbsp;<strong><?=strtoupper($data['nama'])?></strong></button></h2>
            <?php
            // apabila tidak memiliki data pekerjaan
            if (!mysqli_num_rows($hasilker)) {?>
                <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
                        <td colspan = "2">Tidak Ada Data Pekerjaan</td>
                    </tr>
                </table>
                </div>
                </div>
            <?php
            }
            else // apabila memiliki data pekerjaan
            {
                while($dataker=mysqli_fetch_array($hasilker))
                {
            ?>
            <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">Nama Perusahaan</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($dataker['nama_perusahaan']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Jabatan</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($dataker['jabatan']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Masa Kerja</td>
                        <td style="width: 435px"><?php echo "Mulai tahun ".$dataker['tahun_masuk']." sampai tahun ".$dataker['tahun_keluar']. " (".$dataker['tahun_keluar']-$dataker['tahun_masuk']." tahun)";?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Alasan Keluar (Resign)</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($dataker['alasan_keluar']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Gaji Terakhir</td>
                        <td style="width: 435px"><?php echo "Rp. ".number_format($dataker['gaji_terakhir'],2,",",".");?></td>
                    </tr>
                    </table>
                </div>
            </div><?php } }?>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Data Organisasi&nbsp;<strong><?=strtoupper($data['nama'])?></strong></button></h2>
            <?php
            // apabila tidak memiliki data organisasi
            if (!mysqli_num_rows($hasilorg)) {?>
                <div id="collapseFour" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
                        <td colspan = "2">Tidak Ada Data Organisasi</td>
                    </tr>
                </table>
                </div>
                </div>
            <?php }
            else //apabila memiliki data organisasi
            {
                while($dataorg=mysqli_fetch_array($hasilorg)) {
            ?>
            <div id="collapseFour" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">Nama Organisasi</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($dataorg['nama_organisasi']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Jabatan</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($dataorg['jabatan']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Tanggal Join</td>
                        <td style="width: 435px"><?php echo date("d M Y", strtotime($dataorg['tanggal_masuk']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Tanggal Keluar</td>
                        <td style="width: 435px"><?php echo date("d M Y", strtotime($dataorg['tanggal_keluar']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Jenis organisasi</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower(str_replace("_"," ",$dataorg['jenis_organisasi'])));?></td>
                    </tr>
                    </table>
                </div>
            </div><?php } }?>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Data Keluarga&nbsp;<strong><?=strtoupper($data['nama'])?></strong></button></h2>
            <?php
            // apabila tidak memiliki data keluarga
            if (!mysqli_num_rows($hasilkel)) {?>
                <div id="collapseFive" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
                        <td colspan = "2">Tidak Ada Data Keluarga</td>
                    </tr>
                </table>                
            <?php }
            else //apabila memiliki data keluarga
            {
                while($datakel=mysqli_fetch_array($hasilkel)) {
            ?>
            <div id="collapseFive" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
                        <td style="width: 874px">Relasi</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($datakel['relasi']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Nama</td>
                        <td style="width: 435px"><?php echo ucwords(strtolower($datakel['nama']));?></td>
                    </tr>
                    <tr>
                        <td style="width: 874px">Tanggal Lahir</td>
                        <td style="width: 435px"><?php echo date("d M Y", strtotime($datakel['tanggal_lahir']));?></td>
                    </tr>
                    </table>
                </div>
            </div><?php } }?>
        </div>
    </div>
	</td>
    <tr>
    <td colspan = "2" align = "center">
        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Hapus </a>
         <a class="btn btn-dark" onclick="location.href='home_admin.php'">Kembali</a></td>
    </tr>
<!-- MODAL untuk Input Password (Hapus Pelamar) -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Hapus Pelamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="action_admin.php?act=HapusPelamar&id=<?=$data['id_pelamar']?>">
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
</table>
<?php }?>
</body>
</html>