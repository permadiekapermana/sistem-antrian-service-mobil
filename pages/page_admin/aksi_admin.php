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
if ($page=='DataAdmin' AND $act=='input'){

$id_user     = $_POST['id_user'];
$username     = $_POST['username'];
$password     = md5($_POST['password']);
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$no_hp      = $_POST['no_hp'];
$blokir       = 'N';
$level        = 'Admin';

$Q=mysql_query("INSERT INTO users (id_user, username, password, nama_lengkap, alamat, no_hp, level, blokir) VALUES ('$id_user', '$username', '$password',  '$nama_lengkap', '$alamat',  '$no_hp', '$level', '$blokir')");


if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menyimpan data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

  
}

// Update perangkatdesa
elseif ($page=='DataAdmin' AND $act=='update'){

  if (empty($_POST[password]) ){

    $id_user     = $_POST['id_user'];
    $username     = $_POST['username'];
    $password     = md5($_POST['password']);
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $no_hp      = $_POST['no_hp'];
    $blokir       = 'N';
    $blokir   = $_POST['blokir'];
  
  $Q=mysql_query("UPDATE users SET username = '$username', nama_lengkap = '$nama_lengkap', alamat = '$alamat', no_hp ='$no_hp',  blokir='$blokir' WHERE id_user='$id_user'");

  }
  else {

    $id_user     = $_POST['id_user'];
    $username     = $_POST['username'];
    $password     = md5($_POST['password']);
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $no_hp      = $_POST['no_hp'];
    $blokir       = 'N';
    $blokir   = $_POST['blokir'];
  
  $Q=mysql_query("UPDATE users SET username = '$username', password='$password', nama_lengkap = '$nama_lengkap', alamat = '$alamat', no_hp ='$no_hp',  blokir='$blokir' WHERE id_user='$id_user'");

  }

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
