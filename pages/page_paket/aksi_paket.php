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
if ($page=='DataPaket' AND $act=='input'){

  

$id_paket         = $_POST['id_paket'];
$id_jasa             = $_POST['id_jasa'];
$nama_paket           = $_POST['nama_paket'];
$deskripsi           = $_POST['deskripsi'];
$id_bahan         = $_POST['id_bahan'];
$id_detail         = $_POST['id_detail'];
$id_paket2         = $_POST['id_paket2'];
$jumlah           = count($id_bahan);

for ($i=0; $i < $jumlah; $i++){

  $pel2="DPKT.";
  $y2=substr($pel2,0,4);
  $query2=mysql_query("select * from detail_paket where substr(id_detail,1,4)='$y2' order by id_detail desc limit 0,1");
  $row2=mysql_num_rows($query2);
  $data2=mysql_fetch_array($query2);
  if ($row2>0){
  $no2=substr($data2['id_detail'],-6)+1;}
  else{
  $no2=1;
  }
  $nourut2=1000000+$no2;
  $nopel2=$pel2.substr($nourut2,-6);

  mysql_query("INSERT INTO detail_paket(id_detail,
              id_paket,
              id_bahan) 
            VALUES('$nopel2',
            '$id_paket',
            '$id_bahan[$i]')");	
    
}

  $Q=mysql_query("INSERT INTO paket (id_paket, id_jasa, nama_paket, deskripsi) VALUES ('$id_paket', '$id_jasa', '$nama_paket', '$deskripsi')");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }


  
}

// Update perangkatdesa
elseif ($page=='DataPaket' AND $act=='update'){

  $id_paket         = $_POST['id_paket'];
  $id_jasa             = $_POST['id_jasa'];
  $nama_paket           = $_POST['nama_paket'];
  $deskripsi           = $_POST['deskripsi'];
  $id_bahan         = $_POST['id_bahan'];
  $id_detail         = $_POST['id_detail'];
  $id_paket2         = $_POST['id_paket2'];
  $jumlah           = count($id_bahan);

  mysql_query("DELETE FROM detail_paket WHERE id_paket='$id_paket'");

  for ($i=0; $i < $jumlah; $i++){

    $pel2="DPKT.";
    $y2=substr($pel2,0,4);
    $query2=mysql_query("select * from detail_paket where substr(id_detail,1,4)='$y2' order by id_detail desc limit 0,1");
    $row2=mysql_num_rows($query2);
    $data2=mysql_fetch_array($query2);
    if ($row2>0){
    $no2=substr($data2['id_detail'],-6)+1;}
    else{
    $no2=1;
    }
    $nourut2=1000000+$no2;
    $nopel2=$pel2.substr($nourut2,-6);
  
    mysql_query("INSERT INTO detail_paket(id_detail,
                id_paket,
                id_bahan) 
              VALUES('$nopel2',
              '$id_paket',
              '$id_bahan[$i]')");	
      
  }

  $Q=mysql_query("UPDATE paket SET id_jasa='$id_jasa', nama_paket='$nama_paket', deskripsi='$deskripsi' WHERE id_paket='$id_paket'");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }



  

  
}

elseif ($page=='DataPaket' AND $act=='hapus'){
  
  $id = $_GET[id];

  $Q  = mysql_query("DELETE FROM detail_paket WHERE id_paket='$id'");
  mysql_query("DELETE FROM paket WHERE id_paket='$id'");  

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
