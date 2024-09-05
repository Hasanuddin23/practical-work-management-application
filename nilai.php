
<?php
include "koneksi.php";
  
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa where id_magang='$kode'"));
$nilai=mysqli_fetch_array(mysqli_query($koneksi,"select * from nilai where id_magang='$kode' order by id_nilai desc"));

if(isset($_POST['simpan']))
{
	$nilai=round(($_POST['disiplin']+$_POST['kerjasama']+$_POST['inisiatif']+$_POST['kerajinan']+$_POST['tanggungjawab']+$_POST['sikap']+$_POST['prestasi'])/7,2);
	$simpandata=mysqli_query($koneksi,"insert into nilai set id_magang='$kode', 
														no_sertifikat='$_POST[no_sertifikat]',
														tgl_sertifikat='$_POST[tgl_sertifikat]',
														disiplin='$_POST[disiplin]',
														kerjasama='$_POST[kerjasama]', 
														inisiatif='$_POST[inisiatif]',
														kerajinan='$_POST[kerajinan]',
														tanggungjawab='$_POST[tanggungjawab]',
														sikap='$_POST[sikap]',
														prestasi='$_POST[prestasi]',
														nilai='$nilai'");
	if($simpandata)
	{
		mysqli_query($koneksi,"update magang set status='Selesai' where id_magang='$kode'");
		echo"<script>window.location='?halaman=$halaman'</script>";
	}
}

?>




<?php if($proses=="detail"){?>

<div style="width:100%;margin:20px auto;padding:20px;font-family:Cambria;font-size:15px;box-shadow:2px 2px 5px #000;background-color:#FFF;">
<h2>Detail Nilai Kerja Praktik</h2>
     
     
    
    <form class="form1" action="" method="post" enctype="multipart/form-data" >
      
        <div class="row">
             <div class="col-sm-5">
              <table class="tabel_mahasiswa">
              	<tr><td style="width:100px;">NIM</td><td>:</td><td><?=$data['nim']?></td></tr>
              	<tr><td>Nama</td><td>:</td><td><?=$data['nama']?></td></tr>
              	<tr><td>Kampus</td><td>:</td><td><?=$data['kampus']?></td></tr>
              	<tr><td>Jurusan</td><td>:</td><td><?=$data['jurusan']?></td></tr>
              	<tr><td>No Telepon</td><td>:</td><td><?=$data['telp']?></td></tr>
              	<tr><td>Alamat</td><td>:</td><td><?=$data['alamat']?></td></tr>
              </table>
              
                
        	</div>
            
             <div class="col-sm-7">
              <table class="tabel_nilai">
              		<tr><td style="width:200px;">Tanggal Sertifikat</td><td><input class="form-control" name="tgl_sertifikat" type="date" value="<?=$nilai['tgl_sertifikat']?>" required style="width:200px;"></td></tr>
                    <tr><td >Nomor Sertifikat</td><td><input class="form-control" name="no_sertifikat" value="<?=$nilai['no_sertifikat']?>" required style="width:300px;"></td></tr>
                    <tr><td>Nilai Disiplin</td><td><input class="form-control" name="disiplin" value="<?=$nilai['disiplin']?>" required style="width:100px;" onkeypress="return goodchars(event,'0123456789.',this)" maxlength="4"></td></tr>
                    <tr><td>Nilai Kerjasama</td><td><input class="form-control" name="kerjasama" value="<?=$nilai['kerjasama']?>" required style="width:100px;" onkeypress="return goodchars(event,'0123456789.',this)" maxlength="4"></td></tr>
                    <tr><td>Nilai Inisiatif</td><td><input class="form-control" name="inisiatif" value="<?=$nilai['inisiatif']?>" required style="width:100px;" onkeypress="return goodchars(event,'0123456789.',this)" maxlength="4"></td></tr>
                    <tr><td>Nilai Kerajinan</td><td><input class="form-control" name="kerajinan" value="<?=$nilai['kerajinan']?>" required style="width:100px;" onkeypress="return goodchars(event,'0123456789.',this)" maxlength="4"></td></tr>
                    <tr><td>Nilai Tanggung Jawab</td><td><input class="form-control" name="tanggungjawab" value="<?=$nilai['tanggungjawab']?>" required style="width:100px;" onkeypress="return goodchars(event,'0123456789.',this)" maxlength="4"></td></tr>
                    <tr><td>Nilai Sikap</td><td><input class="form-control" name="sikap" value="<?=$nilai['sikap']?>" required style="width:100px;" onkeypress="return goodchars(event,'0123456789.',this)" maxlength="4"></td></tr>
                    <tr><td>Nilai prestasi</td><td><input class="form-control" name="prestasi" value="<?=$nilai['prestasi']?>" required style="width:100px;" onkeypress="return goodchars(event,'0123456789.',this)" maxlength="4"></td></tr>
                    
              </table>
             
             
             <br />
              <input name="simpan" type="submit" class="btn btn-primary" value="Simpan" style="width:100px;">
         		<a href="?halaman=nilai"><input name="cancel" type="button" class="btn btn-danger" value="Cancel" style="width:100px;"></a>
                
        	</div>
            
             
            
            
        </div>
          
         
        
     
     
      
    
   
   
    </form>
  </div>

<?php  }  else { ?>


<div class="isi_conten" style="box-shadow:2px 2px 5px #000;background-color:#FFF;">

<p class="judul_conten" style="padding:10px 0;">Daftar Nilai Kerja Praktik</p>
<div class="kelas_tabel">
<table class="table" cellspacing="0" width="100%">
<thead>
 <tr style="background-color:#777;">
	<th style="width:30px;" rowspan="2">No</th> 
	<th rowspan="2">Mahasiswa</th> 
	<th style='text-align:center;' rowspan="2">Tanggal Kerja Praktik</th> 
	<th style='text-align:center;' colspan="7">Nilai</th> 
	<th rowspan="2" style='text-align:center;width:80px !important;'>Rata-rata</th> 
	<th rowspan="2" style='text-align:center;width:80px !important;'>Action</th>
  </tr>
  <tr style="background-color:#777;">
  	<th style="width:60px;text-align:center;">Disiplin</th>
  	<th style="width:60px;text-align:center;">Kerjasama</th>
  	<th style="width:60px;text-align:center;">Inisiatif</th>
  	<th style="width:60px;text-align:center;">Kerajinan</th>
  	<th style="width:60px;text-align:center;">Tanggungjawab</th>
  	<th style="width:60px;text-align:center;">Sikap</th>
  	<th style="width:60px;text-align:center;">Prestasi</th>
  </tr>
</thead>
<tbody>

 
<?php
$no=0;
$query=mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa order by tgl asc");
while ($data=mysqli_fetch_array($query))
{
	$no++;
	$nilai=mysqli_fetch_array(mysqli_query($koneksi,"select * from nilai where id_magang='$data[id_magang]'"));
	echo "<tr>
		  <td>$no</td> 
		  <td>$data[nama]<br>
				<b>($data[kampus])</b>
		  </td> 
		  <td style='text-align:center;'>".tanggal($data['tgl_mulai'])." -<br> ".tanggal($data['tgl_selesai'])."</td> 
		  <td style='text-align:center;'>$nilai[disiplin]</td> 
		  <td style='text-align:center;'>$nilai[kerjasama]</td> 
		  <td style='text-align:center;'>$nilai[inisiatif]</td> 
		  <td style='text-align:center;'>$nilai[kerajinan]</td> 
		  <td style='text-align:center;'>$nilai[tanggungjawab]</td> 
		  <td style='text-align:center;'>$nilai[sikap]</td> 
		  <td style='text-align:center;'>$nilai[prestasi]</td> 
		  <td style='text-align:center;'>$nilai[nilai]</td> 
		  <td style='width:80px !important;'>
			<a href='?proses=detail&kode=$data[id_magang]&halaman=$halaman' class='btn btn-xs btn-primary' style='width:100% !important;'><span class='glyphicon glyphicon-list-alt' title='edit'></span>  &nbsp; Detail</a>
		  </td>
		  </tr>";
}
?>  
</tbody>
</table>
</div>

</div>


 
<?php } ?>



<style>
.tabel_mahasiswa td:first-child{padding:0 0 0 2px !important;}
.tabel_mahasiswa td{font-size:14px;padding:5px 0 0 2px !important;vertical-align:top;}

.tabel_nilai td{font-size:14px;font-family:Cambria;}
</style>
 
 
 




 