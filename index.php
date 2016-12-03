
<html>
<head>
		<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">

	<title>Pemesanan Tiket Kereta</title>
</head>
<body>

	<h2><p align="center">Sistem Pemesanan Tiket Kereta Api-apian Online</h2>
	<br>
	<h3><p align="center">Pemesanan Tiket Kereta</h3>
	<form method="POST">
		<!-- ==============Untuk berangkat=================== -->
		<div class="highlight">
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<p align="center">Berangkat:
					<select name="berangkat" class="form-control">
						<?php
							include 'koneksi.php';

							$query = "select nama from stasiun";
							$sql = ociparse($koneksi, $query);
							ociexecute($sql);
							
							while (ocifetch($sql)) {
								echo "<option>".ociresult($sql, 1)."</option>";
							}
						?>
					</select>
				</div>
				<div class="col-md-5"></div>
			</div>
			<!-- =============================================== -->
			<!-- ==============Untuk tujuan===================== -->
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<p align="center">Tujuan:
					<select name="tujuan" class="form-control">
						<?php
							include 'koneksi.php';

							$query = "select nama from stasiun";
							$sql = ociparse($koneksi, $query);
							ociexecute($sql);
							
							while (ocifetch($sql)) {
								echo "<option>".ociresult($sql, 1)."</option>";
							}
						?>
					</select>
				</div>
				<div class="col-md-5"></div>
			</div>
			<!-- =============================================== -->
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<p align="center">
						Jumlah Tiket : <input type="number" class="form-control" name="jmltiket" max="30" value=1>
					</p>
				</div>
				<div class="col-md-5"></div>
			</div>
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
					<p align="center">
						<input type="submit" class="btn btn-primary" name="btnjadwal" value="Cari jadwal">
					</p>
				</div>
				<div class="col-md-5"></div>
			</div>
		</div>
	</form>
    
    

		<?php 
		if(isset($_POST['jmltiket'])){
			$jmltiket=$_POST['jmltiket'];
			
			echo"<div class='row'>	<div class='col-md-2'></div><div class='col-md-8'><p align=center><table   class='table'><tr bgcolor='white'><td colspan=5>
";
			
			if (isset($_POST["btnjadwal"])) {
				///////// cari dulu id stasiunnya ///////////
				$berangkat = $_POST["berangkat"];
				$tujuan = $_POST["tujuan"];

				echo "<p align='center'>Hasil pencarian dari <b>$berangkat</b> ke <b>$tujuan</b></p></td>";

				$query = "select id_stasiun from stasiun where nama = '$berangkat' ";
				$sql = ociparse($koneksi, $query);
				ociexecute($sql);
				ocifetch($sql);
				$berangkat = ociresult($sql, 1);

				$query = "select id_stasiun from stasiun where nama = '$tujuan' ";
				$sql = ociparse($koneksi, $query);
				ociexecute($sql);
				ocifetch($sql);
				$tujuan = ociresult($sql, 1);

				/////////////////////////////////////////////

				$query = "select kereta.id_kereta, jadwal.wkt_berangkat, jadwal.wkt_sampai, jadwal.harga, no_keberangkatan.id_no_keberangkatan, kereta.jml_kursi
							from no_keberangkatan, jadwal, kereta
							where no_keberangkatan.id_jadwal = jadwal.id_jadwal 
							and kereta.id_kereta = no_keberangkatan.id_kereta
							and jadwal.id_stasiun_fr = '$berangkat' and jadwal.id_stasiun_to = '$tujuan'
							and jadwal.wkt_berangkat > sysdate";
				$sql = ociparse($koneksi, $query);
				ociexecute($sql);
		?>
		<tr>
		<td>No. Kereta</td>
		<td>Waktu Berangkat</td>
		<td>Waktu Tiba</td>
		<td>Harga</td>
		<td>Booking</td>
		</tr>
		<?php

				while (ocifetch($sql)) {
					echo "<tr>";
					echo "<td>". ociresult($sql, 1)."</td>";
									//tanggal 								//Jam 										//AM/PM
					echo "<td>". substr(ociresult($sql, 2), 0, 9) ."--". substr(ociresult($sql, 2), 10, 5). " " . substr(ociresult($sql, 2), 26, 2) . "</td>";
					echo "<td>". substr(ociresult($sql, 3), 0, 9) ."--". substr(ociresult($sql, 3), 10, 5). " " . substr(ociresult($sql, 3), 26, 2) . "</td>";
					echo "<td>". ociresult($sql, 4)."</td>";
					// MEDAPATKAN KURSI yang telah di booking
					$query = "select count(id_kursi) from kursi where id_kereta = '".ociresult($sql, 1)."' and status != 'Kosong'";
					$sql2 = ociparse($koneksi, $query);
					ociexecute($sql2);
					ocifetch($sql2);
					if (ociresult($sql, 6) > ociresult($sql2, 1)) {
						echo "<td><a href='form_penumpang.php?jml=".$jmltiket."&id_no_keberangkatan=". ociresult($sql, 5)."'><button class='btn btn-primary'>Booking (sisa ".(ociresult($sql, 6)-ociresult($sql2, 1))." kursi)</button></a></td>";
					}
					echo "</tr>";
				}
			}


		}
		?>
	</td></tr></table>
	</div>
	</div>
</body>
</html>