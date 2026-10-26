<?php
// Endpoint HTTP untuk form 2.c – validasi server, sanitasi, prepared statement
header('Content-Type: application/json; charset=utf-8');
function keluar($kode,$ok,$pesan,$extra=[]){http_response_code($kode);echo json_encode(array_merge(['sukses'=>$ok,'pesan'=>$pesan],$extra));exit;}
if($_SERVER['REQUEST_METHOD']!=='POST') keluar(405,false,'Metode tidak diizinkan');

$tarif=['reg'=>['Cuci Kiloan Reguler',7000,'kg'],'exp'=>['Cuci Express',12000,'kg'],'cs'=>['Cuci + Setrika',9000,'kg'],
        'st'=>['Setrika Saja',5000,'kg'],'bd'=>['Bedcover / Selimut',25000,'pcs'],'sp'=>['Cuci Sepatu',30000,'pasang']];
$nama=trim($_POST['nama']??'');$hp=preg_replace('/[\s-]/','',$_POST['no_hp']??'');
$lid=$_POST['jenis_layanan']??'';$qty=(float)($_POST['berat_qty']??0);
$metode=$_POST['metode_pembayaran']??'';$statusBayar=$_POST['status_pembayaran']??'';
$catatan=htmlspecialchars(trim($_POST['catatan']??''),ENT_QUOTES,'UTF-8');

if(!preg_match("/^[A-Za-z\s.'’]{3,100}$/u",$nama)) keluar(422,false,'Nama tidak valid');
if(!preg_match('/^(08|\+628|628)\d{8,11}$/',$hp)) keluar(422,false,'No. HP tidak valid');
if(!isset($tarif[$lid])) keluar(422,false,'Layanan tidak valid');
if($qty<=0||$qty>50) keluar(422,false,'Berat/jumlah tidak valid');
if(!in_array($metode,['Tunai','QRIS','Transfer'],true)) keluar(422,false,'Metode pembayaran tidak valid');
if(!in_array($statusBayar,['Lunas','Belum Lunas'],true)) keluar(422,false,'Status pembayaran tidak valid');
if(mb_strlen($catatan)>150) keluar(422,false,'Catatan terlalu panjang');

try{
 $pdo=new PDO('mysql:host=localhost;dbname=hola_laundry;charset=utf8mb4','root','',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
 $s=$pdo->prepare('SELECT id FROM pelanggan WHERE no_hp=?');$s->execute([$hp]);$pid=$s->fetchColumn();
 if(!$pid){$pdo->prepare('INSERT INTO pelanggan(nama,no_hp) VALUES(?,?)')->execute([$nama,$hp]);$pid=$pdo->lastInsertId();}
 do{$resi='HL'.date('ymd').str_pad((string)random_int(0,9999),4,'0',STR_PAD_LEFT);
    $c=$pdo->prepare('SELECT COUNT(*) FROM transaksi WHERE kode_resi=?');$c->execute([$resi]);}while($c->fetchColumn()>0);
 $total=$tarif[$lid][1]*$qty;
 $pdo->prepare('INSERT INTO transaksi(kode_resi,pelanggan_id,jenis_layanan,berat_qty,total_bayar,status_laundry,status_pembayaran,metode_pembayaran,catatan,tanggal_masuk) VALUES(?,?,?,?,?,?,?,?,?,NOW())')
     ->execute([$resi,$pid,$tarif[$lid][0],$qty,$total,'Diproses',$statusBayar,$metode,$catatan]);
 keluar(200,true,'Tersimpan',['resi'=>$resi,'total'=>$total]);
}catch(Exception $e){keluar(500,false,'Kesalahan database');}
