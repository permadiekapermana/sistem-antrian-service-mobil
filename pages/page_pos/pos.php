<?php
include "../config/koneksi.php";

$pel="DPOS.";
$y=substr($pel,0,4);
$query=mysql_query("select * from pos where substr(id_pos,1,4)='$y' order by id_pos desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_pos'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_pos/aksi_pos.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=DataPos&act=tambahpos" class="btn btn-primary">
        Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Pos Service</th>
            <th>Nama Pos</th>
            <th>Nama Mekanik</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>ID Pos Service</th>
            <th>Nama Pos</th>
            <th>Nama Mekanik</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        $tampil = mysql_query("SELECT * FROM `pos`
                              INNER JOIN `mekanik` ON `pos`.`id_mekanik` = `mekanik`.`id_mekanik`
                              ORDER BY id_pos DESC");                    
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        ?>
          <tr>
            <td><?= $r[id_pos] ?></td>
            <td><?= $r[nama_pos] ?></td>
            <td><?= $r[nama_mekanik] ?></td>
            <td width='13%'><a href="<?php echo"?page=DataPos&act=editpos&id=$r[id_pos]"; ?>" class="btn btn-sm btn-warning"> Edit </a> <a href="<?php echo" $aksi?page=DataPos&act=hapus&id=$r[id_pos] "; ?>" class="btn btn-sm btn-danger" <?php echo "onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\" "; ?>> Hapus </a></td>
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

case "tambahpos":
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Tambah Pos Service
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataPos&act=input";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_pos' class='form-control-label'>ID Pos Service</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_pos' id='id_pos' value='<?= $nopel ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Pos Service diisi sistem otomatis!</small></div>
            <input type='hidden' name='id_pos' id='id_pos' value='<?= $nopel ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_pos' class='form-control-label'>Nama Pos Service</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_pos' id='nama_pos'  placeholder='Masukkan Nama Pos Service' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_mekanik' class='form-control-label'>Mekanik</label></div>
          <div class='col-9 col-md-6'>
            <select name='id_mekanik' class='form-control' tabindex='1' required>
              <option value=''>-- Pilih Mekanik --</option>
              <?php
              $tampil=mysql_query("SELECT * FROM mekanik ORDER BY id_mekanik DESC");
              while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_mekanik]>$r[nama_mekanik]</option>";
              }
              ?>
            </select>
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

case "editpos":
$edit = mysql_query("SELECT * FROM pos WHERE id_pos='$_GET[id]'");
$r    = mysql_fetch_array($edit);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Edit Pos Service
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=DataPos&act=update";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_pos' class='form-control-label'>ID Pos Service</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_pos' id='id_pos' value='<?= $r[id_pos] ?>'  class='form-control' disabled><small class='form-text text-muted'>ID Pos Service tidak dapat diubah!</small></div>
            <input type='hidden' name='id_pos' id='id_pos' value='<?= $r[id_pos] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_pos' class='form-control-label'>Nama Pos Service</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_pos' value='<?= $r[nama_pos] ?>' id='nama_pos'  placeholder='Masukkan Nama Pos Service' class='form-control' required></div>
        </div>
        <div class='row form-group'>
                <div class='col col-md-3'><label for='id_mekanik' class='form-control-label'>Mekanik</label></div>
                <div class='col-9 col-md-6'>
                <select name='id_mekanik' class='form-control' tabindex='1' required>
                <?php      
                $tampil=mysql_query("SELECT * FROM mekanik ORDER BY id_mekanik DESC");
                if ($r[id_mekanik]==0){
                echo "<option value='' selected>-- Pilih Mekanik --</option>";
                }   
                while($w=mysql_fetch_array($tampil)){
                if ($r[id_mekanik]==$w[id_mekanik]){
                echo "<option value=$w[id_mekanik] selected>$w[nama_mekanik]</option>";
                }
                else{
                echo "<option value=$w[id_mekanik]>$w[nama_mekanik]</option>";
                }
                }
                ?>
                </select>
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