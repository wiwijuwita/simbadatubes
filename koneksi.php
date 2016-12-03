<?php
//membangung koneksi
$username="tmd";
$password="tmd";
$database="localhost";
$koneksi=oci_connect($username,$password,$database);
if(!$koneksi){
	$err=oci_error();
	echo "Gagal tersambung ke ORACLE".$err['text'];
}

?>