
<?php
include "koneksi.php";
 
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa where id_magang='$kode'"));

if($proses=="hapus")
{
	mysqli_query($koneksi,"delete from magang where id_magang='$kode'");	
	echo"<script>window.location='?halaman=$halaman'</script>";
}



if(isset($_POST['update']))
{
	$simpandata=mysqli_query($koneksi,"update magang set tgl_mulai='$_POST[tgl_mulai]',
														tgl_selesai='$_POST[tgl_selesai]', 
														bagian='$_POST[bagian]',
														keterangan='$_POST[keterangan]'");
	if($simpandata)
	{
		echo"<script>alert('Data Berhasil Disimpan');</script>";		
		echo"<script>window.location='?halaman=$halaman&proses=detail&kode=$kode'</script>";
	}
}
if(isset($_POST['ditolak']))
{
	$simpandata=mysqli_query($koneksi,"update magang set status='Ditolak' where id_magang='$kode'");
	if($simpandata)
	{	
		echo"<script>window.location='?halaman=$halaman'</script>";
	}
}
if(isset($_POST['diterima']))
{
	$simpandata=mysqli_query($koneksi,"update magang set status='Diterima' where id_magang='$kode'");
	if($simpandata)
	{
		echo"<script>alert('Data Berhasil Disimpan');</script>";		
		echo"<script>window.location='?halaman=$halaman&proses=detail&kode=$kode'</script>";
	}
}

if(isset($_POST['simpan_nilai']))
{
	$simpandata=mysqli_query($koneksi,"update magang set status='Selesai' where id_magang='$kode'");
	if($simpandata)
	{
		$simpandata=mysqli_query($koneksi,"insert into sertifikat set id_magang='$kode', 
														tgl_sertifikat='$_POST[tgl_sertifikat]',
														nilai='$_POST[nilai]'");
		echo"<script>alert('Data Berhasil Disimpan');</script>";		
		echo"<script>window.location='?halaman=$halaman&proses=detail&kode=$kode'</script>";
	}
}


 
if(isset($_POST['selesai']))
{
		echo"<script>window.location='?halaman=$halaman&proses=detail&kode=$kode&aksi=nilai'</script>";
}
 

$status_magang="";
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa where id_magang='$kode'"));
if($data['status']=="Pengajuan"){$status_magang="<span class='btn btn-warning'><b>$data[status]</b></span>";}
if($data['status']=="Diterima"){$status_magang="<span class='btn btn-primary'><b>$data[status]</b></span>";}
if($data['status']=="Ditolak"){$status_magang="<span class='btn btn-danger'><b>$data[status]</b></span>";}
if($data['status']=="Selesai"){$status_magang="<span class='btn btn-warning'><b>$data[status]</b></span>";}

?>




<?php if($proses=="detail"){?>

<div style="width:100%;margin:20px auto;padding:20px;font-family:Cambria;font-size:15px;box-shadow:2px 2px 5px #000;background-color:#FFF;">

     <h2>Detail Pengajuan Kerja Praktik</h2>
     
     <p style="float:right;margin-top:-50px;">Status : <?=$status_magang?></p>
    
    <form class="form1" action="" method="post" enctype="multipart/form-data" >
      
        <div class="row">
        	<div class="col-sm-4" style="padding-right:50px;">
            	
                <table>
                	<tr>
                    	<td style="width:120px;"><label >ID Pengajuan </label></td>
                        <td><input class="form-control" name="id_magang" value="<?=$data['id_magang']?>"  readonly></td>
                    </tr>
                	<tr>
                    	<td><label >NIM </label></td>
                        <td><input class="form-control" name="nim" value="<?=$data['nim']?>"  readonly></td>
                    </tr>
                	<tr>
                    	<td><label >Nama</label></td>
                        <td><input class="form-control" name="nama" value="<?=$data['nama']?>"  readonly></td>
                    </tr>
                	<tr>
                    	<td><label >Nama Kampus</label></td>
                        <td><input class="form-control" name="kampus" value="<?=$data['kampus']?>"  readonly></td>
                    </tr>
                	<tr>
                    	<td><label >Jurusan</label></td>
                        <td><input class="form-control" name="jurusan" value="<?=$data['jurusan']?>"  readonly></td>
                    </tr>
                    <tr><td colspan="2"><img src="foto/mahasiswa/<?=$data['id_mahasiswa']?>.jpg" style="width:100px;height:100px;"/></td></tr>
                </table>
                
        	</div>
            
            <div class="col-sm-5">
              
              <label >Tanggal Kerja Praktik</label>
              <div style="height:40px;">
              <input class="form-control" name="tgl_mulai" type="date" style="width:150px;float:left;margin-right:10px;" value="<?=$data['tgl_mulai']?>" required>
              <label style="float:left;">-s.d-</label>
              <input class="form-control" name="tgl_selesai" type="date" style="width:150px;float:left;margin-left:10px;"   value="<?=$data['tgl_selesai']?>" required>
             
              </div>
              	
              <label >Bagian Yang Dituju </label>
              <select class="form-control" name="bagian"  required>
              	<option value="">-pilih-</option>
              	<option value="IT" <?php if($data['bagian']=="IT"){echo" selected ";}?>>IT</option>
              	<option value="Keuangan" <?php if($data['bagian']=="Keuangan"){echo" selected ";}?>>Keuangan</option>
              	<option value="Administrasi" <?php if($data['bagian']=="Administrasi"){echo" selected ";}?>>Administrasi</option>
              	<option value="HRD" <?php if($data['bagian']=="HRD"){echo" selected ";}?>>HRD</option>
                <option value="SDM" <?php if($data['bagian']=="SDM"){echo" selected ";}?>>SDM</option>
                <option value="PKA" <?php if($data['bagian']=="PKA"){echo" selected ";}?>>PKA</option>
                <option value="Produksi" <?php if($data['bagian']=="Produksi"){echo" selected ";}?>>Produksi</option>
                <option value="Mekanik dan Listrik" <?php if($data['bagian']=="Mekanik dan Listrik"){echo" selected ";}?>>Mekanik dan Listrik</option>
                <option value="Perencanaan" <?php if($data['bagian']=="Perencanaan"){echo" selected ";}?>>Perencanaan</option>
                <option value="Pengadaan" <?php if($data['bagian']=="Pengadaan"){echo" selected ";}?>>Pengadaan</option>
                <option value="Umum" <?php if($data['bagian']=="Umum"){echo" selected ";}?>>Umum</option>
              	<option value="Lain-lain" <?php if($data['bagian']=="Lain-lain"){echo" selected ";}?>>Lain-lain</option>
              </select>
                 
              <label >Keterangan</label>
              <textarea class="form-control" name="keterangan" required style="height:100px !important;" placeholder="Berisikan keterangan seperti fokus dan sasaran yang ingin dikerjakan, Tujuan Kerja Praktik, atau judul penelitian yang sedang diambil..."><?=$data['keterangan']?></textarea>
              
              <br />
              <?php if($data['status']!="Ditolak" and $data['status']!="Selesai" ){?>
              <input name="update" type="submit" class="btn btn-info" value="Simpan" style="width:70px;">
         	  <a href="?halaman=daftar_pengajuan"><input name="cancel" type="button" class="btn btn-warning" value="Kembali" style="width:70px;"></a>
              <?php } ?>
              
              
              <?php if($data['status']=="Pengajuan"){?>
              <div style="margin-top:10px;">
              <input name="diterima" type="submit" class="btn btn-primary" value="Diterima" style="width:150px;padding:20px;" onclick="return confirm('Pengajuan Kerja Praktik Diterima??')">
              <input name="ditolak" type="submit" class="btn btn-danger" value="Ditolak" style="width:150px;padding:20px;" onclick="return confirm('Pengajuan Kerja Praktik Ditolak??')">
              </div>
              <?php } ?>
              
              <?php if($data['status']=="Diterima"){?>
              <div style="margin-top:10px;">
              <a href="?halaman=nilai&proses=detail&kode=<?=$kode?>"><input name="selesai" type="button" class="btn btn-primary" value="Kerja Praktik Selesai" style="width:100%;padding:20px;" onclick="return confirm('Masa Kerja Praktik Selesai??')"></a>
              </div>
              <?php } ?>
              
              <?php if($data['status']=="Selesai"){?>
              <div style="margin-top:10px;">
              <a href='?halaman=sertifikat&kode=<?=$data['id_magang']?>' style='text-decoration:none;'><p class='btn btn-primary' style='width:130px;'><span class='glyphicon glyphicon-certificate'></span> Cetak Sertifikat</p></a>
              </div>
              <?php } ?>
                
        	</div>
            
             <div class="col-sm-3">
              
              <label >Surat Pengantar Dari Kampus</label>
              <hr style="margin:5px 0;" />
              
              <?php
			  foreach (glob("foto/pengantar/$data[id_magang]/*.*") as $filename) 
					{
						$namafile=str_replace("foto/pengantar/$data[id_magang]/","",$filename);
						echo"
								<li class='list_gambar_produk'>
									<a href='foto/pengantar/$data[id_magang]/$namafile' target='_blank'>$namafile</a>
								</li>
							 ";
					}
			  ?>
              <div id="last"></div>
              <br /><br />
              
              <label >Laporan Hasil Kerja Praktik</label>
              <hr style="margin:5px 0;" />
              <?php
			  if($data['laporan']!="" and $data['laporan']!=" ")
			  {
				  echo"<p><a href='foto/laporan/$data[laporan]' target='_blank'><span class='glyphicon glyphicon-file'></span> File Laporan </a> ";
			  }
			  else
			  {
				  echo"<i style='font-size:12px;color:#F00;'>Belum ada laporan hasil Kerja Praktik dari mahasiswa</i>";
			  }
			  ?>
               
        	</div>
        </div>
          
         
        
     
     
      
    
   
   
    </form>
  </div>

<?php  }  else { ?>


<div class="isi_conten" style="box-shadow:2px 2px 5px #000;background-color:#FFF;">

<p class="judul_conten" style="padding:10px 0;">Daftar Kerja Praktik</p>


<div class="kelas_tabel">
<table class="table" cellspacing="0" width="100%">
<thead>
 <tr>
	<th style="width:30px;">No</th> 
    <th style="width:140px;">Tanggal Pengajuan</th> 
	<th>Mahasiswa</th> 
	<th>Tanggal Kerja Praktik</th> 
	<th>Keterangan</th> 
	<th>Status</th> 
	<th>Action</th>
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
		  <td>".tanggal($data['tgl_mulai'])." -sd- <br> ".tanggal($data['tgl_selesai'])."</td> 
		  <td>Pada Bagian: <b>$data[bagian]</b><br><i style='color:#777;'>$data[keterangan]</i></b></td> 
		  <td>$data[status] </td> 
		  <td>
			<a href='?proses=detail&kode=$data[id_magang]&halaman=$halaman' class='btn btn-xs btn-primary' style='width:100% !important;'><span class='glyphicon glyphicon-list-alt' title='edit'></span>  &nbsp; Detail</a>";
			 
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


 
<?php } ?>



<div id="frame_nilai" style="width:101%;height:800px;position:fixed;top:-1px;left:-1px;z-index:9999999;background:rgba(0,0,0,0.8);<?php if($aksi=="nilai"){echo"display:block;";}else{echo"display:none;";}?>">
<div style="width:450px;height:230px;background-color:#FFF;margin:10px;margin:200px auto 0 auto;padding:20px;">
<h2 style="text-align:center;">Penialain & Sertifikat Kerja Praktik</h2>
<form class="form1" action="" method="post" enctype="multipart/form-data" >
<table style="font-size:17px !important;">
	<tr><td style="width:150px;">Nilai Kerja Praktik</td><td>:</td><td><input class="form-control" name="nilai"  required onkeypress="return goodchars(event,'0123456789',this)"></td></tr>
    <tr><td>Tanggal Sertifikat</td><td>:</td><td><input class="form-control" name="tgl_sertifikat"  required type="date"></td></tr>
</table>

<br />
<center>
<input type="submit" name="simpan_nilai" class="btn btn-primary" value="Simpan" /> 
<a href="?halaman=<?=$halaman?>&kode=<?=$kode?>&proses=detail"><input type="button" class="btn btn-warning" value="Kembali" /> </a>
</center>

</form>
	
</div>
</div>
 
 

