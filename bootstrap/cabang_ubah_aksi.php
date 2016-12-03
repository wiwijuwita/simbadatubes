<?php
	session_start();
	include 'koneksi.php';
	
	$KODE_CABANG 	= $_POST['KODE_CABANG'];
	$NAMA_CABANG 	= $_POST['NAMA_CABANG'];
	$NO_TELP_C 		= $_POST['NO_TELP_C'];
	$NAMA_JLN_C 	= $_POST['NAMA_JLN_C'];
	$NO_JLN_C 		= $_POST['NO_JLN_C'];
	$KOTA_CABANG 	= $_POST['KOTA_CABANG'];
	
	$cabang_tambah = "update CABANG set NAMA_CABANG='$NAMA_CABANG',
					NO_TELP_C='$NO_TELP_C',
					NAMA_JLN_C='$NAMA_JLN_C',
					NO_JLN_C='$NO_JLN_C',
					KOTA_CABANG='$KOTA_CABANG'
					where KODE_CABANG='$KODE_CABANG'";
	$sql_cabang_tambah = mysql_query($cabang_tambah);
	
	if($sql_cabang_tambah){
		echo "Pengubahan Cabang Sukses";
		header('location:cabang.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>