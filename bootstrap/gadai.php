<?php
	session_start();
	include 'koneksi.php';
	
	if(!isset($_POST['KODE_GADAI'])){
	$_POST['KODE_GADAI']	= "";
	$_POST['KODE_BARANG']= "";
	$_POST['KODE_JASA']	= "";
	$_POST['NO_KTP']		= "";
	$_POST['TGL_GADAI']	= "";
	$_POST['HARGA_GADAI']= "";
	$_POST['LAMA_GADAI']	= "";
	$_POST['STATUS']		= "";
	}
	
	$KODE_GADAI	= $_POST['KODE_GADAI'];
	$KODE_BARANG= $_POST['KODE_BARANG'];
	$KODE_JASA	= $_POST['KODE_JASA'];
	$NO_KTP		= $_POST['NO_KTP'];
	$TGL_GADAI	= $_POST['TGL_GADAI'];
	$HARGA_GADAI= $_POST['HARGA_GADAI'];
	$LAMA_GADAI	= $_POST['LAMA_GADAI'];
	$STATUS		= $_POST['STATUS'];
	
	$sql_gadai = mysql_query("select * from gadai where KODE_GADAI like '%$KODE_GADAI%' and
	KODE_BARANG like '%$KODE_BARANG%' and
	KODE_JASA like '%$KODE_JASA%' and
	NO_KTP like '%$NO_KTP%' and
	TGL_GADAI like '%$TGL_GADAI%' and
	HARGA_GADAI like '%$HARGA_GADAI%' and
	LAMA_GADAI like '%$LAMA_GADAI%' and
	STATUS like '%$STATUS%'
	");
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>DATA TRANSAKSI PEGADAIAN</h3>
		<p align=center>
		<a href="gadai_tambah.php"><input type="submit" value="Tambahkan Transaksi Gadai Baru"></a>	
		<form action="gadai.php" method=post>
		<p align=center>
		<table border=0>
			<tr>
				<th colspan=2>Cari Berdasarkan:</th>
			</tr>
			<tr>
				<td>Kode Gadai</td>
				<td>: <input type="text" name="KODE_GADAI"></td>
			</tr>
			<tr>
				<td>Kode Barang</td>
				<td>: <input type="text" name="KODE_BARANG">
			</tr>
			<tr>
				<td>Kode Jasa</td>
				<td>: <input type="text" name="KODE_JASA"></td>
			</tr>
			<tr>
				<td>No KTP</td>
				<td>: <input type="text" name="NO_KTP"></td>
			</tr>
			<tr>
				<td>Tanggal Gadai</td>
				<td>: <input type="text" name="TGL_GADAI"></td>
			</tr>
			<tr>
				<td>Harga Gadai</td>
				<td>: <input type="text" name="HARGA_GADAI"></td>
			</tr>
			<tr>
				<td>Lama Gadai</td>
				<td>: <input type="text" name="LAMA_GADAI"></td>
			</tr>
			<tr>
				<td>Status</td>
				<td>: <input type="text" name="STATUS"></td>
			</tr>
			<tr>
				<th colspan=2><input type="submit" value="Cari!"></th>
			</tr>
		</table>
		</form>
		<p align=center>
		<table border=1>
			<tr>
				<th>Kode Gadai</th>
				<th>Kode Barang</th>
				<th>Nama Jasa</th>
				<th>No KTP</th>
				<th>Kode Pegawai</th>
				<th>Tanggal Gadai</th>
				<th>Harga Gadai</th>
				<th>Lama Gadai (Bulan)</th>
				<th>Status</th>
			</tr>

			<?php while($data=mysql_fetch_array($sql_gadai)){
				echo "<tr>";
					echo "<td>$data[KODE_GADAI]</td>";
					echo "<td>$data[KODE_BARANG]</td>";
					echo "<td>$data[KODE_JASA]</td>";
					echo "<td>$data[NO_KTP]</td>";
					echo "<td>$data[KODE_PEGAWAI]</td>";
					echo "<td>$data[TGL_GADAI]</td>";
					echo "<td>$data[HARGA_GADAI]</td>";
					echo "<td>$data[LAMA_GADAI]</td>";
					echo "<td>$data[STATUS]</td>";
				echo "</tr>";
			}
			?>
			
			
		</table>
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
