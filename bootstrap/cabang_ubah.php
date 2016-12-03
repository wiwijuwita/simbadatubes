<?php
	session_start();
	include 'koneksi.php';
	$KODE_CABANG = $_GET['cabang'];
	$cabang = mysql_query("select * from CABANG where KODE_CABANG = '$KODE_CABANG'");
	$data = mysql_fetch_array($cabang);
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>MENGUBAH DATA CABANG PEGADAIAN</h3>	
		<form action="cabang_ubah_aksi.php" method=post>
			<p align=center>
			<table border=0>
				<tr>
					<td><b>Kode Cabang</b></td>
					<td><input type="text" name="KODE_CABANG" value="<?php echo $data['KODE_CABANG']?>"  readonly="readonly"/></td>
				</tr>
				<tr>
					<td><b>Nama Cabang</b></td>
					<td><input type="text" name="NAMA_CABANG" value="<?php echo $data['NAMA_CABANG']?>" required></td>
				</tr>
				<tr>
					<td><b>No Telepon Cabang</b></td>
					<td><input type="text" name="NO_TELP_C"  value="<?php echo $data['NO_TELP_C']?>" required></td>
				</tr>
				<tr>
					<td><b>Alamat Cabang</b></td>
				</tr>
				<tr>
					<td>Nama Jalan</td>
					<td><input type="text" name="NAMA_JLN_C" value="<?php echo $data['NAMA_JLN_C']?>" required></td>
				</tr>
				<tr>
					<td>No Jalan</td>
					<td><input type="text" name="NO_JLN_C" value="<?php echo $data['NO_JLN_C']?>" required></td>
				</tr>
				<tr>
					<td>Kota</td>
					<td><input type="text" name="KOTA_CABANG" value="<?php echo $data['KOTA_CABANG']?>" required></td>
				</tr>	
				<tr>
					<th colspan=2><input type="submit" value="Ubah">  <input type="reset" value="Ulangi">
				</tr>
			</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
