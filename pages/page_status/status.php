<?php
include "../config/koneksi.php";
include "../config/library.php";

$mobil = mysql_query("SELECT * FROM `mobil` WHERE id_user='$_SESSION[id_user]'");
$r3    = mysql_fetch_array($mobil);

$service=mysql_query("SELECT * FROM service WHERE id_mobil='$r3[id_mobil]' AND tgl_service='$tgl_sekarang' AND (status='Dalam Antrian' OR status='Selanjutnya' OR status='Diproses')");
$ketemu=mysql_num_rows($service);
$r2    = mysql_fetch_array($service);

switch($_GET[act]){
  default:

if ($ketemu > 0){
$mobil = mysql_query("SELECT * FROM `mobil` WHERE id_user='$_SESSION[id_user]'");
$r3    = mysql_fetch_array($mobil);

$service=mysql_query("SELECT * FROM service WHERE id_mobil='$r3[id_mobil]' AND tgl_service='$tgl_sekarang' AND (status='Dalam Antrian' OR status='Selanjutnya' OR status='Diproses')");
$ketemu=mysql_num_rows($service);
$r2    = mysql_fetch_array($service);

$edit = mysql_query("SELECT * FROM service WHERE id_mobil='$r2[id_mobil]' ORDER BY id_service DESC");
$r    = mysql_fetch_array($edit);


$paket = mysql_query("SELECT * FROM paket WHERE id_paket='$r[id_paket]'");
$p    = mysql_fetch_array($paket);

$pos = mysql_query("SELECT * FROM pos WHERE id_pos='$r[id_pos]'");
$po    = mysql_fetch_array($pos);

$jasa_service = mysql_query("SELECT * FROM jasa_service WHERE id_jasa='$p[id_jasa]'");
$harga_jasa    = mysql_fetch_array($jasa_service);

        $bahan       = mysql_query("SELECT
        SUM(`bahan`.`harga`) AS harga_bahan
      FROM
        `bahan`
        INNER JOIN `detail_paket` ON `detail_paket`.`id_bahan` = `bahan`.`id_bahan`
        INNER JOIN `paket` ON `detail_paket`.`id_paket` = `paket`.`id_paket` WHERE paket.id_paket='$r[id_paket]'");
        $harga_bahan =mysql_fetch_array($bahan);

        $total_harga  = $harga_jasa['harga_jasa'] + $harga_bahan['harga_bahan'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Status Service Kendaraan Pelanggan
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DaftarService&act=input";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <button class='float-right btn btn-sm btn-info' onclick="printDiv('printMe')">Print Antiran</button>
    <br>
    <div class='col-lg-12'>
        <div class='row form-group'>
          <div class='col col-md-12'><label for='bahan' class='form-control-label'><b>Detail Paket</b></label></div>
        </div>  
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>ID Paket Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $p[id_paket] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Nama Paket Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $p[nama_paket] ?></label></div>
        </div>        
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Deskripsi</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $p[deskripsi] ?></label></div>
        </div> 
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Lama Pengerjaan</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?php echo" $harga_jasa[lama_pengerjaan] Menit "; ?></label></div>
        </div>
        <div id='printMe'>
        <div class='row form-group'>
          <div class='col col-md-12'><label for='bahan' class='form-control-label'><b>Detail Service</b></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>ID Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[id_service] ?></label></div>
        </div> 
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>POS Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $po[nama_pos] ?></label></div>
        </div> 
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Nomor Antrian</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[no_antrian] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Tanggal Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[tgl_service] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Jam Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[jam_service] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Jam Mulai Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[jam_mulai] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Jam Selesai</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[jam_selesai] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Status Service</label></div>
            <div class='col-9 col-md-6'>
            <label for='id_paket' class='form-control-label'>
              <?php
                $time = date('H:i:s');
                if($r[status] == 'Selanjutnya' AND $r[jam_selesai] < $time) {
                  $status = "Kadaluwarsa";
                } else {
                  $status = $r[status];
                }
              ?>
              <?= $status ?>
            </label></div>
        </div>
        </div>
        <div class='row form-group'>
          <div class='col col-md-12'><label for='bahan' class='form-control-label'><b>Detail Biaya Service</b></label></div>
        </div>                
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Harga Jasa Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?php echo" Rp. $harga_jasa[harga_jasa] "; ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Harga Bahan</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?php echo" Rp. $harga_bahan[harga_bahan] "; ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Total Harga Paket Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?php echo" Rp. $total_harga "; ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-12'><label for='bahan' class='form-control-label'><font color="green">* Admin akan mengirimkan pesan pemberitahuan kepada Anda apabila kendaraan telah selesai di Service melalui pesan WhatsApp. Harap pastikan nomor HP yang ada pada profil pelanggan sesuai dengan nomor WhatsApp yang sedang digunakan saat ini.</font></label></div>
        </div>
        
    </div>
    </form>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php

}else{
  echo "<script>alert('Anda tidak mempunyai antrian service yang sedang berjalan, silahkan lakukan order service !');history.go(-1)</script>";
}

}

?>

<script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
</script>