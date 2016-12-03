<?php
	session_start();
	include 'koneksi.php';
	
	$KODE_JASA  = $_POST['KODE_JASA'];
	$NAMA_JASA	= $_POST['NAMA_JASA'];
	$BUNGA   	= $_POST['BUNGA'];
	
	$sql_jasa = mysql_query("insert into JASA values ('$KODE_JASA','$NAMA_JASA','$BUNGA')");
	if($sql_jasa){
		echo "Penambahan Jasa Sukses";
		header('location:jasa.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>