<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
?>

<?php  
  if ( $levelLogin !== "super admin" ) {
    echo "
      <script>
        document.location.href = 'bo';
      </script>
    ";
  }
    
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="bo">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
          <div class="tambah-data">
          	<a href="user-add" class="btn btn-primary">Tambah Data</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <?php  
    	$data = query("SELECT * FROM user ORDER BY user_id DESC");
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data User Keseluruhan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th style="text-transform: capitalize;">Nama</th>
                  <th>No. Hp</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th style="text-align: center;">Status</th>
                  <th style="text-align: center;">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php $i = 1; ?>
                <?php foreach ( $data as $row ) : ?>
                <tr>
                  	<td><?= $i; ?></td>
                  	<td><?= $row['user_nama']; ?></td>
                   	<td><?= $row['user_no_hp']; ?></td>
                    <td><?= $row['user_email']; ?></td>
                   	<td style="text-transform: capitalize;"><?= $row['user_level']; ?></td>
                    <td style="text-align: center;">
                    	<?php 
                    		if ( $row['user_status'] === "1" ) {
                    			echo "<b>Aktif</b>";
                    		} else {
                    			echo "<b style='color: red;'>Tidak Aktif</b>";
                    		}
                    	?>		
                    </td>
                    <td style="text-align: center; width: 15%;">
                      <?php 
                        $id = $row["user_id"];
                      ?>

                    	<a href="user-zoom?id=<?= $id; ?>" title="Zoom Data">
                            <button class="btn btn-success" type="submit">
                               <i class="fa fa-search"></i>
                            </button>
                        </a>
                    	<a href="user-edit?id=<?= $id; ?>" title="Edit Data">
                            <button class="btn btn-primary" type="submit">
                               <i class="fa fa-edit"></i>
                            </button>
                        </a>
                        <a href="user-delete?id=<?= $row["user_id"]; ?>" onclick="return confirm('Yakin dihapus ?')" title="Delete Data">
                            <button class="btn btn-danger" type="submit" name="hapus">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                <?php $i++; ?>
            	<?php endforeach; ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>


<?php include '_footer.php'; ?>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
</body>
</html>
