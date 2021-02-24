<?php 
  include 'aksi/halau.php'; 
  include 'aksi/functions.php';
?>
<?php  
  $status = $_SESSION['user_status'];
    if ( $status === '0') {
    echo"
          <script>
            alert('Akun Tidak Aktif');
            window.location='./';
          </script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nota Cetak POS -  Gotosovie</title>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/style.css">

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php  
	// ambil data di URL
	$id = abs((int)$_GET['no']);

	// query data 
	$invoice = query("SELECT * FROM invoice WHERE invoice_id = $id ")[0];
?>

<!-- Nama Kasir -->
<?php  
    $kasir = $invoice['invoice_kasir'];
    $dataKasir = query("SELECT * FROM user WHERE user_id = $kasir");
?>
<?php foreach ( $dataKasir as $ksr ) : ?>
    <?php $ksrDetail = $ksr['user_nama']; ?>
<?php endforeach; ?>

<!-- Nama Customer -->
<?php  
    $customer = $invoice['invoice_customer'];
    $dataCustomer = query("SELECT * FROM customer WHERE customer_id = $customer");
?>
<?php foreach ( $dataCustomer as $ctr ) : ?>
    <?php 
        $ctrNama   = $ctr['customer_nama']; 
    ?>
<?php endforeach; ?>

<?php  
    $toko = query("SELECT * FROM toko WHERE toko_id = 1");
?>
<?php foreach ( $toko as $row ) : ?>
    <?php 
    	$toko_nama = $row['toko_nama'];
    	$toko_kota = $row['toko_kota'];
    	$toko_tlpn = $row['toko_tlpn'];
    	$toko_wa = $row['toko_wa']; 
    ?>
<?php endforeach; ?>

	<section class="nota" style="width: 10cm; height: 10cm">
		<div class="nota-box">
			<div class="nota-box-title">
				<div class="nbt-parent">
					<?= $toko_nama; ?>
				</div>
				<div class="nbt-address">
					<?= $toko_kota; ?>
				</div>
				<div class="nbt-contact">
					<ul>
					    <li><b>No.tlpn:</b> <?= $toko_tlpn; ?></li>
					    <li><b>Wa:</b> <?= $toko_wa; ?></li>
					</ul>
				</div>
			</div>

			<div class="nota-box-info">
				<div class="row">
					<div class="col-sm-7 col-md-7 col-lg-7 col-padding">
						<div class="nbi-text">
							<div class="nbi-text-parent">
								<b>Tanggal:</b> <?= $invoice['invoice_tgl']; ?>
							</div>
							<div class="nbi-text-parent">
								<b>Invoice:</b> <?= $invoice['penjualan_invoice']; ?>
							</div>
						</div>
					</div>
					<div class="col-sm-5 col-md-5 col-lg-5 col-padding">
						<div class="nbi-text nbi-text-2">
							<div class="nbi-text-parent">
								<b>Kasir:</b> <?= $ksrDetail; ?>
							</div>
							<div class="nbi-text-parent">
								<b>Pembeli:</b> <?= $ctrNama; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="nota-box-table">
				<table class="table">
					<?php 
                      $invoice1 = $invoice['penjualan_invoice'];
	                  $i = 1; 
	                  $queryProduct = $conn->query("SELECT penjualan.penjualan_id, barang.barang_id, barang.barang_nama, barang.barang_harga, barang.barang_harga, penjualan.barang_qty, penjualan.penjualan_invoice
	                             FROM penjualan 
	                             JOIN barang ON penjualan.barang_id = barang.barang_id
	                             WHERE penjualan_invoice = $invoice1
	                             ORDER BY penjualan_id DESC
	                             ");
	                  while ($rowProduct = mysqli_fetch_array($queryProduct)) {
	                ?>
					<tr>
						<td><?= $rowProduct['barang_nama']; ?></td>
                      	<td><?= $rowProduct['barang_qty']; ?></td>
                      	<td><?= number_format($rowProduct['barang_harga'], 0, ',', '.'); ?></td>
                      	<td>
                      	<?php  
                      		$subTotal = $rowProduct['barang_qty'] * $rowProduct['barang_harga'];
                      		echo(number_format($subTotal, 0, ',', '.'));
                      	?>
                      	</td>
					</tr>
					<?php } ?>
				</table>
			</div>
			<div class="nota-box-text">
				<div class="nbt-text">
					<b>Total:</b> Rp. <?= number_format($invoice['invoice_total'], 0, ',', '.'); ?>
				</div>
				<div class="nbt-text">
					<b>Bayar:</b> Rp. <?= number_format($invoice['invoice_bayar'], 0, ',', '.'); ?>
				</div>
				<div class="nbt-text">
					<b>Kembali:</b> Rp. <?= number_format($invoice['invoice_kembali'], 0, ',', '.'); ?>
				</div>
			</div>

			<div class="nota-box-footer">
				<div class="nbf-text">
					Powered By
				</div>
				<div class="nbf-url">
					www.Gotosovie.com
				</div>
			</div>
		</div>
	</section>

</body>
</html>
<script>
	window.print();
</script>