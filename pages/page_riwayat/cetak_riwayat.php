<?php
error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

	function limit_words($string, $word_limit){
		$words = explode(" ",$string);
		return implode(" ",array_splice($words,0,$word_limit));}

include "class.ezpdf.php";
include "../../config/koneksi.php";
include "../../config/library.php";
include "rupiah.php";
define('FPDF_FONTPATH','font/');
require('fpdf_protection.php');
$dari=$_POST[dari];	
$sampai=$_POST[sampai];


	$query= "SELECT
	*, DATE_FORMAT(jam_service, '%H:%i') as `jamservice`, DATE_FORMAT(jam_mulai, '%H:%i') as `jammulai`, DATE_FORMAT(jam_selesai, '%H:%i') as `jamselesai`
  FROM
	`service`
	INNER JOIN `paket` ON `paket`.`id_paket` = `service`.`id_paket`
	INNER JOIN `pos` ON `pos`.`id_pos` = `service`.`id_pos`
	INNER JOIN `mobil` ON `mobil`.`id_mobil` = `service`.`id_mobil`
	INNER JOIN `jasa_service` ON `paket`.`id_jasa` = `jasa_service`.`id_jasa`
	INNER JOIN `users` ON `mobil`.`id_user` = `users`.`id_user`
	WHERE status='Selesai' AND tgl_service Between '$dari' and '$sampai' ORDER BY tgl_service DESC";
	
if (!empty($query))
	  {
	  
	  $baca= mysql_query($query);
	

	$pdf=new FPDF('L','cm','Legal');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(1,3,1);
	$pdf->SetAutoPageBreak(true,3);
	$pdf->SetFont('Arial','B',14);
	// $pdf->Image("images/xxx.jpg",2,1.15,6,'L');
	$pdf->SetFont('Arial','B',16);
	$pdf->Ln();
	$pdf->Cell(0,.6,'Bengkel Body Cat',0,0,'C');
	$pdf->Ln();
	$pdf->Cell(0,.6,'Udin Jaya Cirebon',0,0,'C');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','',14);	
	$pdf->Cell(0,.6,'Jalan Sunan Gunung Jati, Desa Klayan, Gang Muamalah No.100.',0,0,'C');	
	$pdf->Ln();
	$pdf->Cell(0,.6,'Kecamatan Gunung Jati Kabupaten Cirebon 45151 .',0,0,'C');	
	$pdf->Ln();
	$pdf->Cell(0,.6,' Telp. 089666111308.',0,0,'C');	
	$pdf->Ln();
	$pdf->Cell(0,.2,'____________________________________________________________________________________________________________________',0,0,'C');
	$pdf->Ln();
		$pdf->Cell(0,.2,'____________________________________________________________________________________________________________________',0,0,'C');
	$x=$pdf->GetY();
	$pdf->SetY($x+1);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,1,'Laporan Riwayat Service Pelanggan',0,0,'C');
	$pdf->SetFont('Arial','',14);
	$pdf->Ln();


		if (mysql_num_rows ($baca)>0){
	$x=$pdf->GetY();
	$pdf->SetY($x+1);

	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(2.2,1,'Kode buku',1,0,'C');
	$pdf->Cell(2,1,'No.',1,0,'C');
	$pdf->Cell(4,1,'ID Service',1,0,'C');
	$pdf->Cell(5,1,'Nopol Mobil',1,0,'C');
	$pdf->Cell(6,1,'Paket Service',1,0,'C');
	$pdf->Cell(4,1,'Lama Service',1,0,'C');
	$pdf->Cell(4,1,'Jam Mulai',1,0,'C');
	$pdf->Cell(4,1,'Jam Selesai',1,0,'C');
	$pdf->Cell(4,1,'POS Service',1,0,'C');



	$pdf->Ln();
	
	
	
while ($hasil=mysql_fetch_array($baca))
{
	$no++;

	$limited_string = limit_words($hasil['nama_paket'], 3.5);
	
	 $pdf->SetFont('Arial','',12);
	//$pdf->Cell(2.2,1,$hasil[kode_buku],1,0,'C');
	$pdf->Cell(2,1,$no.'.',1,0,'C');
	$pdf->Cell(4,1,$hasil['id_service'],1,0,'L');
	$pdf->Cell(5,1,$hasil['nopol'],1,0,'L');
	$pdf->Cell(6,1,$limited_string.'...',1,0,'L');
	$pdf->Cell(4,1,$hasil['lama_pengerjaan'],1,0,'C');
	$pdf->Cell(4,1,$hasil['jammulai'],1,0,'C');
	$pdf->Cell(4,1,$hasil['jamselesai'],1,0,'C');
	$pdf->Cell(4,1,$hasil['nama_pos'],1,0,'C');

	$pdf->Ln();
	
	}
	
	$x=$pdf->GetY();
	$pdf->SetY($x+2);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(15,0.5,'');
	$pdf->Cell(0,0.5,'Mengetahui,',0,0,'C');
	$pdf->Ln();
	$pdf->Cell(15,0.5,'');
	$pdf->Cell(0,0.5,'Karyawan ',0,0,'C');
	$pdf->Ln();
	$pdf->Cell(15,0.5,'');
	$pdf->Cell(0,0.5,'Bengkel Body Cat Udin Jaya',0,0,'C');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(15,0.5,'');
	$pdf->Cell(0,0.5,$_SESSION[namalengkap],0,0,'C');
	$pdf->Ln();
	
	}
	$pdf->Output();
	}}
?>
