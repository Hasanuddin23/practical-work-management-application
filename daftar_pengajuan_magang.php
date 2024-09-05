
<?php
include "koneksi.php";
  

$status_magang="";
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa where id_magang='$kode'"));
if($data['status']=="Pengajuan"){$status_magang="<span class='btn btn-warning'><b>$data[status]</b></span>";}
if($data['status']=="Diterima"){$status_magang="<span class='btn btn-primary'><b>$data[status]</b></span>";}
if($data['status']=="Ditolak"){$status_magang="<span class='btn btn-danger'><b>$data[status]</b></span>";}
if($data['status']=="Selesai"){$status_magang="<span class='btn btn-warning'><b>$data[status]</b></span>";}

?>


 


<div class="isi_conten" style="box-shadow:2px 2px 5px #000;background-color:#FFF;">
<p class="judul_conten">Daftar Pengajuan magang</p>



<div class="kelas_tabel">
<table class="table" cellspacing="0" width="100%">
<thead>
 <tr>
	<th style="width:30px;">No</th> 
    <th style="width:140px;">Tanggal Pengajuan</th> 
	<th>Mahasiswa</th> 
	<th>Tanggal Magang</th> 
	<th>Keterangan</th> 
	<th>Status</th> 
  </tr>
</thead>
<tbody>

 
<?php
$no=0;
$query=mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa order by tgl asc");
while ($data=mysqli_fetch_array($query))
{
	$no++;
	echo "<tr>
		  <td>$no</td> 
		  <td>".tanggal($data['tgl'])." </td> 
		  <td>$data[nama]<br>
		  		<i>$data[nim]</i><br>
				<b>$data[kampus]</b><br>
				$data[jurusan]
		  </td> 
		  <td>".tanggal($data['tgl_mulai'])." -sd- ".tanggal($data['tgl_selesai'])."</td> 
		  <td>Pada Bagian: <b>$data[bagian]</b><br><i style='color:#777;'>$data[keterangan]</i></b></td> 
		  <td>$data[status] </td> 
		  </tr>";
}
?>  
</tbody>
</table>
</div>

</div>

