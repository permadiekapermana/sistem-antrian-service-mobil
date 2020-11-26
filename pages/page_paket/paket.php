<?php
include "../config/koneksi.php";

$pel="PAKT.";
$y=substr($pel,0,4);
$query=mysql_query("select * from paket where substr(id_paket,1,4)='$y' order by id_paket desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_paket'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_paket/aksi_paket.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=DataPaket&act=tambahpaket" class="btn btn-primary">
        Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
            <td width='13%'><a href="<?php echo"?page=DataPaket&act=editpaket&id=$r[id_paket]"; ?>" class="btn btn-sm btn-warning"> Edit </a> <a href="<?php echo" $aksi?page=DataPaket&act=hapus&id=$r[id_paket] "; ?>" class="btn btn-sm btn-danger" <?php echo "onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\" "; ?>> Hapus </a></td>
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

case "editpaket":
$edit = mysql_query("SELECT * FROM paket WHERE id_paket='$_GET[id]'");
$r    = mysql_fetch_array($edit);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Edit Paket Service
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataPaket&act=update";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_paket' class='form-control-label'>ID Paket Service</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_paket' id='id_paket' value='<?= $r[id_paket] ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Paket Service tidak dapat diubah!</small></div>
            <input type='hidden' name='id_paket' id='id_paket' value='<?= $r[id_paket] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Nama Paket Service</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_paket' value='<?= $r[nama_paket] ?>' id='nama_paket'  placeholder='Masukkan Nama Paket Service' class='form-control' required></div>
        </div>
        <div class='row form-group'>
                <div class='col col-md-3'><label for='id_jasa' class='form-control-label'>Jasa Service</label></div>
                <div class='col-9 col-md-6'>
                <select name='id_jasa' class='form-control' tabindex='1' required>
                <?php      
                $tampil=mysql_query("SELECT * FROM jasa_service ORDER BY id_jasa DESC");
                if ($r[id_jasa]==0){
                echo "<option value='' selected>-- Pilih Jasa Service --</option>";
                }   
                while($w=mysql_fetch_array($tampil)){
                if ($r[id_jasa]==$w[id_jasa]){
                echo "<option value=$w[id_jasa] selected>$w[nama_jasa]</option>";
                }
                else{
                echo "<option value=$w[id_jasa]>$w[nama_jasa]</option>";
                }
                }
                ?>
                </select>
                </div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_paket' class='form-control-label'>Deskripsi</label></div>
            <div class='col-9 col-md-6'><textarea type='text' name='deskripsi' id='deskripsi'  placeholder='Masukkan Deskripsi Paket Service' class='form-control' required><?= $r[deskripsi] ?></textarea></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='bahan' class='form-control-label'>Bahan</label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-12'>
            <?php
            $tampil=mysql_query("SELECT * FROM bahan ORDER BY id_bahan DESC");
            while($r2=mysql_fetch_array($tampil)){
            $id_paket=$r['id_paket'];
            $sql=mysql_query("SELECT
            `bahan`.`id_bahan`
          FROM
            `paket`
            INNER JOIN `detail_paket` ON `detail_paket`.`id_paket` = `paket`.`id_paket`
            INNER JOIN `bahan` ON `bahan`.`id_bahan` = `detail_paket`.`id_bahan` WHERE detail_paket.id_paket='$id_paket' AND bahan.id_bahan='$r2[id_bahan]'");
            $data=mysql_fetch_array($sql);
            //data hobi dari tabel siswa 
            $databahan=explode(',', $data['id_bahan']);
            echo "  
            <input type='checkbox' name='id_bahan[]' id='id_bahan' value='$r2[id_bahan]' "; if (in_array("$r2[id_bahan]", $databahan)) echo "checked"; echo"> $r2[nama_bahan] - $r2[deskripsi]<br>";
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
?>

<?php

}

?>