<?php
	session_start();
	include 'koneksi.php';

	$sql_nasabah = mysql_query("select * from nasabah ");
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>DATA NASABAH PEGADAIAN</h3>	
		<p align=center>
		<a href="nasabah_tambah.php"><input type="submit" value="Tambahkan Nasabah Baru"></a>
		<p align=center>
		<table border=1>
			<tr>
				<th rowspan=2>No KTP</th>
				<th rowspan=2>Nama Nasabah</th>
				<th rowspan=2>Tanggal Lahir</th>
				<th rowspan=2>Pekerjaan</th>
				<th rowspan=2>Jenis Kelamin</th>
				<th rowspan=2>No Telepon Nasabah</th>
				<th colspan=3>Alamat Nasabah</th>
				<th rowspan=2>Aksi</th>
			</tr>
			<tr>
				<th>Nama Jalan</th>
				<th>No Jalan</th>
				<th>Kota</th>
			</tr>

			<?php while($data=mysql_fetch_array($sql_nasabah)){
				echo "<tr>";
					echo "<td>$data[NO_KTP]</td>";
					echo "<td>$data[NAMA]</td>";
					echo "<td>$data[TGL_LAHIR]</td>";
					echo "<td>$data[PEKERJAAN]</td>";
					echo "<td>$data[JENIS_KELAMIN]</td>";
					echo "<td>$data[NO_TELP_N]</td>";
					echo "<td>$data[NAMA_JLN_N]</td>";
					echo "<td>$data[NO_JLN_N]</td>";
					echo "<td>$data[KOTA_NASABAH]</td>";
					echo "<th><a href=nasabah_ubah.php?nasabah=$data[NO_KTP]><img src='edit.png'></a>  <a href=nasabah_hapus.php?nasabah=$data[NO_KTP]><img src='delete.png'></a></th>";
				echo "</tr>";
			}
			?>
			
			
		</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
