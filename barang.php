<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
  error_reporting(0);
?>
<?php  
  if ( $levelLogin === "kasir") {
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
            <h1>Data Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="bo">Home</a></li>
              <li class="breadcrumb-item active">Barang</li>
            </ol>
          </div>
          <div class="tambah-data">
          	<a href="barang-add" class="btn btn-primary">Tambah Data</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <?php  
    	// $data = query("SELECT * FROM barang ORDER BY barang_id DESC");
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data barang Keseluruhan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-auto">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 6%;">No.</th>
                    <th style="width: 13%;">Kode Barang</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <!-- <th>Harga Beli</th> -->
                    <th>Harga Jual</th>
                    <th>Stock</th>
                    <th>Satuan</th>
                    <th>Status</th>
                    <th style="text-align: center;">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 
                    $i = 1; 
                    $queryProduct = $conn->query("SELECT barang.barang_id, barang.barang_kode, barang.barang_nama, barang.barang_harga, barang.barang_stock, barang.barang_status, kategori.kategori_id, kategori.kategori_nama, satuan.satuan_id, satuan.satuan_nama
                               FROM barang 
                               JOIN kategori ON barang.kategori_id = kategori.kategori_id
                               JOIN satuan ON barang.satuan_id = satuan.satuan_id
                               
                               ORDER BY barang_id DESC
                               ");
                    while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                  ?>
                  <tr>
                    	<td><?= $i; ?></td>
                      <td><?= $rowProduct['barang_kode'] ?></td>
                      <td><?= $rowProduct['barang_nama'] ?></td>
                      <td><?= $rowProduct['kategori_nama'] ?></td>
                      <!-- <td>
                          <?php  
                            $bik = $rowProduct['barang_id'];

                            $hargaBeli = query("SELECT * FROM pembelian WHERE barang_id = $bik ORDER BY pembelian_id DESC LIMIT 1")[0];

                            $brg = $hargaBeli['barang_harga_beli'];
                          ?>
                          <?php  
                              if ( $brg < 1 ) {
                                $bhb = "-";
                              } else {
                                $bhb = number_format($brg, 0, ',', '.');
                              }
                              echo "Rp. ".$bhb;
                          ?> 
                      </td> -->
                      <td>Rp. <?= number_format($rowProduct['barang_harga'], 0, ',', '.'); ?></td>
                      <td><?= $rowProduct['barang_stock'] ?></td>
                      <td><?= $rowProduct['satuan_nama'] ?></td>
                      <td><?= $rowProduct['barang_status'] ?></td>
                      <td style="text-align: center; width: 15%;">
                        <?php $id = $rowProduct["barang_id"]; ?>
                          <a href="barang-zoom?id=<?= $id; ?>" title="Zoom Data">
                              <button class="btn btn-success" type="submit">
                                 <i class="fa fa-search"></i>
                              </button>
                          </a>
                      	  <a href="barang-edit?id=<?= $id; ?>" title="Edit Data">
                              <button class="btn btn-primary" type="submit">
                                 <i class="fa fa-edit"></i>
                              </button>
                          </a>
                          <a href="barang-delete?id=<?= $id; ?>" onclick="return confirm('Yakin dihapus ?')" title="Delete Data">
                              <button class="btn btn-danger" type="submit" name="hapus">
                                  <i class="fa fa-trash-o"></i>
                              </button>
                          </a>
                      </td>
                  </tr>
                  <?php $i++; ?>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
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