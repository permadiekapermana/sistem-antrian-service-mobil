<?php
error_reporting(0);
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumb.php";

$page=$_GET[page];
$act=$_GET[act];

// Input users
if ($page=='DataService' AND $act=='konfirm'){

$id_service        = $_POST['id_service'];
$pos        = $_POST['id_pos'];

  $Q=mysql_query("UPDATE service SET status='Diproses' WHERE id_service='$id_service'");  
  $tampil = mysql_query("SELECT * FROM `service`  WHERE id_pos='$pos' AND status='Dalam Antrian' ORDER BY jam_mulai ASC");
  $r=mysql_fetch_array($tampil);
  $ketemu=mysql_num_rows($tampil);
  if ($ketemu > 0){
  mysql_query("UPDATE service SET status='Selanjutnya' WHERE id_service='$r[id_service]'");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  }
  else{
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  }


  
}

elseif ($page=='DataService' AND $act=='selesai'){

$id_service        = $_GET['id'];
$pos        = $_GET['id_pos'];

$lama_service = mysql_query("SELECT
`jasa_service`.`lama_pengerjaan`
FROM
`service`
INNER JOIN `paket` ON `paket`.`id_paket` = `service`.`id_paket`
INNER JOIN `pos` ON `pos`.`id_pos` = `service`.`id_pos`
INNER JOIN `jasa_service` ON `jasa_service`.`id_jasa` = `paket`.`id_jasa` WHERE id_service='$id_service'");
$w=mysql_fetch_array($lama_service);
$waktu_service = $w['lama_pengerjaan'];
$pos2 = mysql_query("SELECT * FROM pos WHERE id_pos='$pos'");
$p=mysql_fetch_array($pos2);
$waktu_pos  = $p['total_waktu'];
$update_waktu = $waktu_pos - $waktu_service;

  $Q=mysql_query("UPDATE service SET status='Selesai' WHERE id_service='$id_service'");
  mysql_query("UPDATE pos SET total_waktu='$waktu_service' WHERE id_pos='$pos'");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }


  
}

// Update perangkatdesa
elseif ($page=='DataPos' AND $act=='update'){

$id_mekanik   = $_POST['id_mekanik'];
$id_pos   = $_POST['id_pos'];
$nama_pos           = $_POST['nama_pos'];

  $Q=mysql_query("UPDATE pos SET id_mekanik='$id_mekanik', nama_pos='$nama_pos' WHERE id_pos='$id_pos'");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }



  

  
}

elseif ($page=='DataPos' AND $act=='hapus'){
  
  $id = $_GET[id];

  $Q  = mysql_query("DELETE FROM pos WHERE id_pos='$id'");

if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}
  
}

}

?>
