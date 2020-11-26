<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bengkel Udin Jaya: Register</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
  <div class="row justify-content-center">

  <div class="col-lg-7">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
              </div>
              <form class="user" action="aksi_register.php" method="POST">
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
                echo"
                <input type='hidden' name='id_user' value='$nopel'>
                ";
                ?>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="password2" placeholder="Masukkan Konfirmasi  Password" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="alamat" placeholder="Masukkan Alamat" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="no_hp" placeholder="Masukkan Nomor HP (62xx-xxxx-xxxx)" required>
                </div>
                <?php
                include "../config/koneksi.php";
                $pel2="MOBI.";
                $y2=substr($pel2,0,4);
                $query2=mysql_query("select * from mobil where substr(id_mobil,1,4)='$y2' order by id_mobil desc limit 0,1");
                $row2=mysql_num_rows($query2);
                $data2=mysql_fetch_array($query2);
                if ($row2>0){
                $no2=substr($data2['id_mobil'],-6)+1;}
                else{
                $no2=1;
                }
                $nourut2=1000000+$no2;
                $nopel2=$pel2.substr($nourut2,-6);
                echo"
                <input type='hidden' name='id_mobil' value='$nopel2'>
                ";
                ?>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nopol" placeholder="Masukkan Nomor Polisi Mobil" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nama_mobil" placeholder="Masukkan Nama Mobil" required>
                </div>
                <button type="text" class="btn btn-primary btn-user btn-block">
                  Buat Akun
              </button>
              </form>
              <hr>
              <div class="text-center">
                Sudah Punya Akun ? Silahkan <a href="login.php">Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
