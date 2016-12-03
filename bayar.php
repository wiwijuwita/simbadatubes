<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">

<?php
include "koneksi.php";
$total=$_POST['total'];
$kelas=$_POST['kelas'];
$maubayar="select penumpang.nama,penumpang.no_ktp,penumpang.kontak,tiket.id_tiket from tiket,penumpang where tiket.no_ktp=penumpang.no_ktp and tiket.status='Belum Bayar'";
$hasil=oci_parse($koneksi,$maubayar);
oci_execute($hasil);
$num_row = 1;
?>

<title>Pemesanan Tiket Kereta</title>

<h2><p align="center">Sistem Pemesanan Tiket Kereta Api-apian Online</h2>
<br>
<h3><p align="center">Pemesanan Tiket Kereta</h3>

<div class='row'>
	<div class='col-md-4'></div>
	<div class='col-md-4'>
		<table class='table table-inline'>
		<?php
			while(oci_fetch($hasil)){
		?>
		  <tr>
			<th colspan='3'>
				<p align='center'>Data Penumpang #<?php echo $num_row; ?>
			</th>
		  </tr>
		  <tr>
			<td width="200px">Nama</td>
			<td>:</td>
			<td><?php echo oci_result($hasil,1);?></td>
		  </tr>
		  <tr>
			<td width="150px">No KTP</td>
			<td>:</td>
			<td><?php echo oci_result($hasil,2);?></td>
		  </tr>
		  <tr>
			<td width="150px">Kontak</td>
			<td>:</td>
			<td><?php echo oci_result($hasil,3);?></td>
		  </tr>
			<tr>
			<?php 
			
			$num_row++;
			}
			
			?>
		  
			<form method="POST" action="p_bayar.php">
		  
		  <td width="150px">Akan Membayar Dengan </td>
		  <td>:</td>
		  <td width="150px" align="center"><select name="media" class='form-control'>
			  <option value="Stasiun">Stasiun</option>
			  <option value="Indomaret">Indomaret</option>
			  <option value="Alfamart">Alfamart</option>
			  <option value="BCA">BCA</option>
			  <option value="Mandiri">Mandiri</option>
			</select></td>
			</tr>
		  
		</table>
	<div class='col-md-4'></div>
<input type="hidden" name="total" value="<?php echo $total;?>" />
<input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
<input type="submit" class='btn btn-primary' value="Bayar Tiket" />
</form>
