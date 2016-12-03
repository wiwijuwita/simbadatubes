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
	
	$nasabah_ubah = "update NASABAH set NAMA='$NAMA',
					TGL_LAHIR='$TGL_LAHIR',
					PEKERJAAN='$PEKERJAAN',
					JENIS_KELAMIN='$JENIS_KELAMIN',
					NO_TELP_N='$NO_TELP_N',
					NAMA_JLN_N='$NAMA_JLN_N', 	
					NO_JLN_N='$NO_JLN_N', 		
					KOTA_NASABAH='$KOTA_NASABAH'
					where NO_KTP='$NO_KTP'";
	$sql_nasabah_ubah = mysql_query($nasabah_ubah);
	
	if($sql_nasabah_ubah){
		echo "Pengubahan Nasabah Sukses";
		header('location:nasabah.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>