<?php
	session_start();
	include 'koneksi.php';

	$sql_jasa = mysql_query("select * from jasa");
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>DATA JASA PEGADAIAN</h3>
		<p align=center>
		<a href="jasa_tambah.php"><input type="submit" value="Tambahkan Jasa Baru"></a>
		<p align=center>
		<table border=1>
			<tr>
				<th>Kode Jasa</th>
				<th>Nama Jasa</th>
				<th>Bunga Perbulan</th>
			</tr>

			<?php while($data=mysql_fetch_array($sql_jasa)){
				echo "<tr>";
					echo "<td>$data[KODE_JASA]</td>";
					echo "<td>$data[NAMA_JASA]</td>";
					echo "<td>$data[BUNGA] %</td>";
				echo "</tr>";
			}
			?>
			
			
		</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
