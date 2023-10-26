<?php
session_start();
include_once("koneksi.php");
$act = $_GET["act"];
$id = $_GET['id'];
switch ($act)
{
	case 'login':
		$uname = $_POST["username"];
		$passw = $_POST["password"];
		
		if($uname !="" && $passw !="")
		{
			// cek user yang login
			$sqlcek = "SELECT * FROM tb_user WHERE username = '$uname' AND password = '$passw' AND status = 'y'";
			$resultcek = mysqli_query($conn,$sqlcek);
			$row = mysqli_fetch_array($resultcek);
			if ($row['jenis_user']=='staff')
			{
				$_SESSION["id"] = $row["id_user"];
				$_SESSION["nama"] = $row["nama"];
				header("Location: staff/home_staff.php");
			}
			else if($row['jenis_user'] =='administrator')
			{
				$_SESSION["username"] = $row["username"];
				$_SESSION["nama"] = $row["nama"];
				$_SESSION["id"] = $row["id_user"];
				header("Location: admin/home_admin.php");			
			}
			else if($row['jenis_user']=='supervisor')
			{
				$_SESSION["id"] = $row["id_user"];
				$_SESSION["nama"] = $row["nama"];
				header("Location: supervisor/home_spv.php");
			}			
			else
			{
				$_SESSION["pesan"] = "User tidak ditemukan atau belum valid.";
				header('Location: index.php');//echo "Gagal.<br /> Sign up kah?";
			}
		}
		else// if (($nama =="" || $pass =="")||($nama =="" && $pass ==""))
		{
				$_SESSION["pesan"] = "Username dan Password belum diisi atau salah.";
				header("Location: index.php");
		}
	break;

	case 'logout':
		unset($_SESSION["nama"]);
		unset($_SESSION["username"]);
		unset($_SESSION["id"]);
		$_SESSION["pesan"] = "Anda telah berhasil logout!";
		header("Location: index.php");
	break;

	case 'reg': //untuk pendaftaran pelamar baru
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
			$querypersonal = "INSERT INTO tb_pelamar VALUES ('$index','$nama','$panggilan','$templahir','$tgllahir','$jk','$agama','$alamat_tinggal','$alamat_ktp','$hp','$wa','$email','$newName')";	
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
	break;

/* FITUR LUPA PASSWORD HANYA PADA SAAT USER SUDAH LOGIN, APABILA STAFF / SUPERVISOR LUPA, BISA DI RESET PASSWORD OLEH ADMIN
	case 'gantiPassw':
		$uname = $_POST['username'];
		$passw = $_POST['password'];
		if ($uname !="" && $passw !="")
		{
			$query = "SELECT username FROM tb_user WHERE username = '$uname'";
			$result2 = mysqli_query($conn,$query);
			$row = mysqli_fetch_array($result2);
			if ($uname == $row["username"])
			{ //APABILA USERNAME YANG DIMASUKKAN ADA DI DATABASE
				$sql = "UPDATE tb_user SET password = '$passw' WHERE username = '$uname'";
				$hasil = mysqli_query($conn,$sql);
				if(!$hasil)
				{
					$_SESSION["pesan"] = "Password Gagal Diubah";
					header('Location:ubahpassword.php');
				}
				else
				{
					$_SESSION["pesan"] = "Password berhasil update, silahkan login ulang";
					header('Location:index.php');
				}
			}
			else
			{
				$_SESSION["pesan"] = "Username tidak ditemukan";
				header('Location: ubahpassword.php');//echo "Gagal.<br /> Sign up kah?";
			}
		}
		else if (($uname =="" || $passw =="")||($uname =="" && $passw ==""))
		{
				$_SESSION["pesan"] = "Anda belum mengisi field atau isian tidak lengkap.";
				header("Location: ubahpassword.php");
		}
		else
		{
				$_SESSION["pesan"] = "anda belum mengisi Username atau Username tidak ditemukan";
				header('Location: ubahpassword.php');//echo "Gagal.<br /> Sign up kah?";
		}
	break;
*/
	case 'EditAkun': // username tidak bisa diubah, hanya diinput 1x oleh admin --> staff
		$nama = strtolower($_POST['nama']);
		$passwlama = $_POST['passwlama'];
		$passwbaru = $_POST['passwbaru'];
		// cek apakah passw lama, passw baru dan conf_passw terisi. apabila terisi, password juga diubah. apabila tidak, hanya ganti nama
		if ($passwlama == "" && $passwbaru == "") // hanya ganti nama
		{
			$querynama = "UPDATE tb_user SET nama = '$nama' WHERE id_user = '$id'";
			$hasilnama = mysqli_query($conn,$querynama);
			if ($hasilnama) { $editnama = "berhasil"; }
			else
			{ $editnama = "gagal"; }
		}
		else // update nama dan password
		{
			// cek passwlama sama dengan di database
			$cekpass = "SELECT password FROM tb_user WHERE id_user = '$id'";
			$hasilcek = mysqli_query($conn,$cekpass);
			$result = mysqli_fetch_array($hasilcek);
			if ($result['password']==$passwlama)
			{
				$queryall = "UPDATE tb_user SET nama = '$nama', password = '$passwbaru' WHERE id_user = '$id'";
				$hasilall = mysqli_query($conn,$queryall);
				if ($hasilall) { $all = "berhasil";	}
				else
				{ $all = "gagal"; }
			}
			else
			{
				$_SESSION["pesan"] = "Akun Berhasil Diperbarui, Anda Salah Input Password Lama";
				header('Location: staff/manageakun_staff.php');
			}
		}

		if ($editnama == "berhasil")
		{
			$_SESSION["pesan"] = "Akun Berhasil Diperbarui.";
			header('Location: staff/manageakun_staff.php');
		}
		else if ($all == "berhasil")
		{
			$_SESSION["pesan"] = "Akun Berhasil Diperbarui.";
			header('Location: staff/manageakun_staff.php');
		}
		else
		{
			$_SESSION["pesan"] = "Akun Gagal Diperbarui.";
			header('Location: staff/manageakun_staff.php');
		}
	break;

	case 'EditAkun2': // username tidak bisa diubah, hanya diinput 1x oleh admin --> spv
		$nama = strtolower($_POST['nama']);
		$passwlama = $_POST['passwlama'];
		$passwbaru = $_POST['passwbaru'];
		// cek apakah passw lama, passw baru dan conf_passw terisi. apabila terisi, password juga diubah. apabila tidak, hanya ganti nama
		if ($passwlama == "" && $passwbaru == "") // hanya ganti nama
		{
			$querynama = "UPDATE tb_user SET nama = '$nama' WHERE id_user = '$id'";
			$hasilnama = mysqli_query($conn,$querynama);
			if ($hasilnama) { $editnama = "berhasil"; }
			else
			{ $editnama = "gagal"; }
		}
		else // update nama dan password
		{
			// cek passwlama sama dengan di database
			$cekpass = "SELECT password FROM tb_user WHERE id_user = '$id'";
			$hasilcek = mysqli_query($conn,$cekpass);
			$result = mysqli_fetch_array($hasilcek);
			if ($result['password']==$passwlama)
			{
				$queryall = "UPDATE tb_user SET nama = '$nama', password = '$passwbaru' WHERE id_user = '$id'";
				$hasilall = mysqli_query($conn,$queryall);
				if ($hasilall) { $all = "berhasil";	}
				else
				{ $all = "gagal"; }
			}
			else
			{
				$_SESSION["pesan"] = "Akun Berhasil Diperbarui, Anda Salah Input Password Lama";
				header('Location: supervisor/manageakun_spv.php');
			}
		}

		if ($editnama == "berhasil")
		{
			$_SESSION["pesan"] = "Akun Berhasil Diperbarui.";
			header('Location: supervisor/manageakun_spv.php');
		}
		else if ($all == "berhasil")
		{
			$_SESSION["pesan"] = "Akun Berhasil Diperbarui.";
			header('Location: supervisor/manageakun_spv.php');
		}
		else
		{
			$_SESSION["pesan"] = "Akun Gagal Diperbarui.";
			header('Location: supervisor/manageakun_spv.php');
		}
	break;

	case 'UbahData': // UBAH DATA PELAMAR
		$idedit = $_SESSION['idpelamar'];
		$nama = $_POST['nama'];
		$panggilan	= $_POST['panggilan'];
		$templahir= $_POST['temp_lahir'];
		$tgllahir = $_POST['tgl_lahir'];
		$alamat_tinggal = $_POST['alamat_tinggal'];
		$alamat_ktp= $_POST['alamat_ktp'];
		$hp = $_POST['hp'];
		$wa = $_POST['wa'];
		$email = $_POST['email'];
		$jenjang = strtoupper($_POST['jenjang']);
		$sekolah = $_POST['sekolah'];
		$jurusan = $_POST['jurusan'];
		$nilai = $_POST['nilai'];
		$foto = $_POST['foto'];
		$foto2 = $_SESSION['foto'];

		// TERISI SEMUA (FOTO BERUBAH)
		if($nama != "" && $panggilan !="" && $templahir != "" && $tgllahir != "" && $alamat_tinggal != "" && $alamat_ktp != "" && $hp != "" && $wa != "" && $email != "" && $jenjang != "" && $sekolah != "" && $jurusan != "" && $nilai != "" && $foto != "")
		{
		$sql = "UPDATE tb_pelamar SET nama='$nama',panggilan='$panggilan',templahir='$templahir',tgllahir='$tgllahir',alamat_tinggal='$alamat_tinggal',alamat_ktp='$alamat_ktp',hp='$hp',wa='$wa',email='$email',jenjang='$jenjang',sekolah='$sekolah',jurusan='$jurusan',nilai='$nilai',foto='$foto' WHERE id_pelamar='$idedit'";
			 $hasil = mysqli_query($conn,$sql);
			if(!$hasil)
			{ 
				$_SESSION["pesan"] = "Data Pelamar Gagal Diubah";
				header('Location:editdata.php?id='.$idedit);
			}
			else
			{
				$_SESSION["pesan"] = "Data Pelamar Berhasil Diubah";
				header('Location:home.php');
			}
		}
		// TERISI SEMUA DAN FOTO TIDAK BERUBAH
		else if($nama != "" && $panggilan !="" && $templahir != "" && $tgllahir != "" && $alamat_tinggal != "" && $alamat_ktp != "" && $hp != "" && $wa != "" && $email != "" && $jenjang != "" && $sekolah != "" && $jurusan != "" && $nilai != "" && $foto == "")
		{
		$sql = "UPDATE tb_pelamar SET nama='$nama',panggilan='$panggilan',templahir='$templahir',tgllahir='$tgllahir',alamat_tinggal='$alamat_tinggal',alamat_ktp='$alamat_ktp',hp='$hp',wa='$wa',email='$email',jenjang='$jenjang',sekolah='$sekolah',jurusan='$jurusan',nilai='$nilai',foto='$foto2' WHERE id_pelamar='$idedit'";
		$hasil = mysqli_query($conn,$sql);
			if(!$hasil)
			{ 
				$_SESSION["pesan"] = "Data Pelamar Gagal Diubah";
				header('Location:editdata.php?id='.$idedit);
			}
			else
			{
				$_SESSION["pesan"] = "Data Pelamar Berhasil Diubah";
				header('Location:home.php');
			}
		}
		else
		{
			$_SESSION["pesan"] = "Data belum lengkap.";
			header('Location:editdata.php?id='.$idedit);
		}
	break;
	default:
		echo "CASE BELUM DIBUAT!!";
	break;
}
?>