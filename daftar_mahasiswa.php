
<?php
include "koneksi.php";
 

?>

 




<div class="isi_conten" style="box-shadow:2px 2px 5px #000;background-color:#FFF;">

<p class="judul_conten" style="padding:10px 0;">Daftar Mahasiswa</p>

<div class="kelas_tabel">
<table class="table" id="example" cellspacing="0" width="100%">
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

 