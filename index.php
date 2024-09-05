<?php  session_start();
error_reporting(0);
include"koneksi.php";
include"fungsi.php";  
$random=rand(1111,9999);


date_default_timezone_set("Asia/Jakarta");
$tanggal=date("Y-m-d");
$jam=date("H:i:s");
$random_date=date("YmdHis");


$proses=isset($_GET['proses'])?$_GET['proses']:'';
$kode=isset($_GET['kode'])?$_GET['kode']:'';
$subkode=isset($_GET['subkode'])?$_GET['subkode']:'';
$aksi=isset($_GET['aksi'])?$_GET['aksi']:'';


if(isset($_SESSION['log_user'])){$log_user=$_SESSION['log_user'];}else{$log_user="";}
if(isset($_SESSION['log_id'])){$log_id=$_SESSION['log_id'];}else{$log_id="";}
 

if($log_user=="Mahasiswa")
{
	$data_log_mahasiswa=mysqli_fetch_array(mysqli_query($koneksi,"select * from mahasiswa where id_mahasiswa='$log_id'"));
	$log_pengguna=$data_log_mahasiswa['nama'];
}
else
{
	$log_pengguna=$log_user;
}



$random=rand(1111,9999);
$subrandom=rand(11,99);
if(isset($_GET['halaman'])){$halaman=$_GET['halaman'];}else{$halaman="";}
if(isset($_GET['kategori'])){$kategori=$_GET['kategori'];}else{$kategori="";}


$data_mahasiswa=mysqli_fetch_array(mysqli_query($koneksi,"select * from mahasiswa where id_mahasiswa='$log_id'"));

$path_laporan="foto/laporan";
if (!file_exists($path)) {mkdir($path_laporan, 0777, true);}

$rand_indeks=rand(1111,9999);
if(!isset($_SESSION['indeks_kode'])){$_SESSION['indeks_kode']=$rand_indeks;}

/*			
$cek_database=mysqli_fetch_array(mysqli_query($koneksi,"select * from user where username='admin'"));
if(!$cek_database)
{
	mysqli_query($koneksi,"alter table magang add laporan varchar(50) not null default' '");
	mysqli_query($koneksi,"create table nilai (id_nilai int(11) primary key auto_increment,
											   id_magang varchar(20) not null,
											   no_sertifikat varchar(30) not null,
											   tgl_sertifikat date not null,
											   disiplin varchar(20) not null,
											   kerjasama varchar(20) not null,
											   inisiatif varchar(20) not null,
											   kerajinan varchar(20) not null,
											   tanggungjawab varchar(20) not null,
											   sikap varchar(20) not null,
											   prestasi varchar(20) not null,
											   nilai varchar(20) not null) ");
	mysqli_query($koneksi,"create table absensi (id_absensi int(11) primary key auto_increment,
											   id_magang varchar(20) not null,
											   tgl date not null,
											   status varchar(20) not null) ");											   
	mysqli_query($koneksi,"drop table sertifikat ");
	
	mysqli_query($koneksi,"insert into user set username='admin', password='12345', akses='Admin'");
}
*/

function hari_inggris($dayss)
{
	$hari="";
	if($dayss=="Sun"){$hari="Minggu";}
	if($dayss=="Mon"){$hari="Senin";}
	if($dayss=="Tue"){$hari="Selasa";}
	if($dayss=="Wed"){$hari="Rabu";}
	if($dayss=="Thu"){$hari="Kamis";}
	if($dayss=="Fri"){$hari="Jumat";}
	if($dayss=="Sat"){$hari="Sabtu";}
	return $hari;
}

?>

<html>
<head>
<title> Perum Tirta Musi</title>


<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
<link rel="icon" href="logo.png">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/fungsi.js"></script>
<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
<script src="js/jquery.canvasjs.min.js"></script>


<link href="css/style1.css?val=<?=$random_date?>" rel="stylesheet">
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

</head>

 
<body style="overflow-x:hidden;padding:0;background-color:#FFF;">


<style>
.note{color:#999 !important;}
.menu_atas .nav li a{color:#FFF !important;font-size:14px;padding:5px 10px;}
.tombol_login{font-weight:bold;font-family:Cambria;font-size:15px;color:#FFF;}
*{font-family:Calibri;}
</style>
<nav class="navbar navbar-default navbar-fixed-top" style="border:none;box-shadow:2px 2px 5px rgba(0,0,0,0.1);">

      
   <div class="" style="overflow:hidden;box-shadow:1px 1px 5px #333;background-color:#FFF;background-image:url(img/header.jpg);background-size:cover;"> 
   
      
   	 <div class="container row" style="margin:0 auto;padding-top:5px;">
       <div class="col-sm-6 " style="padding:10px !important;height:100px;">
          <a href="index.php" style="text-decoration:none;" >
          	<img src="logo.png" class="img-thumbnail" style="width:80px;height:80px;position:absolute;">
            <p style="font-size:30px;line-height:20px;font-family:Cambria;color:#FFF;margin-left:100px;margin-top:30px;">Perumda Tirta Musi Palembang</p>
          </a>
        </div>
       <div class="col-sm-6">
       
       
        <?php if($log_user==""){?>
            
            
            
            
            <?php } else {?>
            
            <div style="text-align:right;color:#333;font-size:14px;font-family:Cambria;position:absolute;right:10px;top:0px;">
        	Selamat Datang, <b><?=$log_pengguna?></b> 
            <a href="?halaman=logout" class="btn btn-xs btn-danger" onClick="return confirm('Keluar?')">Logout</a>
            <br>
            <?php if($log_user=="Mahasiswa")
			{
				echo"<img src='foto/mahasiswa/$log_id.jpg' class='img-thumbnail' style='width:70px;height:70px;margin-top:5px;'>";
			}
			?>
            </div>
            <?php } ?>
       </div> 
        
       
      
      

     
     </div>
     
     <div class="" style="background-color:#EFE;padding:0;" > 
      		<div class="container menu_atas" style="padding:0;">
      		<ul style="margin:0;padding:0;">
            	
            <?php if($log_user=="Admin"){?>
                <a href="?halaman=daftar_mahasiswa"><li <?php if($halaman=="daftar_mahasiswa"){echo" class='active'";}?>> Daftar mahasiswa</li></a>  
                <a href="?halaman=daftar_pengajuan"><li <?php if($halaman=="daftar_pengajuan"){echo" class='active'";}?>> Daftar Pengajuan</li></a>   
                <a href="?halaman=absensi"><li <?php if($halaman=="absensi"){echo" class='active'";}?>> Absensi Kerja Praktik</li></a>   
                <a href="?halaman=nilai"><li <?php if($halaman=="nilai"){echo" class='active'";}?>> Penilaian</li></a>               
                
            <?php } elseif($log_user=="Pimpinan"){?>  
                <a href="?halaman=laporan_mahasiswa"><li <?php if($halaman=="laporan_mahasiswa"){echo" class='active'";}?>>Laporan Mahasiswa</li></a>
                <a href="?halaman=laporan_magang"><li <?php if($halaman=="laporan_magang"){echo" class='active'";}?>>Laporan Magang</li></a>
                
                
            <?php } elseif($log_user=="Mahasiswa"){?>            
            	<a href="?halaman=home" ><li <?php if($halaman=="home"){echo" class='active'";}?>>Home</li></a>
            	<a href="?halaman=profil"><li <?php if($halaman=="profil"){echo" class='active'";}?>> Profil Saya</li></a>
                <a href="?halaman=input_pengajuan"><li <?php if($halaman=="input_pengajuan"){echo" class='active'";}?>> Input Pengajuan Magang</li></a>         
        		<a href="?halaman=pengajuan_magang"><li <?php if($halaman=="pengajuan_magang"){echo" class='active'";}?>> Daftar Pengajuan Magang</li></a>  
                 
            <?php } else {?>
            	<a href="?halaman=home" ><li <?php if($halaman=="home"){echo" class='active'";}?>>Home</li></a>
                <a href="?halaman=profil_perusahaan"><li <?php if($halaman=="profil_perusahaan"){echo" class='active'";}?>> profil perusahaan</li></a>
                
                
                <a href="?halaman=login"><li <?php if($halaman=="login"){echo" class='active'";}?> style="float:right;"> Login</li></a>
            <?php } ?>
            
            </ul>
      		</div>
      </div>
    
  </div>
</nav>



 





<div class="frame_container" style="padding-top:160px;background-color:#EEE;">

<div class="container" style="padding:0;min-height:400px;">

            <?php
			
            if($halaman=="home"){include"home.php";}
            elseif($halaman=="registrasi"){include"registrasi.php";}
            elseif($halaman=="input_pengajuan"){include"input_pengajuan.php";}
            elseif($halaman=="pengajuan_magang"){include"pengajuan_magang.php";}
            elseif($halaman=="profil_perusahaan"){include"profil_perusahaan.php";}
            elseif($halaman=="sertifikat"){include"sertifikat.php";}
            elseif($halaman=="daftar_mahasiswa"){include"daftar_mahasiswa.php";}
            elseif($halaman=="daftar_pengajuan"){include"daftar_pengajuan.php";}
            elseif($halaman=="daftar_pengajuan_magang"){include"daftar_pengajuan_magang.php";}
			
			      
            elseif($halaman=="ambil_kode"){include"ambil_kode.php";}


            elseif($halaman=="absensi"){include"absensi.php";}			
            elseif($halaman=="nilai"){include"nilai.php";}
			
            elseif($halaman=="mahasiswa"){include"mahasiswa.php";}
            elseif($halaman=="laporan_mahasiswa"){include"laporan_mahasiswa.php";}
            elseif($halaman=="laporan_magang"){include"laporan_magang.php";}
			 
			
            elseif($halaman=="profil"){include"profil.php";}
            elseif($halaman=="login"){include"login.php";}
            elseif($halaman=="logout"){include"logout.php";}
            
            
            else
			{
				include"home.php";
			}
            ?>
</div>
</div> 





 
</body>
</html>
