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
if ($page=='DataJasa' AND $act=='input'){

$id_jasa        = $_POST['id_jasa'];
$nama_jasa           = $_POST['nama_jasa'];
$harga_jasa        = $_POST['harga_jasa'];
$lama_pengerjaan        = $_POST['lama_pengerjaan'];

  $Q=mysql_query("INSERT INTO jasa_service (id_jasa, nama_jasa, harga_jasa, lama_pengerjaan) VALUES ('$id_jasa', '$nama_jasa', '$harga_jasa', '$lama_pengerjaan')");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }


  
}

// Update perangkatdesa
elseif ($page=='DataJasa' AND $act=='update'){

$id_jasa        = $_POST['id_jasa'];
$nama_jasa           = $_POST['nama_jasa'];
$harga_jasa         = $_POST['harga_jasa'];
$lama_pengerjaan        = $_POST['lama_pengerjaan'];

  $Q=mysql_query("UPDATE jasa_service SET nama_jasa='$nama_jasa', harga_jasa='$harga_jasa', lama_pengerjaan='$lama_pengerjaan' WHERE id_jasa='$id_jasa'");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }



  

  
}

elseif ($page=='DataJasa' AND $act=='hapus'){
  
  $id = $_GET[id];

  $Q  = mysql_query("DELETE FROM jasa_service WHERE id_jasa='$id'");

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
