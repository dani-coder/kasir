<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
?>

<?php  
  // ambil data di URL
  $id = $_GET['no'];

  // query data mahasiswa berdasarkan id
  $invoice = query("SELECT * FROM invoice WHERE penjualan_invoice = $id ")[0];

  if ( $invoice == null ) {
    header("location: penjualan");
  }
?>

	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="bo">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
				Halaman ini telah ditingkatkan untuk dicetak. Klik tombol cetak di bagian bawah faktur.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> N0. Invoice: <?= $id; ?>
                    <small class="float-right">Tanggal: <?= $invoice['invoice_tgl']; ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <?php  
                  $toko = query("SELECT * FROM toko WHERE toko_id = 1");
              ?>
              <?php foreach ( $toko as $row ) : ?>
                  <?php 
                    $toko_nama   = $row['toko_nama'];
                    $toko_kota   = $row['toko_kota'];
                    $toko_tlpn   = $row['toko_tlpn'];
                    $toko_wa     = $row['toko_wa']; 
                    $toko_email  = $row['toko_email'];
                    $toko_alamat = $row['toko_alamat'];
                  ?>
              <?php endforeach; ?>
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dari
                  <address>
                    <strong><?= $toko_nama; ?></strong><br>
                    <?= $toko_alamat; ?><br>
                    Tlpn/wa: <?= $toko_tlpn; ?> / <?= $toko_wa; ?><br>
                    Email: <?= $toko_email; ?><br>

                    <?php  
                    	$kasir = $invoice['invoice_kasir'];
                    	$dataKasir = query("SELECT * FROM user WHERE user_id = $kasir");
                    ?>
                    <?php foreach ( $dataKasir as $ksr ) : ?>
                    	<?php $ksrDetail = $ksr['user_nama']; ?>
                    <?php endforeach; ?>

                    <b>Kasir: </b><?= $ksrDetail; ?>
                  </address>
                </div>
                <!-- /.col -->

                <div class="col-sm-4 invoice-col">
                  Pembeli
                  <address>
                  	<?php  
                    	$customer = $invoice['invoice_customer'];
                    	$dataCustomer = query("SELECT * FROM customer WHERE customer_id = $customer");
                    ?>
                    <?php foreach ( $dataCustomer as $ctr ) : ?>
                    	<?php 
                    		$ctrNama   = $ctr['customer_nama']; 
                    		$ctrAlamat = $ctr['customer_alamat'];
                    		$ctrEmail  = $ctr['customer_email'];
                    		$ctrTlpn   = $ctr['customer_tlpn'];
                    	?>
                    <?php endforeach; ?>

                    <strong><?= $ctrNama; ?></strong><br>
                    <?= $ctrAlamat; ?><br>
                    Tlpn/wa:
                    	<?php  
                    		if ( $ctrTlpn == null ) {
                    			echo"-";
                    		} else {
                    			echo($ctrTlpn);
                    		}
                    	?>

                    <br>
                    Email: 
                    	<?php  
                    		if ( $ctrEmail == null ) {
                    			echo"-";
                    		} else {
                    			echo($ctrEmail);
                    		}
                    	?>
                  </address>
                </div>

                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <div class="table-auto">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $invoice1 = $id;
  	                  $i = 1; 
  	                  $queryProduct = $conn->query("SELECT penjualan.penjualan_id, barang.barang_id, barang.barang_nama, barang.barang_harga, penjualan.barang_qty, penjualan.penjualan_invoice
  	                             FROM penjualan 
  	                             JOIN barang ON penjualan.barang_id = barang.barang_id
  	                             WHERE penjualan_invoice = $invoice1
  	                             ORDER BY penjualan_id DESC
  	                             ");
  	                  while ($rowProduct = mysqli_fetch_array($queryProduct)) {
  	                ?>
  	                
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $rowProduct['barang_nama']; ?></td>
                        <td><?= $rowProduct['barang_harga']; ?></td>
                        <td><?= $rowProduct['barang_qty']; ?></td>
                        <td>
                        	<?php  
                        		$subTotal = $rowProduct['barang_qty'] * $rowProduct['barang_harga'];
                        		echo($subTotal);
                        	?>
                        </td>
                      </tr>
                      <?php $i++; ?>
                  	<?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Total:</th>
                        <td>Rp. <?= number_format($invoice['invoice_total'], 0, ',', '.'); ?></td>
                      </tr>
                      <tr>
                        <th>Bayar</th>
                        <td>Rp. <?= number_format($invoice['invoice_bayar'], 0, ',', '.'); ?></td>
                      </tr>
                      <tr>
                        <th>Uang Kembali</th>
                        <td>Rp. <?= number_format($invoice['invoice_kembali'], 0, ',', '.'); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  
                  <a href="nota-cetak?no=<?= $invoice['invoice_id']; ?>-invoice-<?= $id; ?>" target="_blank" class="btn btn-primary float-right"><i class="fas fa-print"></i> Print Invoice</a>
                  <a href="beli-langsung" class="btn btn-default float-right" style="margin-right: 5px;"> Kembali Transaksi</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include '_footer.php'; ?>