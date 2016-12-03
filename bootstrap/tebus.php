<?php
	session_start();
	include 'koneksi.php';
	
	if(!isset($_POST['KODE_TEBUS'])){
	$_POST['KODE_TEBUS']= "";
	$_POST['KODE_GADAI']= "";
	$_POST['JUMLAH_TEBUS']= "";
	$_POST['TGL_TEBUS']= "";
	}
	
	$KODE_TEBUS	= $_POST['KODE_TEBUS'];
	$KODE_GADAI	= $_POST['KODE_GADAI'];
	$JUMLAH_TEBUS= $_POST['JUMLAH_TEBUS'];
	$TGL_TEBUS	= $_POST['TGL_TEBUS'];
	
	$sql_tebus = mysql_query("select * from tebus where KODE_TEBUS like '%$KODE_TEBUS%' and
	KODE_GADAI like '%$KODE_GADAI%' and
	JUMLAH_TEBUS like '%$JUMLAH_TEBUS%' and
	TGL_TEBUS like '%$TGL_TEBUS%'
	");
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>DATA TRANSAKSI PENEBUSAN</p></h3>	
		<p align=center>
		<a href="tebus_tambah.php"><input type="submit" value="Tambahkan Transaksi Tebus Baru"></a>
		<form action="tebus.php" method="post">
		<p align=center>
		<table border=0>
			<tr>
				<th colspan=2>Cari Berdasarkan:</th>
			</tr>
			<tr>
				<td>Kode Tebus</td>
				<td>: <input type="text" name="KODE_TEBUS"></td>
			</tr>
			<tr>
				<td>Kode Gadai</td>
				<td>: <input type="text" name="KODE_GADAI"></td>
			</tr>
			<tr>
				<td>Jumlah Tebus</td>
				<td>: <input type="text" name="JUMLAH_TEBUS"></td>
			</tr>
			<tr>
				<td>Tanggal Tebus</td>
				<td>: <input type="text" name="TGL_TEBUS"></td>
			</tr>
			<tr>
				<th colspan=2><input type="submit" value="Cari!"></th>
			</tr>
		</table>
		</form>
		
		<p align=center>
		<table border=1>
			<tr>
				<th>Kode Tebus</th>
				<th>Kode Gadai</th>
				<th>Kode Pegawai</th>
				<th>Jumlah Tebus</th>
				<th>Tanggal Tebus</th>
			</tr>

			<?php while($data=mysql_fetch_array($sql_tebus)){
				echo "<tr>";
					echo "<td>$data[KODE_TEBUS]</td>";
					echo "<td>$data[KODE_GADAI]</td>";
					echo "<td>$data[KODE_PEGAWAI]</td>";
					echo "<td>$data[JUMLAH_TEBUS]</td>";
					echo "<td>$data[TGL_TEBUS]</td>";
				echo "</tr>";
			}
			?>
			
			
		</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
