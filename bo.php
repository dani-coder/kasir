<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
?>

  <?php  
    // Penjualan
    $penjualan = mysqli_query($conn,"select * from penjualan");
    $jmlPenjualan = mysqli_num_rows($penjualan);

    // Barang
    $barang = mysqli_query($conn,"select * from barang");
    $jmlBarang = mysqli_num_rows($barang);

    // Customer
    $customer = mysqli_query($conn,"select * from customer");
    $jmlCustomer = mysqli_num_rows($customer);

    // Invoice
    $invoice = mysqli_query($conn,"select * from invoice");
    $jmlInvoice = mysqli_num_rows($invoice);
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="bo">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $jmlPenjualan; ?></h3>

                <p>Barang Terjual</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $jmlBarang; ?></h3>

                <p>Jumlah Barang</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $jmlCustomer; ?></h3>

                <p>Customer</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $jmlInvoice; ?></h3>

                <p>Data Invoice</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <section class="table-informasi">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Barang Terlaris</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Barang</th>
                    <th>Nama</th>
                    <th>Terjual</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 
                    $i = 1; 
                    $queryProduct = $conn->query("SELECT barang.barang_id, barang.barang_kode, barang.barang_nama, barang.barang_harga, barang.barang_terjual
                               FROM barang 
                               ORDER BY barang_terjual DESC LIMIT 5
                               ");
                    while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                  ?>
                  <tr>
                      <td><?= $i; ?></td>
                      <td><?= $rowProduct['barang_kode']; ?></td>
                      <td><?= $rowProduct['barang_nama']; ?></td>
                      <td>
                        <b><?= $rowProduct['barang_terjual']; ?></b>
                      </td>
                  </tr>
                  <?php $i++; ?>
                  <?php } ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Stok Terkecil</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode Barang</th>
                  <th>Nama</th>
                  <th>Stock</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                  $i = 1; 
                  $queryProduct = $conn->query("SELECT barang.barang_id, barang.barang_kode, barang.barang_nama, barang.barang_harga, barang.barang_stock
                             FROM barang 
                             ORDER BY barang_stock ASC LIMIT 5
                             ");
                  while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $rowProduct['barang_kode']; ?></td>
                    <td><?= $rowProduct['barang_nama']; ?></td>
                    <td>
                      <b><?= $rowProduct['barang_stock']; ?></b>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php } ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->


<?php include '_footer.php'; ?>