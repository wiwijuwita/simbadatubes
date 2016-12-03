<?php
	session_start();
	include 'koneksi.php';
	
	if(!isset ($_POST['MERK'])){
		$_POST['MERK'] = '';
	}
	if(!isset ($_POST['WARNA'])){
		$_POST['WARNA'] = '';
	}
	if(!isset ($_POST['NO_POLISI'])){
		$_POST['NO_POLISI'] = '';
	}
	if(!isset ($_POST['NO_SERI'])){
		$_POST['NO_SERI'] = '';
	}
	if(!isset ($_POST['KARAT'])){
		$_POST['KARAT'] = '';
	}
	
	$KODE_BARANG 		= $_POST['KODE_BARANG'];	
	$NAMA_BARANG 		= $_POST['NAMA_BARANG'];	
	$MERK				= $_POST['MERK'];
	$WARNA				= $_POST['WARNA'];
	$NO_POLISI			= $_POST['NO_POLISI'];
	$NO_SERI			= $_POST['NO_SERI'];
	$KARAT				= $_POST['KARAT'];
	$BERAT				= $_POST['BERAT'];
	$HARGA_TAKSIR		= $_POST['HARGA_TAKSIR'];
	
	$sql_tambah_barang = mysql_query("insert into BARANG values
	('$KODE_BARANG','$NAMA_BARANG', '$MERK','$WARNA', '$NO_POLISI', '$NO_SERI', '$KARAT', '$BERAT', '$HARGA_TAKSIR')");
	
		if($sql_tambah_barang){
		echo "Penambahan Barang Sukses";
		header('location:barang.php');
		}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	
	
</html>
