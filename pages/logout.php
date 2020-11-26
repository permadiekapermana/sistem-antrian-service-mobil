<?php
  session_start();
  session_destroy();
  echo "<script>alert('Anda telah keluar dari Sistem!'); window.location = 'login.php'</script>";
?>
