<?php

// jika tombol tambah di tekan
if(isset($_POST['tambah'])) {
	$nis = htmlspecialchars($_POST['nis']);
  $nama = htmlspecialchars($_POST['nama']);
  $kelas = htmlspecialchars($_POST['kelas']);
  $jk = htmlspecialchars($_POST['jk']);
  $agama = htmlspecialchars($_POST['agama']);
  $status = htmlspecialchars($_POST['status']);
  $ortu = htmlspecialchars($_POST['ortu']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $telp = htmlspecialchars($_POST['telp']);

	$sql = $conn->query("INSERT INTO tb_siswa VALUES(null, '$nis', '$nama', '$kelas', '$jk', '$agama', '$status', '$ortu', '$alamat', '$telp')") or die(mysqli_error($conn));
  if($sql) {
    echo "<script>alert('Data berhasil ditambahkan.');window.location='?p=siswa';</script>";
  } else {
    echo "<script>alert('Data gagal ditambahkan.');window.location='?p=siswa';</script>";
  }
}

// jika tombol ubah di tekan
if(isset($_POST['ubah'])) {
	$idSiswa = htmlspecialchars($_POST['id']);
  $nis = htmlspecialchars($_POST['nis']);
	$nama = htmlspecialchars($_POST['nama']);
  $kelas = htmlspecialchars($_POST['kelas']);
  $jk = htmlspecialchars($_POST['jk']);
  $agama = htmlspecialchars($_POST['agama']);
  $status = htmlspecialchars($_POST['status']);
  $ortu = htmlspecialchars($_POST['ortu']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $telp = htmlspecialchars($_POST['telp']);

	$sql = $conn->query("UPDATE tb_siswa SET nis = '$nis', nama_siswa = '$nama', id_kelas = '$kelas', jk = '$jk', agama = '$agama', status_siswa = '$status', ortu = '$ortu', alamat_siswa = '$alamat', telp_ortu = '$telp' WHERE id_siswa = $idSiswa") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data berhasil diubah.');window.location='?p=siswa';</script>";
	} else {
		echo "<script>alert('Data gagal diubah.');window.location='?p=siswa';</script>";
	}
}

// jika tombol hapus di tekan
if(isset($_POST['hapus'])) {
	$id_siswa = $_POST['id_siswa_hapus'];

	$sql = $conn->query("DELETE FROM tb_siswa WHERE id_siswa = $id_siswa") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data berhasil dihapus.');window.location='?p=tahun';</script>";
	} else {
		echo "<script>alert('Data gagal dihapus.');window.location='?p=tahun';</script>";
	}
}


// Feield Status
// jika tombol "aktifkan tahun ajaran di klik", makan tahun akan aktif, selain dari itu akan di nonaktifkan. sehingga cuma satu tahun saja yang "Aktif!".
if(isset($_POST['aktifkan'])) {
  $idTahunAjaran = htmlspecialchars($_POST['id_tahun_ajaran']);

  $sql = $conn->query("UPDATE tb_tahun_ajaran SET status = 'Aktif' WHERE id_ajaran = $idTahunAjaran") or die(mysqli_error($conn));
  $sql = $conn->query("UPDATE tb_tahun_ajaran SET status = 'Non Aktif' WHERE id_ajaran != $idTahunAjaran") or die(mysqli_error($conn));
  if($sql) {
    echo "<script>alert('Tahun berhasil diaktifkan.');window.location='?p=tahun';</script>";
  } else {
    echo "<script>alert('Tahun gagal diaktifkan.');window.location='?p=tahun';</script>";
  }
}



?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Semua Siswa</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
			<form action="" method="post">
	<div class="row">
		<div class="col-md-4">
				<div class="form-group">
					<label for="kelas">Kelas</label>
					<select name="kelas" id="kelas" class="form-control">
						<option value="">Pilih Kelas</option>
						<!-- menampilkan data semua kelas -->
						<?php 

						$queryKelas = $conn->query("SELECT * FROM tb_kelas") or die(mysqli_error($conn));
						while($dataKelas = $queryKelas->fetch_assoc()) { ?>
						<option value="<?= $dataKelas['id_kelas']; ?>"><?= $dataKelas['nama_kelas']; ?></option>
						<?php	
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-md-4 mt-4">
				<div class="form-group">
					<button type="submit" name="cari" class="btn btn-primary">Cari</button>
				</div>
			</div>
	</div>
		</form>
    <table id="example1" class="table table-bordered table-hover">
      <thead>
	      <tr>
	      <th>No.</th>
          <th>NIS</th>
	        <th>Nama</th>
          <th>Kelas</th>
          <th colspan="2">
          	<div class="from-check">
          		<input type="checkbox" onclick="selectAll()" class="form-check-input">
          		<label for="form-check-label">Pilih Semua</label>
          	</div>
          </th>
	      </tr>
      </thead>
      <tbody>
      	<?php 
      	$no = 1;
      	if(isset($_POST['cari'])) {
					$cari = $_POST['kelas'];

				} 
				
				if($cari != '') {
	      	$querySiswa = $conn->query("SELECT * FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas AND tb_siswa.status_siswa = 'Aktif' AND tb_siswa.id_kelas = $cari") or die(mysqli_error($conn));
				} else {
					$querySiswa = $conn->query("SELECT * FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas AND tb_siswa.status_siswa = 'Aktif'") or die(mysqli_error($conn));
				}
      	while($data = $querySiswa->fetch_assoc()) { ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $data['nis']; ?></td>
					<td><?= $data['nama_siswa']; ?></td>
					<td><?= $data['nama_kelas']; ?></td>
					
					<td colspan="2">
					<form action="" method="post">
	        	<input class="form-check-input" name="pilih[]" value="<?= $data['id_siswa']; ?>" type="checkbox">
					</td>
				</tr>
				<?php
      	}
      	?>
      </tbody>      
      </table>
      
						<div class="row">
								<div class="col-md-4">
										<div class="form-group">
											<label for="kelas">Kelas</label>
											<select name="kelas" id="kelas" class="form-control">
												<option value="">Pilih Kelas</option>
												<!-- menampilkan data semua kelas -->
												<?php 

												$queryKelas = $conn->query("SELECT * FROM tb_kelas") or die(mysqli_error($conn));
												while($dataKelas = $queryKelas->fetch_assoc()) { ?>
												<option value="<?= $dataKelas['id_kelas']; ?>"><?= $dataKelas['nama_kelas']; ?></option>
												<?php	
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-4 mt-4">
										<div class="form-group">
											<button type="submit" name="naikan" class="btn btn-primary">Pindahkan / Naikan Kelas</button>
										</div>
									</div>
							</div>
					</form>
					<?php 
					if(isset($_POST['naikan'])) {
						$kelas = $_POST['kelas'];
						$siswa = $_POST['pilih'];
						$jml_pilih = count($siswa);

						for($i = 0; $i < $jml_pilih; $i++) {
							$naikan = $conn->query("UPDATE tb_siswa SET id_kelas = $kelas WHERE id_siswa = '$siswa[$i]'") or die(mysqli_error($conn));
							if($naikan) {
								echo "<script>alert('Siswa berhasil di pindahkan.');window.location='?p=kenaikan';</script>";
							} else {
								echo "<script>alert('Siswa gagal di pindahkan.');window.location='?p=kenaikan';</script>";
							}
						}
					}
					?>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

