<?php
	session_start();
	include 'koneksi.php';
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>MENAMBAHKAN DATA JASA PEGADAIAN</h3>	
		<form action="jasa_tambah_aksi.php" method=post>
			<p align=center>
			<table border=0>
				<tr>
					<td>Kode Jasa</td>
					<td>: <input type="text" name="KODE_JASA" required></td>
				</tr>
				<tr>
					<td>Nama Jasa</td>
					<td>: <input type="text" name="NAMA_JASA" required></td>
				</tr>
				<tr>
					<td>Bunga Perbulan (%)</td>
					<td>: <input type="text" name="BUNGA" required></td>
				</tr>	
				<tr>
					<th colspan=2><input type="submit" value="Tambahkan">  <input type="reset" value="Ulangi">
				</tr>
			</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
