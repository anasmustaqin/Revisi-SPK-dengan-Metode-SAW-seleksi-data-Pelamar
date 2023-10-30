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
            <a class="nav-link active" href="home_staff.php">Data Pelamar</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="manageakun_staff.php">Kelola Akun</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">MENU 4</a>
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
        <td>
           <a class="btn btn-success" href="action_staff.php?act=tambahorg&idpelamar=<?=$data['id_pelamar']?>">Tambah Data Organisasi</a>
           <a class="btn btn-success" href="action_staff.php?act=tambahkerja&idpelamar=<?=$data['id_pelamar']?>">Tambah Data Pekerjaan</a>
           <a class="btn btn-success" href="action_staff.php?act=tambahkel&idpelamar=<?=$data['id_pelamar']?>">Tambah Anggota Keluarga</a>
       </td>
    </tr>   
<tr>
    <td style="width: 900px"> 
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
                          <td style="width: 874px">NIK KTP</td>
                          <td style="width: 435px"><?=$data['nik_ktp']?></td>
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
                    <tr>
                        <td colspan="2" align="center"><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#staticBackdropEDITPER<?=$data['id_pelamar']?>">Edit Data Personal</a></td>                        
                    </tr>
                </table>
                </div>
            </div>

<!-- MODAL EDIT DATA PERSONAL -->
<div class="modal fade" id="staticBackdropEDITPER<?=$data['id_pelamar']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Data Personal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="action_staff.php?act=editpersonal&id=<?=$data['id_pelamar']?>">
                <div class="modal-body" align="left">
                    <strong>Nama lengkap:</strong>
                    <input type="text" name="nama" placeholder="Input Nama" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['nama']));?>"> 
                    <strong>Panggilan:</strong>
                    <input type="text" name="panggilan" placeholder="Panggilan" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['panggilan']));?>">
                    <strong>NIK KTP:</strong>
                    <input type="text" name="ktp" maxlength="16" placeholder="16 digit" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" value="<?=$data['nik_ktp']?>">
                    <strong>Tempat Lahir:</strong>
                    <input type="text" name="templahir" placeholder="ct: Surabaya" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['templahir']));?>">
                    <strong>Tgl Lahir:</strong>
                    <input type="date" name="tgllahir" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['tgllahir']));?>">
                    <strong>Jenis Kelamin:</strong>
                    <input type="radio" name="jk" value = "l" class="form-check-input" <?php if($data['jenis_kelamin']=='l'){ echo 'checked';} ?> >  Laki-Laki
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="jk" value = "p" class="form-check-input" <?php if($data['jenis_kelamin']=='p'){ echo 'checked';} ?>> Perempuan <br>
                    <strong>Agama: </strong>
                    <select name="agama" id="agama" class="form-select" aria-label="Default select example">
                      <option value="islam" <?php if($data['agama']=='islam'){ echo 'selected';} ?>>Islam</option>
                      <option value="kristen" <?php if($data['agama']=='kristen'){ echo 'selected';} ?>>Kristen</option>
                      <option value="katolik" <?php if($data['agama']=='katolik'){ echo 'selected';} ?>>Katolik</option>
                      <option value="hindu" <?php if($data['agama']=='hindu'){ echo 'selected';} ?>>Hindu</option>
                      <option value="budha" <?php if($data['agama']=='budha'){ echo 'selected';} ?>>Budha</option>
                      <option value="khonghucu" <?php if($data['agama']=='khonghucu'){ echo 'selected';} ?>>Khonghucu</option>
                    </select>
                    <strong:>Alamat Tinggal Saat Ini (Domisili):</strong>
                    <textarea name="alamat_tinggal" class="form-control" id="exampleFormControlTextarea1" rows="2" required><?=ucwords(strtolower($data['alamat_tinggal']));?></textarea>
                    <strong>Alamat Sesuai KTP:</strong>
                    <textarea name="alamat_ktp" placeholder="diisi lengkap dengan RT, RW, Kel/Desa, Kec, dan Kab/Kota" class="form-control" id="exampleFormControlTextarea1" rows="2" required><?=ucwords(strtolower($data['alamat_ktp']));?></textarea>
                    <strong>No telp:<br><small id="passwordHelpBlock" class="form-text text-muted">
        format xxxxxxxxxxxxx</small></strong>
                    <input type="text" name="hp" placeholder="Diawali angka 0" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['hp']));?>">
                    <strong>No WhatsApp<br><small id="passwordHelpBlock" class="form-text text-muted">
        format xxxxxxxxxxxxx</small></strong>
                    <input type="tel" name="wa" placeholder="Diawali angka 0" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['wa']));?>">
                    <strong>Email:</strong>
                    <input type="email" name="email" placeholder="contoh@email.com" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['email']));?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
 </div>
<! -- END MODAL EDIT PERSONAL-->

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
                    <tr>
                        <td colspan="2" align="center"><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#staticBackdropEDITPEND<?=$data['id_pendidikan']?>">Edit Data Pendidikan</a></td>
                    </tr>
                    </table>
                </div>
            </div>

<!-- MODAL EDIT DATA PENDIDIKAN -->
<div class="modal fade" id="staticBackdropEDITPEND<?=$data['id_pendidikan']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pendidikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="action_staff.php?act=editpend&idpelamar=<?=$data['id_pelamar']?>&idpend=<?=$data['id_pendidikan']?>">
                <div class="modal-body" align="left">
                    <strong>Jenjang Sekolah Terakhir: </strong>
                    <select name="jenjang" id="jenjang" class="form-select" aria-label="Default select example">
                      <option value="sltp" <?php if($data['jenjang_pendidikan']=='sltp'){ echo 'selected';} ?>>SLTP</option>
                      <option value="slta" <?php if($data['jenjang_pendidikan']=='slta'){ echo 'selected';} ?>>SLTA</option>
                      <option value="d1" <?php if($data['jenjang_pendidikan']=='d1'){ echo 'selected';} ?>>D1</option>
                      <option value="d2" <?php if($data['jenjang_pendidikan']=='d2'){ echo 'selected';} ?>>D2</option>
                      <option value="d3" <?php if($data['jenjang_pendidikan']=='d3'){ echo 'selected';} ?>>D3</option>
                      <option value="d4" <?php if($data['jenjang_pendidikan']=='d4'){ echo 'selected';} ?>>D4</option>
                      <option value="s1" <?php if($data['jenjang_pendidikan']=='s1'){ echo 'selected';} ?>>S1</option>
                      <option value="s2" <?php if($data['jenjang_pendidikan']=='s2'){ echo 'selected';} ?>>S2</option>
                      <option value="s3" <?php if($data['jenjang_pendidikan']=='s3'){ echo 'selected';} ?>>S3</option>
                    </select>
                    <strong>SMA Asal:</strong>
                    <input type="text" name="sma" placeholder="ct: SMAN 1 Surabaya" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['sma']));?>">
                    <strong>Tahun Masuk SMA:</strong>
                    <input type="number" min="1900" max="2030" name="masuk_sma" placeholder="ct: 2016" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['awal_sma']));?>">
                    <strong>Tahun Lulus SMA:</strong>
                    <input type="number" min="1900" max="2030" name="lulus_sma" placeholder="ct: 2019" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['lulus_sma']));?>">
                    <strong>Jurusan SMA</strong>
                    <select name="jurusan" id="jurusan" class="form-select" aria-label="Default select example">
                      <option value="ipa" <?php if($data['jurusan_sma']=='ipa'){ echo 'selected';} ?>>IPA</option>
                      <option value="ips" <?php if($data['jurusan_sma']=='ips'){ echo 'selected';} ?>>IPS</option>
                      <option value="bahasa" <?php if($data['jurusan_sma']=='bahasa'){ echo 'selected';} ?>>Bahasa</option>
                      <option value="agama" <?php if($data['jurusan_sma']=='agama'){ echo 'selected';} ?>>Agama</option>
                      <option value="lain" <?php if($data['jurusan_sma']=='lain'){ echo 'selected';} ?>>Lainnya</option>
                    </select>
                    <strong>Perguruan Tinggi / Universitas</strong>
                    <input type="text" name="universitas" placeholder="ct: Universitas Surabaya" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['universitas']));?>">
                    <strong>Tahun Masuk Kuliah</strong>
                    <input type="number" min="1900" max="2030"name="masuk_kuliah" placeholder="ct: 2019" class="form-control form-control-sm" required value="<?=$data['awal_kuliah']?>">
                    <strong>Tahun Lulus Kuliah</strong>
                    <input type="number" min="1900" max="2030"name="lulus_kuliah" placeholder="ct: 2023" class="form-control form-control-sm" required value="<?=$data['lulus_kuliah']?>">
                    <strong>Jurusan Kuliah</strong>
                    <input type="text" name="jurusan_kuliah" placeholder="ct: Teknik Mesin" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['jurusan_kuliah']));?>">
                    <strong>IPK<small id="passwordHelpBlock" class="form-text text-muted">
        format x,yy</small></strong>
                    <input type="number" step="0.01" min="1" max="4" name="nilai" placeholder="Input Menggunakan titik (.)" class="form-control form-control-sm" required value="<?=$data['ipk']?>">
                    <strong>Judul Skripsi</strong>
                    <textarea name="judul" placeholder="diisi dengan lengkap" class="form-control" id="exampleFormControlTextarea1" rows="2" required><?=ucwords(strtolower($data['judul_skripsi']));?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
 </div>
<! -- END MODAL EDIT PENDIDIKAN-->

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
                    <tr>
                        <td colspan = "2" align="center"><a class="btn btn-success" href="action_staff.php?act=tambahkerja&idpelamar=<?=$data['id_pelamar']?>">Tambah Data Pekerjaan</a></td>
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
                    <tr>
                        <td colspan = "2" align="center"><a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdropEDIT<?=$dataker['id_pekerjaan']?>" href="">Edit Data Pekerjaan Ini</a>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropDEL<?=$dataker['id_pekerjaan']?>" href="">Hapus Data Pekerjaan Ini</a>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>

<!-- MODAL untuk Input Password (Hapus Data Pekerjaan) -->
<div class="modal fade" id="staticBackdropDEL<?=$dataker['id_pekerjaan']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Pekerjaan "<?=strtoupper($dataker['nama_perusahaan']);?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="action_staff.php?act=delkerja&idpelamar=<?=$data['id_pelamar']?>&idker=<?=$dataker['id_pekerjaan']?>">
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
<! -- END MODAL HAPUS PEKERJAAN -->

<!-- MODAL EDIT DATA PEKERJAAN -->
<div class="modal fade" id="staticBackdropEDIT<?=$dataker['id_pekerjaan']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pekerjaan "<?=strtoupper($dataker['nama_perusahaan']);?>"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="action_staff.php?act=editkerja&idpelamar=<?=$data['id_pelamar']?>&idker=<?=$dataker['id_pekerjaan']?>">
                <div class="modal-body" align="left">
                    <strong>Nama Perusahaan: </strong>
                    <input type="text" name="perusahaan" placeholder="ct: Paguyuban Senam Jasmani" class="form-control form-control-sm" required value="<?=ucwords(strtolower($dataker['nama_perusahaan']));?>">
                    <strong>Jabatan:</strong>
                    <input type="text" name="jabatan_per" placeholder="ct: Bendahara" class="form-control form-control-sm" required value="<?=ucwords(strtolower($dataker['jabatan']));?>">
                    <strong>Tahun Masuk:</strong>
                    <input type="number" min="1900" max="2030" name="masuk_per" class="form-control form-control-sm" placeholder="ct:2022" required value="<?=$dataker['tahun_masuk']?>">
                    <strong>Tahun Keluar:</strong>
                    <input type="number" min="1900" max="2030" name="keluar_per" class="form-control form-control-sm" placeholder="ct:2022" required value="<?=$dataker['tahun_keluar']?>">
                    <strong>Gaji:</strong> <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping">Rp.</span>
                    <input type="number" min="1000000" max="99999999" name="gaji" class="form-control" placeholder="tanpa titik, ct: 5000000" required value="<?=$dataker['gaji_terakhir']?>"></div>
                    <strong>Alasan Berhenti / Pindah Kerja:</strong>
                    <textarea name="resign" placeholder="Alasan Berhenti / Pindah Kerja" class="form-control" id="exampleFormControlTextarea1" rows="2" required><?=ucwords(strtolower($dataker['alasan_keluar']));?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
 </div>
<! -- END MODAL EDIT PEKERJAAN-->

        <?php } }?>
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
                    <tr>
                        <td colspan = "2" align="center"><a class="btn btn-success" href="action_staff.php?act=tambahorg&idpelamar=<?=$data['id_pelamar']?>">Tambah Data Organisasi</a></td>
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
                    <tr>
                        <td colspan = "2" align="center"><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#staticBackdropEDITORG<?=$dataorg['id_organisasi']?>">Edit Data Organisasi Ini</a>
                            <a class="btn btn-danger" href="" data-bs-toggle="modal" data-bs-target="#staticBackdropDELORG<?=$dataorg['id_organisasi']?>">Hapus Data Organisasi Ini</a>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>

<!-- MODAL untuk Input Password (Hapus Data Organisasi) -->
<div class="modal fade" id="staticBackdropDELORG<?=$dataorg['id_organisasi']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Organisasi "<?=strtoupper($dataorg['nama_organisasi']);?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="action_staff.php?act=delorg&idpelamar=<?=$data['id_pelamar']?>&idorg=<?=$dataorg['id_organisasi']?>">
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
<! -- END MODAL HAPUS ORGANISASI -->

<!-- MODAL EDIT DATA ORGANISASI -->
<div class="modal fade" id="staticBackdropEDITORG<?=$dataorg['id_organisasi']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Data Organisasi "<?=strtoupper($dataorg['nama_organisasi']);?>"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="action_staff.php?act=editorg&idpelamar=<?=$data['id_pelamar']?>&idorg=<?=$dataorg['id_organisasi']?>">
                <div class="modal-body" align="left">
                    <strong>Nama Organisasi: </strong>
                    <input type="text" name="nama_org" placeholder="ct: Paguyuban Senam Jasmani" class="form-control form-control-sm" required value="<?=ucwords(strtolower($dataorg['nama_organisasi']));?>">
                    <strong>Jabatan:</strong>
                    <input type="text" name="jabatan_org" placeholder="ct: Bendahara" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataorg['jabatan']));?>" required>
                    <strong>Tanggal Masuk:</strong>
                    <input type="date" name="masuk_org" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataorg['tanggal_masuk']));?>" required>
                    <strong>Tanggal Keluar:</strong>
                    <input type="date" name="keluar_org" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataorg['tanggal_keluar']));?>" required>
                    <strong>Jenis Organisasi:</strong>
                    <select name="jenis" id="jenis" class="form-select" aria-label="Default select example">
                          <option value="luar_kampus" <?php if ($dataorg['jenis_organisasi']=='luar_kampus'){ echo 'selected'; }?> > Luar Kampus</option>
                          <option value="dalam_kampus" <?php if ($dataorg['jenis_organisasi']=='dalam_kampus'){ echo 'selected'; }?>>Dalam Kampus</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
 </div>
<! -- END MODAL EDIT ORGANISASI -->

        <?php } }?>
        </div>
        <div class="accordion-item" align="center">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Data Keluarga&nbsp;<strong><?=strtoupper($data['nama'])?></strong>
            </button></h2>
            <?php
            // apabila tidak memiliki data keluarga
            if (!mysqli_num_rows($hasilkel)) {?>
                <div id="collapseFive" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border="0" width="100%" class="table">
                    <tr>
                        <td colspan = "2">Tidak Ada Data Keluarga</td>
                    </tr>
                    <tr>
                        <td colspan = "2" align="center"><a class="btn btn-success" href="action_staff.php?act=tambahkel&idpelamar=<?=$data['id_pelamar']?>">Tambah Anggota Keluarga</a></td>
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
                    <tr>
                        <td colspan = "2" align="center"><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#staticBackdropEDITKEL<?=$datakel['id_keluarga']?>">Edit Data Keluarga Ini</a>
                            <a class="btn btn-danger" href="" data-bs-toggle="modal" data-bs-target="#staticBackdropDELKEL<?=$datakel['id_keluarga']?>" >Hapus Data Keluarga Ini</a>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>

<!-- MODAL untuk Input Password (Hapus Data Keluarga) -->
<div class="modal fade" id="staticBackdropDELKEL<?=$datakel['id_keluarga']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Keluarga "<?=strtoupper($datakel['relasi']);?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="action_staff.php?act=delkel&idpelamar=<?=$data['id_pelamar']?>&idkel=<?=$datakel['id_keluarga']?>">
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
<! -- END MODAL HAPUS KELUARGA -->

<!-- MODAL EDIT DATA KELUARGA -->
<div class="modal fade" id="staticBackdropEDITKEL<?=$datakel['id_keluarga']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Edit Data Keluarga "<?=strtoupper($datakel['relasi']);?>"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="action_staff.php?act=editkel&idpelamar=<?=$data['id_pelamar']?>&idkel=<?=$datakel['id_keluarga']?>">
                <div class="modal-body" align="left">
                    <strong>Nama Keluarga: </strong>
                    <input type="text" name="perusahaan" placeholder="ct: Andi Kemang" class="form-control form-control-sm" required value="<?=ucwords(strtolower($datakel['nama']));?>">
                    <strong>Relasi:</strong>
                    <select name="relasi" id="relasi" class="form-select" aria-label="Default select example">
                      <option value="ayah" <?php if ($datakel['relasi']=='ayah'){ echo 'selected'; }?>>Ayah</option>
                      <option value="ibu" <?php if ($datakel['relasi']=='ibu'){ echo 'selected'; }?>>Ibu</option>
                      <option value="kakak" <?php if ($datakel['relasi']=='kakak'){ echo 'selected'; }?>>Kakak</option>
                      <option value="adik" <?php if ($datakel['relasi']=='adik'){ echo 'selected'; }?>>Adik</option>
                    </select>
                    <strong>Tanggal Lahir:</strong>
                    <input type="date" name="tgllahir_kel" class="form-control form-control-sm" value="<?=ucwords(strtolower($datakel['tanggal_lahir']));?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
 </div>
<! -- END MODAL EDIT KELUARGA -->

        <?php } } ?>
        </div>
    </div>
	</td>
    <tr>
    <td colspan = "2" align = "center">
        <!-- <a href="editpelamar.php?id=<?=$id?>" class="btn btn-danger"> Edit Pelamar </a> -->
         <a class="btn btn-dark" onclick="location.href='home_staff.php'">Kembali</a></td>
    </tr>
</table>
<?php }?>
</body>
</html>