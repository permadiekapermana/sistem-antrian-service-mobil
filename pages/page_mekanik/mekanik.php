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

$aksi="page_mekanik/aksi_mekanik.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=DataMekanik&act=tambahmekanik" class="btn btn-primary">
        Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Mekanik</th>
            <th>Nama Mekanik</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID Mekanik</th>
            <th>Nama Mekanik</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        $tampil = mysql_query("SELECT * FROM `mekanik` ORDER BY id_mekanik DESC");                    
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        ?>
          <tr>
            <td><?= $r[id_mekanik] ?></td>
            <td><?= $r[nama_mekanik] ?></td>
            <td>Rp. <?= $r[alamat] ?></td>
            <td width='13%'><a href="<?php echo"?page=DataMekanik&act=editmekanik&id=$r[id_mekanik]"; ?>" class="btn btn-sm btn-warning"> Edit </a> <a href="<?php echo" $aksi?page=DataMekanik&act=hapus&id=$r[id_mekanik] "; ?>" class="btn btn-sm btn-danger" <?php echo "onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\" "; ?>> Hapus </a></td>
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

case "tambahmekanik":
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Tambah Mekanik
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataMekanik&act=input";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_mekanik' class='form-control-label'>ID Jasa</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_mekanik' id='id_mekanik' value='<?= $nopel ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Jasa diisi sistem otomatis!</small></div>
            <input type='hidden' name='id_mekanik' id='id_mekanik' value='<?= $nopel ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_mekanik' class='form-control-label'>Nama Mekanik</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_mekanik' id='nama_mekanik'  placeholder='Masukkan Nama Mekanik' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='harga_jasa' class='form-control-label'>Alamat</label></div>
            <div class='col-9 col-md-6'><textarea type='text' name='alamat' id='alamat'  placeholder='Masukkan Alamat Mekanik' class='form-control' required></textarea></div>
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