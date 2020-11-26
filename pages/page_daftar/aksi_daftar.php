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
if ($page=='DaftarService' AND $act=='input'){

$id_service     = $_POST['id_service'];
$id_paket       = $_POST['id_paket'];
$id_pos       = $_POST['id_pos'];
$id_mobil       = $_POST['id_mobil'];
$lama_pengerjaan       = $_POST['lama_pengerjaan'];
$converted_time = decimal_to_time($lama_pengerjaan);
$total_biaya       = $_POST['total_biaya'];

$mobil_user       = mysql_query("SELECT * FROM `mobil` WHERE id_user='$_SESSION[id_user]'");
$mobil =mysql_fetch_array($mobil_user);
$user=mysql_query("SELECT * FROM service WHERE id_mobil='$mobil[id_mobil]' AND (status='Dalam Antrian' OR status='Selanjutnya' OR status='Diproses')");
$ketemu_user=mysql_num_rows($user);
// fungsi untuk membatasi 1 user hanya dapat 1x service
if($ketemu_user > 0){

  echo "<script>alert('Anda sudah ada dalam daftar antrian service, mohon tunggu hingga service selesai untuk service kembali !');history.go(-1)</script>";

}
// Service sebelum jam 08.00
elseif($jam_sekarang<'07:59:00'){

  echo "<script>alert('Bengkel masih belum buka, silahkan coba kembali pukul 08.00 WIB!');history.go(-1)</script>";

}
else{

$pos=mysql_query("SELECT * FROM service WHERE id_pos='$id_pos' AND tgl_service='$tgl_sekarang' AND (status='Dalam Antrian' OR status='Selanjutnya')");
$ketemu=mysql_num_rows($pos);

  if ($ketemu > 0){
    // ada antrian dalam POS
    // cek antrian terakhir selesai, dan jumlahkan dengan waktu total service apakah lebih dari jam 17.00
    $antrian_terakhir       = mysql_query("SELECT * FROM `service` ORDER BY jam_selesai DESC");
    $a =mysql_fetch_array($antrian_terakhir);
    $b  = $a['jam_selesai'] ;
    // ambil jam selesai service      
    $time_total = sum_the_time($converted_time, $b);
    if($time_total>'17:00:00'){

      echo "<script>alert('Mohon maaf, antrian hari sudah penuh. Silahkan mendaftar kembali esok hari!');history.go(-1)</script>";
    
    }    
    else{
    // ada antrian dalam POS dan jam selesai sebelum jam 17.00
    // cek antrian terakhir selesai, dan jumlahkan dengan waktu total service
    $antrian_terakhir       = mysql_query("SELECT * FROM `service` ORDER BY jam_selesai DESC");
    $a =mysql_fetch_array($antrian_terakhir);
    $b  = $a['jam_selesai'] ;
    // ambil jam selesai service      
    $time_total = sum_the_time($converted_time, $b);
    // ambil nomor antrian
    $no_antrian       = mysql_query("SELECT COUNT(`service`.`id_service`) AS total_antrian FROM `service` WHERE tgl_service='$tgl_sekarang'");
    $no =mysql_fetch_array($no_antrian);
    $nomor = $no['total_antrian'] + 1;
    // tambah waktu POS
    $pos_service       = mysql_query("SELECT * FROM `pos` WHERE id_pos='$id_pos'");
    $pos =mysql_fetch_array($pos_service);
    $total_pos = $pos['total_waktu'] + $lama_pengerjaan;

    if($time_total>'17:00:00'){

      echo "<script>alert('Mohon maaf, antrian hari sudah penuh. Silahkan mendaftar kembali esok hari!');history.go(-1)</script>";
    
    }
    else{
    
    $Q=mysql_query("INSERT INTO service (id_service, id_paket, id_pos, id_mobil, no_antrian, tgl_service, jam_service, jam_mulai, jam_selesai, total_biaya, status) VALUES ('$id_service', '$id_paket', '$id_pos', '$id_mobil', '$nomor', '$tgl_sekarang', '$jam_sekarang', '$b', '$time_total', '$total_biaya', 'Dalam Antrian')");
    mysql_query("UPDATE pos SET total_waktu='$total_pos' WHERE id_pos='$id_pos'");

    if($Q) {
      header('location:../menu.php?page=Status');
    }
    else{
      echo "<script>alert('Gagal menyimpan data!')</script>";
      echo "<script>window.location = '../menu.php?page=$page';</script>";
    }
  }

    }

  }
  else{
    // tidak ada antrian sama sekali di POS dan jam service melebihi jam 17.00
    // ambil jam selesai service      
    $time_total = sum_the_time($converted_time, $jam_sekarang);
    if($time_total>'17:00:00'){

      echo "<script>alert('Mohon maaf, antrian hari sudah penuh. Silahkan mendaftar kembali esok hari!');history.go(-1)</script>";
    
    }
    else{
      // tidak ada antrian di POS dan jam service sebelum jam 17.00
      // ambil nomor antrian
      $no_antrian       = mysql_query("SELECT COUNT(`service`.`id_service`) AS total_antrian FROM `service` WHERE tgl_service='$tgl_sekarang'");
      $no =mysql_fetch_array($no_antrian);
      $nomor = $no['total_antrian'] + 1;
      // ambil jam selesai service      
      $time_total = sum_the_time($converted_time, $jam_sekarang);
      // tambah waktu POS
      $pos_service       = mysql_query("SELECT * FROM `pos` WHERE id_pos='$id_pos'");
      $pos =mysql_fetch_array($pos_service);
      $total_pos = $pos['total_waktu'] + $lama_pengerjaan;

      $Q=mysql_query("INSERT INTO service (id_service, id_paket, id_pos, id_mobil, no_antrian, tgl_service, jam_service, jam_mulai, jam_selesai, total_biaya, status) VALUES ('$id_service', '$id_paket', '$id_pos', '$id_mobil', '$nomor', '$tgl_sekarang', '$jam_sekarang', '$jam_sekarang', '$time_total', '$total_biaya', 'Selanjutnya')");
      mysql_query("UPDATE pos SET total_waktu='$total_pos' WHERE id_pos='$id_pos'");
  
      if($Q) {
        header('location:../menu.php?page=Status');
      }
      else{
        echo "<script>alert('Gagal menyimpan data!')</script>";
        echo "<script>window.location = '../menu.php?page=$page';</script>";
      }
    }

  }

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
