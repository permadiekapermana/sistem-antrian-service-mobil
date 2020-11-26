<?php
include "../config/koneksi.php";

$pel="BAHN.";
$y=substr($pel,0,4);
$query=mysql_query("select * from bahan where substr(id_bahan,1,4)='$y' order by id_bahan desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_bahan'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_bahan/aksi_bahan.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=DataBahan&act=tambahbahan" class="btn btn-primary">
        Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Bahan</th>
            <th>Gambar</th>
            <th>Nama Bahan</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID Bahan</th>
            <th width='105px'>Gambar</th>
            <th>Nama Bahan</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        $tampil = mysql_query("SELECT * FROM `bahan` ORDER BY id_bahan DESC");                    
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        ?>
          <tr>
            <td><?= $r[id_bahan] ?></td>
            <td width='105px'><img src='upload/bahan/<?= $r[gambar] ?>' border='3' height='100' width='100'></td>
            <td><?= $r[nama_bahan] ?></td>
            <td><?= $r[deskripsi] ?></td>
            <td>Rp. <?= $r[harga] ?></td>
            <td width='13%'><a href="<?php echo"?page=DataBahan&act=editbahan&id=$r[id_bahan]"; ?>" class="btn btn-sm btn-warning"> Edit </a> <a href="<?php echo" $aksi?page=DataBahan&act=hapus&id=$r[id_bahan] "; ?>" class="btn btn-sm btn-danger" <?php echo "onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\" "; ?>> Hapus </a></td>
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

case "tambahbahan":
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Tambah Bahan
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataBahan&act=input";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_bahan' class='form-control-label'>ID Bahan</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_bahan' id='id_bahan' value='<?= $nopel ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Bahan diisi sistem otomatis!</small></div>
            <input type='hidden' name='id_bahan' id='id_bahan' value='<?= $nopel ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_bahan' class='form-control-label'>Nama Bahan</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_bahan' id='nama_bahan'  placeholder='Masukkan Nama Bahan' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='deskripsi' class='form-control-label'>Deskripsi</label></div>
            <div class='col-9 col-md-6'><textarea type='text' name='deskripsi' id='deskripsi'  placeholder='Masukkan Deskripsi' class='form-control' required></textarea></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='harga' class='form-control-label'>Harga (Rp.)</label></div>
            <div class='col-9 col-md-6'><input type='number' name='harga' id='harga'  placeholder='Masukkan Harga' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='fupload' class='form-control-label'>Gambar</label></div>
            <div class='col-9 col-md-6'><input type='file' name='fupload' id='fupload'  placeholder='Masukkan Harga' class='form-control' required><small class='form-text text-muted'>Hanya file dengan tipe ekstensi .JPG dan .PNG saja yang dapat diupload</small></div>
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

case "editbahan":
$edit = mysql_query("SELECT * FROM bahan WHERE id_bahan='$_GET[id]'");
$r    = mysql_fetch_array($edit);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Edit Bahan
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataBahan&act=update";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_bahan' class='form-control-label'>ID Bahan</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_bahan' id='id_bahan' value='<?= $r[id_bahan] ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Bahan tidak dapat diubah!</small></div>
            <input type='hidden' name='id_bahan' id='id_bahan' value='<?= $r[id_bahan] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_bahan' class='form-control-label'>Nama Bahan</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_bahan' value='<?= $r[nama_bahan] ?>' id='nama_bahan'  placeholder='Masukkan Nama Bahan' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='deskripsi' class='form-control-label'>Deskripsi</label></div>
            <div class='col-9 col-md-6'><textarea type='text'  name='deskripsi' id='deskripsi'  placeholder='Masukkan Deskripsi' class='form-control' required><?= $r[deskripsi] ?></textarea></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='harga' class='form-control-label'>Harga (Rp.)</label></div>
            <div class='col-9 col-md-6'><input type='number' value='<?= $r[harga] ?>' name='harga' id='harga'  placeholder='Masukkan Harga' class='form-control' required></div>
        </div>
        <div class='row form-group'>
          <div class='col col-md-3'><label for='gambar' class='form-control-label'>Gambar Bahan</label></div>
          <div class='col-9 col-md-6'><img src='<?php echo"upload/bahan/$r[gambar]"; ?>' border='3' height='100' width='100'></img></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='fupload' class='form-control-label'>Gambar</label></div>
            <div class='col-9 col-md-6'><input type='file' name='fupload' id='fupload' class='form-control'><small class='form-text text-muted'>Hanya file dengan tipe ekstensi .JPG dan .PNG saja yang dapat diupload</small></div>
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