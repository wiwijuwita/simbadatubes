<?php
	$nk=$_GET['id_no_keberangkatan'];
	$jmltiket=$_GET['jml'];
	$mulai=1;
?>
<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">

<title>Pemesanan Tiket Kereta</title>

<h2><p align="center">Sistem Pemesanan Tiket Kereta Api-apian Online</h2>
<br>
<h3><p align="center">Pemesanan Tiket Kereta</h3>



<form action="tiket.php" method="POST">
<input type="hidden" name="nk" value="<?php echo $nk; ?>" />
<input type="hidden" name="jmltiket" value="<?php echo $jmltiket; ?>" />
<div class='row'>
	<div class='col-md-4'></div>
	<div class='col-md-4'>
		<table width="400" border="1" class='table table-inline table-bordered'>
			<?php
				while($mulai<=$jmltiket){
					
			?>
		  <tr>
			<td width="150">Nama #<?php echo $mulai;?></td>
			<td width="200"><input type="text" name="nama[]" class='form-control' size=40 required="required"></td>
		  </tr>
		  <tr>
			<td>No.KTP #<?php echo $mulai;?></td>
			<td><input type="text" name="id[]" maxlength="16" class='form-control' size=40 required="required" ></td>
		  </tr>
		  <tr>
			<td>Kontak #<?php echo $mulai;?></td>
			<td><input type="text" name="kontak[]" maxlength="12" class='form-control'  size=40 required="required"></td>
		  </tr>
		  <tr><?php
			$mulai++;
			}
		  ?>
			<td>Kelas</td>
			<td><select name="kelas" class='form-control'>
			<?php
						include 'koneksi.php';
						
						$nk = $_GET['id_no_keberangkatan'];
						$query2="select gerbong.kelas from gerbong,kereta,no_keberangkatan where kereta.id_kereta=no_keberangkatan.id_kereta and gerbong.id_kereta=kereta.id_kereta and no_keberangkatan.id_no_keberangkatan='$nk'";
						$sql = ociparse($koneksi, $query2);
						ociexecute($sql);
						
						while (ocifetch($sql)) {
							echo "<option>".ociresult($sql, 1)."</option>";
						}
					?>
		  </select></td>
		  </tr>
			<td></td>
			<td><input type="submit" value='Pesan' class='btn btn-primary'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="reset" value='Ulangi' class='btn btn-danger'>           </td>
		  </tr>
		</table>
	</div>
	<div class='col-md-4'></div>
</div>
</form>

