
<?php
include "koneksi.php";
 


if($aksi=="set_absensi")
{
	if($_GET['dt_stat']=="Hadir")
	{
		mysqli_query($koneksi,"delete from absensi where id_magang='$kode' and tgl='$_GET[dt_tgl]'");	
	}
	else
	{
		mysqli_query($koneksi,"insert into absensi set id_magang='$kode', tgl='$_GET[dt_tgl]', status='Hadir'");	
	}
	//mysqli_query($koneksi,"delete from magang where id_magang='$kode'");	
	/*echo"<script>window.location='?halaman=$halaman'</script>";*/
}
 
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from magang left join mahasiswa on mahasiswa.id_mahasiswa=magang.id_mahasiswa where id_magang='$kode'"));


function getWeekdayDifference($startDate, $endDate)
{
   	$start = new DateTime($startDate);
	$end = new DateTime($endDate);
	// otherwise the  end date is excluded (bug?)
	$end->modify('+1 day');
	
	$interval = $end->diff($start);
	
	// total days
	$days = $interval->days;
	
	// create an iterateable period of date (P1D equates to 1 day)
	$period = new DatePeriod($start, new DateInterval('P1D'), $end);
	
	// best stored as array, so you can add more than one
	$holidays = array('2020-01-01');
	
	foreach($period as $dt) {
		$curr = $dt->format('D');
	
		// substract if Saturday or Sunday
		if ($curr == 'Sat' || $curr == 'Sun') {
			$days--;
		}
	
		// (optional) for the updated question
		elseif (in_array($dt->format('Y-m-d'), $holidays)) {
			$days--;
		}
	}

    return $days;
}

?>




<?php if($proses=="detail"){?>

<div style="width:100%;margin:20px auto;padding:20px;font-family:Cambria;font-size:15px;box-shadow:2px 2px 5px #000;background-color:#FFF;">

     <h2>Detail absensi Kerja Praktik</h2>
     
     
    
    <form class="form1" action="" method="post" enctype="multipart/form-data" >
      
        <div class="row">
        	<div class="col-sm-12" style="padding-right:50px;">
            	
            <?php
			$jlh_hadir=0;
				$jlh_tgl=0;
				$start = new DateTime($data['tgl_mulai']);
				$end = new DateTime($data['tgl_selesai']);
				// otherwise the  end date is excluded (bug?)
				$end->modify('+1 day');
				
				$interval = $end->diff($start);
				
				// total days
				$days = $interval->days;
				
				// create an iterateable period of date (P1D equates to 1 day)
				$period = new DatePeriod($start, new DateInterval('P1D'), $end);
				
				// best stored as array, so you can add more than one
				$holidays = array('2020-01-01');
				
				foreach($period as $dt) {
					$curr = $dt->format('D');
					$hari=hari_inggris($curr);
					$tgll=$dt->format('Y-m-d');
					 
					if ($curr == 'Sat' || $curr == 'Sun') {
						//$days--;
					}
					else
					{
						$jlh_tgl++;
						$set_stat="";
						$cek_kehadiran=mysqli_fetch_array(mysqli_query($koneksi,"select * from absensi where tgl='$tgll' and id_magang='$data[id_magang]'"));
						if($cek_kehadiran){$set_stat="Hadir";$jlh_hadir++;}
						
						else{$set_stat="Tidak Hadir";}
						echo"<div class='hari_absensi'><b style='color:#279;'>$hari</b> <br><b>".tanggal($tgll)."</b>
								<br>
								<input type='checkbox' style='width:30px;height:30px;' onclick=\"set_absensi('$kode','$tgll','$set_stat')\" "; if($set_stat=="Hadir"){echo" checked";} echo">
							 </div>";
					}
				 
				}
				
				if($jlh_hadir>0)
				{
					$persen_hadir=round($jlh_hadir/$jlh_tgl*100);
				}
				else
				{
					$persen_hadir=0;
				}
			?>
            
            
        	</div>
            
            <p style="padding:10px 0 0 15px;">&nbsp; <br />Kehadiran : <b><?=$jlh_hadir?></b> hari (<?=$persen_hadir?>%)</p>
            
        </div>
          
         <center>
         	<a href="?halaman=absensi"><input type="button"  value="Simpan" class="btn btn-primary" style="width: 120px;"></a>
         </center>
        
     
     
      
    
   
   
    </form>
  </div>

<?php  }  else { ?>


<div class="isi_conten" style="box-shadow:2px 2px 5px #000;background-color:#FFF;">

<p class="judul_conten" style="padding:10px 0;">Daftar absensi Kerja Praktik</p>
<div class="kelas_tabel">
<table class="table" cellspacing="0" width="100%">
<thead>
 <tr style="background-color:#F60;">
	<th style="width:30px;">No</th> 
	<th>Mahasiswa</th> 
	<th style='text-align:center;'>Tanggal Kerja Praktik</th> 
	<th style='text-align:center;'>Jumlah Hari</th> 
	<th style='text-align:center;'>Jumlah Kehadiran</th> 
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
	
	$data_kehadiran=mysqli_num_rows(mysqli_query($koneksi,"select * from absensi where id_magang='$data[id_magang]' group by tgl"));

	echo "<tr>
		  <td>$no</td> 
		  <td>$data[nama]<br>
				<b>($data[kampus])</b>
		  </td> 
		  <td style='text-align:center;'>".tanggal($data['tgl_mulai'])." - ".tanggal($data['tgl_selesai'])."</td> 
		  <td style='text-align:center;'>";
		  
			$jlh_tgl=getWeekdayDifference($data['tgl_mulai'],$data['tgl_selesai']);
			echo $jlh_tgl;
			
			if($data_kehadiran>0)
				{
					$persen_hadir=round($data_kehadiran/$jlh_tgl*100);
				}
				else
				{
					$persen_hadir=0;
				}
		  echo"
		  </td> 
		  <td style='text-align:center;'>$data_kehadiran hari ($persen_hadir %)</td> 
		  <td>
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
.table td,.table th{border:1px solid #CCC;}
.hari_absensi{border:1px solid #999;width:150px;height:90px;margin:0 5px 5px 0;float:left;text-align:center;}
</style>
 
 
 
<script>
function set_absensi(kode,tgll,stat)
{
	window.location="?halaman=<?=$halaman?>&kode="+kode+"&dt_tgl="+tgll+"&dt_stat="+stat+"&aksi=set_absensi&proses=detail";
}
</script>




 