<?php
	session_start();
	include 'koneksi.php';
	
	$KODE_TEBUS 	= $_POST['KODE_TEBUS'];
	$KODE_GADAI 	= $_POST['KODE_GADAI'];
	$KODE_PEGAWAI	= $_SESSION['kode_pegawai'];
	$JUMLAH_TEBUS	= $_POST['JUMLAH_TEBUS'];
	
	$tebus_tambah = "insert into TEBUS values('$KODE_TEBUS', '$KODE_PEGAWAI','$KODE_GADAI', '$JUMLAH_TEBUS', null)";
	$sql_tebus_tambah = mysql_query($tebus_tambah);
	
	$update=mysql_query("update GADAI set HARGA_GADAI=HARGA_GADAI-$JUMLAH_TEBUS where KODE_GADAI='$KODE_GADAI'");
	
	$cek=mysql_fetch_array(mysql_query("select HARGA_GADAI from GADAI where KODE_GADAI='$KODE_GADAI'"));
	
	//echo$cek;
	if($cek['HARGA_GADAI']<=0){
		$update=mysql_query("update GADAI set STATUS='Lunas' where KODE_GADAI='$KODE_GADAI'");
	}
	
	if($sql_tebus_tambah){
		echo "Penambahan Data Transaksi Tebus Sukses";
		header('location:tebus.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>