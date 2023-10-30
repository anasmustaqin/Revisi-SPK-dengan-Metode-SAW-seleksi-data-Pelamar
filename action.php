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