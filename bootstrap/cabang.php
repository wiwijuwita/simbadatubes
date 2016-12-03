<?php
	session_start();
	include 'koneksi.php';

	$sql_cabang = mysql_query("select * from cabang ");
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>DATA CABANG PEGADAIAN</h3>	
		
		<p align=center>
		<a href="cabang_tambah.php"><input type="submit"value="Tambahkan Cabang Baru"></a>
		<p align=center>
		<table border=1>
			<tr>
				<th rowspan=2>Kode Cabang</th>
				<th rowspan=2>Nama Cabang</th>
				<th colspan=3>Alamat Cabang</th>
				<th rowspan=2>No Telepon Cabang</th>
				<th rowspan=2>Aksi</th>
			</tr>
			<tr>
				<th>Nama Jalan</th>
				<th>No Jalan</th>
				<th>Kota</th>
			</tr>

			<?php while($data=mysql_fetch_array($sql_cabang)){
				echo "<tr>";
					echo "<td>$data[KODE_CABANG]</td>";
					echo "<td>$data[NAMA_CABANG]</td>";
					echo "<td>$data[NAMA_JLN_C]</td>";
					echo "<td>$data[NO_JLN_C]</td>";
					echo "<td>$data[KOTA_CABANG]</td>";
					echo "<td>$data[NO_TELP_C]</td>";
					echo "<th><a href=cabang_ubah.php?cabang=$data[KODE_CABANG]><img src='edit.png'></a>  <a href=cabang_hapus.php?cabang=$data[KODE_CABANG]><img src='delete.png'></a></th>";
				echo "</tr>";
			}
			?>
			
			
		</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
