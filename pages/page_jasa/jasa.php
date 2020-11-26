<?php
include "../config/koneksi.php";

$pel="JASA.";
$y=substr($pel,0,4);
$query=mysql_query("select * from jasa_service where substr(id_jasa,1,4)='$y' order by id_jasa desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_jasa'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_jasa/aksi_jasa.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=DataJasa&act=tambahjasa" class="btn btn-primary">
        Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Jasa</th>
            <th>Nama Jasa</th>
            <th>Harga Jasa</th>
            <th>Lama Pengerjaan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID Jasa</th>
            <th>Nama Jasa</th>
            <th>Harga Jasa</th>
            <th>Lama Pengerjaan</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        $tampil = mysql_query("SELECT * FROM `jasa_service` ORDER BY id_jasa DESC");                    
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        ?>
          <tr>
            <td><?= $r[id_jasa] ?></td>
            <td><?= $r[nama_jasa] ?></td>
            <td>Rp. <?= $r[harga_jasa] ?></td>
            <td><?= $r[lama_pengerjaan] ?> Menit</td>
            <td width='13%'><a href="<?php echo"?page=DataJasa&act=editjasa&id=$r[id_jasa]"; ?>" class="btn btn-sm btn-warning"> Edit </a> <a href="<?php echo" $aksi?page=DataJasa&act=hapus&id=$r[id_jasa] "; ?>" class="btn btn-sm btn-danger" <?php echo "onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\" "; ?>> Hapus </a></td>
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

case "tambahjasa":
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Tambah Jasa
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataJasa&act=input";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_jasa' class='form-control-label'>ID Jasa</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_jasa' id='id_jasa' value='<?= $nopel ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Jasa diisi sistem otomatis!</small></div>
            <input type='hidden' name='id_jasa' id='id_jasa' value='<?= $nopel ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_jasa' class='form-control-label'>Nama Jasa</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_jasa' id='nama_jasa'  placeholder='Masukkan Nama Jasa' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='harga_jasa' class='form-control-label'>Harga Jasa (Rp.)</label></div>
            <div class='col-9 col-md-6'><input type='number' name='harga_jasa' id='harga_jasa'  placeholder='Masukkan Harga Jasa' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='lama_pengerjaan' class='form-control-label'>Lama Pengerjaan (Menit)</label></div>
            <div class='col-9 col-md-6'><input type='number' name='lama_pengerjaan' id='lama_pengerjaan'  placeholder='Masukkan Lama Pengerjaan' class='form-control' required></div>
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

case "editjasa":
$edit = mysql_query("SELECT * FROM jasa_service WHERE id_jasa='$_GET[id]'");
$r    = mysql_fetch_array($edit);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Edit Jasa
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataJasa&act=update";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_jasa' class='form-control-label'>ID Jasa</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_jasa' id='id_jasa' value='<?= $r[id_jasa] ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Jasa tidak dapat diubah!</small></div>
            <input type='hidden' name='id_jasa' id='id_jasa' value='<?= $r[id_jasa] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_jasa' class='form-control-label'>Nama Jasa</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_jasa' value='<?= $r[nama_jasa] ?>' id='nama_jasa'  placeholder='Masukkan Nama Jasa' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='harga_jasa' class='form-control-label'>Harga Jasa (Rp.)</label></div>
            <div class='col-9 col-md-6'><input type='number' value='<?= $r[harga_jasa] ?>' name='harga_jasa' id='harga_jasa'  placeholder='Masukkan Harga Jasa' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='lama_pengerjaan' class='form-control-label'>Lama Pengerjaan (Menit)</label></div>
            <div class='col-9 col-md-6'><input type='number' value='<?= $r[lama_pengerjaan] ?>' name='lama_pengerjaan' id='lama_pengerjaan'  placeholder='Masukkan Lama Pengerjaan' class='form-control' required></div>
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