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
	<title>Nota Cetak POS - Seniman Koding</title>
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
	$invoice = query("SELECT * FROM invoice_pembelian WHERE invoice_pembelian_id = $id ")[0];
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
    $supplier = $invoice['invoice_supplier'];
    $dataSupplier = query("SELECT * FROM supplier WHERE supplier_id = $supplier");
?>
<?php foreach ( $dataSupplier as $ctr ) : ?>
    <?php 
        $ctrNama   = $ctr['supplier_nama']; 
        $ctrCmpn   = $ctr['supplier_company']; 
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
								<b>Invoice:</b> <?= $invoice['pembelian_invoice']; ?>
							</div>
						</div>
					</div>
					<div class="col-sm-5 col-md-5 col-lg-5 col-padding">
						<div class="nbi-text nbi-text-2">
							<div class="nbi-text-parent">
								<b>Kasir:</b> <?= $ksrDetail; ?>
							</div>
							<div class="nbi-text-parent">
								<b>Supplier:</b> <?= $ctrNama; ?> - <?= $ctrCmpn; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="nota-box-table">
				<table class="table">
					<?php 
                      $invoice1 = $invoice['pembelian_invoice'];
	                  $i = 1; 
	                  $queryProduct = $conn->query("SELECT pembelian.pembelian_id, barang.barang_id, barang.barang_nama, pembelian.barang_harga_beli, pembelian.barang_qty, pembelian.pembelian_invoice
	                             FROM pembelian 
	                             JOIN barang ON pembelian.barang_id = barang.barang_id
	                             WHERE pembelian_invoice = $invoice1
	                             ORDER BY pembelian_id DESC
	                             ");
	                  while ($rowProduct = mysqli_fetch_array($queryProduct)) {
	                ?>
					<tr>
						<td><?= $rowProduct['barang_nama']; ?></td>
                      	<td><?= $rowProduct['barang_qty']; ?></td>
                      	<td><?= number_format($rowProduct['barang_harga_beli'], 0, ',', '.'); ?></td>
                      	<td>
                      	<?php  
                      		$subTotal = $rowProduct['barang_qty'] * $rowProduct['barang_harga_beli'];
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
					www.gotosovie.com
				</div>
			</div>
		</div>
	</section>

</body>
</html>
<script>
	window.print();
</script>