<?php
 session_start();
 include("../koneksi.php");
 $query = "SELECT * FROM tb_user WHERE id_user <> '1' AND jenis_user <> 'administrator'";
 $hasil = mysqli_query($conn,$query);

if (isset($_POST['submit'])) 
{

    //ambil jumlah alternatif
    $jum_alt=mysqli_query($conn,"select count(id_alternatif) from tb_alternatif");
    $jum_alter=mysqli_fetch_row($jum_alt);
    //ambil semua data karyawannya dulu dengan urutan proses = urutan kolom tidak bisa bolak balik

    $lihat_alt = array('3','1','4','5','2');
    $sqldata_awal = "select pel.jenis_kelamin,pend.jurusan_kuliah,pend.ipk,pkr.gaji_terakhir, CASE
                        WHEN count(pkr.id_pekerjaan) = 1 THEN 'ada'
                        WHEN count(pkr.id_pekerjaan) = 0 THEN 'tidak ada'
                        END ,pel.id_pelamar ".
                        "from tb_pelamar pel, tb_pekerjaan pkr, tb_pendidikan pend ".
                        "where pel.id_pelamar=pkr.id_pelamar ".
                        "and pel.id_pelamar=pend.id_pelamar ".
                        "group by pel.id_pelamar, pel.jenis_kelamin, pend.jurusan_kuliah, pend.ipk, pkr.gaji_terakhir order by pel.id_pelamar";

    $datadata_awal=mysqli_query($conn,$sqldata_awal);
    $alter_normal=0;

    while ($a=mysqli_fetch_row($datadata_awal))
    {
        
        for($i=0;$i<$jum_alter[0];$i++)
        {   
            //cek dulu untuk SAW nya, apakah fix atau range?
            $sql_lihat_saw=mysqli_query($conn,"select cek from tb_alternatif where id_alternatif=$lihat_alt[$i]");
            $sql_l_saw=mysqli_fetch_row($sql_lihat_saw);

            if($sql_l_saw[0]=="fix")
            {
                //isi disini query untuk yg fix
                $querybobot = "SELECT bobot FROM tb_kriteria WHERE id_alternatif = '$lihat_alt[$i]' and alt_to='$a[$i]'";
            }
            else
            {
                //isi disini query untuk yg Range
                $querybobot="SELECT bobot FROM tb_kriteria WHERE id_alternatif = '$lihat_alt[$i]' AND cast(alt_from as FLOAT) <= cast('$a[$i]' as FLOAT) and cast(alt_to as FLOAT) >= cast('$a[$i]' as FLOAT)";
            }

            $sql_bobot_tipe=mysqli_query($conn,$querybobot);    
            $bobotrange =mysqli_fetch_row($sql_bobot_tipe);
            //jurusan = lainnya
            if (!mysqli_num_rows($sql_bobot_tipe)){ $kosong = 0;
                if ($lihat_alt[$i] == 1 && $kosong == 0 ) {
                $querybobot = "SELECT bobot FROM tb_kriteria WHERE id_alternatif = '$lihat_alt[$i]' and alt_to='lainnya'"; }
                $sql_bobot_tipe=mysqli_query($conn,$querybobot);
                $bobotrange =mysqli_fetch_row($sql_bobot_tipe);
            }
            //echo $querybobot.";<br>";
            //echo $bobotrange[0].";<br>";

            //ambil bobot nya
            $all_bobot[$alter_normal][$i]=$bobotrange[0];

        }
        $alter_normal++;
        //echo "<br> <br>";
    }


    $alter_normal=0;
    $datadata_awal1=mysqli_query($conn,$sqldata_awal);
    while ($b=mysqli_fetch_row($datadata_awal1))
    {
        $final_score=0;

        for($i=0;$i<$jum_alter[0];$i++)
        {   
            //cek dulu untuk tipe SAW nya, apakah Benefit atau cost? dan juga ambil persentase rangking nya

            $sql_lihat_saw1=mysqli_query($conn,"select nilai_saw,rangking from tb_alternatif where id_alternatif=$lihat_alt[$i]");
            $sql_l_saw1=mysqli_fetch_row($sql_lihat_saw1);

            $maksimum[$i]=max($all_bobot[$i]);
            $minimum[$i]=min($all_bobot[$i]);

            if($sql_l_saw1[0]=="1") //benefit
            {
                $bobot_norm=$all_bobot[$alter_normal][$i]/$maksimum[$i];    
            }
            else
            {
                $bobot_norm=$minimum[$i]/$all_bobot[$alter_normal][$i];
            }
            
            $rangking_persen=$sql_l_saw1[1]/100;

            $final_score=$final_score+($rangking_persen*$bobot_norm);

        }
    
        $sql_update_final=mysqli_query($conn,"update tb_pelamar set final_score= $final_score where id_pelamar=$b[5]");
        $alter_normal++;
    }
    echo "SUCCESS";
    
}
 

?>
<html>
  <head>
    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
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
            <a class="nav-link " href="home_admin.php">Data Pelamar</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="listuser.php">Data Pengguna</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="alternatif.php">Kriteria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kriteria.php">Bobot</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="metode_saw.php">Metode SAW</a>
          </li>
         <!--  <li class="nav-item">
            <a class="nav-link " href="filter_pelamar.php">Hasil Filter Pelamar</a>
          </li> -->
    </ul>

</nav>
<table align = "right">
<tr>
    <td>
 <?php
    echo "Selamat Datang, <strong>".strtoupper($_SESSION["nama"])."</strong>&nbsp;";
    echo "<a href='../action.php?act=logout' \" class = 'btn btn-outline-secondary btn-sm''>Logout </a>";
  ?>
</td>
 </tr>
 </table>
<br><br><br>
<h3 align = "center">DATA PELAMAR YANG MEMENUHI KRITERIA SEBAGAI IT STAFF</h3>

<table class ="table table-bordered">                
    <thead>
      <tr>
        <th class="text-center">Nama Pelamar</th>
        <th class="text-center">Jenis Kelamin</th>
        <th class="text-center">Jurusan</th>
        <th class="text-center">IPK</th>
        <th class="text-center">Pengalaman Kerja</th>
        <th class="text-center">Gaji Terakhir</th>
        <th class="text-center">Final Score</th>
        <th class="text-center">Ranking</th>
      </tr>
    </thead>

<?php
$sqlaternatif = "SELECT pel.id_pelamar,pel.nama, pel.jenis_kelamin,pend.jurusan_kuliah,pend.ipk,pkr.gaji_terakhir,
                CASE
                WHEN count(pkr.id_pekerjaan) = 1 THEN 'ada'
                WHEN count(pkr.id_pekerjaan) = 0 THEN 'tidak ada'
                END AS 'Pengalaman',pel.final_score FROM tb_pelamar pel, tb_pekerjaan pkr, tb_pendidikan pend WHERE pel.id_pelamar=pkr.id_pelamar AND pel.id_pelamar=pend.id_pelamar GROUP BY pel.id_pelamar, pel.jenis_kelamin, pend.jurusan_kuliah, pend.ipk, pkr.gaji_terakhir ORDER BY pel.final_score desc";

$dataalter=mysqli_query($conn,$sqlaternatif);
$idx =1;
while ($a=mysqli_fetch_array($dataalter)) { 
?>
    <tr>
        <td class="text-center"><?=ucwords(strtolower($a['nama']))?> </td>
        <td class="text-center"><?php if ($a['jenis_kelamin'] == "l") { echo "Laki-Laki"; } else { echo "Perempuan"; } ?></td>
        <td class="text-center"><?=ucwords(strtolower($a['jurusan_kuliah']))?> </td>
        <td class="text-center"><?=$a['ipk'];?> </td>
        <td class="text-center"><?php if ($a['Pengalaman'] == "ada") { echo "Ada Pengalaman"; } else { echo "Tidak Ada Pengalaman"; } ?> </td>
        <td class="text-center"><?php echo "Rp. ".number_format($a['gaji_terakhir'],2,",",".");?></td>
        <td class="text-center"><?=$a['final_score'];?> </td>
        <td class="text-center"><?=$idx?> </td>
    </tr>
<?php 
$idx +=1;}
?>
</td>
</tr>
</table>


<form method="POST" action="metode_saw.php">
    <input type="submit" class="btn btn-success btn-sm" name="submit" value="Proses Saw">
</form>

<strong><?=$_SESSION["pesan"];$_SESSION["pesan"]="";?></strong><br>
</div>
  </body>
</html>