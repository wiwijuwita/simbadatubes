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
		
		<form action="nasabah_tambah_aksi.php" method=post>
			<p align=center>
			<table border=0>
				<tr>
					<td><b>No KTP</b></td>
					<td><input type="text" name="NO_KTP" required></td>
				</tr>
				<tr>
					<td><b>Nama Nasabah</b></td>
					<td><input type="text" name="NAMA" required></td>
				</tr>
				<tr>
					<td><b>Tanggal Lahir (yyyy-mm-dd)</b></td>
					<td><input type="date" name="TGL_LAHIR" required></td>
				</tr>
				<tr>
					<td><b>Pekerjaan</b></td>
					<td><input type="text" name="PEKERJAAN" required></td>
				</tr>
				<tr>
					<td><b>Jenis Kelamin</b></td>
					<td>
						<input type="radio" name="JENIS_KELAMIN" value="L" required>Laki-laki
						<input type="radio" name="JENIS_KELAMIN" value="P" required>Perempuan
					</td>
				</tr>
				<tr>
					<td><b>No Telepon Nasabah</b></td>
					<td><input type="text" name="NO_TELP_N" required></td>
				</tr>
				<tr>
					<td><b>Alamat Nasabah</b></td>
				</tr>
				<tr>
					<td>Nama Jalan</td>
					<td><input type="text" name="NAMA_JLN_N" required></td>
				</tr>
				<tr>
					<td>No Jalan</td>
					<td><input type="text" name="NO_JLN_N" required></td>
				</tr>
				<tr>
					<td>Kota</td>
					<td><input type="text" name="KOTA_NASABAH" required></td>
				</tr>	
				<tr>
					<th colspan=2><input type="submit" value="Tambah">  <input type="reset" value="Ulangi">
				</tr>
			</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
