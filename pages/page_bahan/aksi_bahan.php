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
if ($page=='DataBahan' AND $act=='input'){

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file; 

$id_bahan        = $_POST['id_bahan'];
$nama_bahan           = $_POST['nama_bahan'];
$deskripsi         = $_POST['deskripsi'];
$harga        = $_POST['harga'];

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
  UploadBahan($nama_file_unik);
  $Q=mysql_query("INSERT INTO bahan (id_bahan, nama_bahan, deskripsi, harga, gambar) VALUES ('$id_bahan', '$nama_bahan', '$deskripsi', '$harga', '$nama_file_unik')");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }

}
}
else{
  $Q=mysql_query("INSERT INTO bank (id_bank, bank, no_rek, pemilik) VALUES ('$id_bank', '$bank', '$no_rek', '$pemilik')");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
}

  
}

// Update perangkatdesa
elseif ($page=='DataBahan' AND $act=='update'){

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file; 

$id_bahan        = $_POST['id_bahan'];
$nama_bahan           = $_POST['nama_bahan'];
$deskripsi         = $_POST['deskripsi'];
$harga        = $_POST['harga'];

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
  UploadBahan($nama_file_unik);
  $cek  = mysql_fetch_array(mysql_query("SELECT * FROM bahan where id_bahan='$id_bahan'"));
  unlink("../upload/bahan/$cek[gambar]");
  $Q=mysql_query("UPDATE bahan SET nama_bahan='$nama_bahan', deskripsi='$deskripsi', harga='$harga', gambar='$nama_file_unik' WHERE id_bahan='$id_bahan'");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }

}
}
else{
  $Q=mysql_query("UPDATE bahan SET nama_bahan='$nama_bahan', deskripsi='$deskripsi', harga='$harga' WHERE id_bahan='$id_bahan'");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
}
  

  
}

elseif ($page=='DataBahan' AND $act=='hapus'){
  
  $id = $_GET[id];
  $cek  = mysql_fetch_array(mysql_query("SELECT * FROM bahan where id_bahan='$id'"));
  unlink("../upload/bahan/$cek[gambar]");

  $Q  = mysql_query("DELETE FROM bahan WHERE id_bahan='$id'");

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
