<?php 
// menampilkan semua data di tabel kelas
$semuaKelas = [];
$queryKelas = $conn->query("SELECT * FROM tb_kelas ORDER BY id_kelas DESC") or die(mysqli_error($conn));
while ($data = $queryKelas->fetch_assoc()) {
	$semuaKelas[] = $data;
}


// jika tombol tambah di tekan
if(isset($_POST['tambah'])) {
	$namaKelas = htmlspecialchars($_POST['kelas']);

	$sql = $conn->query("INSERT INTO tb_kelas VALUES(null, '$namaKelas')") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data berhasil ditambahkan.');window.location='?p=kelas';</script>";
	} else {
		echo "<script>alert('Data gagal ditambahkan.');window.location='?p=kelas';</script>";
	}
}

// jika tombol ubah di tekan
if(isset($_POST['ubah'])) {
	$idKelasUbah = htmlspecialchars($_POST['id']);
	$namaKelas = htmlspecialchars($_POST['kelas']);

	$sql = $conn->query("UPDATE tb_kelas SET nama_kelas = '$namaKelas' WHERE id_kelas = $idKelasUbah") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data berhasil diubah.');window.location='?p=kelas';</script>";
	} else {
		echo "<script>alert('Data gagal diubah.');window.location='?p=kelas';</script>";
	}
}

// jika tombol hapus di tekan
if(isset($_POST['hapus'])) {
	$id_kelas_hapus = $_POST['id_kelas_hapus'];

	$sql = $conn->query("DELETE FROM tb_kelas WHERE id_kelas = $id_kelas_hapus") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data berhasil dihapus.');window.location='?p=kelas';</script>";
	} else {
		echo "<script>alert('Data gagal dihapus.');window.location='?p=kelas';</script>";
	}
}

?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Semua Kelas</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
	<button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#formTambahKelas"><i class="fa fa-plus-circle"></i> Tambah Kelas</button>
    <table id="example1" class="table table-bordered table-hover">
      <thead>
	      <tr>
	        <th>No.</th>
	        <th>Nama Kelas</th>
	        <th>Aksi</th>
	      </tr>
      </thead>
      <tbody>
      	<?php 
      	$no = 1;
      	foreach($semuaKelas as $k) : ?>
      	<tr>
      		<td><?= $no++; ?></td>
      		<td><?= $k['nama_kelas']; ?></td>
      		<td>
      			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default<?= $k['id_kelas']; ?>">
                  <i class="fa fa-edit"></i>
                </button>
                <!-- form hapus -->
                <form action="" method="post">
                <input type="hidden" name="id_kelas_hapus" value="<?= $k['id_kelas']; ?>">
                <button type="submit" name="hapus" onclick="return confirm('Yakin ?')" class="btn btn-danger">
                  <i class="fa fa-trash"></i>
                </button>
                </form>
                <!-- /form hapus -->
      		</td>
      	</tr>
      	<!-- Modal ubah data kelas -->
      	<div class="modal fade" id="modal-default<?= $k['id_kelas']; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
              	<?php 
              	// mengambil id sesuai data yg ingin di edit
              	$id_kelas = $k['id_kelas'];
              	$sql_edit = $conn->query("SELECT * FROM tb_kelas WHERE id_kelas = '$id_kelas'") or die(mysqli_error($conn));
              	while($dataEdit = $sql_edit->fetch_assoc()) {


              	?>
              	<input type="text" name="id" value="<?= $dataEdit['id_kelas']; ?>">
              	<div class="form-group">
                    <label for="kelas">Nama Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Nama Kelas.." value="<?= $dataEdit['nama_kelas']; ?>">
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
              <h4 class="modal-title">Tambah Data Kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
              	<div class="form-group">
              		<label for="kelas">Nama Kelas</label>
              		<input type="text" name="kelas" id="kelas" class="form-control">
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