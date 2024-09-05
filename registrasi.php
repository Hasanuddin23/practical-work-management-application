<?php
include "koneksi.php";

//echo $_SESSION['indeks_kode']; 

if($proses=="berhasil"){$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from mahasiswa where id_mahasiswa='$kode'"));}

if(isset($_POST['simpan']))
{
	$simpandata=mysqli_query($koneksi,"insert into mahasiswa set nim='$_POST[nim]', 
														nama='$_POST[nama]',
														jurusan='$_POST[jurusan]',
														kampus='$_POST[kampus]', 
														telp='$_POST[telp]',
														alamat='$_POST[alamat]',
														username='$_POST[username]',
														password='$_POST[password]'");
		if($simpandata)
		{
			$data_tersimpan=mysqli_fetch_array(mysqli_query($koneksi,"select * from mahasiswa order by id_mahasiswa desc"));
			$fileSize = $_FILES['foto']['size'];  
			$fileError = $_FILES['foto']['error'];
			if($fileSize > 0 || $fileError == 0)
			{
				$move=move_uploaded_file($_FILES['foto']['tmp_name'],'foto/mahasiswa/'.$data_tersimpan['id_mahasiswa'].'.jpg');
			}
			
			echo"<script>window.location='?halaman=$halaman&proses=berhasil&kode=$data_tersimpan[id_mahasiswa]'</script>"; 
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

 <div style="width:900px;margin:20px auto;padding:20px;font-family:Cambria;font-size:15px;box-shadow:2px 2px 5px #000;background-color:#FFF;">

     <h2>Registrasi Mahasiswa</h2>
    
    <form class="form1" action="" method="post" enctype="multipart/form-data" >
      
      <div style="height: 40px;color: #39F;text-align: center;border-bottom: 1px solid #999;">
         <b>Kode Autentikasi :</b> <input type="text" id="kode_autentikasi" name="kode_autentikasi" required style="font-weight: bold;font-size: 17px;font-weight: bold; width: 100px;" onkeypress="return goodchars(event,'0123456789',this)">
         <p id="teks_peringatan" style="color: #FFF;position: absolute;background-color: #E00;padding: 5px;left: 60%;margin-top: -30px;display: none;font-size: 12px;"><i>Tekan tombol kembali untuk mendapatkan Kode autentikasi</i></p>
      </div>

        <div class="row">
        	<div class="col-sm-4" style="padding-right:50px;">
            	
				<label >Username</label>
              	<input class="form-control" name="username"  required>
                               
                <label >Password</label>
              	<input class="form-control" name="password"  required>
                               
                <label >Foto</label>
              	<input class="form-control" name="foto" type="file"  required>
                
        	</div>
            
            <div class="col-sm-4">
              
              <label >NIM (Nomor Induk Mahasiswa)</label>
              <input class="form-control" name="nim"  required>
              	
              <label >Nama </label>
              <input class="form-control" name="nama"  required>
                
              <label >No Telepon</label>
              <input class="form-control" name="telp"  required onkeypress="return goodchars(event,'0123456789',this)">
                
              <label >Alamat</label>
              <textarea class="form-control" name="alamat" required style="height:70px !important;"></textarea>
                
        	</div>
            
             <div class="col-sm-4">
              
              <label >Nama Kampus / Universitas</label>
              <input class="form-control" name="kampus"  required>
                
              <label >Jurusan</label>
              <input class="form-control" name="jurusan"  required>
                
        	</div>
        </div>
          
         
         <br />
         
         
         <center>
         <input name="simpan" type="submit" class="btn btn-primary" value="Simpan" style="width:100px;" onclick="return cek_kode()">
         <a href="?halaman=ambil_kode"><input name="kembali" type="button" class="btn btn-danger" value="Kembali" style="width:100px;"></a>
         </center>
         
     
   
   
    </form>
  </div>

 <?php } ?>
 
 </div>


<style>
.frame_container{background-color:#EEE !important;}
</style>


<script type="text/javascript">
  function cek_kode()
  {
    //alert(document.getElementById('kode_autentikasi').value);
    if(document.getElementById('kode_autentikasi').value=="<?=$_SESSION['indeks_kode']?>")
    {
      return true;
    }
    else
    {
      alert('Kode Autentikasi salah');
      document.getElementById('teks_peringatan').style.display="block";
      return false;
      
    }
  }
</script>