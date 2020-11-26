<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/fungsi_rupiah.php";
              
                   
 echo"  ";     
if ($_GET['page']=='Dashboard'){  
  if ($_SESSION['leveluser']=='Admin' OR $_SESSION['leveluser']=='Pelanggan'){
    include "page_dashboard/dashboard.php";  
  }
}
elseif ($_GET['page']=='DataAdmin'){ 
  if ($_SESSION['leveluser']=='Admin'){ 
    include "page_admin/admin.php";  
  }
}
elseif ($_GET['page']=='DataPelanggan'){ 
  if ($_SESSION['leveluser']=='Admin'){ 
    include "page_pelanggan/pelanggan.php";  
  }
}
elseif ($_GET['page']=='DataBahan'){ 
  if ($_SESSION['leveluser']=='Admin'){ 
    include "page_bahan/bahan.php";  
  }
}
elseif ($_GET['page']=='DataJasa'){ 
  if ($_SESSION['leveluser']=='Admin'){ 
    include "page_jasa/jasa.php";  
  }
}
elseif ($_GET['page']=='DataMekanik'){ 
  if ($_SESSION['leveluser']=='Admin'){ 
    include "page_mekanik/mekanik.php";  
  }
}
elseif ($_GET['page']=='DataPos'){ 
  if ($_SESSION['leveluser']=='Admin'){ 
    include "page_pos/pos.php";  
  }
}
elseif ($_GET['page']=='DataPaket'){ 
  if ($_SESSION['leveluser']=='Admin'){ 
    include "page_paket/paket.php";  
  }
}
elseif ($_GET['page']=='DataService'){ 
  if ($_SESSION['leveluser']=='Admin'){ 
    include "page_service/service.php";  
  }
}
elseif ($_GET['page']=='DaftarService'){ 
  if ($_SESSION['leveluser']=='Pelanggan'){ 
    include "page_daftar/daftar.php";  
  }
}
elseif ($_GET['page']=='Status'){ 
  if ($_SESSION['leveluser']=='Pelanggan'){ 
    include "page_status/status.php";  
  }
}
elseif ($_GET['page']=='Riwayat'){ 
  if ($_SESSION['leveluser']=='Admin' OR $_SESSION['leveluser']=='Pelanggan'){ 
    include "page_riwayat/riwayat.php";  
  }
}
elseif ($_GET['page']=='UbahProfil'){ 
  if ($_SESSION['leveluser']=='Admin' OR $_SESSION['leveluser']=='Pelanggan'){ 
    include "page_profil/profil.php";  
  }
}


else{
  echo "<p><b>Halaman Tidak DITEMUKAN</b></p>";
}		
echo"";
?>   
