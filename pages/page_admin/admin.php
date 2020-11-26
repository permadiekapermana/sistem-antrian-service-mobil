<?php
include "../config/koneksi.php";

$pel="USER.";
$y=substr($pel,0,4);
$query=mysql_query("select * from users where substr(id_user,1,4)='$y' order by id_user desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_user'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_kota/aksi_kota.php";

$aksi="page_admin/aksi_admin.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=DataAdmin&act=tambahadmin" class="btn btn-primary">
        Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Blokir</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Blokir</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        $tampil = mysql_query("SELECT * FROM `users` WHERE level='Admin'");                    
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        ?>
          <tr>
            <td><?= $r[id_user] ?></td>
            <td><?= $r[username] ?></td>
            <td><?= $r[nama_lengkap] ?></td>
            <td><?= $r[alamat] ?></td>
            <td><?= $r[no_hp] ?></td>
            <td><?= $r[blokir] ?></td>
            <td><a href="<?php echo"?page=DataAdmin&act=editadmin&id=$r[id_user]"; ?>" class="btn btn-warning"> Edit </a></td>
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

case "tambahadmin":
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Tambah Admin
  </div>
  <div class="card-body">
    <form action='<?php echo" $aksi?page=DataAdmin&act=input "; ?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>ID User</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_user' id='username' value='<?= $nopel ?>'  placeholder='Masukkan Username' class='form-control' disabled><small class='form-text text-muted'>ID User diisi sistem otomatis!</small></div>
            <input type='hidden' name='id_user' id='id_user' value='<?= $nopel ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>Username</label></div>
            <div class='col-9 col-md-6'><input type='text' name='username' id='username'  placeholder='Masukkan Username' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='password' class='form-control-label'>Password</label></div>
            <div class='col-9 col-md-6'><input type='password' name='password' id='password'  placeholder='Masukkan Password' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_lengkap' class='form-control-label'>Nama Lengkap</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_lengkap' id='nama_lengkap'  placeholder='Masukkan Nama Lengkap' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='alamat' class='form-control-label'>Alamat</label></div>
            <div class='col-9 col-md-6'><textarea type='text' name='alamat' id='alamat'  placeholder='Masukkan Alamat' class='form-control' required></textarea></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='no_hp' class='form-control-label'>Nomor HP</label></div>
            <div class='col-9 col-md-6'><input type='text' name='no_hp' id='no_hp'  placeholder='Masukkan Nomor HP' class='form-control' required></div>
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

case "editadmin":
$edit = mysql_query("SELECT * FROM users WHERE id_user='$_GET[id]'");
$r    = mysql_fetch_array($edit);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Ubah Admin
  </div>
  <div class="card-body">
    <form action='<?php echo" $aksi?page=DataAdmin&act=update "; ?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>ID User</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_user' id='username' value='<?= $r[id_user] ?>'  placeholder='Masukkan Username' class='form-control' disabled><small class='form-text text-muted'>ID User tidak dapat diubah!</small></div>
            <input type='hidden' name='id_user' id='id_user' value='<?= $r[id_user] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>Username</label></div>
            <div class='col-9 col-md-6'><input type='text' name='username' value='<?= $r[username] ?>' id='username'  placeholder='Masukkan Username' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='password' class='form-control-label'>Password</label></div>
            <div class='col-9 col-md-6'><input type='password' name='password' id='password'  placeholder='Masukkan Password' class='form-control'><small class='form-text text-muted'>Jika password tidak ingin diubah, kosongkan</small></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_lengkap' class='form-control-label'>Nama Lengkap</label></div>
            <div class='col-9 col-md-6'><input type='text' value='<?= $r[nama_lengkap] ?>' name='nama_lengkap' id='nama_lengkap'  placeholder='Masukkan Nama Lengkap' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='alamat' class='form-control-label'>Alamat</label></div>
            <div class='col-9 col-md-6'><textarea type='text' name='alamat' id='alamat'  placeholder='Masukkan Alamat' class='form-control' required><?= $r[alamat] ?></textarea></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='no_hp' class='form-control-label'>Nomor HP</label></div>
            <div class='col-9 col-md-6'><input type='text' value='<?= $r[no_hp] ?>' name='no_hp' id='no_hp'  placeholder='Masukkan Nomor HP' class='form-control' required></div>
        </div>
        <div class='form-group'>
            <label for='blokir'>Blokir User ? &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label> <?php
              if ($r[blokir]=='Y')   {                         
              echo"              
                <input type='radio' class='flat' name='blokir' id='level' value='N'  required /> Tidak
                <input type='radio' class='flat' name='blokir' id='level' value='Y' checked='' /> Blokir";
              }
              elseif ($r[blokir]=='N')    {
              echo"
                <input type='radio' class='flat' name='blokir' id='level' value='N' checked='' required /> Tidak
                <input type='radio' class='flat' name='blokir' id='level' value='Y'  /> Blokir";        
              } ?>
              
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