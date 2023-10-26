<?php
session_start();
include_once("../koneksi.php");
$act = $_GET["act"];
$id = $_GET['id'];
// mencocokan pass inputan dengan database
$passsql = "SELECT password FROM tb_user WHERE jenis_user = 'supervisor' AND status = 'y' AND id_user = ".$id; 
$hasilpass = mysqli_query($conn,$passsql);
$pass = mysqli_fetch_array($hasilpass);
switch ($act)
{
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
				header('Location:home_spv.php');
			}else
			{
				$_SESSION["pesan"] = "Pelamar Gagal Dihapus.";
				header('Location:home_spv.php');
			}
		}
		else
		{
			$_SESSION["pesan"] = "Password salah.";
			header('Location:home_spv.php');
		}
	break;

	default:
		echo "case belum dibuat!!";
	break;
}
?>