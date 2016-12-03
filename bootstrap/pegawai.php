<?php
	session_start();
	include 'koneksi.php';

	$sql_pegawai = mysql_query("select * from pegawai");
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>DATA PEGAWAI PEGADAIAN</h3>	
		<p align=center>
		<a href="pegawai_tambah.php"><input type="submit" value="Tambahkan Pegawai Baru"></a>
		<p align=center>
		<table border=1>
			<tr>
				<th>Kode Pegawai</th>
				<th>Kode Cabang</th>
				<th>Nama Pegawai</th>
				<th>Jabatan</th>
				<th>Password</th>
			</tr>

			<?php while($data=mysql_fetch_array($sql_pegawai)){
				echo "<tr>";
					echo "<td>$data[KODE_PEGAWAI]</td>";
					echo "<td>$data[KODE_CABANG]</td>";
					echo "<td>$data[NAMA_PEGAWAI]</td>";
					echo "<td>$data[JABATAN]</td>";
					echo "<td>$data[PASSWORD]</td>";
				echo "</tr>";
			}
			?>
			
			
		</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
