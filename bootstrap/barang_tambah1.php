<?php
	session_start();
	include 'koneksi.php';
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>MENAMBAHKAN DATA BARANG PEGADAIAN</p></h3>	
		<form action="barang_tambah2.php" method=post>
			<p align=center>
			<table border=0>
				<tr>
					<td><i>Pilih jenis barang terlebih dahulu</i></td>
				<tr>
					<th><b>Jenis Barang :</b></th>
				</tr>
				<tr>
					<th>
						<select name="jenis">
							<option value="0">Pilih jenis...</option>
							<option value="1">Emas</option>
							<option value="2">Elektronik</option>
							<option value="3">Kendaraan</option>
						</select>
						<br/>
					</th>
				<tr>
					<th><input type="submit" value="Lanjutkan">  <input type="reset" value="Ulangi"></th>
				</tr>
			</table>
			</p>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
