<?php 
  if($page == 'pengguna') {
    if($aksi == '') {
      require_once 'page/pengguna/index.php';
    }
  } else if($page == 'kelas') {
  	require_once 'page/kelas/index.php';
  } else if($page == 'tahun') {
  	if($aksi == '') {
  		require_once 'page/tahun/index.php';
  	}
  } else if($page == 'siswa') {
    if($aksi == '') {
      require_once 'page/siswa/index.php';
    }
  } else if($page == 'kenaikan') {
    if($aksi == '') {
      require_once 'page/kenaikan/index.php';
    }
  } else if($page == 'kelulusan') {
    if($aksi == '') {
      require_once 'page/kelulusan/index.php';
    }
  }
?>

