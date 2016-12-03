<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">

<?php
include "koneksi.php";
$via=$_POST['media'];
$total=$_POST['total'];
$kelas=$_POST['kelas'];
$maubayar="select penumpang.nama,penumpang.no_ktp,penumpang.kontak,tiket.id_no_keberangkatan,tiket.id_kursi,tiket.id_tiket from tiket,penumpang where tiket.no_ktp=penumpang.no_ktp and tiket.status='Belum Bayar'";
$hasil=oci_parse($koneksi,$maubayar);
oci_execute($hasil);

$charge="select id_pembayaran,charge from pembayaran where nama='$via'";
$hcharge=oci_parse($koneksi,$charge);
oci_execute($hcharge);
oci_fetch($hcharge);

$tax=oci_result($hcharge,2);
$idp=oci_result($hcharge,1);

?>
<title>Pemesanan Tiket Kereta</title>

<h2><p align="center">Sistem Pemesanan Tiket Kereta Api-apian Online</h2>
<br>
<h3><p align="center">Pemesanan Tiket Kereta</h3>

<h4><p align="center">Data anda telah berhasil di simpan dengan status <i>Sudah Bayar</i></h4>


<div class='row'>
	<div class='col-md-4'></div>
	<div class='col-md-4'>
		<table class='table table-inline'>
		
		<?php
			while(oci_fetch($hasil)){ 
			$idtiket=oci_result($hasil,6);

			//proses ganti status
			$bayar="insert into bayar values(seq_bayar.nextval,'$idp','$idtiket',sysdate)";
			$hb=oci_parse($koneksi,$bayar);
			oci_execute($hb);

?>

				
			  <tr>
				<td width="150px">Nama</td>
				<td>:</td>
				<td><?php echo oci_result($hasil,1); ;?></td>
			  </tr>
			  <tr>
				<td>No.KTP</td>
				<td>:</td>
				<td><?php echo oci_result($hasil,2);?></td>
			  </tr>
			  <tr>
				<td>No KA</td>
				<td>:</td>
				<td><?php echo $noka=oci_result($hasil,4)?></td>
			  </tr>
			  <tr>
				<td>Kelas / No Kursi</td>
				<td>:</td>
				
				<td><?php echo $kelas; echo " / "; echo oci_result($hasil,5);?></td>
			  </tr>
			  
			  <?php
			  $jadwal="select jadwal.* from jadwal,no_keberangkatan where jadwal.id_jadwal=no_keberangkatan.id_jadwal and no_keberangkatan.id_no_keberangkatan='$noka'";
			  $hjadwal=oci_parse($koneksi,$jadwal);
			  oci_execute($hjadwal);
			  oci_fetch($hjadwal);
			  
				$stbr=oci_result($hjadwal,2);
				$sttb=oci_result($hjadwal,3);
				$wktbr=oci_result($hjadwal,4);
				$wkttb=oci_result($hjadwal,5);
				
				$berangkat="select nama from stasiun where id_stasiun='$stbr'";
				$tiba="select nama from stasiun where id_stasiun='$sttb'";
				$hberangkat=oci_parse($koneksi,$berangkat);
				$htiba=oci_parse($koneksi,$tiba);
				oci_execute($hberangkat);
				oci_execute($htiba);
				oci_fetch($hberangkat);
				oci_fetch($htiba);
			  ?>
			  <tr>
				<td rowspan="2">Berangkat</td>
				<td>:</td>
				<td><?php echo oci_result($hberangkat,1);?></td>
			  </tr>
			  <tr>
				<td>:</td>
				<td><?php echo $wktbr;?></td>
			  </tr>
			  <tr>
				<td rowspan="2">Tiba</td>
				<td>:</td>
				<td><?php echo oci_result($htiba,1);?></td>
			  </tr>
			  <tr>
				<td>:</td>
				<td><?php echo $wkttb;?></td>
			  </tr>
			  <tr>
				<td>Harga Tiket </td>
				<td>:</td>
				<td><?php echo $total;?></td>
			  </tr>
			  <tr>
				<td>Harga pihak ketiga</td>
				<td>:</td>
				<td><?php echo $tax;?></td>
			  </tr>
			  <tr>
			  <td> </td>
			  <td> </td>
			  <td> </td>
			  </tr>
			  <?php }?>
			</table>
			<p align='center'><a href='index.php'><button class='btn btn-warning' value='Kembali'>Kembali</button></a></p>
		</div>
	<div class='col-md-4'></div>
</div>