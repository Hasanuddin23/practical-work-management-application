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

<p class="judul_conten">Laporan Magang</p>


<div style="position:absolute;margin-top:-50px;margin-left:60%;"> 
<select class="form-control" id="bln" name="bln" style="width:150px;float:left;" onchange="set_tanggal()">
    <option value="" <?php if($bln==""){echo" selected";}?>>Setahun</option>
    <option value="1" <?php if($bln=="1"){echo" selected";}?>>Januari</option>
    <option value="2" <?php if($bln=="2"){echo" selected";}?>>Februari</option>
    <option value="3" <?php if($bln=="3"){echo" selected";}?>>Maret</option>
    <option value="4" <?php if($bln=="4"){echo" selected";}?>>April</option>
    <option value="5" <?php if($bln=="5"){echo" selected";}?>>Mei</option>
    <option value="6" <?php if($bln=="6"){echo" selected";}?>>Juni</option>
    <option value="7" <?php if($bln=="7"){echo" selected";}?>>Juli</option>
    <option value="8" <?php if($bln=="8"){echo" selected";}?>>Agustus</option>
    <option value="9" <?php if($bln=="9"){echo" selected";}?>>September</option>
    <option value="10" <?php if($bln=="10"){echo" selected";}?>>Oktober</option>
    <option value="11" <?php if($bln=="11"){echo" selected";}?>>November</option>
<option value="12" <?php if($bln=="12"){echo" selected";}?>>Desember</option>
</select>

<select class="form-control" id="thn" name="thn" style="padding:5px;width:100px;float:left;" onchange="set_tanggal()">
<?php
$tahun=date("Y");
$tahun1=$tahun-5;
for ($i=$tahun;$i>=$tahun1;$i--)
{
	echo"<option value='$i' "; if($i==$thn){echo" selected";} echo">$i</option>"; 
}
?>
</select>




<input type="button" class="btn btn-primary" value="Cetak" onclick="cetak('print_area');" style="padding:6px;margin-left:10px;float:left;width:100px;" />

</div>


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


<h2>Laporan Magang  (<?=$periode?>)</h2>


 


<table   class="table table-striped table-bordered tabel1 tabel_garis" cellspacing="0" width="100%">
<thead>
  <tr>
    <th style="width:30px;">No</th> 
    <th style="width:250px;">Tanggal Kerja Praktik</th> 
	<th>Mahasiswa</th> 
	<th>Keterangan</th> 
	<th>Status</th> 
  </tr>
</thead>
<tbody>  
<?php
$no=0;

$query=mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa where tgl_mulai like '$tanggal%' order by tgl asc");
while ($data=mysqli_fetch_array($query))
{
	$no++;
	echo "<tr>
		  <td>$no</td> 
		  <td>".tanggal($data['tgl_mulai'])." s.d. ".tanggal($data['tgl_selesai'])."</td> 
		  <td>$data[nama]<br>
		  		<i>$data[nim]</i><br>
				<b>$data[kampus]</b><br>
				$data[jurusan]
		  </td> 
		  
		  <td>Pada Bagian: <b>$data[bagian]</b><br><i style='color:#777;'>$data[keterangan]</i></b></td> 
		  <td>$data[status] ";
		  
		  if($data['laporan']!=" " and $data['laporan']!="")
			{
				echo"<p><a href='foto/laporan/$data[laporan]' target='_blank' style='text-decoration:none;'><p class='btn btn-success' style='width:100% !important;margin-top:5px;'><span class='glyphicon glyphicon-file'></span> Laporan Magang</p></a>";
			}
			
			 if($data['status']=="Selesai")
			{
				echo"<p><a href='?halaman=sertifikat&kode=$data[id_magang]' style='text-decoration:none;'><p class='btn btn-warning' style='width:100% !important;margin-top:5px;'><span class='glyphicon glyphicon-certificate'></span> Cetak Sertifikat</p></a>";
			}
			
		  echo"
		  </td> 
		  
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