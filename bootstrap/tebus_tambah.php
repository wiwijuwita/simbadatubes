<?php
	session_start();
	include 'koneksi.php';

	$sql_gadai = mysql_query("select * from gadai");
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3>DATA TRANSAKSI PEGADAIAN</h3>
		<form action=tebus_tambah_aksi.php method=post>
		<table border=0>
			<tr>
				<td colspan=2><b>Kode Tebus :</b></td>
			</tr>
			<tr>
				<td><i>Format Kode 'Txxxx' (x adalah angka, tanpa kutip)</i></td>
			</tr>
				<td><input type="text" name="KODE_TEBUS" required></td>
			</tr>
			<tr>
				<td><b>Kode Gadai :</b></td>
			</tr>
			<tr>
				<td>
					<select name="KODE_GADAI">
					<option value="0">Pilih Kode Gadai...</option>
					
				<?php
					$sql_gadai = mysql_query("select * from GADAI");
					while($show = mysql_fetch_array($sql_gadai)){
				?>
					<option value="<?php echo $show['KODE_GADAI']; ?>"><?php echo $show['KODE_GADAI']; ?></option>
				<?php
					}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<input type="hidden" name="KODE_PEGAWAI" value="<?php echo $_SESSION['kode_pegawai']; ?>" >
				<td><b>Jumlah Tebus (Rp.):</b></td>
			</tr>
			<tr>
				<td><input type="text" name="JUMLAH_TEBUS" required></td>
			</tr>
			<tr>
				<th colspan=2>
					<input type="submit" value="Tambahkan">  
					<input type="reset" value="Ulangi">
				</th>
		</table>
		<a href="tebus.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
