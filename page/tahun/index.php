<?php 
// menampilkan semua data di tabel kelas
$semuaTahun = [];
$queryTahun = $conn->query("SELECT * FROM tb_tahun_ajaran ORDER BY id_ajaran DESC") or die(mysqli_error($conn));
while ($data = $queryTahun->fetch_assoc()) {
	$semuaTahun[] = $data;
}


// jika tombol tambah di tekan
if(isset($_POST['tambah'])) {
	$tahun = htmlspecialchars($_POST['tahun']);

	$sql = $conn->query("INSERT INTO tb_tahun_ajaran VALUES(null, '$tahun', status = 'Non Aktif')") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data berhasil ditambahkan.');window.location='?p=tahun';</script>";
	} else {
		echo "<script>alert('Data gagal ditambahkan.');window.location='?p=tahun';</script>";
	}
}

// jika tombol ubah di tekan
if(isset($_POST['ubah'])) {
	$idTahunUbah = htmlspecialchars($_POST['id']);
	$tahun = htmlspecialchars($_POST['tahun']);

	$sql = $conn->query("UPDATE tb_tahun_ajaran SET tahun_ajaran = '$tahun' WHERE id_ajaran = $idTahunUbah") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data berhasil diubah.');window.location='?p=tahun';</script>";
	} else {
		echo "<script>alert('Data gagal diubah.');window.location='?p=tahun';</script>";
	}
}

// jika tombol hapus di tekan
if(isset($_POST['hapus'])) {
	$id_tahun_hapus = $_POST['id_tahun_hapus'];

	$sql = $conn->query("DELETE FROM tb_tahun_ajaran WHERE id_ajaran = $id_tahun_hapus") or die(mysqli_error($conn));
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
    <h3 class="card-title">Data Semua Tahun Ajaran</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
	<button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#formTambahKelas"><i class="fa fa-plus-circle"></i> Tambah Tahun Ajaran</button>
    <table id="example1" class="table table-bordered table-hover">
      <thead>
	      <tr>
	        <th>No.</th>
	        <th>Tahun</th>
	        <th>Status</th>
          <th>Aksi</th>
	      </tr>
      </thead>
      <tbody>
      	<?php 
      	$no = 1;
      	foreach($semuaTahun as $st) : ?>
      	<tr>
      		<td><?= $no++; ?></td>
      		<td><?= $st['tahun_ajaran']; ?></td>
          <td>
            <?php if($st['status'] == 'Aktif') : ?>
              <button disabled="" class="btn btn-success">Sedang Aktif</button>
              <?php else : ?>
                <form action="" method="post">
                  <input type="hidden" name="id_tahun_ajaran" value="<?= $st['id_ajaran']; ?>">
                  <button type="submit" name="aktifkan" class="btn btn-primary">Aktif Tahun Ajaran</button>
                </form>
            <?php endif; ?>
          </td>
      		<td>
      			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default<?= $st['id_ajaran']; ?>">
                  <i class="fa fa-edit"></i>
                </button>
                <!-- form hapus -->
                <form action="" method="post">
                <input type="hidden" name="id_tahun_hapus" value="<?= $st['id_ajaran']; ?>">
                <button type="submit" name="hapus" onclick="return confirm('Yakin ?')" class="btn btn-danger">
                  <i class="fa fa-trash"></i>
                </button>
                </form>
                <!-- /form hapus -->
      		</td>
      	</tr>
      	<!-- Modal ubah data kelas -->
      	<div class="modal fade" id="modal-default<?= $st['id_ajaran']; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Data Tahun Ajaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
              	<?php 
              	// mengambil id sesuai data yg ingin di edit
              	$id_ajaran = $st['id_ajaran'];
              	$sql_edit = $conn->query("SELECT * FROM tb_tahun_ajaran WHERE id_ajaran = '$id_ajaran'") or die(mysqli_error($conn));
              	while($dataEdit = $sql_edit->fetch_assoc()) {


              	?>
              	<input type="text" name="id" value="<?= $dataEdit['id_ajaran']; ?>">
              	<div class="form-group">
                  <label for="tahun">Tahun Ajaran</label>
                  <input type="text" name="tahun" id="tahun" class="form-control" value="<?= $dataEdit['tahun_ajaran']; ?>">
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
      	<?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->



<!-- Form tambah data kelas -->
<div class="modal fade" id="formTambahKelas">
        <div class="modal-dialog">
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
              		<label for="tahun">Tahun Ajaran</label>
              		<input type="text" name="tahun" id="tahun" class="form-control">
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