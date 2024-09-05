<?php

$rand_indeks=rand(1111,9999);
$_SESSION['indeks_kode']=$rand_indeks; 
 
?>


<div style="min-height:480px;">
<div style="background-color: #FFF;border:1px solid #999; width:400px; height:170px; border-radius:10px;  margin: 100px auto 0 auto; font-family: Cambria !important; ">
    <p style="font-size: 15px !important;text-align: center;margin:10px 0;color: #39F;"><b>Kode Autentikasi</b></p>
    <hr style="margin: 5px 0; border: 1px solid #999;">
    <p style="text-align: center;font-size: 25px;"><b><?=$_SESSION['indeks_kode']?></b></p>
    <p style="color: #F00;text-align: center;"><i>Ingat dan masukkan kode di atas ketika melakukan registrasi</i></p>

    <center><a href="?halaman=registrasi"><input type="button" class="btn btn-primary" value="Registrasi"></a></center>
</div>
</div>