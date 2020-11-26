<?php
include "../config/koneksi.php";

$aksi="page_profil/aksi_profil.php";
switch($_GET[act]){
default:

?>
<?php
if($_SESSION[leveluser]=='Admin'){

$login=mysql_query("SELECT * FROM users WHERE id_user='$_SESSION[id_user]'");
$r=mysql_fetch_array($login);

?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Ubah Profil
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=UbahProfil&act=update";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_user' class='form-control-label'>ID User</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_user' id='id_user' value='<?php echo"$r[id_user]"; ?>'  class='form-control' disabled><small class='form-text text-muted'>ID User tidak dapat diubah!</small></div>
            <input type='hidden' name='id_user' id='id_user' value='<?= $r[id_user] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>Username</label></div>
            <div class='col-9 col-md-6'><input type='text' name='username' value='<?php echo"$r[username]"; ?>' id='username'  placeholder='Masukkan Username' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='password' class='form-control-label'>Password</label></div>
            <div class='col-9 col-md-6'><input type='text' name='password' id='password' value='' placeholder='Masukkan Password' class='form-control'><small class='form-text text-muted'>Apabila password tidak ingin diubah, kosongkan field!</small></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_lengkap' class='form-control-label'>Nama Lengkap</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_lengkap' value='<?php echo"$r[nama_lengkap]"; ?>' id='nama_lengkap'  placeholder='Masukkan Username' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='alamat' class='form-control-label'>Alamat</label></div>
            <div class='col-9 col-md-6'><textarea type='text' name='alamat' id='alamat'  placeholder='Masukkan Username' class='form-control' required><?php echo"$r[alamat]"; ?></textarea></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='no_hp' class='form-control-label'>Nomor HP</label></div>
            <div class='col-9 col-md-6'><input type='text' name='no_hp' value='<?php echo"$r[no_hp]"; ?>' id='no_hp'  placeholder='Masukkan Username' class='form-control' required></div>
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
}elseif($_SESSION[leveluser]=='Pelanggan'){
$login=mysql_query("SELECT * FROM users WHERE id_user='$_SESSION[id_user]'");
$r=mysql_fetch_array($login);
$mobil=mysql_query("SELECT * FROM mobil WHERE id_user='$_SESSION[id_user]'");
$m=mysql_fetch_array($mobil);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Ubah Profil
  </div>
  <div class="card-body">
    <form action='<?php echo"$aksi?page=UbahProfil&act=update2";?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <h5>Data Pelanggan</h5>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_user' class='form-control-label'>ID User</label></div>
            <div class='col-9 col-md-6'><input type='text' name='id_user' id='id_user' value='<?php echo"$r[id_user]"; ?>'  class='form-control' disabled><small class='form-text text-muted'>ID User tidak dapat diubah!</small></div>
            <input type='hidden' name='id_user' id='id_user' value='<?= $r[id_user] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>Username</label></div>
            <div class='col-9 col-md-6'><input type='text' name='username' value='<?php echo"$r[username]"; ?>' id='username'  placeholder='Masukkan Username' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='password' class='form-control-label'>Password</label></div>
            <div class='col-9 col-md-6'><input type='text' name='password' id='password' value='' placeholder='Masukkan Password' class='form-control'><small class='form-text text-muted'>Apabila password tidak ingin diubah, kosongkan field!</small></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_lengkap' class='form-control-label'>Nama Lengkap</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_lengkap' value='<?php echo"$r[nama_lengkap]"; ?>' id='nama_lengkap'  placeholder='Masukkan Username' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='alamat' class='form-control-label'>Alamat</label></div>
            <div class='col-9 col-md-6'><textarea type='text' name='alamat' id='alamat'  placeholder='Masukkan Username' class='form-control' required><?php echo"$r[alamat]"; ?></textarea></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='no_hp' class='form-control-label'>Nomor HP</label></div>
            <div class='col-9 col-md-6'><input type='text' name='no_hp' value='<?php echo"$r[no_hp]"; ?>' id='no_hp'  placeholder='Masukkan Username' class='form-control' required></div>
        </div>
        <h5>Data Kendaraan</h5>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nopol' class='form-control-label'>Nomor Polisi</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nopol' value='<?php echo"$m[nopol]"; ?>' id='nopol'  placeholder='Masukkan Nomor Polisi' class='form-control' required></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_mobil' class='form-control-label'>Nama Mobil</label></div>
            <div class='col-9 col-md-6'><input type='text' name='nama_mobil' value='<?php echo"$m[nama_mobil]"; ?>' id='nama_mobil'  placeholder='Masukkan Nama Mobil' class='form-control' required></div>
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
}
?>

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