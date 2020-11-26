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
if ($page=='DataPos' AND $act=='input'){

$id_mekanik        = $_POST['id_mekanik'];
$id_pos        = $_POST['id_pos'];
$nama_pos           = $_POST['nama_pos'];

  $Q=mysql_query("INSERT INTO pos (id_pos, id_mekanik, nama_pos) VALUES ('$id_pos', '$id_mekanik', '$nama_pos')");
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
