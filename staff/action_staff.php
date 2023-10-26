<?php
session_start();
include_once("../koneksi.php");
$act = $_GET["act"];
$id = $_GET['id'];
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

		// oRGANISASI
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

		//ORGANISASI (AKAN TERISI JIKA DI CENTANG)
		if (isset($_POST['organisasi'])) { $status_org = "true"; }
		else { $status_org = "false"; }

		//PEKERJAAN (AKAN TERISI JIKA DI CENTANG)
		if (isset($_POST['pekerjaan'])) { $status_per = "true"; }
		else { $status_per = "false"; }

		//KELUARGA (AKAN TERISI JIKA DI CENTANG)
		if (isset($_POST['keluarga'])) { $status_kel = "true";	}
		else { $status_kel = "false"; }

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

		$querypersonal = "UPDATE tb_pelamar SET nama = '$nama', panggilan = '$panggilan', templahir = '$templahir', tgllahir = '$tgllahir',jenis_kelamin = '$jk', agama = '$agama', alamat_tinggal = '$alamat_tinggal', alamat_ktp = '$alamat_ktp', hp = '$hp', wa = '$wa', email = '$email' WHERE id_pelamar = ".$id;	
		$hasilper = mysqli_query($conn,$querypersonal);
		if ($hasilper)
		{
			$querypendidikan = "UPDATE tb_pendidikan SET sma = '$sekolah', awal_sma = '$masuk_sma', lulus_sma = '$lulus_sma',jurusan_sma = '$jurusan_sma', jenjang_pendidikan = '$jenjang', universitas = '$universitas', awal_kuliah = '$masuk_kuliah', lulus_kuliah = '$lulus_kuliah', jurusan_kuliah = '$jurusan_kuliah', ipk = '$nilai', judul_skripsi = '$judul' WHERE id_pelamar = ".$id;
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
						header('Location: editpelamar.php?id='.$id);
					}
				}
				else if ($status_org == "false")
				{
					$queryorg = "UPDATE tb_organisasi SET nama_organisasi = '$organisasi', jabatan = '$jab_org', tanggal_masuk = '$masuk_org', tanggal_keluar = '$keluar_org', jenis_organisasi ='$jenis_org' WHERE id_pelamar = ".$id ;
					$hasilorg = mysqli_query($conn,$queryorg);
					if ($hasilorg)
					{
						$statusqueryorg = " organisasi berhasil ";
					}
					else
					{
						$_SESSION["pesan"] = "Gagal Memperbarui Organisasi";
						header('Location: editpelamar.php?id='.$id);
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
						header('Location: editpelamar.php?id='.$id);
					}
				}
				else if ($status_per == "false")
				{
					$queryker = "UPDATE tb_pekerjaan SET nama_perusahaan = '$perusahaan', jabatan = '$jab_per', tahun_masuk = '$masuk_per', tahun_keluar = '$keluar_per', gaji_terakhir = '$gaji', alasan_keluar = '$resign' WHERE $id_pelamar = ".$id;
					$hasilker = mysqli_query($conn,$queryker);
					if ($hasilker)
					{
						$statusqueryker = " pekerjaan berhasil ";
					}
					else
					{
						$_SESSION["pesan"] = "Gagal Memperbarui Pekerjaan";
						header('Location: editpelamar.php?id='.$id);
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
						header('Location: editpelamar.php?id='.$id);
					}
				}
				else if ($status_kel == "false")
				{
					$querykel = "UPDATE tb_keluarga SET nama = '$keluarga', relasi = '$relasi', tanggal_lahir = '$tgllahir_kel' WHERE id_pelamar = ".$id;
					$hasilkel = mysqli_query($conn,$querykel);
					if ($hasilkel)
					{
						$statusquerykel = " keluarga berhasil ";
					}
					else
					{
						$_SESSION["pesan"] = "Gagal Memperbarui Keluarga";
						header('Location: editpelamar.php?id='.$id);
					}
				}
			}
			else
			{
				$_SESSION["pesan"] = "Gagal Memperbarui Pendidikan";
				header('Location: editpelamar.php?id='.$id);
			}
		}
		else
		{
			$_SESSION["pesan"] = "Gagal Memperbarui Personal";
			header('Location: editpelamar.php?id='.$id);
		}
		if ($statusqueryorg == " organisasi berhasil " && $statusqueryker == " pekerjaan berhasil " && $statusquerykel == " keluarga berhasil ") {
			$_SESSION["pesan"] = "berhasil Memperbarui Personal";
			header('Location: editpelamar.php?id='.$id);
		}
	break;

	default:
		echo "case belum dibuat!!";
	break;
}
?>