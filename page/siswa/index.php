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
	<button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#formTambahKelas"><i class="fa fa-plus-circle"></i> Tambah Siswa</button>
    <table id="example1" class="table table-bordered table-hover">
      <thead>
	      <tr>
	        <th>No.</th>
          <th>NIS</th>
	        <th>Nama</th>
          <th>Kelas</th>
	        <th>Kelamin</th>
          <th>Agama</th>
          <th>Status</th>
          <th>Orang Tua</th>
          <th>Alamat</th>
          <th>Telepon</th>
          <th>Aksi</th>
	      </tr>
      </thead>
      <tbody>
      	<?php 
        $no = 1;
        $querySiswa = $conn->query("SELECT * FROM tb_siswa") or die(mysqli_error($conn));

        while ($data = $querySiswa->fetch_assoc()) {
        // menampilkan semua data di tabel kelas
          // var_dump($data);
        ?>

          <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nis']; ?></td>
            <td><?= $data['nama_siswa']; ?></td>
            <td><?= $data['id_kelas']; ?></td>
            <td><?= $data['jk'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
            <td><?= $data['agama']; ?></td>
            <td><?= $data['status_siswa']; ?></td>
            <td><?= $data['ortu']; ?></td>
            <td><?= $data['alamat_siswa']; ?></td>
            <td><?= $data['telp_ortu']; ?></td>
            <td>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#formUbahSiswa<?= $data['id_siswa']; ?>"><i class="fas fa-edit"></i></button>
              <form action="" method="post">
                <input type="hidden" name="id_siswa_hapus" value="<?= $data['id_siswa']; ?>">
                <button type="submit" name="hapus" class="btn btn-danger" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          <!-- Modal ubah data kelas -->
            <div class="modal fade" id="formUbahSiswa<?= $data['id_siswa']; ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="post">
                      <?php 
                      // mengambil id sesuai data yg ingin di edit
                      $id_siswa = $data['id_siswa'];
                      $sql_edit = $conn->query("SELECT * FROM tb_siswa WHERE id_siswa = $id_siswa") or die(mysqli_error($conn));
                      while($dataEdit = $sql_edit->fetch_assoc()) {


                      ?>
                      <input type="text" name="id" value="<?= $dataEdit['id_siswa']; ?>">
                      <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" id="nis" readonly class="form-control" value="<?= $dataEdit['nis']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $dataEdit['nama_siswa']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="nama">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                          <option value="">Pilih Kelas</option>
                          <?php 
                          $queryKelas = $conn->query("SELECT * FROM tb_kelas") or die(mysqli_error($conn));
                          while($rowK = $queryKelas->fetch_assoc()) { ?>
                            <?php if($rowK['id_kelas'] == $dataEdit['id_kelas']) : ?>
                            <option value="<?= $rowK['id_kelas']; ?>" selected><?= $rowK['nama_kelas']; ?></option>
                            <?php else : ?>
                              <option value="<?= $rowK['id_kelas']; ?>"><?= $rowK['nama_kelas']; ?></option>
                            <?php endif; ?>
                          <?php  } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="jk" id="jk" value="L" <?php if($dataEdit['jk'] == 'L')echo "checked"; ?>>
                          <label class="form-check-label" for="jk">
                          Laki-Laki
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="jk" id="jk" value="P" <?php if($dataEdit['jk'] == 'P')echo "checked"; ?>>
                          <label class="form-check-label" for="jk">
                          Perempuan
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="agama">Agama</label>
                        <select name="agama" id="agama" class="form-control">
                          <option value="">Pilih Agama</option>
                          <option value="Islam" <?php if($dataEdit['agama'] == 'Islam'){echo "selected";} ?>>Islam</option>
                          <option value="Kristen" <?php if($dataEdit['agama'] == 'Kristen'){echo "selected";} ?>>Kristen</option>
                          <option value="Budha" <?php if($dataEdit['agama'] == 'Budha'){echo "selected";} ?>>Budha</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                          <option value="">Pilih Status</option>
                          <option value="Aktif" <?php if($dataEdit['status_siswa'] == 'Aktif'){echo "selected";} ?>>Aktif</option>
                          <option value="Nonaktif" <?php if($dataEdit['status_siswa'] == 'Nonaktif'){echo "selected";} ?>>Nonaktif</option>
                          <option value="Keluar" <?php if($dataEdit['status_siswa'] == 'Keluar'){echo "selected";} ?>>Keluar</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="ortu">Orang Tua</label>
                        <input type="text" name="ortu" id="ortu" class="form-control" value="<?= $dataEdit['ortu']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $dataEdit['alamat_siswa']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="telp">Telepon</label>
                        <input type="text" name="telp" id="telp" class="form-control" value="<?= $dataEdit['telp_ortu']; ?>">
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
                  </div>
                  <?php } ?>
                  </form>
                </div>
                <!-- /Modal ubah data kelas -->
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
          </div>
        <?php } ?>
      </tbody>      
      </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->



<!-- Form tambah data kelas -->
<div class="modal fade" id="formTambahKelas">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Tahun Ajaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
              	<div class="form-group">
                  <label for="nis">NIS</label>
                  <input type="text" name="nis" id="nis" class="form-control">
                </div>
                <div class="form-group">
                  <label for="nama">Nama Siswa</label>
                  <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="form-group">
                  <label for="nama">Kelas</label>
                  <select name="kelas" id="kelas" class="form-control">
                    <option value="">Pilih Kelas</option>
                    <?php 
                    $queryKelas = $conn->query("SELECT * FROM tb_kelas") or die(mysqli_error($conn));
                    while($rowK = $queryKelas->fetch_assoc()) { ?>
                        <option value="<?= $rowK['id_kelas']; ?>"><?= $rowK['nama_kelas']; ?></option>
                    <?php  } ?>
                  </select>
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk" id="jk" value="L">
                    <label class="form-check-label" for="jk">
                    Laki-Laki
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk" id="jk" value="P">
                    <label class="form-check-label" for="jk">
                    Perempuan
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="agama">Agama</label>
                  <select name="agama" id="agama" class="form-control">
                    <option value="">Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Budha">Budha</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option value="">Pilih Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                    <option value="Keluar">Keluar</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ortu">Orang Tua</label>
                  <input type="text" name="ortu" id="ortu" class="form-control">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control">
                </div>
                <div class="form-group">
                  <label for="telp">Telepon</label>
                  <input type="text" name="telp" id="telp" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->