<?php
	session_start();
	include 'koneksi.php';
	$NO_KTP = $_GET['nasabah'];
	
	$nasabah_hapus = "delete from NASABAH where NO_KTP='$NO_KTP'";
	$sql_nasabah_hapus = mysql_query($nasabah_hapus);
	
	if($sql_nasabah_hapus){
		echo "Penghapusan Nasabah Sukses";
		header('location:nasabah.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>