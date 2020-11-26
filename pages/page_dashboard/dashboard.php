<?php
if ($_SESSION['leveluser']=='Admin'){
$order_selesai = mysql_num_rows(mysql_query("SELECT * FROM service WHERE tgl_service='$tgl_sekarang' AND status='Selesai'"));
$order_berjalan = mysql_num_rows(mysql_query("SELECT * FROM service WHERE tgl_service='$tgl_sekarang' AND (status='Selanjutnya' OR status='Diproses')"));
$antrian = mysql_num_rows(mysql_query("SELECT * FROM service WHERE tgl_service='$tgl_sekarang' AND status='Dalam Antrian'"));
$order_selesai_total = mysql_num_rows(mysql_query("SELECT * FROM service WHERE status='Selesai'"));
?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Order Selesai</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo"$order_selesai"; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Order Berjalan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo"$order_berjalan"; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Antrian</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo"$antrian"; ?></div>
                        </div>
                        <!-- <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Order Service</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo"$order_selesai_total"; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
}
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <h5>Selamat datang <?php echo"$_SESSION[namalengkap]" ?> di Sistem Antrian Bengkel Body Cat Udin Jaya. Anda Login sebagai <?php echo"$_SESSION[leveluser]" ?></h5>
    <br><br><br><br><br><br><br><br>
  </div>
</div>
