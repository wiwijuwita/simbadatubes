<?php
	session_start();
	include 'koneksi.php';
	if(!isset ($_POST['jenis'])){
		$_POST['jenis'] = '0';
	}
	
	$jenis = $_POST['jenis'];
	
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>DATA BARANG PEGADAIAN</p></h3>

		<p align=center>
		<a href="barang_tambah1.php"><input type="submit" value="Tambahkan Barang Baru"></a>
		<br/>
		<br/>
		<b>Pilih dahulu Jenis Barang:</b>
		<form action=barang.php method=post>
		<p align=center>
		<select name="jenis">
			<option value="0">Pilih jenis...</option>
			<option value="1">Emas</option>
			<option value="2">Elektronik</option>
			<option value="3">Kendaraan</option>
		</select>
		<br/>
		<input type="submit" value="Tampilkan">		
		</p>
		</form>
		
		<?php if($jenis=="1"){ ?>
		<p align=center>
		<table border=1>
			<tr>
				<th>Kode Barang</th>
				<th>Karat</th>
				<th>Berat</th>
				<th>Harga Taksir Emas</th>
			</tr>
			
			<?php
				$sql_barang = mysql_query("select * from barang where KODE_BARANG in (select KODE_BARANG from barang where substr(KODE_BARANG,1,1)='E')");
				while($data=mysql_fetch_array($sql_barang)){
				echo "<tr>";
					echo "<td>$data[KODE_BARANG]</td>";
					echo "<td>$data[KARAT]</td>";
					echo "<td>$data[BERAT] gram</td>";
					echo "<td>Rp. $data[HARGA_TAKSIR]</td>";
				echo "</tr>";
			}
		echo "</table>";
		}
		
		else if($jenis=="2"){ ?>
		<table border=1>
			<tr>
				<th>Kode Barang</th>
				<th>Nama Barang Elektronik</th>
				<th>Merk</th>
				<th>Nomor Seri</th>
				<th>Warna</th>
				<th>Berat</th>
				<th>Harga Taksir Elektronik</th>
			</tr>
			
			<?php
				$sql_barang = mysql_query("select * from barang where KODE_BARANG in (select KODE_BARANG from barang where substr(KODE_BARANG,1,1)='L')");
				while($data=mysql_fetch_array($sql_barang)){
				echo "<tr>";
					echo "<td>$data[KODE_BARANG]</td>";
					echo "<td>$data[NAMA_BARANG]</td>";
					echo "<td>$data[MERK]</td>";
					echo "<td>$data[NO_SERI]</td>";
					echo "<td>$data[WARNA]</td>";
					echo "<td>$data[BERAT] gram</td>";
					echo "<td>Rp. $data[HARGA_TAKSIR]</td>";
				echo "</tr>";
			}
			?>
		</table>
		<?php 
			}
		
		else if($jenis=="3"){ ?>
		<table border=1>
			<tr>
				<th>Kode Barang</th>
				<th>Nomor Polisi</th>
				<th>Nama Kendaraan</th>
				<th>Merk</th>
				<th>Warna</th>
				<th>Berat</th>
				<th>Harga Taksir Kendaraan</th>
			</tr>
			
			<?php
				$sql_barang = mysql_query("select * from barang where KODE_BARANG in (select KODE_BARANG from barang where substr(KODE_BARANG,1,1)='K')");
				while($data=mysql_fetch_array($sql_barang)){
				echo "<tr>";
					echo "<td>$data[KODE_BARANG]</td>";
					echo "<td>$data[NO_POLISI]</td>";
					echo "<td>$data[NAMA_BARANG]</td>";
					echo "<td>$data[MERK]</td>";
					echo "<td>$data[WARNA]</td>";
					echo "<td>$data[BERAT] ton</td>";
					echo "<td>Rp. $data[HARGA_TAKSIR]</td>";
				echo "</tr>";
			}
			?>
		</table>
		<?php } ?>
		
		
		<a href="login.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
