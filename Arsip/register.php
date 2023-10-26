<?php
 session_start();
 include("koneksi.php");
 if(!isset($_SESSION["nama"]))
  {
	header("Location: index.php");
  }
?>
<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Register</title>

</head>
<body>
	<h1>E-Recruitment PT Gudang Garam, Tbk.</h1>

<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <nav class="navbar navbar-expand-lg navbar-black bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="home.php">Data Pelamar</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="register.php">Daftar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search">
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

<form method="POST" action="action.php?act=reg">
<table border = "0" style = "font-size:small;" width = "800px" align="center">
	<tr>
		<td>Nama lengkap</td>
		<td><input type="text" name="nama" placeholder="Input Nama"></td>
	</tr>
	<tr>
		<td>Panggilan</td>
		<td><input type="text" name="panggilan" placeholder="Panggilan"></td>
	</tr><tr>
		<td>Tempat Lahir</td>
		<td><input type="text" name="templahir" placeholder="Input Tempat Lahir"></td>
	</tr>
	<tr>
		<td>Tgl Lahir</td>
		<td><input type="date" name="tgllahir" placeholder="Input Tanggal Lahir"></td>
	</tr>
	<tr>
		<td>Alamat Tinggal Saat Ini</td>
		<td><input type="text" name="alamat_tinggal" placeholder="Input Alamat Saat Ini"></td>
	</tr>
	<tr>
		<td>Alamat (KTP)</td>
		<td><input type="text" name="alamat_ktp" placeholder="Input Alamat sesuai (KTP)"></td>
	</tr>
	<tr>
		<td>No HP</td>
		<td><input type="text" name="hp" placeholder="Input HP"></td>
	</tr>
	<tr>
		<td>No WhatsApp</td>
		<td><input type="text" name="wa" placeholder="No WA yang aktif"></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="Email" name="email" placeholder="Input Email"></td>
	</tr>
	<tr>
		<td>Jenjang</td>
		<td>
		<select name="jenjang" id="jenjang">
		  <option value="SLTP">SLTP</option>
		  <option value="SLTA">SLTA</option>
		  <option value="D1">D1</option>
		  <option value="D2">D2</option>
		  <option value="D3">D3</option>
		  <option value="D4">D4</option>
		  <option value="S1">S1</option>
		  <option value="S2">S2</option>
		</select>		</td>
	</tr>
	<tr>
		<td>Asal Sekolah / Perguruan Tinggi</td>
		<td><input type="text" name="sekolah" placeholder="Universitas Gadjah Mada"></td>
	</tr>
	<tr>
		<td>Jurusan</td>
		<td><input type="text" name="jurusan" placeholder="Input Jurusan"></td>
	</tr>
	<tr>
		<td>IPK / Nilai Akhir</td>
		<td><input type="text" name="nilai" placeholder="Input Nilai"></td>
	</tr>
	<tr>
		<td>Foto</td>
		<td><input type="file" name="foto"></td>
	</tr>

	<tr>
		
		<td><input type="reset" value="Reset"></td>
		<td><input type="submit" value="Daftar"></td>
		<td><input type="button" value="Kembali" onclick="location.href='home.php'"></td>
	</tr>
</table>
</form>
</body>
</html>