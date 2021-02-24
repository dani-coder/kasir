<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
?>


	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="bo">Home</a></li>
              <li class="breadcrumb-item active">Penjualan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data barang Penjualan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-auto">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 6%;">No.</th>
                  <th style="width: 13%;">Invoice</th>
                  <th>Tanggal</th>
                  <th>Customer</th>
                  <th>Total</th>
                  <th>Bayar</th>
                  <th>Kembali</th>
                  <th>Kasir</th>
                  <th style="text-align: center;">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                  $i = 1; 
                  $queryInvoice = $conn->query("SELECT invoice.invoice_id ,invoice.penjualan_invoice, invoice.invoice_tgl, customer.customer_id, customer.customer_nama, invoice.invoice_total, invoice.invoice_bayar, invoice.invoice_kembali, user.user_id, user.user_nama
                             FROM invoice 
                             JOIN customer ON invoice.invoice_customer = customer.customer_id
                             JOIN user ON invoice.invoice_kasir = user.user_id
                             ORDER BY invoice_id DESC
                             ");
                  while ($rowProduct = mysqli_fetch_array($queryInvoice)) {
                ?>
                <tr>
                  	<td><?= $i; ?></td>
                    <td><?= $rowProduct['penjualan_invoice']; ?></td>
                    <td><?= $rowProduct['invoice_tgl']; ?></td>
                    <td>
                        <?php  
                          $customer = $rowProduct['customer_nama'];   
                          if  ( $customer === 'Umum' ) {
                            echo "<b style='color: red;'>Umum</b>";
                          } else {
                            echo($customer);
                          }
                        ?> 
                    </td>
                    <td>Rp. <?= number_format($rowProduct['invoice_total'], 0, ',', '.'); ?></td>
                    <td>Rp. <?= number_format($rowProduct['invoice_bayar'], 0, ',', '.'); ?></td>
                    <td>Rp. <?= number_format($rowProduct['invoice_kembali'], 0, ',', '.'); ?></td>
                    <td><?= $rowProduct['user_nama'] ?></td>
                    <td style="text-align: center; width: 20%;">
                      <?php $id = $rowProduct['invoice_id']; ?>
                        <a href="penjualan-zoom?no=<?= $id; ?>-invoice-<?= $rowProduct['penjualan_invoice']; ?>" title="Lihat Data">
                            <button class="btn btn-primary" type="submit">
                               <i class="fa fa-eye"></i>
                            </button>
                        </a>
                    	  <a href="penjualan-edit?no=<?= $id; ?>-invoice-<?= $rowProduct['penjualan_invoice']; ?>" title="Edit Data" onclick="return confirm('Fitur ini digunkan untuk EDIT TRANSAKSI yang salah satu barang pembelian TIDAK JADI.. Apakah Anda Yakin !!!')">
                            <button class="btn btn-warning" type="submit">
                               <i class="fa fa-edit"></i>
                            </button>
                        </a>
                        <a href="nota-cetak?no=<?= $id; ?>-invoice-<?= $rowProduct['penjualan_invoice']; ?>" title="Cetak Nota" target="_blank">
                            <button class="btn btn-success" type="submit">
                               <i class="fa fa-print"></i>
                            </button>
                        </a>
                        <?php if ( $levelLogin !== "kasir" ) { ?>
                        <a href="penjualan-delete-invoice?id=<?= $rowProduct['penjualan_invoice']; ?>" onclick="return confirm('Apakah Anda Yakin Hapus Seluruh Data No. Invoice <?= $rowProduct['penjualan_invoice']; ?> ?')" title="Delete Invoice">
                            <button class="btn btn-danger" type="submit" name="hapus">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </a>
                        <?php } ?>
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