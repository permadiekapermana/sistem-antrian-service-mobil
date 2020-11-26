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
if ($page=='DataMekanik' AND $act=='input'){

$id_mekanik        = $_POST['id_mekanik'];
$nama_mekanik           = $_POST['nama_mekanik'];
$alamat        = $_POST['alamat'];

  $Q=mysql_query("INSERT INTO mekanik (id_mekanik, nama_mekanik, alamat) VALUES ('$id_mekanik', '$nama_mekanik', '$alamat')");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }


  
}

// Update perangkatdesa
elseif ($page=='DataMekanik' AND $act=='update'){

$id_mekanik   = $_POST['id_mekanik'];
$nama_mekanik           = $_POST['nama_mekanik'];
$alamat         = $_POST['alamat'];

  $Q=mysql_query("UPDATE mekanik SET nama_mekanik='$nama_mekanik', alamat='$alamat' WHERE id_mekanik='$id_mekanik'");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }



  

  
}

elseif ($page=='DataMekanik' AND $act=='hapus'){
  
  $id = $_GET[id];

  $Q  = mysql_query("DELETE FROM mekanik WHERE id_mekanik='$id'");

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
