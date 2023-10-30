<?php
session_start();
include_once("../koneksi.php");
$act = $_GET["act"];
$id = $_GET['idpelamar'];
// mencocokan pass inputan dengan database
$passsql = "SELECT password FROM tb_user WHERE jenis_user = 'staff' AND status = 'y' AND id_user = ".$id; 
$hasilpass = mysqli_query($conn,$passsql);
$pass = mysqli_fetch_array($hasilpass);
switch ($act)
{
	case'UbahPelamar':
		//PERSONAL
		$nama = strtolower($_POST['nama']);
		$panggilan	= strtolower($_POST['panggilan']);
		$templahir= strtolower($_POST['templahir']);
		$tgllahir = $_POST['tgllahir'];
		$jk = $_POST['jk'];
		$agama = strtolower($_POST['agama']);
		$alamat_tinggal = strtolower($_POST['alamat_tinggal']);
		$alamat_ktp= strtolower($_POST['alamat_ktp']);
		$hp = $_POST['hp'];
		$wa = $_POST['wa'];
		$email = strtolower($_POST['email']);

		//PENDIDIKAN
		$jenjang= $_POST['jenjang'];
		$sekolah = strtolower($_POST['sma']);
		$masuk_sma = $_POST['masuk_sma'];
		$lulus_sma = $_POST['lulus_sma'];
		$jurusan_sma =strtolower( $_POST['jurusan']);
		$universitas = strtolower($_POST['universitas']);
		$masuk_kuliah = $_POST['masuk_kuliah'];
		$lulus_kuliah = $_POST['lulus_kuliah'];
		$jurusan_kuliah = strtolower($_POST['jurusan_kuliah']);
		$nilai = $_POST['nilai'];
		$judul = strtolower($_POST['judul']);

		// ORGANISASI
		$organisasi = strtolower($_POST['nama_org']);
		$jab_org = strtolower($_POST['jabatan_org']);
		$masuk_org = $_POST['masuk_org'];
		$keluar_org = $_POST['keluar_org'];
		$jenis_org = strtolower($_POST['jenis']);

		// PEKERJAAN
		$perusahaan = strtolower($_POST['perusahaan']);
		$jab_per = strtolower($_POST['jabatan_per']);
		$masuk_per = $_POST['masuk_per'];
		$keluar_per = $_POST['keluar_per'];
		$gaji = $_POST['gaji'];
		$resign = strtolower($_POST['resign']);
		
		// KELUARGA
		$keluarga = strtolower($_POST['nama_kel']);
		$relasi = strtolower($_POST['relasi']);
		$tgllahir_kel = $_POST['tgllahir_kel'];
	break;

	case 'reg': //untuk pendaftaran pelamar baru
		$ktp= $_POST['ktp'];
		//cek NIK KTP sudah ada di DB? kl sudah ada, tidak bisa input pelamar, kl belum ada langsung insert ke db
		$cekktp = mysqli_query($conn, "SELECT nik_ktp FROM tb_pelamar WHERE nik_ktp = '$ktp'"); 
		 if($cekktp->num_rows > 0) {
			$_SESSION["pesan"] = "Gagal tambah Pelamar, NIK KTP Pelamar sudah ada.";
		 }
		 else { // insert ke db apabila NIK KTP belum pernah ada
		 
			//PERSONAL
			$nama = strtolower($_POST['nama']);
			$panggilan	= strtolower($_POST['panggilan']);
			$templahir= strtolower($_POST['templahir']);
		
			$tgllahir = $_POST['tgllahir'];
			$jk = $_POST['jk'];
			$agama = strtolower($_POST['agama']);
			$alamat_tinggal = strtolower($_POST['alamat_tinggal']);
			$alamat_ktp= strtolower($_POST['alamat_ktp']);
			$hp = $_POST['hp'];
			$wa = $_POST['wa'];
			$email = strtolower($_POST['email']);

			//PENDIDIKAN
			$jenjang= $_POST['jenjang'];
			$sekolah = strtolower($_POST['sma']);
			$masuk_sma = $_POST['masuk_sma'];
			$lulus_sma = $_POST['lulus_sma'];
			$jurusan_sma =strtolower( $_POST['jurusan']);
			$universitas = strtolower($_POST['universitas']);
			$masuk_kuliah = $_POST['masuk_kuliah'];
			$lulus_kuliah = $_POST['lulus_kuliah'];
			$jurusan_kuliah = strtolower($_POST['jurusan_kuliah']);
			$nilai = $_POST['nilai'];
			$judul = strtolower($_POST['judul']);

		//ORGANISASI (AKAN TERISI JIKA DI CENTANG)
		if (isset($_POST['organisasi'])) {
			$organisasi = strtolower($_POST['nama_org']);
			$jab_org = strtolower($_POST['jabatan_org']);
			$masuk_org = $_POST['masuk_org'];
			$keluar_org = $_POST['keluar_org'];
			$jenis_org = strtolower($_POST['jenis']);
			$status_org = "true";
		}
		else { $status_org = "false"; }

		//PEKERJAAN (AKAN TERISI JIKA DI CENTANG)
		if (isset($_POST['pekerjaan'])) {
			$perusahaan = strtolower($_POST['perusahaan']);
			$jab_per = strtolower($_POST['jabatan_per']);
			$masuk_per = $_POST['masuk_per'];
			$keluar_per = $_POST['keluar_per'];
			$gaji = $_POST['gaji'];
			$resign = strtolower($_POST['resign']);
			$status_per = "true";
		}
		else { $status_per = "false"; }

		//KELUARGA (AKAN TERISI JIKA DI CENTANG)
		if (isset($_POST['keluarga'])) {
			$keluarga = strtolower($_POST['nama_kel']);
			$relasi = strtolower($_POST['relasi']);
			$tgllahir_kel = $_POST['tgllahir_kel'];
			$status_kel = "true";
		}
		else { $status_kel = "false"; }
		
		// AMBIL ID TERAKHIR (id pelamar)
		$queryambilid = "SELECT id_pelamar FROM tb_pelamar ORDER BY id_pelamar DESC LIMIT 1";
		$resultambilid = mysqli_query($conn,$queryambilid);
		$rowid = mysqli_fetch_array($resultambilid);
		$index = $rowid["id_pelamar"]+1;

		// AMBIL ID TERAKHIR (id pendidikan)
		$queryambilidpend = "SELECT id_pendidikan FROM tb_pendidikan ORDER BY id_pendidikan DESC LIMIT 1";
		$resultambilidpend = mysqli_query($conn,$queryambilidpend);
		$rowidpend = mysqli_fetch_array($resultambilidpend);
		$indexpend = $rowidpend["id_pendidikan"]+1;

		// AMBIL ID TERAKHIR (id organisasi)
		$queryambilidorg = "SELECT id_organisasi FROM tb_organisasi ORDER BY id_organisasi DESC LIMIT 1";
		$resultambilidorg = mysqli_query($conn,$queryambilidorg);
		$rowidorg = mysqli_fetch_array($resultambilidorg);
		$indexorg = $rowidorg["id_organisasi"]+1;

		// AMBIL ID TERAKHIR (id pekerjaan)
		$queryambilidker = "SELECT id_pekerjaan FROM tb_pekerjaan ORDER BY id_pekerjaan DESC LIMIT 1";
		$resultambilidker = mysqli_query($conn,$queryambilidker);
		$rowidker = mysqli_fetch_array($resultambilidker);
		$indexker = $rowidker["id_pekerjaan"]+1;

		// AMBIL ID TERAKHIR (id keluarga)
		$queryambilidkel = "SELECT id_keluarga FROM tb_keluarga ORDER BY id_keluarga DESC LIMIT 1";
		$resultambilidkel = mysqli_query($conn,$queryambilidkel);
		$rowidkel = mysqli_fetch_array($resultambilidkel);
		$indexkel = $rowidkel["id_keluarga"]+1;

		if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
			$uploadFile = $_FILES["foto"];
			$uploadDir = "img/";
			// Extract nama file yang diupload
			$extractFile = pathinfo($uploadFile["name"]);
		}
		$newName = $nama.".".$extractFile["extension"]; // yang disimpan di database adalah $newName
		if (move_uploaded_file($uploadFile['tmp_name'],$uploadDir.$newName))
		{
			$upload = "berhasil";			
		}
		else 
		{
			$_SESSION["pesan"] = "Upload Foto Gagal";
			header('Location: register.php');
		}
		if ($upload == "berhasil")
		{
			$querypersonal = "INSERT INTO tb_pelamar VALUES ('$index','$nama','$panggilan','$nik_ktp','$templahir','$tgllahir','$jk','$agama','$alamat_tinggal','$alamat_ktp','$hp','$wa','$email','$newName')";	
			$hasilper = mysqli_query($conn,$querypersonal);
			if ($hasilper)
			{
				$querypendidikan = "INSERT INTO tb_pendidikan VALUES ('$index','$indexpend','$sekolah','$masuk_sma','$lulus_sma','$jurusan_sma','$jenjang','$universitas','$masuk_kuliah','$lulus_kuliah','$jurusan_kuliah','$nilai','$judul')";
				$hasilpend = mysqli_query($conn,$querypendidikan);
				if ($hasilpend)
				{
					if ($status_org == "true")
					{
						$queryorg = "INSERT INTO tb_organisasi VALUES ('$index','$indexorg','$organisasi','$jab_org','$masuk_org','$keluar_org','$jenis_org')";
						$hasilorg = mysqli_query($conn,$queryorg);
						if ($hasilorg)
						{
							$statusqueryorg = " organisasi berhasil ";
						}
						else
						{
							$_SESSION["pesan"] = "Gagal Menambahkan Organisasi";
							header('Location: register.php');
						}
					}
					else if ($status_per == "true")
					{
						$queryker = "INSERT INTO tb_pekerjaan VALUES ('$index','$indexker','$perusahaan','$jab_per','$masuk_per','$keluar_per','$gaji','$resign')";
						$hasilker = mysqli_query($conn,$queryker);
						if ($hasilker)
						{
							$statusqueryker = " pekerjaan berhasil ";
						}
						else
						{
							$_SESSION["pesan"] = "Gagal Menambahkan Pekerjaan";
							header('Location: register.php');
						}
					}
					else if ($status_kel == "true")
					{
						$querykel = "INSERT INTO tb_keluarga VALUES ('$index','$indexkel','$keluarga','$relasi','$tgllahir_kel')";
						$hasilkel = mysqli_query($conn,$querykel);
						if ($hasilkel)
						{
							$statusquerykel = " keluarga berhasil ";
						}
						else
						{
							$_SESSION["pesan"] = "Gagal Menambahkan Keluarga";
							header('Location: register.php');
						}
					}
				}
				else
				{
					$_SESSION["pesan"] = "Gagal Menambahkan Pendidikan";
					header('Location: register.php');
				}
			}
			else
			{
				$_SESSION["pesan"] = "Gagal Menambahkan Personal";
				header('Location: register.php');
			}
		}
		else
		{
			$_SESSION["pesan"] = "terjadi kesalahan sistem";
			header('Location: register.php');
		}

		if ($statusqueryorg = " organisasi berhasil " || $statusqueryker = " pekerjaan berhasil " || $statusquerykel = " keluarga berhasil ")
		{
			$_SESSION["pesan"] = "Pelamar Berhasil Terdaftar";
			header('Location: register.php');
		}
	}
	break;

	default:
		echo "case belum dibuat!!";
	break;
}
?>