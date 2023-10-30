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
<br><br>
<h2 align="center">Edit Data Pelamar</h2>
<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong>
<br>
<form method="POST" action="action_staff.php?act=UbahPelamar&id=<?=$id?>">
<?php
	while($data=mysqli_fetch_array($hasil)) {
?>
<div class="accordion" id="accordionExample">
    <div class="accordion-item" align="center">
	   	<h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Data Personal&nbsp;<strong><?=strtoupper($data['nama'])?></strong></strong></button></h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table border = "1" style = "font-size:medium;" width = "800px" align="center" class="table">
                    	<tr>
	                        <td>Nama lengkap </td>
	                        <td><input type="text" name="nama" placeholder="Input Nama" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['nama']));?>"> </td>
                    	</tr>
                    	<tr>
							<td>Panggilan</td>
							<td><input type="text" name="panggilan" placeholder="Panggilan" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['panggilan']));?>"></td>
						</tr>
						<tr>
							<td>Tempat Lahir</td>
							<td><input type="text" name="templahir" placeholder="ct: Surabaya" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['templahir']));?>"></td>
						</tr>
						<tr>
							<td>Tgl Lahir</td>
							<td><input type="date" name="tgllahir" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['tgllahir']));?>"></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td><input type="radio" name="jk" value = "l" class="form-check-input" <?php if($data['jenis_kelamin']=='l'){ echo 'checked';} ?> >  Laki-Laki
					            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					            <input type="radio" name="jk" value = "p" class="form-check-input" <?php if($data['jenis_kelamin']=='p'){ echo 'checked';} ?>> Perempuan</td>
						</tr>
						<tr>
	                        <td>Agama </td>
	                        <td><select name="agama" id="agama" class="form-select" aria-label="Default select example">
								  <option value="islam" <?php if($data['agama']=='islam'){ echo 'selected';} ?>>Islam</option>
								  <option value="kristen" <?php if($data['agama']=='kristen'){ echo 'selected';} ?>>Kristen</option>
								  <option value="katolik" <?php if($data['agama']=='katolik'){ echo 'selected';} ?>>Katolik</option>
								  <option value="hindu" <?php if($data['agama']=='hindu'){ echo 'selected';} ?>>Hindu</option>
								  <option value="budha" <?php if($data['agama']=='budha'){ echo 'selected';} ?>>Budha</option>
								  <option value="khonghucu" <?php if($data['agama']=='khonghucu'){ echo 'selected';} ?>>Khonghucu</option>
								</select></td>
                    	</tr>
						<tr>
							<td>Alamat Tinggal Saat Ini (Domisili)</td>
							<td><textarea name="alamat_tinggal" class="form-control" id="exampleFormControlTextarea1" rows="2" required><?=ucwords(strtolower($data['alamat_tinggal']));?></textarea></td>
						</tr>
						<tr>
							<td>Alamat Sesuai KTP</td>
							<td><textarea name="alamat_ktp" placeholder="diisi lengkap dengan RT, RW, Kel/Desa, Kec, dan Kab/Kota" class="form-control" id="exampleFormControlTextarea1" rows="2" required><?=ucwords(strtolower($data['alamat_ktp']));?></textarea></td>
						</tr>
						<tr>
							<td>No telp<br><small id="passwordHelpBlock" class="form-text text-muted">
        format xxxxxxxxxxxxx</small></td>
							<td><input type="text" name="hp" placeholder="Diawali angka 0" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['hp']));?>"></td>
						</tr>
						<tr>
							<td>No WhatsApp<br><small id="passwordHelpBlock" class="form-text text-muted">
        format xxxxxxxxxxxxx</small></td>
							<td><input type="tel" name="wa" placeholder="Diawali angka 0" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['wa']));?>"></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="email" name="email" placeholder="contoh@email.com" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['email']));?>"></td>
						</tr>
                    </table>
                </div>
            </div>
        </div>
    <div class="accordion-item" align="center">
		<h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">Data Pendidikan&nbsp;<strong><?=strtoupper($data['nama'])?></strong></strong></button></h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                	<table border = "1" style = "font-size:medium;" width = "800px" align="center" class="table"> 
                    	<tr>
	                        <td>Jenjang Sekolah Terakhir </td>
	                        <td><select name="jenjang" id="jenjang" class="form-select" aria-label="Default select example">
								  <option value="sltp" <?php if($data['jenjang_pendidikan']=='sltp'){ echo 'selected';} ?>>SLTP</option>
								  <option value="slta" <?php if($data['jenjang_pendidikan']=='slta'){ echo 'selected';} ?>>SLTA</option>
								  <option value="d1" <?php if($data['jenjang_pendidikan']=='d1'){ echo 'selected';} ?>>D1</option>
								  <option value="d2" <?php if($data['jenjang_pendidikan']=='d2'){ echo 'selected';} ?>>D2</option>
								  <option value="d3" <?php if($data['jenjang_pendidikan']=='d3'){ echo 'selected';} ?>>D3</option>
								  <option value="d4" <?php if($data['jenjang_pendidikan']=='d4'){ echo 'selected';} ?>>D4</option>
								  <option value="s1" <?php if($data['jenjang_pendidikan']=='s1'){ echo 'selected';} ?>>S1</option>
								  <option value="s2" <?php if($data['jenjang_pendidikan']=='s2'){ echo 'selected';} ?>>S2</option>
								  <option value="s3" <?php if($data['jenjang_pendidikan']=='s3'){ echo 'selected';} ?>>S3</option>
								</select></td>
                    	</tr>
                    	<tr>
	                        <td>SMA Asal</td>
	                        <td><input type="text" name="sma" placeholder="ct: SMAN 1 Surabaya" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['sma']));?>"></td>
	                    </tr>
	                    <tr>
	                        <td>Tahun Masuk SMA</td>
	                        <td><input type="number" min="1900" max="2030" name="masuk_sma" placeholder="ct: 2016" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['awal_sma']));?>"></td>
	                    </tr>
	                    <tr>
	                        <td>Tahun Lulus SMA</td>
	                        <td><input type="number" min="1900" max="2030" name="lulus_sma" placeholder="ct: 2019" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['lulus_sma']));?>"></td>
	                    </tr>
	                    <tr>
	                        <td>Jurusan SMA</td>
	                        <td><select name="jurusan" id="jurusan" class="form-select" aria-label="Default select example">
								  <option value="ipa" <?php if($data['jurusan_sma']=='ipa'){ echo 'selected';} ?>>IPA</option>
								  <option value="ips" <?php if($data['jurusan_sma']=='ips'){ echo 'selected';} ?>>IPS</option>
								  <option value="bahasa" <?php if($data['jurusan_sma']=='bahasa'){ echo 'selected';} ?>>Bahasa</option>
								  <option value="agama" <?php if($data['jurusan_sma']=='agama'){ echo 'selected';} ?>>Agama</option>
								  <option value="lain" <?php if($data['jurusan_sma']=='lain'){ echo 'selected';} ?>>Lainnya</option>
								</select></td>
	                    </tr>
					    <tr>
					        <td>Perguruan Tinggi / Universitas</td>
					        <td><input type="text" name="universitas" placeholder="ct: Universitas Surabaya" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['universitas']));?>"></td>
					    </tr>
	                    <tr>
	                        <td>Tahun Masuk Kuliah</td>
	                        <td><input type="number" min="1900" max="2030"name="masuk_kuliah" placeholder="ct: 2019" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['awal_kuliah']));?>"></td>
	                    </tr>
	                    <tr>
	                        <td>Tahun Lulus Kuliah</td>
	                        <td><input type="number" min="1900" max="2030"name="lulus_kuliah" placeholder="ct: 2023" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['lulus_kuliah']));?>"></td>
	                    </tr>
					    <tr>
					        <td>Jurusan Kuliah</td>
					        <td><input type="text" name="jurusan_kuliah" placeholder="ct: Teknik Mesin" class="form-control form-control-sm" required value="<?=ucwords(strtolower($data['jurusan_kuliah']));?>"></td>
					    </tr>
					    <tr>
					        <td>IPK<br><small id="passwordHelpBlock" class="form-text text-muted">
        format x,yy</small></td>
					     	<td><input type="number" step="0.01" min="1" max="4" name="nilai" placeholder="Input Menggunakan titik (.)" class="form-control form-control-sm" required value="<?=$data['ipk']?>"></td>
					    </tr>
					    <tr>
					        <td>Judul Skripsi</td>
					     	<td><textarea name="judul" placeholder="diisi dengan lengkap" class="form-control" id="exampleFormControlTextarea1" rows="2" required><?=ucwords(strtolower($data['judul_skripsi']));?></textarea></td>
					    </tr>
                    </table>
                </div>
        </div>
    </div>
    <div class="accordion-item" align="center">
		<h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseOne">Data Pekerjaan&nbsp;<strong><?=strtoupper($data['nama'])?></strong></strong></button></h2>
            <div id="collapseFour" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <?php
       			// apabila tidak memiliki data pekerjaan
            	if (!mysqli_num_rows($hasilker)) {?>
                	<input type="checkbox" name="pekerjaan" class="form-check-input" id="flexCheckDefault"> <strong>Centang jika mengisi formulir Pekerjaan</strong>
                	<table border = "1" style = "font-size:medium;" width = "800px" align="center" class="table"> 
                    	<tr>
	                        <td>Nama Perusahaan</td>
	                        <td><input type="text" name="perusahaan" placeholder="ct: PT. Karya Abadi" class="form-control form-control-sm"></td>
	                    </tr>
	                    <tr>
					        <td>Jabatan</td>
					        <td><input type="text" name="jabatan_per" placeholder="ct: Bendahara" class="form-control form-control-sm"></td>
					    </tr>
	                    <tr>
	                        <td>Tahun Masuk</td>
	                        <td><input type="number" min="1900" max="2030" name="masuk_per" class="form-control form-control-sm" placeholder="ct:2021"></td>
	                    </tr>
	                    <tr>
	                        <td>Tahun Keluar</td>
	                        <td><input type="number" min="1900" max="2030" name="keluar_per" class="form-control form-control-sm" placeholder="ct:2022"></td>
	                    </tr>
					    <tr>
					        <td>Gaji</td>
					        <td><div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping">Rp.</span>
					        	<input type="number" min="1000000" max="99999999" name="gaji" class="form-control" placeholder="tanpa titik, ct: 5000000"></div></td>
					     </tr>
					     <tr>
							<td>Alasan Berhenti / Pindah Kerja</td>
							<td><textarea name="resign" placeholder="Alasan Berhenti / Pindah Kerja" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea></td>
						</tr>
                    </table>
                <?php }
                else
                { while ($dataker = mysqli_fetch_array($hasilker)) {
                	
                ?>
                <table border = "1" style = "font-size:medium;" width = "800px" align="center" class="table"> 
                   	<tr>
	                    <td>Nama Perusahaan</td>
	                    <td><input type="text" name="perusahaan" placeholder="ct: PT. Karya Abadi" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataker['nama_perusahaan']));?>"></td>
	                </tr>
	                <tr>
					    <td>Jabatan</td>
					    <td><input type="text" name="jabatan_per" placeholder="ct: Bendahara" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataker['jabatan']));?>"></td>
					</tr>
	                <tr>
	                    <td>Tahun Masuk</td>
	                    <td><input type="number" min="1900" max="2030" name="masuk_per" class="form-control form-control-sm" placeholder="ct:2021" value="<?=ucwords(strtolower($dataker['tahun_masuk']));?>"></td>
	                </tr>
	                <tr>
	                    <td>Tahun Keluar</td>
	                    <td><input type="number" min="1900" max="2030" name="keluar_per" class="form-control form-control-sm" placeholder="ct:2022" value="<?=$dataker['tahun_keluar']));?>"></td>
	                </tr>
					<tr>
				    <td>Gaji</td>
					    <td><div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping">Rp.</span>
					       	<input type="number" min="1000000" max="99999999" name="gaji" class="form-control" placeholder="tanpa titik, ct: 5000000" value="<?=$dataker['gaji_terakhir']?>"></div></td>
					</tr>
					<tr>
						<td>Alasan Berhenti / Pindah Kerja</td>
						<td><textarea name="resign" placeholder="Alasan Berhenti / Pindah Kerja" class="form-control" id="exampleFormControlTextarea1" rows="2"><?=ucwords(strtolower($dataker['alasan_keluar']));?></textarea></td>
					</tr>
                </table>
                <?php } } ?>
	        </div>
        </div>
    </div>
    <div class="accordion-item" align="center">
	<h2 class="accordion-header">
       <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseOne">Data Organisasi&nbsp;<strong><?=strtoupper($data['nama'])?></strong></strong></button></h2>
           <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
               <div class="accordion-body">
            <?php
       		// apabila tidak memiliki data organisasi
            if (!mysqli_num_rows($hasilorg)) {?>
               	<input type="checkbox" name="organisasi" class="form-check-input" id="flexCheckDefault"> <strong>Centang jika mengisi formulir Organisasi</strong>
               	<table border = "1" style = "font-size:medium;" width = "800px" align="center" class="table"> 
                   	<tr>
	                    <td>Nama Organisasi</td>
	                    <td><input type="text" name="nama_org" placeholder="ct: Paguyuban Senam Jasmani" class="form-control form-control-sm"></td>
	                </tr>
	                <tr>
				        <td>Jabatan</td>
				        <td><input type="text" name="jabatan_org" placeholder="ct: Bendahara" class="form-control form-control-sm"></td>
				    </tr>
	                <tr>
	                    <td>Tanggal Masuk</td>
	                    <td><input type="date" name="masuk_org" class="form-control form-control-sm"></td>
	                </tr>
	                <tr>
	                    <td>Tanggal Keluar</td>
	                    <td><input type="date" name="keluar_org" class="form-control form-control-sm"></td>
	                </tr>
				    <tr>
	                    <td>Jenis Organisasi</td>
	                    <td><select name="jenis" id="jenis" class="form-select" aria-label="Default select example">
						  <option value="luar_kampus" selected>Luar Kampus</option>
						  <option value="dalam_kampus">Dalam Kampus</option>
						</select></td>
                   	</tr>
                </table>
            <?php }
            else
            { while ($dataorg = mysqli_fetch_array($hasilorg)) {  ?>
             	<table border = "1" style = "font-size:medium;" width = "800px" align="center" class="table"> 
                   	<tr>
	                    <td>Nama Organisasi</td>
	                    <td><input type="text" name="nama_org" placeholder="ct: Paguyuban Senam Jasmani" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataorg['nama_organisasi']));?>"></td>
	                </tr>
	                <tr>
				        <td>Jabatan</td>
				        <td><input type="text" name="jabatan_org" placeholder="ct: Bendahara" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataorg['jabatan']));?>"></td>
				    </tr>
	                <tr>
	                    <td>Tanggal Masuk</td>
	                    <td><input type="date" name="masuk_org" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataorg['tanggal_masuk']));?>"></td>
	                </tr>
	                <tr>
	                    <td>Tanggal Keluar</td>
	                    <td><input type="date" name="keluar_org" class="form-control form-control-sm" value="<?=ucwords(strtolower($dataorg['tanggal_keluar']));?>"></td>
	                </tr>
				    <tr>
	                    <td>Jenis Organisasi</td>
	                    <td><select name="jenis" id="jenis" class="form-select" aria-label="Default select example">
						  <option value="luar_kampus" <?php if ($dataorg['jenis_organisasi']=='luar_kampus'){ echo 'selected'; }?> > Luar Kampus</option>
						  <option value="dalam_kampus" <?php if ($dataorg['jenis_organisasi']=='dalam_kampus'){ echo 'selected'; }?>>Dalam Kampus</option>
						</select></td>
                   	</tr>
                </table>
                <?php } } ?>
            </div>
        </div>
    </div>    
    <div class="accordion-item" align="center">
		<h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseOne">Data Keluarga&nbsp;<strong><?=strtoupper($data['nama'])?></strong></strong></button></h2>
            <div id="collapseFive" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <?php
       				// apabila tidak memiliki data organisasi
            	if (!mysqli_num_rows($hasilkel)) {?>
                	<input type="checkbox" name="keluarga" class="form-check-input" id="flexCheckDefault"> <strong>Centang jika mengisi formulir Keluarga</strong>
                	<table border = "1" style = "font-size:medium;" width = "800px" align="center" class="table"> 
                    	<tr>
	                        <td>Nama Keluarga</td>
	                        <td><input type="text" name="nama_kel" placeholder="ct: Andi Kemang" class="form-control form-control-sm"></td>
	                    </tr>
	                    <tr>
	                        <td>Relasi</td>
	                        <td><select name="relasi" id="relasi" class="form-select" aria-label="Default select example">
								  <option value="ayah" selected>Ayah</option>
								  <option value="ibu">Ibu</option>
								  <option value="kakak">Kakak</option>
								  <option value="adik">Adik</option>
								</select></td>
                    	</tr>
	                    <tr>
	                        <td>Tanggal Lahir</td>
	                        <td><input type="date" name="tgllahir_kel" class="form-control form-control-sm"></td>
	                    </tr>
                    </table>
				<?php }
            	else
            	{ while ($datakel = mysqli_fetch_array($hasilkel)) {  ?>
                    <table border = "1" style = "font-size:medium;" width = "800px" align="center" class="table"> 
                    	<tr>
	                        <td>Nama Keluarga</td>
	                        <td><input type="text" name="nama_kel" placeholder="ct: Andi Kemang" class="form-control form-control-sm" value="<?=ucwords(strtolower($datakel['nama']));?>"></td>
	                    </tr>
	                    <tr>
	                        <td>Relasi</td>
	                        <td><select name="relasi" id="relasi" class="form-select" aria-label="Default select example">
								  <option value="ayah" <?php if ($datakel['relasi']=='ayah'){ echo 'selected'; }?>>Ayah</option>
								  <option value="ibu" <?php if ($datakel['relasi']=='ibu'){ echo 'selected'; }?>>Ibu</option>
								  <option value="kakak" <?php if ($datakel['relasi']=='kakak'){ echo 'selected'; }?>>Kakak</option>
								  <option value="adik" <?php if ($datakel['relasi']=='adik'){ echo 'selected'; }?>>Adik</option>
								</select></td>
                    	</tr>
	                    <tr>
	                        <td>Tanggal Lahir</td>
	                        <td><input type="date" name="tgllahir_kel" class="form-control form-control-sm" value="<?=ucwords(strtolower($datakel['tanggal_lahir']));?>"></td>
	                    </tr>
	                <?php } } ?>
                    </table>
            </div>
        </div>
    </div>
	<tr>
		<td colspan="2">
		<input type="submit" value="Perbarui Data" class="btn btn-primary btn-sm"></td>
		<td><a href="home_staff.php" class="btn btn-dark btn-sm">Kembali</a></td>
	</tr>
	</div>
</div>
<?php } ?>
</form>
</div>
</body>
</html>