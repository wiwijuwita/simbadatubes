<?php
	session_start();
	include 'koneksi.php';

?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>MENAMBAH DATA PEGAWAI PEGADAIAN</h3>
		<form action=pegawai_tambah_aksi.php method=post>
		<p align=center>
		<table border=0>
			<tr>
				<td>Kode Pegawai :</td>
			</tr>
			<tr>
				<td><i>Format Kode Pegawai adalah 'Pxxxx' (x adalah angka, tanpa kutip)</i></td>
			</tr>
			<tr>
				<td><input type="text" name="KODE_PEGAWAI" required></td>
			</tr>
			<tr>
				<td>Kode Cabang :</td>
			</tr>
			<tr>
				<td><input type="text" name="KODE_CABANG" required></td>
			</tr>
			<tr>
				<td>Nama Pegawai :</td>
			</tr>
			<tr>
				<td><input type="text" name="NAMA_PEGAWAI" required></td>
			</tr>
			<tr>
				<td>Jabatan :</td>
			</tr>
			<tr>
				<td>
					<select name="JABATAN">
						<option value="admin">admin</option>
						<option value="kasir">kasir</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Password :</td>
			</tr>
			<tr>
				<td><input type="password" name="PASSWORD">
			</tr>
			<tr>
				<th><input type="submit" value="Tambahkan">   <input type="reset" value="Ulangi">
				</th>
			</tr>
		</table>
		</form>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
