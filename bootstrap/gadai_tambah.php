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
		<h3><p align=center>DATA TRANSAKSI PEGADAIAN</h3>
		<form action=gadai_tambah_aksi.php method=post>
		<table border=1>
			<tr>
				<th>Kode Gadai</th>
				<td><input type="text" name="KODE_GADAI" required></td>
			</tr>
			<tr>
				<th>Kode Barang</th>
				<td><input type="text" name="KODE_BARANG" required></td>
			</tr>
			<tr>
				<th>Kode Jasa</th>
				<td>
					<select name="KODE_JASA">
					<option value="0">Pilih jasa...</option>
					
				<?php
					$sql_jasa = mysql_query("select * from jasa");
					while($show = mysql_fetch_array($sql_jasa)){
				?>
					<option value="<?php echo $show['KODE_JASA']; ?>"><?php echo $show['NAMA_JASA']; ?></option>
				<?php
					}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<th>No KTP</th>
				<td>
					<select name="NO_KTP">
					<option value="0">Pilih No KTP...</option>
					
				<?php
					$sql_NO_KTP = mysql_query("select * from NASABAH");
					while($show = mysql_fetch_array($sql_NO_KTP)){
				?>
					<option value="<?php echo $show['NO_KTP']; ?>"><?php echo $show['NO_KTP']; ?></option>
				<?php
					}
				?>
				</select>
				</td>
			</tr>
			
			<tr><input type="hidden" name="KODE_PEGAWAI value='<?php echo $_SESSION['kode_pegawai']; ?>'">
				<th>Harga Gadai (Rp.)</th>
				<td><input type="text" name="HARGA_GADAI" required></td>
			</tr>
			<tr>
				<th>Lama Gadai (Bulan)</th>
				<td><input type="text" name="LAMA_GADAI" required></td>
			</tr>
			<tr>
				<th>Status</th>
				<td><input type="radio" name="STATUS" value="Aktif" checked >Aktif
				<input type="radio" name="STATUS" value="Lunas" >Lunas</td>
			</tr>
			<tr>
				<th colspan=2>
					<input type="submit" value="Tambahkan">  
					<input type="reset" value="Ulangi">
				</th>
		</table>
		<a href="gadai.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
