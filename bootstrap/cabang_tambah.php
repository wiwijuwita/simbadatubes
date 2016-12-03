<?php
	session_start();
	include 'koneksi.php';
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>MENAMBAHKAN DATA CABANG PEGADAIAN</h3>	
		<form action="cabang_tambah_aksi.php" method=post>
			<p align=center>
			<table border=0>
				<tr>
					<td>Kode Cabang</td>
					<td><input type="text" name="KODE_CABANG" required></td>
				</tr>
				<tr>
					<td>Nama Cabang</td>
					<td><input type="text" name="NAMA_CABANG" required></td>
				</tr>
				<tr>
					<td>No Telepon Cabang</td>
					<td><input type="text" name="NO_TELP_C" required></td>
				</tr>
				<tr>
					<td>Alamat Cabang</td>
				</tr>
				<tr>
					<td>Nama Jalan</td>
					<td><input type="text" name="NAMA_JLN_C" required></td>
				</tr>
				<tr>
					<td>No Jalan</td>
					<td><input type="text" name="NO_JLN_C" required></td>
				</tr>
				<tr>
					<td>Kota</td>
					<td><input type="text" name="KOTA_CABANG" required></td>
				</tr>	
				<tr>
					<th colspan=2><input type="submit" value="Tambahkan">  <input type="reset" value="Ulangi">
				</tr>
			</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
