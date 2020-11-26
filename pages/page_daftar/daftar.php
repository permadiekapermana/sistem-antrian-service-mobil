<?php
include "../config/koneksi.php";
include "../config/library.php";

$pel="SRVC.";
$y=substr($pel,0,4);
$query=mysql_query("select * from service where substr(id_service,1,4)='$y' order by id_service desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_service'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_daftar/aksi_daftar.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Silahkan Pilih Paket Service Anda
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Paket Service</th>
            <th>Nama Paket</th>
            <th>Deskripsi Paket</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID Paket Service</th>
            <th>Nama Paket</th>
            <th>Deskripsi Paket</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        $tampil = mysql_query("SELECT * FROM `paket` ORDER BY id_paket DESC");                    
        $no = 1;
        while($r=mysql_fetch_array($tampil)){

        $jasa       = mysql_query("SELECT * FROM `jasa_service` WHERE id_jasa='$r[id_jasa]'");
        $harga_jasa =mysql_fetch_array($jasa);
        $bahan       = mysql_query("SELECT
        SUM(`bahan`.`harga`) AS harga_bahan
      FROM
        `bahan`
        INNER JOIN `detail_paket` ON `detail_paket`.`id_bahan` = `bahan`.`id_bahan`
        INNER JOIN `paket` ON `detail_paket`.`id_paket` = `paket`.`id_paket` WHERE paket.id_paket='$r[id_paket]'");
        $harga_bahan =mysql_fetch_array($bahan);

        $total_harga  = $harga_jasa['harga_jasa'] + $harga_bahan['harga_bahan'];

        ?>
          <tr>
            <td><?= $r[id_paket] ?></td>
            <td><?= $r[nama_paket] ?></td>
            <td><?= $r[deskripsi] ?></td>
            <td><?php echo" Rp. $total_harga ";?></td>
            <td width='5%'><a href="<?php echo"?page=DaftarService&act=infopaket&id=$r[id_paket]"; ?>" class="btn btn-sm btn-info"> Pilih </a></td>
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

case "tambahpaket":
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Tambah Data Paket Service
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataPaket&act=input";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>ID Paket Service</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_paket' id='id_paket' value='<?= $nopel ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Paket Service diisi sistem otomatis!</small></div>
            <input type='hidden' name='id_paket' id='id_paket' value='<?= $nopel ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Nama Paket Service</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_paket' id='nama_paket'  placeholder='Masukkan Nama Paket Service' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_jasa' class='form-control-label'>Jasa Service</label></div>
          <div class='col-9 col-md-6'>
            <select name='id_jasa' class='form-control' tabindex='1' required>
              <option value=''>-- Pilih Jasa Service --</option>
              <?php
              $tampil=mysql_query("SELECT * FROM jasa_service ORDER BY id_jasa DESC");
              while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_jasa]>$r[nama_jasa] - $r[harga_jasa]</option>";
              }
              ?>
            </select>
        </div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='deskripsi' class='form-control-label'>Deskripsi Paket Service</label></div>
            <div class='col-9 col-md-6'><textarea type='text' name='deskripsi' id='deskripsi'  placeholder='Masukkan Deskripsi Paket Service' class='form-control' required></textarea></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='bahan' class='form-control-label'>Bahan</label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-12'>
            <?php
            $tampil=mysql_query("SELECT * FROM bahan ORDER BY id_bahan DESC");
            while($r=mysql_fetch_array($tampil)){
            echo "  
            <input type='checkbox' name='id_bahan[]' id='id_bahan' value='$r[id_bahan]'> $r[nama_bahan] - $r[deskripsi]<br>";
            }
            ?>
        </div>
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

case "infopaket":
$edit = mysql_query("SELECT * FROM paket WHERE id_paket='$_GET[id]'");
$r    = mysql_fetch_array($edit);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Paket Service
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DaftarService&act=input";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
    <input type='hidden' name='id_service' value='<?= $nopel ?>' class='form-control' >
    <input type='hidden' name='id_paket' value='<?= $_GET[id] ?>' class='form-control' >
    <?php
    $pos = mysql_query("SELECT * FROM `pos` ORDER BY total_waktu ASC");
    $r2    = mysql_fetch_array($pos);
    ?>
    <input type='hidden' name='id_pos' value='<?= $r2[id_pos] ?>' class='form-control' >
    <?php
    $mobil = mysql_query("SELECT * FROM `mobil` WHERE id_user='$_SESSION[id_user]'");
    $r3    = mysql_fetch_array($mobil);
    ?>
    <input type='hidden' name='id_mobil' value='<?= $r3[id_mobil] ?>' class='form-control' >
    <input type='hidden' name='tgl_service' value='<?= $tgl_sekarang ?>' class='form-control' >
    <input type='hidden' name='jam_service' value='<?= $jam_sekarang ?>' class='form-control' >
    <?php
    $jasa_service       = mysql_query("SELECT * FROM `jasa_service` WHERE id_jasa='$r[id_jasa]'");
    $jasa =mysql_fetch_array($jasa_service);
    ?>
    <input type='hidden' name='lama_pengerjaan' value='<?= $jasa[lama_pengerjaan] ?>' class='form-control' >
    <?php
        $jasa       = mysql_query("SELECT * FROM `jasa_service` WHERE id_jasa='$r[id_jasa]'");
        $harga_jasa =mysql_fetch_array($jasa);
        $bahan       = mysql_query("SELECT
        SUM(`bahan`.`harga`) AS harga_bahan
      FROM
        `bahan`
        INNER JOIN `detail_paket` ON `detail_paket`.`id_bahan` = `bahan`.`id_bahan`
        INNER JOIN `paket` ON `detail_paket`.`id_paket` = `paket`.`id_paket` WHERE paket.id_paket='$r[id_paket]'");
        $harga_bahan =mysql_fetch_array($bahan);

        $total_harga  = $harga_jasa['harga_jasa'] + $harga_bahan['harga_bahan'];

        ?>
    <input type='hidden' name='total_biaya' value='<?= $total_harga ?>' class='form-control' >
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
        <div class='col col-md-3'><label for='bahan' class='form-control-label'>Bahan</label></div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Gambar</th>
                <th>Nama Bahan</th>
                <th>Deskripsi</th>
                <th>Harga</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $tampil = mysql_query("SELECT
            *
          FROM
            `detail_paket`
            INNER JOIN `bahan` ON `bahan`.`id_bahan` = `detail_paket`.`id_bahan` WHERE id_paket='$r[id_paket]' ORDER BY bahan.id_bahan DESC");                    
            $no = 1;
            while($r=mysql_fetch_array($tampil)){
            ?>
              <tr>
                <td width='105px'><img src='upload/bahan/<?= $r[gambar] ?>' border='3' height='100' width='100'></td>
                <td><?= $r[nama_bahan] ?></td>
                <td><?= $r[deskripsi] ?></td>
                <td>Rp. <?= $r[harga] ?></td>
            <?php
            $no++;
            }
            ?>
              </tr>
            </tbody>
          </table>
        </div>
        <div class='form-group'>
            <div class='col col-md-3'></div>
            <div class='col-9 col-md-6'>
                <button class='btn btn-danger btn-sm' type='button' onclick=self.history.back()>Kembali</button>
                <button type='submit' class='btn btn-primary btn-sm'>Pilih Paket Service</button>  
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