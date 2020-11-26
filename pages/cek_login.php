<?php

include "../config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  echo "<script>alert('Terdapat aktivitas mencurigakan, terdeteksi percobaan injeksi Website!');history.go(-1)</script>";
}
else{
$login=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' and blokir='N' ");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
$login2=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' and blokir='Y'");
$ketemu2=mysql_num_rows($login2);
$r2=mysql_fetch_array($login2);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  include "timeout.php";

    $_SESSION[namauser]     = $r[username];
    $_SESSION[id_user]     = $r[id_user];
    $_SESSION[namalengkap]  = $r[nama_lengkap];
    $_SESSION[passuser]     = $r[password];
    $_SESSION[leveluser]    = $r[level];
  
  // session timeout
  $_SESSION[login] = 1;
  timer();

	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();

  mysql_query("UPDATE users SET id_session='$sid_baru' WHERE username='$username'");
  header('location:menu.php?page=Dashboard');
}
elseif ($ketemu2 > 0){
  echo "<script>alert('Anda tidak lagi memiliki akses ke dalam Sistem!');history.go(-1)</script>";
}
else{
  echo "<script>alert('Username atau Password yang anda masukkan salah!');history.go(-1)</script>";
}
}
?>
