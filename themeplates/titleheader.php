<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
            <?php 
            if($page == 'pengguna') {
              echo "Data Pengguna";
            } else if($page == 'kelas') {
              echo "Data Kelas";
            } else if($page == 'tahun') {
              echo "Data Tahun Ajarang";
            } else if($page == 'siswa') {
              echo "Data Siswa";
            } else {
              echo "Dashboard";
            }
            ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">
                <?php 
                  if($page == 'pengguna') {
                    echo "Data Pengguna";
                  } else if($page == 'kelas') {
                    echo "Data Kelas";
                  } else if($page == 'tahun') {
                    echo "Data Tahun Ajarang";
                  } else if($page == 'siswa') {
                    echo "Data Siswa";
                  } else {
                    echo "Dashboard";
                  }
                ?>

              </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>