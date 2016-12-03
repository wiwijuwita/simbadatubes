<?php
	session_start();
	include 'koneksi.php';
	$jenis 			= $_POST['jenis'];
	
?>
<html>
	<header>
		<title>PASSION (Pegadaian Application Support System Integrated Online)</title>
	</header>
	<body>
		<h3><p align=center>MENAMBAHKAN DATA BARANG PEGADAIAN</p></h3>

		<form action=barang_tambah_aksi.php method=post>
		<input type="hidden" name="jenis" value="<?php echo $jenis; ?>">
		<p align=center>
		<table border=0>
		<?php
		if($jenis=="1"){ ?>
			<tr>
				<td colspan=2><i>Kode barang kendaraan dimulai dengan huruf 'E'</i></td>
			</tr>
			<tr>
				<td>Kode Barang</td>
				<td>: <input type="text" name="KODE_BARANG" required >
			</tr>
			<tr>
				<input type="hidden" name="NAMA_BARANG" value="EMAS">
				<td>Karat</td>
				<td>: <input type="text" name="KARAT" required></td>
			</tr>
			<tr>
				<td>Berat (gram)</td>
				<td>: <input type="text" name="BERAT"  required></td>
			</tr>			
			<tr>	
				<td>Harga Taksir (Rp.)</td>
				<td>: <input type="text" name="HARGA_TAKSIR" required></td>
			</tr>
		<?php
			}
		
		else if($jenis=="2"){ ?>
			<tr>
				<td colspan=2><i>Kode barang kendaraan dimulai dengan huruf 'L'</i></td>
			</tr>
			<tr>
				<td>Kode Barang</td>
				<td>: <input type="text" name="KODE_BARANG" required>
			</tr>
			<tr>
				<td>Nama Barang Elektronik</td>
				<td>: <input type="text" name="NAMA_BARANG" required></td>
			</tr>
			<tr>
				<td>Merk</td>
				<td>: <input type="text" name="MERK"></td>
			<tr>
			</tr>
				<td>Nomor Seri</td>
				<td>: <input type="text" name="NO_SERI" ></td>
			</tr>
			</tr>
				<td>Warna</td>
				<td>: <input type="text" name="WARNA" ></td>
			</tr>
			</tr>
				<td>Berat (gram)</td>
				<td>: <input type="text" name="BERAT" ></td>
			</tr>
			<tr>
				<td>Harga Taksir (Rp.)</td>
				<td>: <input type="text" name="HARGA_TAKSIR" required></td>
			</tr>
		<?php 
			}
		
		else if($jenis=="3"){ ?>
			<tr>
				<td colspan=2><i>Kode barang kendaraan dimulai dengan huruf 'K'</i></td>
			</tr>
			<tr>
				<td>Kode Barang</td>
				<td>: <input type="text" name="KODE_BARANG" required>
			</tr>
			<tr>
				<td>No Polisi</td>
				<td>: <input type="text" name="NO_POLISI" required></td>
			</tr>
			<tr>
				<td>Nama Kendaraan</td>
				<td>: 
					<select name="NAMA_BARANG">
						<option value="Motor">Motor</option>
						<option value="Mobil">Mobil</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Merk Kendaraan</td>
				<td>: <input type="text" name="MERK" ></td>
			</tr>
			<tr>
				<td>Warna</td>
				<td>: <input type="text" name="WARNA" ></td>
			</tr>
			<tr>
				<td>Berat (ton)</td>
				<td>: <input type="text" name="BERAT" required></td>
			</tr>
			<tr>
				<td>Harga Taksir (Rp.)</td>
				<td>: <input type="text" name="HARGA_TAKSIR" required></td>
			</tr>
		<?php 
		}else{ echo "<i>Maaf, data yang anda masukkan belum benar</i>";}
		?>
			<tr>
				<th colspan=2><input type="submit" value="Tambahkan">  <input type="reset" value="Ulangi">
			</tr>
		</table>
		</p>
		<a href="barang.php"><input type="submit" value="Kembali"></a>
	</body>
</html>
