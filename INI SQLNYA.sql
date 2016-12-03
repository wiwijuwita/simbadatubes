connect system
system

create user tubes identified by tubes;
grant connect to tubes;
grant all privileges to tubes;

connect tubes
tubes

create table penumpang(
no_ktp varchar2(16) primary key not null,
nama varchar2(25) not null,
kontak varchar2(14) not null,
status varchar2(15) not null
);

create table pembayaran(
id_pembayaran varchar2(7) primary key not null,
nama varchar2(20) not null,
charge number(7) not null
);

create table kereta(
id_kereta varchar2(7) primary key not null,
jml_gerbong number(5) not null,
jml_kursi number(5) not null
);

create table gerbong(
id_gerbong varchar2(7) primary key not null,
id_kereta varchar2(7) not null,
kelas varchar2(15) not null,
harga_kelas number(7) not null,
constraint fk_k foreign key (id_kereta) references kereta(id_kereta)
);

create table kursi(
id_kursi varchar2(10) primary key not null,
id_gerbong varchar2(7) not null,
id_kereta varchar2(7) not null,
kelas varchar2(15) not null,
status varchar2(15) not null,
constraint fk_g foreign key (id_gerbong) references gerbong(id_gerbong),
constraint fk_k2 foreign key (id_kereta) references kereta(id_kereta)
);

create table stasiun(
id_stasiun varchar2(7) primary key not null,
nama varchar2(25) not null
);

create table jadwal(
id_jadwal varchar2(7) primary key not null,
id_stasiun_fr varchar2(7) not null,
id_stasiun_to varchar2(7) not null,
wkt_berangkat timestamp not null,
wkt_sampai timestamp not null,
harga number(10) not null,
constraint fk_stasiun foreign key (id_stasiun_fr) references stasiun(id_stasiun),
constraint fk_stasiunt foreign key(id_stasiun_to) references stasiun(id_stasiun)
);

create table no_keberangkatan(
id_no_keberangkatan varchar2(7) primary key not null,
id_kereta varchar2(7) not null,
id_jadwal varchar2(7) not null,
constraint fk_kereta foreign key (id_kereta) references kereta(id_kereta),
constraint jd foreign key (id_jadwal) references jadwal(id_jadwal)
);

create table transit(
id_transit varchar2(7) primary key not null,
id_stasiun varchar2(7) not null,
id_no_keberangkatan varchar2(7) not null,
waktu timestamp,
constraint fk_s foreign key (id_stasiun) references stasiun(id_stasiun),
constraint fk_no foreign key (id_no_keberangkatan) references no_keberangkatan(id_no_keberangkatan)
);


create table tiket(
id_tiket varchar2(7) primary key not null,
no_ktp varchar2(30) not null,
id_no_keberangkatan varchar2(7) not null,
id_kursi varchar2(10) not null,
status varchar2(20) not null,
constraint ktp foreign key (no_ktp) references penumpang(no_ktp),
constraint berangkat foreign key (id_no_keberangkatan) references no_keberangkatan(id_no_keberangkatan),
constraint kursi foreign key (id_kursi) references kursi(id_kursi)
);


create table bayar(
id_bayar varchar2(7) primary key not null,
id_pembayaran varchar2(7) not null,
id_tiket varchar2(8) not null,
waktu timestamp,
constraint fk_t foreign key (id_tiket) references tiket(id_tiket),
constraint fk_p foreign key (id_pembayaran) references pembayaran(id_pembayaran)
);





create sequence seq_bayar increment by 1;
create sequence seq_tiket increment by 1;



create or replace trigger gantistatus
after 
	insert on bayar
for each row
begin
	if inserting then
		update tiket set status='Sudah Bayar' where id_tiket=:new.id_tiket;
	end if;
end;
/

create or replace trigger gantistatuskursi
after
	insert on tiket
for each row
begin
	if inserting then
		update kursi set status='Terisi' where id_kursi=:new.id_kursi;
	end if;
end;
/

insert into penumpang values('3217082406940002','Chairul Anam','085722983616','Belum Naik');
insert into penumpang values('3277031812930007','Riski Andika','085722983617','Belum Naik');

insert into pembayaran values('IDM','Indomaret','7500');
insert into pembayaran values('MDR','Mandiri','2500');
insert into pembayaran values('BCA','BCA','3500');
insert into pembayaran values('AFM','Alfamart','7500');
insert into pembayaran values('STS','Stasiun','0');

insert into kereta values('KRT001','3','80');
insert into kereta values('KRT002','3','60');
insert into kereta values('KRT003','4','100');
insert into kereta values('KRT004','4','75');
insert into kereta values('KRT005','4','80');

insert into gerbong values('GRBE01','KRT001','Ekonomi','10000');
insert into gerbong values('GRBE02','KRT002','Ekonomi','10000');
insert into gerbong values('GRBE03','KRT003','Ekonomi','10000');
insert into gerbong values('GRBE04','KRT004','Ekonomi','10000');
insert into gerbong values('GRBE05','KRT005','Ekonomi','10000');
insert into gerbong values('GRBB01','KRT001','Bisnis','30000');
insert into gerbong values('GRBB02','KRT002','Bisnis','30000');
insert into gerbong values('GRBB03','KRT003','Bisnis','30000');
insert into gerbong values('GRBB04','KRT004','Bisnis','30000');
insert into gerbong values('GRBB05','KRT005','Bisnis','30000');
insert into gerbong values('GRBX01','KRT001','Eksekutif','50000');
insert into gerbong values('GRBX02','KRT002','Eksekutif','50000');
insert into gerbong values('GRBX03','KRT003','Eksekutif','50000');
insert into gerbong values('GRBX04','KRT004','Eksekutif','50000');
insert into gerbong values('GRBX05','KRT005','Eksekutif','50000');


insert into kursi values('KRSE01A1','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B1','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C1','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D1','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01A2','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B2','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C2','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D2','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01A3','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B3','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C3','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D3','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01A4','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B4','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C4','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D4','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01A5','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B5','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C5','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D5','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01A6','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B6','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C6','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D6','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01A7','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B7','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C7','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D7','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01A8','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B8','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C8','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D8','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01A9','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01B9','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01C9','GRBE01','KRT001','Ekonomi','Kosong');
insert into kursi values('KRSE01D9','GRBE01','KRT001','Ekonomi','Kosong');


insert into kursi values('KRSE02A1','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B1','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C1','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D1','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02A2','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B2','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C2','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D2','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02A3','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B3','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C3','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D3','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02A4','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B4','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C4','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D4','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02A5','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B5','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C5','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D5','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02A6','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B6','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C6','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D6','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02A7','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B7','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C7','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D7','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02A8','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B8','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C8','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D8','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02A9','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02B9','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02C9','GRBE01','KRT002','Ekonomi','Kosong');
insert into kursi values('KRSE02D9','GRBE01','KRT002','Ekonomi','Kosong');


insert into kursi values('KRSE03A1','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B1','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C1','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D1','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03A2','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B2','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C2','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D2','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03A3','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B3','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C3','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D3','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03A4','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B4','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C4','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D4','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03A5','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B5','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C5','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D5','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03A6','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B6','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C6','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D6','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03A7','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B7','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C7','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D7','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03A8','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B8','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C8','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D8','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03A9','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03B9','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03C9','GRBE01','KRT003','Ekonomi','Kosong');
insert into kursi values('KRSE03D9','GRBE01','KRT003','Ekonomi','Kosong');


insert into kursi values('KRSE04A1','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B1','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C1','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D1','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04A2','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B2','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C2','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D2','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04A3','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B3','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C3','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D3','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04A4','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B4','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C4','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D4','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04A5','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B5','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C5','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D5','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04A6','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B6','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C6','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D6','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04A7','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B7','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C7','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D7','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04A8','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B8','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C8','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D8','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04A9','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04B9','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04C9','GRBE04','KRT004','Ekonomi','Kosong');
insert into kursi values('KRSE04D9','GRBE04','KRT004','Ekonomi','Kosong');


insert into kursi values('KRSE05A1','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B1','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C1','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D1','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05A2','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B2','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C2','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D2','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05A3','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B3','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C3','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D3','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05A4','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B4','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C4','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D4','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05A5','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B5','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C5','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D5','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05A6','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B6','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C6','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D6','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05A7','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B7','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C7','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D7','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05A8','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B8','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C8','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D8','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05A9','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05B9','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05C9','GRBE05','KRT005','Ekonomi','Kosong');
insert into kursi values('KRSE05D9','GRBE05','KRT005','Ekonomi','Kosong');


insert into kursi values('KRSX01A1','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B1','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C1','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D1','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01A2','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B2','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C2','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D2','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01A3','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B3','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C3','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D3','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01A4','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B4','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C4','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D4','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01A5','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B5','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C5','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D5','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01A6','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B6','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C6','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D6','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01A7','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B7','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C7','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D7','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01A8','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B8','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C8','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D8','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01A9','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01B9','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01C9','GRBX01','KRT001','Eksekutif','Kosong');
insert into kursi values('KRSX01D9','GRBX01','KRT001','Eksekutif','Kosong');


insert into kursi values('KRSX02A1','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B1','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C1','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D1','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02A2','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B2','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C2','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D2','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02A3','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B3','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C3','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D3','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02A4','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B4','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C4','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D4','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02A5','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B5','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C5','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D5','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02A6','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B6','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C6','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D6','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02A7','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B7','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C7','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D7','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02A8','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B8','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C8','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D8','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02A9','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02B9','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02C9','GRBX02','KRT002','Eksekutif','Kosong');
insert into kursi values('KRSX02D9','GRBX02','KRT002','Eksekutif','Kosong');


insert into kursi values('KRSX03A1','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B1','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C1','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D1','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03A2','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B2','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C2','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D2','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03A3','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B3','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C3','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D3','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03A4','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B4','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C4','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D4','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03A5','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B5','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C5','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D5','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03A6','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B6','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C6','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D6','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03A7','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B7','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C7','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D7','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03A8','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B8','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C8','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D8','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03A9','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03B9','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03C9','GRBX03','KRT003','Eksekutif','Kosong');
insert into kursi values('KRSX03D9','GRBX03','KRT003','Eksekutif','Kosong');


insert into kursi values('KRSX04A1','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B1','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C1','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D1','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04A2','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B2','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C2','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D2','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04A3','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B3','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C3','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D3','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04A4','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B4','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C4','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D4','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04A5','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B5','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C5','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D5','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04A6','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B6','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C6','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D6','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04A7','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B7','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C7','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D7','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04A8','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B8','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C8','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D8','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04A9','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04B9','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04C9','GRBX04','KRT004','Eksekutif','Kosong');
insert into kursi values('KRSX04D9','GRBX04','KRT004','Eksekutif','Kosong');

insert into kursi values('KRSX05A1','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B1','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C1','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D1','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05A2','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B2','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C2','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D2','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05A3','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B3','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C3','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D3','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05A4','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B4','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C4','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D4','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05A5','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B5','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C5','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D5','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05A6','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B6','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C6','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D6','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05A7','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B7','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C7','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D7','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05A8','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B8','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C8','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D8','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05A9','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05B9','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05C9','GRBX05','KRT005','Eksekutif','Kosong');
insert into kursi values('KRSX05D9','GRBX05','KRT005','Eksekutif','Kosong');


insert into kursi values('KRSB01A1','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B1','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C1','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D1','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01A2','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B2','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C2','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D2','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01A3','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B3','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C3','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D3','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01A4','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B4','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C4','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D4','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01A5','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B5','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C5','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D5','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01A6','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B6','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C6','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D6','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01A7','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B7','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C7','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D7','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01A8','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B8','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C8','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D8','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01A9','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01B9','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01C9','GRBB01','KRT001','Bisnis','Kosong');
insert into kursi values('KRSB01D9','GRBB01','KRT001','Bisnis','Kosong');

insert into kursi values('KRSB02A1','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B1','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C1','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D1','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02A2','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B2','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C2','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D2','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02A3','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B3','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C3','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D3','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02A4','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B4','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C4','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D4','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02A5','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B5','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C5','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D5','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02A6','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B6','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C6','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D6','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02A7','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B7','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C7','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D7','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02A8','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B8','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C8','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D8','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02A9','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02B9','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02C9','GRBB02','KRT002','Bisnis','Kosong');
insert into kursi values('KRSB02D9','GRBB02','KRT002','Bisnis','Kosong');


insert into kursi values('KRSB03A1','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B1','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C1','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D1','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03A2','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B2','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C2','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D2','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03A3','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B3','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C3','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D3','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03A4','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B4','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C4','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D4','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03A5','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B5','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C5','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D5','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03A6','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B6','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C6','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D6','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03A7','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B7','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C7','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D7','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03A8','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B8','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C8','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D8','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03A9','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03B9','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03C9','GRBB03','KRT003','Bisnis','Kosong');
insert into kursi values('KRSB03D9','GRBB03','KRT003','Bisnis','Kosong');


insert into kursi values('KRSB04A1','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B1','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C1','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D1','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04A2','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B2','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C2','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D2','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04A3','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B3','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C3','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D3','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04A4','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B4','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C4','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D4','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04A5','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B5','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C5','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D5','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04A6','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B6','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C6','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D6','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04A7','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B7','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C7','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D7','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04A8','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B8','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C8','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D8','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04A9','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04B9','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04C9','GRBB04','KRT004','Bisnis','Kosong');
insert into kursi values('KRSB04D9','GRBB04','KRT004','Bisnis','Kosong');

insert into kursi values('KRSB05A1','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B1','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C1','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D1','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05A2','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B2','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C2','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D2','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05A3','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B3','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C3','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D3','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05A4','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B4','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C4','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D4','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05A5','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B5','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C5','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D5','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05A6','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B6','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C6','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D6','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05A7','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B7','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C7','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D7','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05A8','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B8','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C8','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D8','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05A9','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05B9','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05C9','GRBB05','KRT005','Bisnis','Kosong');
insert into kursi values('KRSB05D9','GRBB05','KRT005','Bisnis','Kosong');


insert into stasiun values('STCMH01','Stasiun Cimahi');
insert into stasiun values('STBDG01','Stasiun Bandung');
insert into stasiun values('STBDG02','Stasiun Padalarang');
insert into stasiun values('STBDG03','Stasiun Gadobangkong');
insert into stasiun values('STJKT01','Stasiun Gambir');
insert into stasiun values('STJKT02','Stasiun Jatinegara');
insert into stasiun values('STJKT03','Stasiun Jakarta Kota');
insert into stasiun values('STJKT04','Stasin Pasar Senin');
insert into stasiun values('STCRB01','Stasiun Cirebon Kota');
insert into stasiun values('STSBY01','Stasiun Surabaya Gubeng');

insert into jadwal values(
'1','STBDG01','STJKT01',
TO_DATE('2015/01/01 05:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 08:00','yyyy/mm/dd hh24:mi'),
'50000');
insert into jadwal values(
'2','STBDG01','STCMH01',
TO_DATE('2015/01/01 05:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 05:30','yyyy/mm/dd hh24:mi'),
'10000');
insert into jadwal values(
'3','STBDG01','STBDG02',
TO_DATE('2015/01/01 05:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 06:00','yyyy/mm/dd hh24:mi'),
'10000');
insert into jadwal values(
'4','STBDG01','STBDG03',
TO_DATE('2015/01/01 05:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 06:00','yyyy/mm/dd hh24:mi'),
'10000');
insert into jadwal values(
'5','STBDG01','STJKT04',
TO_DATE('2015/01/01 07:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 09:00','yyyy/mm/dd hh24:mi'),
'70000');
insert into jadwal values(
'6','STJKT03','STCMH01',
TO_DATE('2015/01/01 14:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 18:00','yyyy/mm/dd hh24:mi'),
'80000');
insert into jadwal values(
'7','STJKT03','STBDG01',
TO_DATE('2015/01/01 13:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 16:00','yyyy/mm/dd hh24:mi'),
'65000');
insert into jadwal values(
'8','STJKT03','STBDG02',
TO_DATE('2015/01/01 09:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 11:00','yyyy/mm/dd hh24:mi'),
'70000');
insert into jadwal values(
'9','STJKT03','STSBY01',
TO_DATE('2015/01/01 05:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 20:00','yyyy/mm/dd hh24:mi'),
'200000');
insert into jadwal values(
'10','STJKT03','STCRB01',
TO_DATE('2015/01/01 05:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 08:00','yyyy/mm/dd hh24:mi'),
'40000');
insert into jadwal values(
'11','STCMH01','STBDG01',
TO_DATE('2015/01/01 10:00','yyyy/mm/dd hh24:mi'),
TO_DATE('2015/01/01 12:00','yyyy/mm/dd hh24:mi'),
'9000');



 
insert into no_keberangkatan values('NKA01','KRT001','1');
insert into no_keberangkatan values('NKA02','KRT002','2');
insert into no_keberangkatan values('NKA03','KRT004','3');
insert into no_keberangkatan values('NKA04','KRT005','4');
insert into no_keberangkatan values('NKA05','KRT003','5');
insert into no_keberangkatan values('NKA06','KRT001','6');
insert into no_keberangkatan values('NKA07','KRT002','7');
insert into no_keberangkatan values('NKA08','KRT004','8');
insert into no_keberangkatan values('NKA09','KRT003','9');
insert into no_keberangkatan values('NKA10','KRT005','10');
insert into no_keberangkatan values('NKA11','KRT001','11');


