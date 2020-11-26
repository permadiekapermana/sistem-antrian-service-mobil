<?php
include "../config/koneksi.php";

$pel="MKNK.";
$y=substr($pel,0,4);
$query=mysql_query("select * from mekanik where substr(id_mekanik,1,4)='$y' order by id_mekanik desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_mekanik'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_riwayat/aksi_riwayat.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
        Riwayat Service Pelanggan
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <?php
    if($_SESSION[leveluser]=='Admin'){
    ?>
    <form class='form-horizontal' action='page_riwayat/cetak_riwayat.php' target='_blank' method='post'>
                    
                    <fieldset>
                      <div class='control-group'>
                        <div class='controls'>
                          <div class='input-prepend input-group'>
                            <input type='date' style='width: 200px' name='dari'  class='form-control' title='Dari tanggal' required/>
                            <input type='date' style='width: 200px' name='sampai'  class='form-control' title='Sampai tanggal' required/>
                            <button class='btn btn-success' type='submit'><i class='fa fa-print'></i> Cetak Riwayat Service</button>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </form>    
    <br> <br>
    <?php
    }
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>ID Service</th>
            <th>Nopol Mobil</th>
            <th>Paket Service</th>
            <th>Lama Service</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>POS Service</th>
            <th>Status Service</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No.</th>
            <th>ID Service</th>
            <th>Nopol Mobil</th>
            <th>Paket Service</th>
            <th>Lama Service</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>POS Service</th>
            <th>Status Service</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        if($_SESSION[leveluser]=='Admin'){
        $tampil = mysql_query("SELECT
        *, DATE_FORMAT(jam_service, '%H:%i') as `jamservice`, DATE_FORMAT(jam_mulai, '%H:%i') as `jammulai`, DATE_FORMAT(jam_selesai, '%H:%i') as `jamselesai`
      FROM
        `service`
        INNER JOIN `paket` ON `paket`.`id_paket` = `service`.`id_paket`
        INNER JOIN `pos` ON `pos`.`id_pos` = `service`.`id_pos`
        INNER JOIN `mobil` ON `mobil`.`id_mobil` = `service`.`id_mobil`
        INNER JOIN `jasa_service` ON `paket`.`id_jasa` = `jasa_service`.`id_jasa`
        INNER JOIN `users` ON `mobil`.`id_user` = `users`.`id_user`
        WHERE status='Selesai' ORDER BY tgl_service DESC");
        }
        else{
          $mobil_user       = mysql_query("SELECT * FROM `mobil` WHERE id_user='$_SESSION[id_user]'");
          $mobil =mysql_fetch_array($mobil_user);
          $tampil = mysql_query("SELECT
        *, DATE_FORMAT(jam_service, '%H:%i') as `jamservice`, DATE_FORMAT(jam_mulai, '%H:%i') as `jammulai`, DATE_FORMAT(jam_selesai, '%H:%i') as `jamselesai`
      FROM
        `service`
        INNER JOIN `paket` ON `paket`.`id_paket` = `service`.`id_paket`
        INNER JOIN `pos` ON `pos`.`id_pos` = `service`.`id_pos`
        INNER JOIN `mobil` ON `mobil`.`id_mobil` = `service`.`id_mobil`
        INNER JOIN `jasa_service` ON `paket`.`id_jasa` = `jasa_service`.`id_jasa`
        INNER JOIN `users` ON `mobil`.`id_user` = `users`.`id_user`
        WHERE status='Selesai' AND mobil.id_mobil='$mobil[id_mobil]' ORDER BY tgl_service DESC");
        }
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $r[id_service] ?></td>
            <td><?= $r[nopol] ?></td>
            <td><?= $r[nama_paket] ?></td>
            <td><?= $r[lama_pengerjaan] ?> Menit</td>
            <td><?= $r[jammulai] ?></td>
            <td><?= $r[jamselesai] ?></td>
            <td><?= $r[nama_pos] ?></td>
            <td><?= $r[status] ?></td>
            <td width='5%'><a href="<?php echo" ?page=Riwayat&act=detail&id=$r[id_service]&id_pos=$r[id_pos]"; ?>" class="btn btn-sm btn-info">Detail</a></td>
        <?php
        $no++;
        }
        ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
break;

case "detail":

$tampil = mysql_query("SELECT *, DATE_FORMAT(jam_service, '%H:%i') as `jamservice`, DATE_FORMAT(jam_mulai, '%H:%i') as `jammulai`, DATE_FORMAT(jam_selesai, '%H:%i') as `jamselesai` FROM `service` INNER JOIN `paket` ON `paket`.`id_paket` = `service`.`id_paket` INNER JOIN `pos` ON `pos`.`id_pos` = `service`.`id_pos` INNER JOIN `mobil` ON `mobil`.`id_mobil` = `service`.`id_mobil` INNER JOIN `jasa_service` ON `paket`.`id_jasa` = `jasa_service`.`id_jasa` WHERE id_service='$_GET[id]'");
$r=mysql_fetch_array($tampil);

$kendaraan = mysql_query("SELECT * FROM `mobil`  WHERE id_mobil='$r[id_mobil]'");
$k=mysql_fetch_array($kendaraan);

$pelanggan = mysql_query("SELECT * FROM `users`  WHERE id_user='$k[id_user]'");
$p=mysql_fetch_array($pelanggan);

$jasa_service = mysql_query("SELECT * FROM jasa_service WHERE id_jasa='$r[id_jasa]'");
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
    Riwayat Service
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataService&act=konfirm";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <!-- <?php
    if($_SESSION[leveluser]=='Admin'){
    ?>
    <a href="?page=DataJasa&act=tambahjasa" class="btn btn-success btn-sm">
        Cetak Laporan
    </a>
    <br> <br>
    <?php
    }
    ?> -->
    <div class='col-lg-12'>
        <div class='row form-group'>
          <div class='col col-md-12'><label for='bahan' class='form-control-label'><b>Detail Pelanggan</b></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>ID Pelanggan</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $p[id_user] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>Nama Pelanggan</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $p[nama_lengkap] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>Alamat</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $p[alamat] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>Nomor Handphone</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $p[no_hp] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>Nomor Polisi</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $k[nopol] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>Nama Kendaraan</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $k[nama_mobil] ?></label></div>
        </div>
        <div class='row form-group'>
          <div class='col col-md-12'><label for='bahan' class='form-control-label'><b>Detail Paket</b></label></div>
        </div>  
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>ID Paket Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[id_paket] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Nama Paket Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[nama_paket] ?></label></div>
        </div>        
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Deskripsi</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[deskripsi] ?></label></div>
        </div> 
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Lama Pengerjaan</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?php echo" $harga_jasa[lama_pengerjaan] Menit "; ?></label></div>
        </div>   
        <div class='row form-group'>
          <div class='col col-md-12'><label for='bahan' class='form-control-label'><b>Detail Service</b></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>ID Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[id_service] ?></label></div>
            <input type="hidden" value="<?= $r[id_service] ?>" name="id_service">
            <input type="hidden" value="<?= $r[id_pos] ?>" name="id_pos">
        </div> 
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>POS Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[nama_pos] ?></label></div>
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
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[jamservice] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Waktu Tunggu</label></div>
        <?php
        $awal  = strtotime($r[jam_service]);
        $akhir = strtotime($r[jam_mulai]);
        $diff  = $akhir - $awal;
        
        $jam   = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        $menit2 = floor( $menit / 60 );
        ?>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?php echo"$jam Jam $menit2 Menit"; ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Jam Mulai Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[jammulai] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Jam Selesai</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[jamselesai] ?></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Status Service</label></div>
            <div class='col-9 col-md-6'><label for='id_paket' class='form-control-label'><?= $r[status] ?></label></div>
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
        
    </div>
    </form>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
break;

case "editmekanik":
$edit = mysql_query("SELECT * FROM mekanik WHERE id_mekanik='$_GET[id]'");
$r    = mysql_fetch_array($edit);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Edit Mekanik
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataMekanik&act=update";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_mekanik' class='form-control-label'>ID Mekanik</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_mekanik' id='id_mekanik' value='<?= $r[id_mekanik] ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Mekanik tidak dapat diubah!</small></div>
            <input type='hidden' name='id_mekanik' id='id_mekanik' value='<?= $r[id_mekanik] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_mekanik' class='form-control-label'>Nama Mekanik</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_mekanik' value='<?= $r[nama_mekanik] ?>' id='nama_mekanik'  placeholder='Masukkan Nama Mekanik' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='alamat' class='form-control-label'>Alamat</label></div>
            <div class='col-9 col-md-6'><textarea type='text'  name='alamat' id='alamat'  placeholder='Masukkan Alamat Mekanik' class='form-control' required><?= $r[alamat] ?></textarea></div>
        </div>
        <div class='form-group'>
            <div class='col col-md-3'></div>
            <div class='col-9 col-md-6'>
                <button class='btn btn-danger btn-sm' type='button' onclick=self.history.back()>Cancel</button>
                <button class='btn btn-warning btn-sm' type='reset'>Reset</button>
                <button type='submit' class='btn btn-primary btn-sm'>Submit</button>  
            </div>      
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
break;
?>

<?php

}

?>