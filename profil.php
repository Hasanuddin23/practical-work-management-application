<?php
include "koneksi.php";




if(isset($_POST['simpan']))
{
		$fileSize = $_FILES['foto']['size'];  
	   	$fileError = $_FILES['foto']['error'];
		if($fileSize > 0 || $fileError == 0)
	   	{
			$move=move_uploaded_file($_FILES['foto']['tmp_name'],'foto/mahasiswa/'.$log_id.'.jpg');	
		}
		$simpandata=mysqli_query($koneksi,"update mahasiswa set  
														 nim='$_POST[nim]', 
														nama='$_POST[nama]',
														jurusan='$_POST[jurusan]',
														kampus='$_POST[kampus]', 
														telp='$_POST[telp]',
														alamat='$_POST[alamat]',
														username='$_POST[username]',
														password='$_POST[password]' 
														where id_mahasiswa ='$log_id'");
		if($simpandata)
		{
			echo"<script>window.location='?halaman=$halaman&proses=berhasil&kode=$id_pelanggan'</script>"; 
		}
	
}

$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from mahasiswa where id_mahasiswa='$log_id'"));

 
?>

 





<div class="isi_conten" style="box-shadow:2px 2px 5px #777;background-color:#FFF;margin-top:15px;">     

<p class="judul_conten" style="margin:5px 0 !important; padding:5px 0;">Profil Mahasiswa</p>   

        <form action="" method="post" enctype="multipart/form-data" >
         <div class="row">
        	<div class="col-sm-4" style="padding-right:50px;">
            	
				<label >Username</label>
              	<input class="form-control" name="username" value="<?=$data['username']?>" required>
                               
                <label >Password</label>
              	<input class="form-control" name="password"   value="<?=$data['password']?>" required>
                               
                <label >Foto</label>
              	<input class="form-control" name="foto" type="file"  >
                <img src="foto/mahasiswa/<?=$log_id?>.jpg" style="width:100px;height:100px;" />
        	</div>
            
            <div class="col-sm-4">
              
              <label >NIM (Nomor Induk Mahasiswa)</label>
              <input class="form-control" name="nim"  value="<?=$data['nim']?>"  required>
              	
              <label >Nama </label>
              <input class="form-control" name="nama"  value="<?=$data['nama']?>"  required>
                
              <label >No Telepon</label>
              <input class="form-control" name="telp"  value="<?=$data['telp']?>"  required onkeypress="return goodchars(event,'0123456789',this)">
                
              <label >Alamat</label>
              <textarea class="form-control" name="alamat" required style="height:70px !important;"><?=$data['alamat']?></textarea>
                
        	</div>
            
             <div class="col-sm-4">
              
              <label >Nama Kampus / Universitas</label>
              <input class="form-control" name="kampus" value="<?=$data['kampus']?>"  required>
                
              <label >Jurusan</label>
              <input class="form-control" name="jurusan" value="<?=$data['jurusan']?>"  required>
                
        	</div>
        </div>
            
            <br /> 
            <input name="simpan" type="submit" class="btn btn-primary" value="Simpan" style="width:100px;">
            <a href="index.php"><input name="cancel" type="button" class="btn btn-danger" value="Cancel" style="width:100px;"></a>
        
        </form>
        
        
            
<?php if($proses=="berhasil"){?>
    
    <p style="text-align:center;font-family:Calibri;font-size:20px;color:#F00;"><i>Data berhasil diupdate</i></p>
    <?php } ?>
    
    
</div>
       
