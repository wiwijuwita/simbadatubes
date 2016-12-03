<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">

<title>Pemesanan Tiket Kereta</title>

<h2><p align="center">Sistem Pemesanan Tiket Kereta Api-apian Online</h2>
<br>
<h3><p align="center">Pemesanan Tiket Kereta</h3>


<?php

	include "koneksi.php";
	$nk=$_POST['nk'];
	$nama0=$_POST['nama'];
	$id0=$_POST['id'];
	$kontak0=$_POST['kontak'];
	$kelas=$_POST['kelas'];
	$jmltiket=$_POST['jmltiket'];
	
	while (list(, $id) = each($id0)) {
	list(,$kontak)=each($kontak0);
	list(,$nama)=each($nama0);
	$status='Belum Naik';
	$query ="insert into penumpang values('$id','$nama','$kontak','$status')";
	$hasil=oci_parse($koneksi,$query);
	oci_execute($hasil);
	}
	unset($id);
	unset($kontak);
	unset($nama);
	
		
	//memilih kursi secara random sesuai kelas yang dipilih//
	$kursi="select * from(select kursi.id_kursi from kursi,kereta,no_keberangkatan 
	where no_keberangkatan.id_kereta=kereta.id_kereta and kursi.id_kereta=kereta.id_kereta 
	and no_keberangkatan.id_no_keberangkatan='$nk' and kursi.kelas='$kelas' and kursi.status='Kosong' order by id_kursi) where rownum<=$jmltiket";
	$hkursi=oci_parse($koneksi,$kursi);
	oci_execute($hkursi);
	
	
	
	//proses update status kursi
	//$update="update kursi set status='Terisi' where id_kursi='$pilihkursi'";
	//$hupdate=oci_parse($koneksi,$update);
	//oci_execute($hupdate);
	
	//mengambil waktu
	$waktu="select jadwal.* from jadwal,no_keberangkatan where jadwal.id_jadwal=no_keberangkatan.id_jadwal and no_keberangkatan.id_no_keberangkatan='$nk'";
	$hwaktu=oci_parse($koneksi,$waktu);
	oci_execute($hwaktu);
	oci_fetch($hwaktu);
	$wktbr=substr(ociresult($hwaktu, 4), 0, 9) ."  ". substr(ociresult($hwaktu, 4), 10, 5). " " . substr(ociresult($hwaktu, 4), 26, 2);
	$wkttb=substr(ociresult($hwaktu, 5), 0, 9) ."  ". substr(ociresult($hwaktu, 5), 10, 5). " " . substr(ociresult($hwaktu, 5), 26, 2);
	$idbr=oci_result($hwaktu,2);
	$idtb=oci_result($hwaktu,3);
	
	//mengambil nama stasiun
	$stbr="select nama from stasiun where id_stasiun='$idbr'";
	$sttb="select nama from stasiun where id_stasiun='$idtb'";
	$brngkt=oci_parse($koneksi,$stbr);
	$tb=oci_parse($koneksi,$sttb);
	oci_execute($brngkt);
	oci_execute($tb);
	oci_fetch($brngkt);
	oci_fetch($tb);
	$hstbr=oci_result($brngkt,1);
	$hsttb=oci_result($tb,1);
	
	
	$query3="select harga from jadwal where id_stasiun_fr='$idbr' and id_stasiun_to='$idtb'";
	$hjadwal=oci_parse($koneksi,$query3);
	oci_execute($hjadwal);
	oci_fetch($hjadwal);
	$hargajadwal=oci_result($hjadwal,1);
	
	
	$query2="select harga_kelas from gerbong where kelas='$kelas'";
	$hkelas=oci_parse($koneksi,$query2);
	oci_execute($hkelas);
	oci_fetch($hkelas);
	$hargakelas=oci_result($hkelas,1);
	
	$nama0=$_POST['nama'];
	$id0=$_POST['id'];
	$kontak0=$_POST['kontak'];
	
?>

<h4><p align='center'>Data anda telah berhasil disimpan dengan status <b><i>"Booking"</b></i></h4></p> 

<div class='row'>
	<div class='col-md-4'></div>
	<div class='col-md-4'>
		<table class='table table-inline'>
		  <?php	while (list(, $id2) = each($id0)) {
			list(,$kontak2)=each($kontak0);
			list(,$nama2)=each($nama0);
			
			?>
		  <tr>
			<td width="150px">Nama</td>
			<td>: </td>
			<td><?php echo $nama2 ;?></td>
		  </tr>
		  <tr>
			<td>No. KTP</td>
			<td>: </td>
			<td><?php echo $id2;?></td>
		  </tr>
		  <tr>
			<td>No KA</td>
			<td>: </td>
			<td><?php echo $nk;?></td>
		  </tr>
		  <tr>
			<td>Kelas / No Kursi</td>
			<td>: </td>
			<td><?php echo $kelas; echo " / "; oci_fetch($hkursi);
				$pilihkursi=oci_result($hkursi,1);
				echo $pilihkursi; ?></td>
		  </tr>
		  <?php }?>
		  <tr>
			<td rowspan="2">Berangkat</td>
			<td>: </td>
			<td><?php echo $hstbr;?></td>
		  </tr>
		  <tr>
			<td>: </td>
			<td><?php echo $wktbr;?></td>
		  </tr>
		  <tr>
			<td rowspan="2">Tiba</td>
			<td>: </td>
			<td><?php echo $hsttb;?></td>
		  </tr>
		  <tr>
			<td>: </td>
			<td><?php echo $wkttb;?></td>
		  </tr>
		  <tr>
			<td>Harga tiap tiket</td>
			<td>: </td>
			<td><?php $total=($hargajadwal+$hargakelas); 
						echo $total;?></td>
		  </tr>
		  <tr>
			<td>Harga Total tiket</td>
			<td>: </td>
			<td><?php $total2=($hargakelas+$hargajadwal)*$jmltiket;
					echo $total2;
					?></td>
		  </tr>
		</table>
			<form action="bayar.php" method="POST">
			  <input type="hidden" name="nama" value="<?php echo $nama;?>"  />
			  <input type="hidden" name="kontak" value="<?php echo $kontak;?>" />
			  <input type="hidden" name="ktp" value="<?php echo $id;?>" />
			  <input type="hidden" name="noka" value="<?php echo $nk;?>" />
			  <input type="hidden" name="stbr" value="<?php echo $hstbr;?>" />
			  <input type="hidden" name="sttb" value="<?php echo $hsttb;?>" />
			  <input type="hidden" name="wktbr" value="<?php echo $wktbr;?>" />
			  <input type="hidden" name="wkttb" value="<?php echo $wkttb;?>" />
			  <input type="hidden" name="kelas" value="<?php echo $kelas;?>"  />
			  <input type="hidden" name="total" value="<?php echo $total;?>" />
			  <input type="hidden" name="nokursi" value="<?php echo $pilihkursi;?>" />
			  <input type="hidden" name="idtiket" value="<?php echo $idtiket; ?>" />
			 <p align='center'> <input type="submit" class='btn btn-primary' value="Bayar Tiket" />
			</form>

	</div>
	<div class='col-md-4'></div>
</div>
<?php 
//proses pengisian data pembeli tiket
$nama0=$_POST['nama'];
$id0=$_POST['id'];
$kontak0=$_POST['kontak'];

$kursi="select * from(select kursi.id_kursi from kursi,kereta,no_keberangkatan 
where no_keberangkatan.id_kereta=kereta.id_kereta and kursi.id_kereta=kereta.id_kereta 
and no_keberangkatan.id_no_keberangkatan='$nk' and kursi.kelas='$kelas' and kursi.status='Kosong' order by id_kursi) where rownum<=$jmltiket";
$hkursi=oci_parse($koneksi,$kursi);
oci_execute($hkursi);

while (list(, $id2) = each($id0)) {
	list(,$kontak2)=each($kontak0);
	list(,$nama2)=each($nama0);
	oci_fetch($hkursi);
	$pilihkursi=oci_result($hkursi,1);	
$tiket="insert into tiket values(seq_tiket.nextval,'$id2','$nk','$pilihkursi','Belum Bayar')";
$hasil=oci_parse($koneksi,$tiket);
oci_execute($hasil);
}

//$ambilid="select id_tiket from tiket where id_kursi='$pilihkursi'";
//$hambil=oci_parse($koneksi,$ambilid);
//oci_execute($hambil);
//oci_fetch($hambil);
//$idtiket=oci_result($hambil,1);
?>
