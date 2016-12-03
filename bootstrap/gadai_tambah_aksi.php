<?php
	session_start();
	include 'koneksi.php';
	
	$KODE_GADAI 	= $_POST['KODE_GADAI'];
	$KODE_BARANG	= $_POST['KODE_BARANG'];
	$KODE_JASA		= $_POST['KODE_JASA'];
	$NO_KTP			= $_POST['NO_KTP'];
	$KODE_PEGAWAI	= $_SESSION['kode_pegawai'];
	$LAMA_GADAI		= $_POST['LAMA_GADAI'];
	$HARGA_GADAI	= $_POST['HARGA_GADAI'];
	$STATUS			= $_POST['STATUS'];
	
	$gadai_tambah = "insert into GADAI values('$KODE_GADAI', '$KODE_BARANG', '$KODE_JASA', '$NO_KTP', '$KODE_PEGAWAI', null, '$HARGA_GADAI', '$LAMA_GADAI', '$STATUS')";
	$sql_gadai_tambah = mysql_query($gadai_tambah);
	
	if($sql_gadai_tambah){
		echo "Penambahan Data Transaksi Gadai Sukses";
		header('location:gadai.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>