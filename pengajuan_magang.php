
<?php
include "koneksi.php";

 
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa where id_magang='$kode'")); 


if($proses=="batal")
{
	mysqli_query($koneksi,"delete from magang where id_magang='$kode'");
} 


if(isset($_POST['simpan_laporan_magang']))
{
	$fileSize = $_FILES['file_laporan']['size'];  
	$fileError = $_FILES['file_laporan']['error'];
	$fileName = $_FILES['file_laporan']['name'];
	$extension = pathinfo($_FILES['file_laporan']['name'], PATHINFO_EXTENSION);
	$nama_file=$_POST['id_magang'].".$extension";
	if($fileSize > 0 || $fileError == 0)
	{
		$move=move_uploaded_file($_FILES['file_laporan']['tmp_name'],'foto/laporan/'.$nama_file);
	}
	if($move)
	{
		mysqli_query($koneksi,"update magang set laporan='$nama_file' where id_magang='$_POST[id_magang]'");
		echo"<script>window.location='?halaman=$halaman'</script>"; 
	}
}

?>



<style>
.tbl_faktur{border:1px solid #AAA;padding:5px;background-color:#CCC;text-align:center;margin-bottom:10px;width:90px;border-radius:10px;float:left;color:#006;}
.tbl_pembayaran{border:1px solid #900;padding:5px;background-color:#F00;text-align:center;color:#FFF;width:110px;border-radius:10px;float:left;}
.tbl_slip{border:1px solid #F60;padding:5px;background-color:#F90;text-align:center;color:#FFF;width:120px;border-radius:10px;float:left;}
.tbl_batal{border:1px solid #000;padding:5px;background-color:#333;text-align:center;color:#FFF;width:120px;border-radius:10px;float:right;margin:10px;}
.Lunas{background:#EEE !important;}
</style>
 

<?php if($proses=="detail"){?>
 


<div style="width:100%;margin:20px auto;padding:20px;font-family:Cambria;font-size:15px;box-shadow:2px 2px 5px #000;background-color:#FFF;">

     <h2>Detail Pengajuan Kerja Praktik</h2>
    
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
                    <tr><td colspan="2"><img src="foto/mahasiswa/<?=$log_id?>.jpg" style="width:100px;height:100px;"/></td></tr>
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
              <textarea class="form-control" name="keterangan" required style="height:100px !important;" placeholder="Berisikan keterangan seperti fokus dan sasaran yang ingin dikerjakan, Tujuan Magang, atau judul penelitian yang sedang diambil..."><?=$data['keterangan']?></textarea>
              
              <br />
              <input name="simpan" type="submit" class="btn btn-primary" value="Simpan" style="width:100px;">
         		<a href="?halaman=pengajuan_magang"><input name="cancel" type="button" class="btn btn-danger" value="Kembali" style="width:100px;"></a>
                
        	</div>
            
             <div class="col-sm-3">
              
              <label >Surat Pengantar Dari Kampus</label>
              <hr style="margin:5px 0;" />
              
              <?php
			  foreach (glob("foto/pengantar/$data[id_magang]/*.*") as $filename) 
					{
						$namafile=str_replace("foto/pengantar/$data[id_magang]/","",$filename);
						echo"
								<li class='list_gambar'>
									<a href='foto/pengantar/$data[id_magang]/$namafile' target='_blank'>$namafile</a>
								</li>
							 ";
					}
			  ?>
              <div id="last"></div>
              <br />
            <input type="button" class="btn-xs" value="Tambah File" style="color:#777;border:1px solid #BBB;background-color:#CCC;" onclick="tambah_item();" />
                
        	</div>
        </div>
          
         
        
     
     
      
    
   
   
    </form>
  </div>



<?php } else { ?>


<p class="judul_conten">Daftar Pengajuan Kerja Praktik</p>
<div class="isi_conten">

 
<?php
$no=0;
$query=mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa  where magang.id_mahasiswa='$log_id'  order by tgl desc");
while ($data=mysqli_fetch_array($query))
{
	$status_magang="";
	
	if($data['status']=="Pengajuan"){$status_magang="<span class='btn btn-xs btn-warning'><b>$data[status]</b></span>";}
	if($data['status']=="Diterima"){$status_magang="<span class='btn btn-xs btn-primary'><b>$data[status]</b></span>";}
	if($data['status']=="Ditolak"){$status_magang="<span class='btn btn-xs btn-danger'><b>$data[status]</b></span>";}
	if($data['status']=="Selesai"){$status_magang="<span class='btn btn-xs btn-warning'><b>$data[status]</b></span>";}
	$no++;
	
		 
		echo "<div class='baris_magang $data[status]' >";
		echo "<div class='row'>";
			echo "<div class='col-sm-6'>";
					echo"<p class='tgl'>".tanggal($data['tgl_mulai'])." - ".tanggal($data['tgl_selesai'])."</p>";
					echo"<p> Bagian $data[bagian]</p>";	
					echo"<p> $data[keterangan]</p>";		
					echo"<p>Status : <b><span>$status_magang</span></b></p>";
					
			echo"</div>";
			
			echo "<div class='col-sm-4'> 
					<label style='margin:0px;'>Surat Pengantar Dari Kampus: </label>";
					foreach (glob("foto/pengantar/$data[id_magang]/*.*") as $filename) 
					{
						$namafile=str_replace("foto/pengantar/$data[id_magang]/","",$filename);
						echo"
								<li class='list_gambar' style='margin:0px;line-height:20px;'>
									<a href='foto/pengantar/$data[id_magang]/$namafile' target='_blank'>$namafile</a>
								</li>
							 ";
					}
					echo"<hr style='margin:10px 0;'>";
					
					echo"
					<a href='?halaman=$halaman&kode=$data[id_magang]&proses=detail'><p class='btn btn-warning' style='width:100px;margin:2px;'><span class='glyphicon glyphicon-pencil'></span> Detail</p></a> &nbsp; ";
					
					if($data['status']=="Pengajuan")
					{
					echo"<a href='?halaman=$halaman&kode=$data[id_magang]&proses=batal' onclick=\"return confirm('Anda akan membatalkan data kerja praktik ini?')\" style='text-decoration:none;'><p class='btn btn-danger' style='width:100px;margin:2px;'><span class='glyphicon glyphicon-remove'></span> Hapus</p></a> &nbsp; ";
					}
					
					
					if($data['status']=="Selesai")
					{
					echo"<a href='?halaman=sertifikat&kode=$data[id_magang]' style='text-decoration:none;'><p class='btn btn-primary' style='width:130px;margin:2px;'><span class='glyphicon glyphicon-certificate'></span> Cetak Sertifikat</p></a>";
					}
					
					
			echo"</div>";
			
			echo "<div class='col-sm-2'> ";
					
					echo"<label style='margin:0px;'>Laporan Hasil Kerja Praktik: </label>";
					
					if($data['status']=="Ditolak" )
					{
					echo"";
					}
					elseif($data['laporan']==" " or $data['laporan']=="") 
					{
					echo"<p class='btn btn-primary' style='width:130px;margin:2px;padding:10px;' onclick=\"tampil_frame_laporan('$data[id_magang]')\">Upload Laporan<br> Hasil Magang</p>";
					}
					else
					{
						echo"<p><a href='foto/laporan/$data[laporan]' target='_blank'><span class='glyphicon glyphicon-file'></span> File Laporan </a> 
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
								 if($data['status']!="Selesai")
								 {
								 	echo"<span class='glyphicon glyphicon-edit' onclick=\"tampil_frame_laporan('$data[id_magang]')\"></span>";
								 }
						echo"		 
							 </p>";
					}
					
					
			 	echo"</div>";
		echo"</div>";
		echo"</div>";
	
}

if($no==0)
{
	echo"<i>Belum ada data</i>";
}
?>  



</div>

 
<?php } ?>




<style>
.baris_magang{border:1px solid #CCC; border-radius:5px;padding:10px 30px;background-color:#FFF;margin-bottom:10px;font-family:Candara;line-height:25px;font-size:14px;}
.baris_magang p{margin:0;}
.merk{font-size:17px;font-weight:bold;color:#036;}
.harga{font-weight:bold;color:#F00;font-size:15px;}
.tgl{font-size:20px;line-height:50px;color:#069;}
.status{font-weight:bold;color:#999;font-size:14px;}
</style>



<div id="frame_laporan_magang" style="width:101%;height:800px;position:fixed;top:-1px;left:-1px;z-index:9999999;background:rgba(0,0,0,0.8);display:none;">
<div style="width:450px;height:250px;background-color:#FFF;margin:10px;margin:200px auto 0 auto;padding:20px;">
<h2 style="text-align:center;">Laporan Hasil Kerja Praktik</h2>
<form class="form1" action="" method="post" enctype="multipart/form-data" >
<table style="font-size:17px !important;">
	<tr><td style="width:150px;">ID Kerja Praktik</td><td>:</td><td><input class="form-control" id="id_magang" name="id_magang" readonly="readonly"></td></tr>
    <tr><td style="padding-top:10px;">File Laporan (*Format PDF)</td><td style="vertical-align:top;padding-top:10px;">:</td><td style="vertical-align:top;padding-top:10px;"><input class="form-control" name="file_laporan" type="file"  required ></td></tr>
</table>

<br />
<center>
<input type="submit" name="simpan_laporan_magang" class="btn btn-primary" value="Simpan" /> 
<input type="button" class="btn btn-warning" value="Kembali" onclick="tutup_frame_laporan()" />
</center>

</form>
	
</div>
</div>



<script>
function tampil_frame_laporan(id_magang)
{
	document.getElementById('frame_laporan_magang').style.display='block';
	document.getElementById('id_magang').value=id_magang;
}

function tutup_frame_laporan()
{
	document.getElementById('frame_laporan_magang').style.display='none';
}

</script>