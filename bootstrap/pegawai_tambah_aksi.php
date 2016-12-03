<?php
	session_start();
	include 'koneksi.php';

	$KODE_PEGAWAI		= $_POST['KODE_PEGAWAI'];
	$KODE_CABANG		= $_POST['KODE_CABANG'];
	$NAMA_PEGAWAI		= $_POST['NAMA_PEGAWAI'];
	$JABATAN			= $_POST['JABATAN'];
	$PASSWORD			= $_POST['PASSWORD'];
	
	$sql_pegawai_tambah = mysql_query("insert into PEGAWAI values ('$KODE_PEGAWAI','$KODE_CABANG','$NAMA_PEGAWAI', '$JABATAN','$PASSWORD')");
	
	if($sql_pegawai_tambah){
		echo "Penambahan Pegawai Sukses";
		header('location:pegawai.php');
	}
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
</html>
