<?php
session_start();
include_once("../koneksi.php");
$act = $_GET["act"];
$id = $_GET['id'];
// mencocokan pass inputan dengan database
$passsql = "SELECT password FROM tb_user WHERE jenis_user = 'administrator'"; 
$hasilpass = mysqli_query($conn,$passsql);
$pass = mysqli_fetch_array($hasilpass);
switch ($act)
{
	case 'UbahUser': // status valid atau tidak
		if ($pass['password'] == $_POST['passw'])
		{
			// mengambil status terakhir user
			$sql = "SELECT status FROM tb_user WHERE id_user = '$id'";
			$hasil = mysqli_query($conn,$sql);
			$ambil=mysqli_fetch_array($hasil);
			if ($ambil['status']=='n') // diubah menjadi aktif (y)
			{
				$sql2 = "UPDATE tb_user SET status = 'y' WHERE id_user = '$id'";		
			}
			else // diubah menjadi nonaktif (n)
			{
				$sql2 = "UPDATE tb_user SET status = 'n' WHERE id_user = '$id'";
			}
			$ubah = mysqli_query($conn,$sql2);
			if(!$ubah)
			{ 
				$_SESSION["pesan"] = "Status Pengguna Gagal Diubah";
				header('Location:listuser.php');
			}
			else
			{
				$_SESSION["pesan"] = "Status Pengguna Berhasil Diubah";
				header('Location:listuser.php');
			}
		}
		else
		{
			$_SESSION["pesan"] = "Password salah.";
			header('Location:manageuser.php?id='.$id);
		}
	break;
	case 'resetpass': //password default qwe123
		if ($pass['password'] == $_POST['passw'])
		{
			$sql = "UPDATE tb_user SET password = 'qwe123' WHERE id_user = '$id'";
			$ubah = mysqli_query($conn,$sql);
			if(!$ubah)
			{ 
				$_SESSION["pesan"] = "Password Pengguna Gagal Direset";
				header('Location:listuser.php');
			}
			else
			{
				$_SESSION["pesan"] = "Password Pengguna Berhasil Direset";
				header('Location:listuser.php');
			}
		}
		else
		{
			$_SESSION["pesan"] = "Password salah.";
			header('Location:manageuser.php?id='.$id);
		}
	break;
	case 'UbahJenisUser':
		if ($pass['password'] == $_POST['passw'])
		{
			// mengambil jenis user terakhir user
			$sql = "SELECT jenis_user FROM tb_user WHERE id_user = '$id'";
			$hasil = mysqli_query($conn,$sql);
			$ambil=mysqli_fetch_array($hasil);
			if ($ambil['jenis_user']=='staff') // diubah menjadi supervisor
			{
				$sql2 = "UPDATE tb_user SET jenis_user = 'supervisor' WHERE id_user = '$id'";		
			}
			else // diubah menjadi staff
			{
				$sql2 = "UPDATE tb_user SET jenis_user = 'staff' WHERE id_user = '$id'";
			}
			$ubah = mysqli_query($conn,$sql2);
			if(!$ubah)
			{ 
				$_SESSION["pesan"] = "Jenis Pengguna Gagal Diubah";
				header('Location:manageuser.php?id='.$id);
			}
			else
			{
				$_SESSION["pesan"] = "Jenis Pengguna Berhasil Diubah";
				header('Location:listuser.php');
			}
		}
		else
		{
			$_SESSION["pesan"] = "Password salah.";
			header('Location:manageuser.php?id='.$id);
		}		
	break;

	case 'HapusUser' :
		if ($pass['password'] == $_POST['passw'])
		{
			$query="DELETE from tb_user WHERE id_user=".$id;
			$hasil=mysqli_query($conn,$query);
			if ($hasil)
			{
				$_SESSION["pesan"] = "Pengguna Berhasil Dihapus.";
				header('Location:listuser.php');
			}
			else
			{
				$_SESSION["pesan"] = "Pengguna Gagal Dihapus.";
				header('Location:listuser.php');
			}
		}
		else
		{
			$_SESSION["pesan"] = "Password salah.";
			header('Location:listuser.php');
		}
	break;

	case 'HapusPelamar' :
		if ($pass['password'] == $_POST['passw'])
		{
			// ambil nama foto dan hapus dari folder img
			$fotosql = "SELECT foto FROM tb_pelamar WHERE id_pelamar = ".$id;
			$hasilfoto=mysqli_query($conn,$fotosql);
			$foto = mysqli_fetch_assoc($hasilfoto);
			unlink("..img/".$foto['foto']);

			// delete tb_pelamar & tb_pendidikan
			$query1="DELETE FROM tb_pelamar WHERE id_pelamar = '$id'";
			$query2="DELETE FROM tb_pendidikan WHERE id_pelamar = '$id'";
			$query3="DELETE FROM tb_organisasi WHERE id_pelamar = '$id'";
			$query4="DELETE FROM tb_keluarga WHERE id_pelamar = '$id'";
			$query5="DELETE FROM tb_pekerjaan WHERE id_pelamar = '$id'";
			$hasil1=mysqli_query($conn,$query1);
			$hasil2=mysqli_query($conn,$query2);
			$hasil3=mysqli_query($conn,$query3);
			$hasil4=mysqli_query($conn,$query4);
			$hasil5=mysqli_query($conn,$query5);

			if ($hasil1 && $hasil2 && $hasil3 && $hasil4 && $hasil5 )
			{
				$_SESSION["pesan"] = "Pelamar Berhasil Dihapus.";
				header('Location:home_admin.php');
			}else
			{
				$_SESSION["pesan"] = "Pelamar Gagal Dihapus.";
				header('Location:home_admin.php');
			}
		}
		else
		{
			$_SESSION["pesan"] = "Password salah.";
			header('Location:home_admin.php');
		}
	break;

	case 'adduser' :
		$id = $_POST['idnew'];
		$username = strtolower($_POST['username']);
		$nama = strtolower($_POST['nama']);
		$jenis = strtolower($_POST['jenis']);

		// cek apakah username sudah terpakai
		$cekusername = "SELECT username FROM tb_user WHERE username = '$username'";
		$hasilcek =mysqli_query($conn,$cekusername);
		$datacek = mysqli_fetch_assoc($hasilcek);
		if ($datacek['username'] == $username)
		{
			$_SESSION["pesan"] = "Username yang diinput sudah ada, ganti dengan username lain.";
			header('Location:adduser.php');
		}
		else
		{
			$query	= "INSERT INTO tb_user VALUES ('$id','$username','$nama','qwe123','$jenis','y')";
			$hasil=mysqli_query($conn,$query);
			if ($hasil)
			{
				$_SESSION["pesan"] = "Pengguna Baru Berhasil Ditambahkan.";
				header('Location:listuser.php');
			}else
			{
				$_SESSION["pesan"] = "Pengguna Baru Gagal Ditambahkan.";
				header('Location:listuser.php');
			}
		}		
	break;

	default:
		echo "case belum dibuat!!";
	break;
}
?>