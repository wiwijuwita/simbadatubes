create database rpl;

use rpl;

create table anggota(
	nta int primary key auto_increment,
	username_anggota varchar(30) not null,
	password_anggota varchar(30) not null,
	nama_anggota varchar(100) not null,
	alamat_anggota varchar(100) not null,
	jk_anggota varchar(20) not null,
	tanggal_daftar timestamp not null,
	jurusan varchar(30) not null,
	kontak_anggota varchar(30) not null
	
);

create table pengurus(
	id_pengurus varchar(30) primary key,
	username_pengurus varchar(30) not null,
	password_pengurus varchar(30) not null,
	nama_pengurus varchar(100) not null,
	alamat_pengurus varchar(100) not null,
	jk_pengurus varchar(20) not null,
	jabatan_pengurus varchar(20) not null,
	kontak_pengurus varchar(20) not null
);

create table pembayaran_iuran_pokok(
	id_pokok int primary key auto_increment,
	nta int not null,
	id_pengurus varchar(30) not null,
	tgl_pembayaran timestamp not null,
	nominal_pokok int not null,
	foreign key (nta) references anggota(nta),
	foreign key (id_pengurus) references pengurus(id_pengurus)
);

create table pembayaran_iuran_wajib(
	id_wajib int primary key auto_increment,
	nta int not null,
	id_pengurus varchar(30) not null,
	bulan_pembayaran varchar(20) not null,
	tahun_pembayaran varchar(20) not null,
	tgl_pembayaran timestamp not null,
	nominal_wajib int not null,
	foreign key (nta) references anggota(nta),
	foreign key (id_pengurus) references pengurus(id_pengurus)
);