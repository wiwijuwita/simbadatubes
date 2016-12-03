<?php
	session_start();
	include 'koneksi.php';
	
	$NO_KTP 		= $_POST['NO_KTP'];
	$NAMA		 	= $_POST['NAMA'];
	$TGL_LAHIR	 	= $_POST['TGL_LAHIR'];
	$PEKERJAAN	 	= $_POST['PEKERJAAN'];
	$JENIS_KELAMIN 	= $_POST['JENIS_KELAMIN'];
	$NO_TELP_N 		= $_POST['NO_TELP_N'];
	$NAMA_JLN_N 	= $_POST['NAMA_JLN_N'];
	$NO_JLN_N 		= $_POST['NO_JLN_N'];
	$KOTA_NASABAH 	= $_POST['KOTA_NASABAH'];
	
	$nasabah_tambah = "insert into NASABAH(NO_KTP, NAMA, TGL_LAHIR, PEKERJAAN, JENIS_KELAMIN, NO_TELP_N, NAMA_JLN_N, NO_JLN_N, KOTA_NASABAH) value('$NO_KTP', '$NAMA', '$TGL_LAHIR', '$PEKERJAAN', '$JENIS_KELAMIN', '$NO_TELP_N', '$NAMA_JLN_N', '$NO_JLN_N', '$KOTA_NASABAH')";
	$sql_nasabah_tambah = mysql_query($nasabah_tambah);
	
	if($sql_nasabah_tambah){
		echo "Penambahan Nasabah Sukses";
		header('location:nasabah.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>