
<?php
include "koneksi.php";

 
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa where id_magang='$kode'")); 
$data_nilai=mysqli_fetch_array(mysqli_query($koneksi,"select * from nilai where id_magang='$kode' order by id_nilai desc")); 

if($data_nilai['nilai']>0){}else{$data_nilai['nilai']="70";}
$predikat="BAIK";
if($data_nilai['nilai']>70){$predikat="SANGAT BAIK";}

function cek_nilai($angka)
{
	$predikat="B";
	$bobot="Baik";
	if($angka>=8.5 && $angka<=10){$predikat="A";$bobot="Baik Sekali";}
	if($angka>=7.5 && $angka<8.5){$predikat="B";$bobot="Baik";}
	if($angka>=5.5 && $angka<7.5){$predikat="C";$bobot="Cukup";}
	if($angka>=3.5 && $angka<5.5){$predikat="D";$bobot="Kurang";}
	if($angka>=1 && $angka<3.5){$predikat="E";$bobot="Kurang Sekali";}
	
	
	return array($predikat,$bobot);
}

$nilai_disiplin=cek_nilai($data_nilai['disiplin']);
$nilai_kerjasama=cek_nilai($data_nilai['kerjasama']);
$nilai_inisiatif=cek_nilai($data_nilai['inisiatif']);
$nilai_kerajinan=cek_nilai($data_nilai['kerajinan']);
$nilai_tanggungjawab=cek_nilai($data_nilai['tanggungjawab']);
$nilai_sikap=cek_nilai($data_nilai['sikap']);
$nilai_prestasi=cek_nilai($data_nilai['prestasi']);

$jumlah_nilai= $data_nilai['disiplin']+$data_nilai['kerjasama']+$data_nilai['inisiatif']+$data_nilai['kerajinan']+$data_nilai['tanggungjawab']+$data_nilai['sikap']+$data_nilai['prestasi'];
$rata_nilai=round($jumlah_nilai/7,2);
$bobot_rata=cek_nilai($rata_nilai);
 
?>

 <input type="button" value="Cetak" class="btn btn-primary" onclick="cetak('print_area');" style="padding:6px;margin-left:5px;width:100px;" />
 
<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;width:100%;"></iframe>

<div id="print_area" style="width:100%;">  
<style>
.print * {
  transition: none !important;  
   -webkit-print-color-adjust: exact; 
}
*{font-family:Cambria !important;}
</style>
<div class="print"> 



<div style="width:95%;margin:20px auto;padding:20px;font-family:Cambria;font-size:15px;box-shadow:2px 2px 5px #000;font-family:'Times New Roman' !important;text-align:center !important;font-size:18px !important;border:1px solid #CCC;background-color:#FFF;">
	
  
     <center><img src="logo2.png" style="width:100px;height:100px;"/></center>
     
     <h1 style="text-align:center;font-size:22px;font-family:Calibri;font-weight:bold;color:#333;margin-top:10px;font-weight:bolder;">PDAM TIRTA MUSI PALEMBANG</h1>
     
     <h1 style="text-align:center;font-size:30px;font-family:Arial;font-weight:bold;color:#03C;">SERTIFIKAT</h1>
     <p style="text-align:center;font-weight:bold;font-size:17px;">Nomor : <?=$data_nilai['no_sertifikat']?></p>
	
    
    
	 <p style="text-align:center;font-size:20px;font-stretch: extra-expanded;font-family:'Monotype Corsiva', 'Bradley Hand ITC' !important;margin:20px 0 ;">Diberikan Kepada:</p>
     
     <h1 style="text-align:center;font-weight:bold;font-family:'Monotype Corsiva', 'Bradley Hand ITC' !important;margin:0;"><?=$data['nama']?></h1>
     <hr style="border:1px solid #777; width:500px;margin:5px auto;" />
     <p style="text-transform:uppercase;font-family:Arial;font-weight:bold;"><?=$data['kampus']?></p>
     
     <p style="margin-bottom:0;font-size:17px;">Telah Mengikuti Praktek Kerja Lapangan / Magang Pada Perusahaan Daerah Air Minum Tirta Musi Palembang<br />
     	 	Pada Tanggal <?=tanggal($data['tgl_mulai'])." s.d. ".tanggal($data['tgl_selesai'])?>
      </p>
     
     <p style="margin-bottom:0;font-size:17px;">Demikianlah untuk dimaklumi dan dapat dipergunakan sebagaimana mestinya.</p>

	
    <table style="width:100%;">
    <tr>
    	<td></td>
        <td>
        	<table style="width:300px;float:right;">
            <tr>
                <td style="font-size:14px;text-align:center;">
                    Palembang, <?=tanggal($data_nilai['tgl_sertifikat'])?>
                    <br />
                    a.n. Direksi PDAM Tirta Musi Palembang 
                    <br />
                    Direktur Umum & Keuangan
                    <br />
                    
                    <img src="foto/mahasiswa/<?=$data['id_mahasiswa']?>.jpg" style="width:80px;height:80px;position:absolute;margin:10px 0 0 -130px !important;" />
                    
                    <br /><br />
                    <img src="img/ttd.png?val=2" style="width:100px;" />
                    <br />
                    Hardi, S.T.
                                
                    
                    
                </td>
            </tr>
            </table>
        </td>
    </tr>
    </table>
  </div>








<div style="width:95%;margin:20px auto;padding:20px;font-family:Cambria;font-size:15px;box-shadow:2px 2px 5px #000;font-family:'Times New Roman' !important;text-align:center !important;font-size:18px !important;border:1px solid #CCC;background-color:#FFF;">
	
     <p style="text-align:center;font-weight:bold;font-size:17px;">DAFTAR NILAI PENGALAMAN KERJA LAPANGAN <br /> LOKASI : PDAM TIRTA MUSI PALEMBANG</p>
     
     <table class="tabel_nilai" style="width:95%;">
     	<tr><th style="text-align:center;">NO.</th><th>KOMPONEN PENILAIAN</th><th style="width:150px;text-align:center;">NILAI</th><th style="width:200px;text-align:center;">PREDIKAT</th><th style="width:200px;text-align:center;">KETERANGN</th></tr>
        
        <tr><td style="width:50px;text-align:center;">1. &nbsp; </td><td>Disiplin</td><td style="text-align:center;"><?=$data_nilai['disiplin']?></td><td style="text-align:center;"><?=$nilai_disiplin[0]?></td><td style="text-align:center;"><?=$nilai_disiplin[1]?></td></tr>
        <tr><td style="text-align:center;">2. &nbsp; </td><td>Kerjasama</td><td style="text-align:center;"><?=$data_nilai['kerjasama']?></td><td style="text-align:center;"><?=$nilai_kerjasama[0]?></td><td style="text-align:center;"><?=$nilai_kerjasama[1]?></td></tr>
        <tr><td style="text-align:center;">3. &nbsp; </td><td>Inisiatif</td><td style="text-align:center;"><?=$data_nilai['inisiatif']?></td><td style="text-align:center;"><?=$nilai_inisiatif[0]?></td><td style="text-align:center;"><?=$nilai_inisiatif[1]?></td></tr>
        <tr><td style="text-align:center;">4. &nbsp; </td><td>Kerajinan</td><td style="text-align:center;"><?=$data_nilai['kerajinan']?></td><td style="text-align:center;"><?=$nilai_kerajinan[0]?></td><td style="text-align:center;"><?=$nilai_kerajinan[1]?></td></tr>
        <tr><td style="text-align:center;">5. &nbsp; </td><td>Tanggung Jawab</td><td style="text-align:center;"><?=$data_nilai['tanggungjawab']?></td><td style="text-align:center;"><?=$nilai_tanggungjawab[0]?></td><td style="text-align:center;"><?=$nilai_tanggungjawab[1]?></td></tr>
        <tr><td style="text-align:center;">6. &nbsp; </td><td>Sikap</td><td style="text-align:center;"><?=$data_nilai['sikap']?></td><td style="text-align:center;"><?=$nilai_sikap[0]?></td><td style="text-align:center;"><?=$nilai_sikap[1]?></td></tr>
        <tr><td style="text-align:center;">7. &nbsp; </td><td>Prestasi</td><td style="text-align:center;"><?=$data_nilai['prestasi']?></td><td style="text-align:center;"><?=$nilai_prestasi[0]?></td><td style="text-align:center;"><?=$nilai_prestasi[1]?></td></tr>
        <tr><td style="text-align:center;"> </td><td>Jumlah</td><td style="text-align:center;"><?=$jumlah_nilai?></td><td style="text-align:center;"></td><td style="text-align:center;"></td></tr>
        <tr><td style="text-align:center;"> </td><td>Rata-rata</td><td style="text-align:center;"><?=$rata_nilai?></td><td style="text-align:center;"><?=$bobot_rata[0]?></td><td style="text-align:center;"><?=$bobot_rata[1]?></td></tr>
        
     </table>
	
    
    <br />
    
    <p style="text-align:left;"><b style="font-size:14px;text-align:left;">KETERANGAN NILAI</b></p>
    <table class="tabel_bobot">
    	<tr><td>A</td><td>=</td><td>8.5 - 10</td><td>=</td><td>Baik Sekali</td></tr>
    	<tr><td>B</td><td>=</td><td>7.5 - 8.4</td><td>=</td><td>Baik </td></tr>
    	<tr><td>C</td><td>=</td><td>5.5 - 7.4</td><td>=</td><td>Cukup</td></tr>
    	<tr><td>D</td><td>=</td><td>3.5 - 5.4</td><td>=</td><td>Kurang</td></tr>
    	<tr><td>E</td><td>=</td><td>1.0 - 3.4</td><td>=</td><td>Kurang Sekali</td></tr>
    </table>
    
	  

	
     <style>
	 .tabel_nilai th{background-color:#09C;padding:7px;border:1px solid #555;font-size:15px;}
	 .tabel_nilai td{padding:7px;border:1px solid #555;font-size:15px;}
	 .tabel_bobot td{padding:2px 5px;}
	 </style>
     
  </div>

 
</div>
</div>
