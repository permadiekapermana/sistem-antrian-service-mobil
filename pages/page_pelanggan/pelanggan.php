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

$aksi="page_pelanggan/aksi_pelanggan.php";
switch($_GET[act]){
default:

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID User</th>
            <th>Nama Lengkap</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Nomor Kendaraan</th>
            <th>Blokir</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID User</th>
            <th>Nama Lengkap</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Nomor Kendaraan</th>
            <th>Blokir</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        $tampil = mysql_query("SELECT * FROM `users`
                              INNER JOIN `mobil` ON `mobil`.`id_user` = `users`.`id_user`
                              WHERE level='Pelanggan'");                    
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        ?>
          <tr>
            <td><?= $r[id_user] ?></td>
            <td><?= $r[nama_lengkap] ?></td>
            <td><?= $r[alamat] ?></td>
            <td><?= $r[no_hp] ?></td>
            <td><?= $r[nopol] ?></td>
            <td><?= $r[blokir] ?></td>
            <td><a href="<?php echo"?page=DataPelanggan&act=detailpelanggan&id=$r[id_user]"; ?>" class="btn btn-sm btn-info"> Detail </a> <a href="<?php echo"$aksi?page=DataPelanggan&act=blokir&id=$r[id_user]"; ?>" <?php echo "onClick=\"return confirm('Yakin ingin blokir pelanggan ? Data pelanggan yang diblokir tidak dapat lagi mengakses sistem !')\" "; ?> class="btn btn-sm btn-danger"> Blokir </a></td>
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

case "detailpelanggan":
$edit = mysql_query("SELECT * FROM users WHERE id_user='$_GET[id]'");
$r    = mysql_fetch_array($edit);
$edit2 = mysql_query("SELECT * FROM mobil WHERE id_user='$_GET[id]'");
$r2    = mysql_fetch_array($edit2);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    Detail Data Pelanggan
  </div>
  <div class="card-body">
    <form action='<?php echo" $aksi?page=DataAdmin&act=update "; ?>' method='POST' enctype='multipart/form-data' class='form-horizontal'>
    <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'><b>Data Pelanggan</b></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>ID User</label></div>
            <div class='col-9 col-md-6'>: <?= $r[id_user] ?></div>
            <input type='hidden' name='id_user' id='id_user' value='<?= $r[id_user] ?>'  placeholder='Masukkan Username' class='form-control' >
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>Username</label></div>
            <div class='col-9 col-md-6'>: <?= $r[username] ?></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='nama_lengkap' class='form-control-label'>Nama Lengkap</label></div>
            <div class='col-9 col-md-6'>: <?= $r[nama_lengkap] ?></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='alamat' class='form-control-label'>Alamat</label></div>
            <div class='col-9 col-md-6'>: <?= $r[alamat] ?></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='no_hp' class='form-control-label'>Nomor HP</label></div>
            <div class='col-9 col-md-6'>: <?= $r[no_hp] ?></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'><b>Data Kendaraan</b></label></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='no_hp' class='form-control-label'>Nomor Polisi Kendaraan</label></div>
            <div class='col-9 col-md-6'>: <?= $r2[nopol] ?></div>
        </div>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='no_hp' class='form-control-label'>Nama Kendaraan</label></div>
            <div class='col-9 col-md-6'>: <?= $r2[nama_mobil] ?></div>
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