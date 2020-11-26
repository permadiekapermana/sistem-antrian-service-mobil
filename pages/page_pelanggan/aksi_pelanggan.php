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

// Update perangkatdesa
if ($page=='DataPelanggan' AND $act=='blokir'){

    $id_user     = $_GET['id'];
    $blokir       = 'Y';
  
  $Q=mysql_query("UPDATE users SET blokir='$blokir' WHERE id_user='$id_user'");


  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  
}

elseif ($page=='DataPelanggan' AND $act=='unblokir'){

  $id_user     = $_GET['id'];
  $blokir       = 'N';

$Q=mysql_query("UPDATE users SET blokir='$blokir' WHERE id_user='$id_user'");


if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menyimpan data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

}

}

?>
