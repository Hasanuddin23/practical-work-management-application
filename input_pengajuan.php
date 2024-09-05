<?php
include "koneksi.php";


$data_mahasiswa=mysqli_fetch_array(mysqli_query($koneksi,"select * from mahasiswa where id_mahasiswa='$log_id' "));

$jlh_data=mysqli_num_rows(mysqli_query($koneksi,"select * from magang "));
$id_magang=date("ymd").str_pad($jlh_data+1,4,"0",STR_PAD_LEFT).rand(111,999);

if($proses=="berhasil"){$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from mahasiswa where id_mahasiswa='$kode'"));}

if(isset($_POST['simpan']))
{
	$sekarang=date("Y-m-d");
	$simpandata=mysqli_query($koneksi,"insert into magang set id_magang='$_POST[id_magang]',
														id_mahasiswa='$log_id', 
														tgl='$sekarang',
														tgl_mulai='$_POST[tgl_mulai]',
														tgl_selesai='$_POST[tgl_selesai]', 
														bagian='$_POST[bagian]',
														keterangan='$_POST[keterangan]',
														status='Pengajuan',
														tanggapan=' '");
		if($simpandata)
		{
			$path="foto/pengantar/$_POST[id_magang]";
			if (!file_exists($path)) {mkdir($path, 0777, true);}
			for($i=1;$i<=100;$i++)
			{
				$fileSize = $_FILES['pengantar']['size'][$i];  
				$fileError = $_FILES['pengantar']['error'][$i];
				$fileName = $_FILES['pengantar']['name'][$i];
				if($fileSize > 0 || $fileError == 0)
				{
					$move=move_uploaded_file($_FILES['pengantar']['tmp_name'][$i],$path.'/'.$fileName);
				}
			}
			
			echo"<script>window.location='?halaman=pengajuan_magang'</script>"; 
		}
}

?>



<style>
.registrasi{color:#333;}
</style>

<div style="min-height:480px;">

<?php if($proses=="berhasil"){?>
    <div class="isi_conten" style="min-height:450px;">
    
    <a href="?halaman=login" style="font-size:15px;" ><p  style="text-align:center;margin-top:90px;font-family:Calibri;font-size:30px;"><b style="color:#03C;">Registrasi Berhasil</b></p></a>
    
    </div>
    
    <?php } else { ?>

 <div style="width:100%;margin:20px auto;padding:20px;font-family:Cambria;font-size:15px;box-shadow:2px 2px 5px #000;background-color:#FFF;">

     <h2>Input Pengajuan Magang</h2>
    
    <form class="form1" action="" method="post" enctype="multipart/form-data" >
      
        <div class="row">
        	<div class="col-sm-4" style="padding-right:50px;">
            	
                <table>
                	<tr>
                    	<td style="width:120px;"><label >ID Pengajuan </label></td>
                        <td><input class="form-control" name="id_magang" value="<?=$id_magang?>"  readonly></td>
                    </tr>
                	<tr>
                    	<td><label >NIM </label></td>
                        <td><input class="form-control" name="nim" value="<?=$data_mahasiswa['nim']?>"  readonly></td>
                    </tr>
                	<tr>
                    	<td><label >Nama</label></td>
                        <td><input class="form-control" name="nama" value="<?=$data_mahasiswa['nama']?>"  readonly></td>
                    </tr>
                	<tr>
                    	<td><label >Nama Kampus</label></td>
                        <td><input class="form-control" name="kampus" value="<?=$data_mahasiswa['kampus']?>"  readonly></td>
                    </tr>
                	<tr>
                    	<td><label >Jurusan</label></td>
                        <td><input class="form-control" name="jurusan" value="<?=$data_mahasiswa['jurusan']?>"  readonly></td>
                    </tr>
                    <tr><td colspan="2"><img src="foto/mahasiswa/<?=$log_id?>.jpg" style="width:100px;height:100px;"/></td></tr>
                </table>
                
        	</div>
            
            <div class="col-sm-5">
              
              <label >Tanggal Magang</label>
              <div style="height:40px;">
              <input class="form-control" name="tgl_mulai" type="date" style="width:150px;float:left;margin-right:10px;"  required>
              <label style="float:left;">-s.d-</label>
              <input class="form-control" name="tgl_selesai" type="date" style="width:150px;float:left;margin-left:10px;"  required>
             
              </div>
              	
              <label >Bagian Yang Dituju </label>
              <select class="form-control" name="bagian"  required>
              	<option value="">-pilih-</option>
              	<option value="IT">IT</option>
              	<option value="Keuangan">Keuangan</option>
              	<option value="Administrasi">Administrasi</option>
              	<option value="HRD">HRD</option>
                <option value="SDM">SDM</option>
                <option value="PKA">PKA</option>
                <option value="Produksi">Produksi</option>
                <option value="Mekanik dan Listrik">Mekanik dan Listrik</option>
                <option value="Perencanaan">Perencanaan</option>
                <option value="Pengadaan">Pengadaan</option>
                <option value="Umum">Umum</option>
              	<option value="Lain-lain">Lain-lain</option>
              </select>
                 
              <label >Keterangan</label>
              <textarea class="form-control" name="keterangan" required style="height:100px !important;" placeholder="Berisikan keterangan seperti fokus dan sasaran yang ingin dikerjakan, Tujuan Magang, atau judul penelitian yang sedang diambil..."></textarea>
              
              <br />
              <input name="simpan" type="submit" class="btn btn-primary" value="Simpan" style="width:100px;">
         		<a href="index.php"><input name="cancel" type="button" class="btn btn-danger" value="Cancel" style="width:100px;"></a>
                
        	</div>
            
             <div class="col-sm-3">
              
              <label >Surat Pengantar Dari Kampus</label>
              <hr style="margin:5px 0;" />
              
              <div id="last"></div>
              <br />
            <input type="button" class="btn-xs" value="Tambah File" style="color:#777;border:1px solid #BBB;background-color:#CCC;" onclick="tambah_item();" />
                
        	</div>
        </div>
          
         
        
     
     
      
    
   
   
    </form>
  </div>

 <?php } ?>
 
 </div>




<script>

nx=1;
function tambah_item()
{   
    nx++; 
	row='<div class="'+nx+' frame_file" style="height:35px;">'+
	'<span class="glyphicon glyphicon-remove" onclick="del_item('+nx+')" style="color:#F00;float:left;margin-right:7px;"></span>'+
	'<input type="file" id="gbr'+nx+'"   name="pengantar['+nx+']" required style="float:left;width:200px;">'+
	'</div>';
    $(row).insertBefore("#last");  
} 

function del_item(nn)
{
	$("."+nn).remove();
}

</script>