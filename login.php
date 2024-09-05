<?php  session_start();?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<?php

 
$status="";
$notif="";



$level=$_GET['level'];	
if(isset($_POST['proses_login']))
{
	   
	   if($_POST['username']=="admin" and $_POST['password']=="12345")
	   {
		   	$_SESSION['log_user']="Admin";
			echo"<script>window.parent.location='index.php'</script>";
	   }
	   elseif($_POST['username']=="pimpinan" and $_POST['password']=="12345")
	   {
		   	$_SESSION['log_user']="Pimpinan";
			echo"<script>window.parent.location='index.php'</script>";
	   }
	   else
	   {
		   $cek=mysqli_fetch_array(mysqli_query($koneksi,"select * from mahasiswa where  username='$_POST[username]' and password='$_POST[password]'"));
		   if($cek)
		   {
			   $_SESSION['log_user']="Mahasiswa";
			   $_SESSION['log_id']=$cek['id_mahasiswa'];
				echo"<script>window.parent.location='index.php'</script>";
		   }
		   else
		   {
				$cek=mysqli_fetch_array(mysqli_query($koneksi,"select * from user where  username='$_POST[username]' and password='$_POST[password]'"));
			   if($cek)
			   {
				   $_SESSION['log_user']=$cek['akses'];
					echo"<script>window.parent.location='index.php'</script>";
			   }
			   else
			   {
					$notif_gagal="Ya";
			   }
		   }
	   }
	
	
}

//echo "status:".$status;


?>


<div id="frame_login" style="min-height:480px;">
    <div style="width:300px;margin:50px auto;padding:20px;">
        <center style="font-size:20px;font-weight:bold;font-family:Cambria;">LOGIN</center>
        <br />
        <div class="panel-body" style="font-size:14px;color:#333;border-radius:5px;">
        	<div style="width:200px;margin:0 auto;"> 
            	<form method="post" style="font-family:Calibri;line-height:25px;" >
                
                <div class="input-group input_login" style="margin-bottom:20px;">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1" >
                </div>
                
                <div class="input-group input_login">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                  <input name="password" type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" required>
                </div>
                
                <br />
                <input type="submit" class="btn btn-sm btn-primary" name="proses_login" value="Login"  style="background-color:#069;color:#FFF;border:none;width:80px;margin-top:-2px;">
                
                <a href="?halaman=ambil_kode" style="text-decoration:none;"><span style="font-size:14px;color:#FFF;background-color:#F93;padding:6px 10px;font-family:Cambria;border-radius:2px;margin-left:30px;">Registrasi</span></a>
                    
                <br /><br />
                    
                </form>
			</div>                 
		</div>
                
        <?php if($notif_gagal=="Ya"){echo"<p style='background-color:#F00;color:#FFF;padding:10px;text-align:center;font-size:14px;'> Login Gagal </p>";} ?>        
        
    </div>
</div>

 