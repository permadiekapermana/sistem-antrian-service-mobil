<?php
error_reporting(0);
include "../config/koneksi.php";

$id_user        = $_POST['id_user'];
$username       = $_POST['username'];
$pass           = md5($_POST['password']);
$pass2           = md5($_POST['password2']);
$nama_lengkap   = $_POST['nama_lengkap'];
$alamat         = $_POST['alamat'];
$no_hp          = $_POST['no_hp'];
$level          = 'Pelanggan';
$blokir         = 'N';
$id_mobil       = $_POST['id_mobil'];
$nopol          = $_POST['nopol'];
$nama_mobil     = $_POST['nama_mobil'];
// pastikan username dan password adalah berupa huruf atau angka.

$login=mysql_query("SELECT username FROM `users` WHERE username = '$username'");
$ketemu=mysql_num_rows($login);

if ($_POST['password']==$_POST['password2'] ) {
  //proses simpan data, $_POST['pw'] dan $_POST['pw1'] adalah name dari masing masing text password 
  


if ($ketemu > 0){

  echo"<script>alert('Username yang anda pakai telah digunakan !');history.go(-1);</script>";
}
else{

  $query = mysql_query("INSERT INTO users (id_user, username, password, nama_lengkap, alamat, no_hp, level, blokir) 
  VALUES ('$id_user', '$username','$pass','$nama_lengkap', '$alamat', '$no_hp','$level', '$blokir')");
  mysql_query("INSERT INTO mobil (id_mobil, id_user, nopol, nama_mobil) 
  VALUES ('$id_mobil', '$id_user', '$nopol','$nama_mobil')"); 
  echo"<script>alert('Anda berhasil terdaftar di Sistem!');history.go(-2);</script>";
    
}

}else {
  echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
  }

?>