<?php
	session_start();
	include 'koneksi.php';
	$NO_KTP = $_GET['nasabah'];
	$nasabah = mysql_query("select * from NASABAH where NO_KTP = '$NO_KTP'");
	$data = mysql_fetch_array($nasabah);
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>MENGUBAH DATA NASABAH PEGADAIAN</h3>	
		<form action="nasabah_ubah_aksi.php" method=post>
			<p align=center>
			<table border=0>
				<tr>
					<td><b>No KTP</b></td>
					<td><input type="text" name="NO_KTP" value="<?php echo $data['NO_KTP']?>"  readonly="readonly"/></td>
				</tr>
				<tr>
					<td><b>Nama Nasabah</b></td>
					<td><input type="text" name="NAMA" value="<?php echo $data['NAMA']?>" required></td>
				</tr>
				<tr>
					<td><b>Tanggal Lahir (yyyy-mm-dd)</b></td>
					<td><input type="date" name="TGL_LAHIR" value="<?php echo $data['TGL_LAHIR']?>" required></td>
				</tr>
				<tr>
					<td><b>Pekerjaan</b></td>
					<td><input type="text" name="PEKERJAAN" value="<?php echo $data['PEKERJAAN']?>" required></td>
				</tr>
				<tr>
					<td><b>Jenis Kelamin</b></td>
					<td>
					<?php if ($data['JENIS_KELAMIN']=='L'){?>
					<input type="radio" name="JENIS_KELAMIN" value="L" checked required>Laki-laki <input type="radio" name="JENIS_KELAMIN" value="P" required>Perempuan
					<?php }else{?>
					<input type="radio" name="JENIS_KELAMIN" value="L" required>Laki-laki <input type="radio" name="JENIS_KELAMIN" value="P" checked required>Perempuan
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td><b>No Telepon Nasabah</b></td>
					<td><input type="text" name="NO_TELP_N"  value="<?php echo $data['NO_TELP_N']?>" required></td>
				</tr>
				<tr>
					<td><b>Alamat Nasabah</b></td>
				</tr>
				<tr>
					<td>Nama Jalan</td>
					<td><input type="text" name="NAMA_JLN_N" value="<?php echo $data['NAMA_JLN_N']?>" required></td>
				</tr>
				<tr>
					<td>No Jalan</td>
					<td><input type="text" name="NO_JLN_N" value="<?php echo $data['NO_JLN_N']?>" required></td>
				</tr>
				<tr>
					<td>Kota</td>
					<td><input type="text" name="KOTA_NASABAH" value="<?php echo $data['KOTA_NASABAH']?>" required></td>
				</tr>	
				<tr>
					<th colspan=2><input type="submit" value="Ubah">  <input type="reset" value="Ulangi">
				</tr>
			</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
