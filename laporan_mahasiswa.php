<?php
error_reporting(0);
include "koneksi.php";

if(isset($_GET['bln'])){$bln=$_GET['bln'];}else{$bln=date("m");}
if(isset($_GET['thn'])){$thn=$_GET['thn'];}else{$thn=date("Y");}
if(isset($_GET['tgl'])){$tgl=$_GET['tgl'];}else{$tgl="";}

$tahunan="";

	if($bln!=""){$tanggal=$thn."-".str_pad($bln,2,"0",STR_PAD_LEFT);}else{$tanggal=$thn;$tahunan="Ya";}
	$periode=namabulan($bln)." ".$thn;





?>

<p class="judul_conten">Laporan Mahasiswa</p>
<input type="button" value="Cetak" onclick="cetak('print_area');" class="btn btn-primary" style="padding:6px;margin-left:5px;float:right;margin-right:20px;width:100px;" />
<div class="isi_conten">

  

<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;width:100%;"></iframe>

<div id="print_area" style="width:100%;">  
<style>
.print * {
  transition: none !important;  
   -webkit-print-color-adjust: exact; 
}
</style>
<div class="print">  
<style>
h1,h2,h3,h4,h4{text-transform:capitalize;}
table{border-collapse:collapse;}
.tabel_garis th{border:0.1em solid #999 !important;padding:5px;text-align:left;text-transform:capitalize;background-color:#CCC; color:#333 !important;}
.tabel_garis td{border:0.1em solid #999 !important;padding:5px;text-align:left;}
</style>
<style>
 .tabel_grafik td{border:none !important;text-align:center;width:50px;}
 .bar_grafik{width:30px;margin:0 auto;border:1px solid #BBB;background-color:#CCC;}
 .klik_bulan:hover{background-color:#333;cursor:pointer;}
 </style>


<h2>Laporan Mahasiswa  </h2>


 


<table   class="table table-striped table-bordered tabel1 tabel_garis" cellspacing="0" width="100%">
<thead>
  <tr>
    <th style="width:30px;">No</th> 
    <th style="width:110px;">NIM</th> 
	<th>Nama</th> 
	<th>Kampus / Jurusan</th> 
	<th>No Telepon</th> 
	<th style='width:300px;text-align:left;'>Alamat</th>
  </tr>
</thead>
<tbody>  
<?php
$no=0;
$query=mysqli_query($koneksi,"select * from mahasiswa");
while ($data=mysqli_fetch_array($query))
{
	$no++;
	echo "<tr>
		  <td>$no</td> 
		  <td>$data[nim]</td> 
		  <td>$data[nama]</td>
		  <td>$data[kampus] ($data[jurusan])</td> 
		  <td>$data[telp]</td> 
		  <td style='width:300px;text-align:left;'>$data[alamat]</td> 
		  </tr>";
}
?>  
 </tbody>
</table>





</div>
</div>


</div>



<script>
function set_tanggal()
{
	var bln=document.getElementById("bln").value;
	var thn=document.getElementById("thn").value;
	window.location="?halaman=<?=$halaman?>&bln="+bln+"&thn="+thn;
}
function set_tgl()
{
	var tgl=document.getElementById("tgl").value;
	window.location="?halaman=<?=$halaman?>&tgl="+tgl;
}
</script>