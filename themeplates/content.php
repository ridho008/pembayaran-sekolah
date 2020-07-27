<?php 
  if($page == 'pengguna') {
    if($aksi == '') {
      require_once 'page/pengguna/index.php';
    }
  } else if($page == 'kelas') {
  	require_once 'page/kelas/index.php';
  }
?>

