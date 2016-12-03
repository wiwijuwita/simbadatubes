<?php
	session_start();
	include 'koneksi.php';
	$KODE_CABANG = $_GET['cabang'];
	
	$sql_cabang_hapus = mysql_query("delete from CABANG where KODE_CABANG='$KODE_CABANG'");
	
	if($sql_cabang_hapus){
		echo "Penghapusan Cabang Sukses";
		header('location:cabang.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>