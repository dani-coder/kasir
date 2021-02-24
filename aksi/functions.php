<?php 

// koneksi ke database
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


// ================================================ USER ====================================== //
 
function tambahUser($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$user_nama = htmlspecialchars($data["user_nama"]);
	$user_no_hp = htmlspecialchars($data["user_no_hp"]);
	$user_alamat = htmlspecialchars($data["user_alamat"]);
	$user_email = htmlspecialchars($data["user_email"]);
	$user_password = md5(md5(htmlspecialchars($data["user_password"])));
	$user_create = date("d F Y g:i:s a");
	$user_level = htmlspecialchars($data["user_level"]);
	$user_status = htmlspecialchars($data["user_status"]);

	// Cek Email
	$email_user_cek = mysqli_num_rows(mysqli_query($conn, "select * from user where user_email = '$user_email' "));

	if ( $email_user_cek > 0 ) {
		echo "
			<script>
				alert('Email Sudah Terdaftar');
			</script>
		";
	} else {
		// query insert data
		$query = "INSERT INTO user VALUES ('', '$user_nama', '$user_no_hp', '$user_alamat', '$user_email', '$user_password', '$user_create', '$user_level' , '$user_status')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

function editUser($data){
	global $conn;
	$id = $data["user_id"];


	// ambil data dari tiap elemen dalam form
	$user_nama = htmlspecialchars($data["user_nama"]);
	$user_no_hp = htmlspecialchars($data["user_no_hp"]);
	$user_email = htmlspecialchars($data["user_email"]);
	$user_alamat = htmlspecialchars($data["user_alamat"]);
	$user_password = md5(md5(htmlspecialchars($data["user_password"])));
	$user_level = htmlspecialchars($data["user_level"]);
	$user_status = htmlspecialchars($data["user_status"]);

		// query update data
		$query = "UPDATE user SET 
						user_nama      = '$user_nama',
						user_no_hp     = '$user_no_hp',
						user_alamat    = '$user_alamat',
						user_email     = '$user_email',
						user_password  = '$user_password',
						user_level     = '$user_level',
						user_status    = '$user_status'
						WHERE user_id  = $id
				";
		// var_dump($query); die();
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);

}


function hapusUser($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM user WHERE user_id = $id");

	return mysqli_affected_rows($conn);
}
// ========================================= Toko ======================================== //
function editToko($data) {
	global $conn;
	$id = $data["toko_id"];

	// ambil data dari tiap elemen dalam form
	$toko_nama      = htmlspecialchars($data["toko_nama"]);
	$toko_kota      = htmlspecialchars($data["toko_kota"]);
	$toko_alamat    = htmlspecialchars($data["toko_alamat"]);
	$toko_tlpn      = htmlspecialchars($data["toko_tlpn"]);
	$toko_wa        = htmlspecialchars($data["toko_wa"]);
	$toko_email     = htmlspecialchars($data["toko_email"]);

	// query update data
	$query = "UPDATE toko SET 
				toko_nama       = '$toko_nama',
				toko_kota       = '$toko_kota',
				toko_alamat     = '$toko_alamat',
				toko_tlpn       = '$toko_tlpn',
				toko_wa         = '$toko_wa',
				toko_email      = '$toko_email'
				WHERE toko_id   = $id
				";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// ========================================= Kategori ======================================= //
function tambahKategori($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$kategori_nama = htmlspecialchars($data['kategori_nama']);
	$kategori_status = $data['kategori_status'];

	// query insert data
	$query = "INSERT INTO kategori VALUES ('', '$kategori_nama', '$kategori_status')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function editKategori($data) {
	global $conn;
	$id = $data["kategori_id"];

	// ambil data dari tiap elemen dalam form
	$kategori_nama = htmlspecialchars($data['kategori_nama']);
	$kategori_status = $data['kategori_status'];

	// query update data
	$query = "UPDATE kategori SET 
				kategori_nama   = '$kategori_nama',
				kategori_status = '$kategori_status'
				WHERE kategori_id = $id
				";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapusKategori($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM kategori WHERE kategori_id = $id");

	return mysqli_affected_rows($conn);
}


// ======================================= Satuan ========================================= //
function tambahSatuan($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$satuan_nama = htmlspecialchars($data['satuan_nama']);
	$satuan_status = $data['satuan_status'];

	// query insert data
	$query = "INSERT INTO satuan VALUES ('', '$satuan_nama', '$satuan_status')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function editSatuan($data) {
	global $conn;
	$id = $data["satuan_id"];

	// ambil data dari tiap elemen dalam form
	$satuan_nama = htmlspecialchars($data['satuan_nama']);
	$satuan_status = $data['satuan_status'];

	// query update data
	$query = "UPDATE satuan SET 
				satuan_nama   = '$satuan_nama',
				satuan_status = '$satuan_status'
				WHERE satuan_id = $id
				";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapusSatuan($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM satuan WHERE satuan_id = $id");

	return mysqli_affected_rows($conn);
}


// ===================================== ekspedisi ========================================= //
function tambahEkspedisi($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$ekspedisi_nama = htmlspecialchars($data['ekspedisi_nama']);
	$ekspedisi_status = $data['ekspedisi_status'];

	// query insert data
	$query = "INSERT INTO ekspedisi VALUES ('', '$ekspedisi_nama', '$ekspedisi_status')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function editEkspedisi($data) {
	global $conn;
	$id = $data["ekspedisi_id"];

	// ambil data dari tiap elemen dalam form
	$ekspedisi_nama = htmlspecialchars($data['ekspedisi_nama']);
	$ekspedisi_status = $data['ekspedisi_status'];

	// query update data
	$query = "UPDATE ekspedisi SET 
				ekspedisi_nama   = '$ekspedisi_nama',
				ekspedisi_status = '$ekspedisi_status'
				WHERE ekspedisi_id = $id
				";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapusEkspedisi($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM ekspedisi WHERE ekspedisi_id = $id");

	return mysqli_affected_rows($conn);
}


// ======================================== Barang =============================== //
function tambahBarang($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$barang_kode      = htmlspecialchars($data["barang_kode"]);
	$barang_nama      = htmlspecialchars($data["barang_nama"]);
	$barang_deskripsi = htmlspecialchars($data["barang_deskripsi"]);
	$barang_status 	  = htmlspecialchars($data["barang_status"]);
	$barang_harga     = htmlspecialchars($data["barang_harga"]);
	$kategori_id      = $data["kategori_id"];
	$satuan_id        = $data["satuan_id"];
	$barang_tanggal   = date("d F Y g:i:s a");
	$barang_stock     = htmlspecialchars($data["barang_stock"]);
	

	// Cek Email
	$barang_kode_cek = mysqli_num_rows(mysqli_query($conn, "select * from barang where barang_kode = '$barang_kode' "));

	if ( $barang_kode_cek > 0 ) {
		echo "
			<script>
				alert('Kode Barang Sudah Ada Coba Kode yang Lain !!!');
			</script>
		";
	} else {
		// query insert data
		$query = "INSERT INTO barang VALUES ('', '$barang_kode', '$barang_nama', '$barang_harga', '$barang_stock', '$barang_tanggal', '$kategori_id', '$satuan_id' , '$barang_deskripsi', '','$barang_status' )";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}


function editBarang($data) {
	global $conn;
	$id = $data["barang_id"];

	// ambil data dari tiap elemen dalam form
	$barang_kode      = htmlspecialchars($data["barang_kode"]);
	$barang_nama      = htmlspecialchars($data["barang_nama"]);
	$barang_deskripsi = htmlspecialchars($data["barang_deskripsi"]);
	$barang_harga     = htmlspecialchars($data["barang_harga"]);
	$kategori_id      = $data["kategori_id"];
	$satuan_id        = $data["satuan_id"];
	$barang_stock     = htmlspecialchars($data["barang_stock"]);
	$barang_status     = htmlspecialchars($data["barang_status"]);

	// query update data
	$query = "UPDATE barang SET 
				barang_kode       = '$barang_kode',
				barang_nama       = '$barang_nama',
				barang_harga      = '$barang_harga',
				barang_stock      = '$barang_stock',
				barang_status      = '$barang_status',
				kategori_id       = '$kategori_id',
				satuan_id         = '$satuan_id',
				barang_deskripsi  = '$barang_deskripsi'
				WHERE barang_id   = $id
				";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}


function hapusBarang($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM barang WHERE barang_id = $id");

	return mysqli_affected_rows($conn);
}

// ===================================== Keranjang ========================================= //
function tambahKeranjang($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$barang_id          = $data['barang_id'];
	$keranjang_nama     = $data['keranjang_nama'];
	$keranjang_harga    = $data['keranjang_harga'];
	$keranjang_id_kasir = $data['keranjang_id_kasir'];
	$keranjang_qty      = 1;
	$keranjang_id_cek   = $barang_id.$keranjang_id_kasir;

	// Cek STOCK
	$barang_id_cek = mysqli_num_rows(mysqli_query($conn, "select * from keranjang where keranjang_id_cek = '$keranjang_id_cek' "));
	
		
	if ( $barang_id_cek > 0 ) {
		echo "
			<script>
				alert('Barang ini sudah Anda Tambahkan Sebelumnya!! JIKA ingin menambahkan QTY langsung saja di input angka QTY kemudian klik TOMBOL REFRESH');
			</script>
		";

	} else {
		// query insert data
		$query = "INSERT INTO keranjang VALUES ('', '$keranjang_nama', '$keranjang_harga', '$barang_id', '$keranjang_qty', '$keranjang_id_kasir', '$keranjang_id_cek')";
		
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

function updateQTY($data) {
	global $conn;
	$id = $data["keranjang_id"];

	// ambil data dari tiap elemen dalam form
	$keranjang_qty = htmlspecialchars($data['keranjang_qty']);
	$stock_brg = $data['stock_brg'];

	if ( $keranjang_qty > $stock_brg ) {
		echo"
			<script>
				alert('QTY Melebihi Stock Barang.. Coba Cek Lagi !!!');
				document.location.href = 'beli-langsung.php';
			</script>
		";
	} else {
		// query update data
		$query = "UPDATE keranjang SET 
					keranjang_qty   = '$keranjang_qty'
					WHERE keranjang_id = $id
					";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
}

function hapusKeranjang($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM keranjang WHERE keranjang_id = $id");

	return mysqli_affected_rows($conn);
}


function updateStock($data) {
	global $conn;
	$id                  = $data["barang_ids"];
	$keranjang_qty       = $data["keranjang_qty"];
	$keranjang_id_kasir  = $data['keranjang_id_kasir'];
	$penjualan_invoice   = $data['penjualan_invoice'];
	$kik                 = $data['kik'];

	$penjualan_invoice2  = $data['penjualan_invoice2'];
	$invoice_tgl         = date("d F Y g:i:s a");
	$invoice_customer    = $data['invoice_customer'];
	$invoice_total       = $data['invoice_total'];
	$invoice_bayar       = $data['angka1'];
	$invoice_kembali     = $invoice_bayar - $invoice_total;
	$invoice_date        = date("Y-m-d");
	$penjualan_date      = $data['penjualan_date'];

	$jumlah = count($keranjang_id_kasir);
	
	// $stock = mysqli_query( $conn, "select barang_stock from barang where barang_id = $id");
	// $kn = mysqli_fetch_array($stock); 
	// $nKn = $kn['barang_stock'];
    
 //    $stoks = $nKn - $keranjang_qty;


	// $query = "UPDATE barang SET barang_stock = $stoks WHERE barang_id = $id";
	// mysqli_query($conn, $query);

	// query insert invoice
	$query1 = "INSERT INTO invoice VALUES ('', '$penjualan_invoice2', '$invoice_tgl', '$invoice_customer', '$invoice_total', '$invoice_bayar', '$invoice_kembali', '$kik', '$invoice_date', ' ', ' ', '$invoice_total', '$invoice_bayar', '$invoice_kembali')";
	// var_dump($query1); die();
	mysqli_query($conn, $query1);

	for( $x=0; $x<$jumlah; $x++ ){
		$query = "INSERT INTO penjualan VALUES ('', '$id[$x]', '$keranjang_qty[$x]', '$keranjang_id_kasir[$x]', '$penjualan_invoice[$x]' , '$penjualan_date[$x]', '$keranjang_qty[$x]', '$keranjang_qty[$x]')";
		$query2 = "INSERT INTO terlaris VALUES ('', '$id[$x]', '$keranjang_qty[$x]')";

		mysqli_query($conn, $query);
		mysqli_query($conn, $query2);
	}
	

	mysqli_query( $conn, "DELETE FROM keranjang WHERE keranjang_id_kasir = $kik");
	return mysqli_affected_rows($conn);


}

// =========================================== CUSTOMER ====================================== //
 
function tambahCustomer($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$customer_nama     = htmlspecialchars($data["customer_nama"]);
	$customer_tlpn     = htmlspecialchars($data["customer_tlpn"]);
	$customer_email    = htmlspecialchars($data["customer_email"]);
	$customer_alamat   = htmlspecialchars($data["customer_alamat"]);
	$customer_create   = date("d F Y g:i:s a");
	$customer_status   = htmlspecialchars($data["customer_status"]);

	// Cek Email
	$customer_tlpn_cek = mysqli_num_rows(mysqli_query($conn, "select * from customer where customer_tlpn = '$customer_tlpn' "));

	if ( $customer_tlpn_cek > 0 ) {
		echo "
			<script>
				alert('Customer Sudah Terdaftar');
			</script>
		";
	} else {
		// query insert data
		$query = "INSERT INTO customer VALUES ('', '$customer_nama', '$customer_tlpn', '$customer_email', '$customer_alamat', '$customer_create', '$customer_status')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

function editCustomer($data){
	global $conn;
	$id = $data["customer_id"];


	// ambil data dari tiap elemen dalam form
	$customer_nama     = htmlspecialchars($data["customer_nama"]);
	$customer_tlpn     = htmlspecialchars($data["customer_tlpn"]);
	$customer_email    = htmlspecialchars($data["customer_email"]);
	$customer_alamat   = htmlspecialchars($data["customer_alamat"]);
	$customer_status   = htmlspecialchars($data["customer_status"]);

		// query update data
		$query = "UPDATE customer SET 
						customer_nama     = '$customer_nama',
						customer_tlpn     = '$customer_tlpn',
						customer_email    = '$customer_email',
						customer_alamat   = '$customer_alamat',
						customer_status   = '$customer_status'
						WHERE customer_id = $id
				";
		// var_dump($query); die();
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);

}


function hapusCustomer($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM customer WHERE customer_id = $id");

	return mysqli_affected_rows($conn);
}


// =========================================== Panjualan ===================================== //
function hapusPenjualan($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM penjualan WHERE penjualan_id = $id");

	return mysqli_affected_rows($conn);
}

function hapusPenjualanInvoice($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM penjualan WHERE penjualan_invoice = $id");
	mysqli_query( $conn, "DELETE FROM invoice WHERE penjualan_invoice = $id");

	return mysqli_affected_rows($conn);
}

function updateQTY2($data) {
	global $conn;
	$id = $data["penjualan_id"];
	$bid = $data["barang_id"];

	// ambil data dari tiap elemen dalam form
	$barang_qty      = htmlspecialchars($data['barang_qty']);
	$barang_qty_lama = $data['barang_qty_lama'];

	// retur
	$barang_stock           = $data['barang_stock'];
	$barang_stock_kurang    = $barang_qty_lama - $barang_qty;
	$barang_stock_hasil     = $barang_stock + $barang_stock_kurang;
	// var_dump($barang_stock_hasil); die();

	if ( $barang_qty > $barang_qty_lama ) {
		echo"
			<script>
				alert('Jika Anda Ingin Menambahkan QTY Barang.. Lakukan Transaksi Invoice Baru !!!');
			</script>
		";
	} else {
		// query update data
		$query = "UPDATE penjualan SET 
					barang_qty       = '$barang_qty',
					barang_qty_lama  = '$barang_qty'
					WHERE penjualan_id = $id
					";
		$query1 = "UPDATE barang SET 
					barang_stock   = '$barang_stock_hasil'
					WHERE barang_id = $bid
					";
		mysqli_query($conn, $query1);
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
		// $query1 = "INSERT INTO retur VALUES ('', '$retur_barang_id', '$retur_invoice', '$retur_admin_id', '$retur_date', ' ', '$barang_stock')";
		// mysqli_query($conn, $query1);
		
	} 
}

function updateInvoice($data) {
	global $conn;
	$id = $data["invoice_id"];

	// ambil data dari tiap elemen dalam form
	$invoice_total        = htmlspecialchars($data['invoice_total']);
	$invoice_bayar        = htmlspecialchars($data['angka1']);
	$invoice_kembali      = $invoice_bayar - $invoice_total;
	$invoice_kasir_edit   = $data['invoice_kasir_edit'];
	$invoice_date_edit    = date('Y-m-d');

		// query update data
		$query = "UPDATE invoice SET 
					invoice_total      = '$invoice_total',
					invoice_bayar      = '$invoice_bayar',
					invoice_kembali    = '$invoice_kembali',
					invoice_date_edit  = '$invoice_date_edit',
					invoice_kasir_edit = '$invoice_kasir_edit'
					WHERE invoice_id = $id
					";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);

}

// ================================================ USER ====================================== //
 
function tambahSupplier($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$supplier_nama      = htmlspecialchars($data["supplier_nama"]);
	$supplier_wa 		= htmlspecialchars($data["supplier_wa"]);
	$supplier_alamat    = htmlspecialchars($data["supplier_alamat"]);
	$supplier_company   = htmlspecialchars($data["supplier_company"]);
	$supplier_status    = htmlspecialchars($data["supplier_status"]);
	$supplier_create    = date("d F Y g:i:s a");

	// Cek Email
	$supplier_wa_cek = mysqli_num_rows(mysqli_query($conn, "select * from supplier where supplier_wa = '$supplier_wa' "));

	if ( $supplier_wa_cek > 0 ) {
		echo "
			<script>
				alert('No. WhatsApp Sudah Terdaftar');
			</script>
		";
	} else {
		// query insert data
		$query = "INSERT INTO supplier VALUES ('', '$supplier_nama', '$supplier_wa', '$supplier_alamat', '$supplier_company', '$supplier_status', '$supplier_create')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

function editSupplier($data){
	global $conn;
	$id = $data["supplier_id"];


	// ambil data dari tiap elemen dalam form
	$supplier_nama      = htmlspecialchars($data["supplier_nama"]);
	$supplier_wa 		= htmlspecialchars($data["supplier_wa"]);
	$supplier_alamat    = htmlspecialchars($data["supplier_alamat"]);
	$supplier_company   = htmlspecialchars($data["supplier_company"]);
	$supplier_status    = htmlspecialchars($data["supplier_status"]);

		// query update data
		$query = "UPDATE supplier SET 
						supplier_nama      = '$supplier_nama',
						supplier_wa        = '$supplier_wa',
						supplier_alamat    = '$supplier_alamat',
						supplier_company   = '$supplier_company',
						supplier_status    = '$supplier_status'
						WHERE supplier_id  = $id
				";
		// var_dump($query); die();
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);

}

function hapusSupplier($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM supplier WHERE supplier_id = $id");

	return mysqli_affected_rows($conn);
}

// ===================================== Keranjang Pembelian =============================== //
function tambahKeranjangPembelian($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$barang_id          = $data['barang_id'];
	$keranjang_nama     = $data['keranjang_nama'];
	$keranjang_harga    = $data['keranjang_harga'];
	$keranjang_id_kasir = $data['keranjang_id_kasir'];
	$keranjang_qty      = 1;
	$keranjang_id_cek   = $barang_id.$keranjang_id_kasir;

	// Cek STOCK
	$barang_id_cek = mysqli_num_rows(mysqli_query($conn, "select * from keranjang_pembelian where keranjang_id_cek = '$keranjang_id_cek' "));
	
		
	if ( $barang_id_cek > 0 ) {
		echo "
			<script>
				alert('Barang ini sudah Anda Tambahkan Sebelumnya!! JIKA ingin menambahkan QTY langsung saja di input angka QTY kemudian klik TOMBOL REFRESH');
			</script>
		";

	} else {
		// query insert data
		$query = "INSERT INTO keranjang_pembelian VALUES ('', '$keranjang_nama', '$keranjang_harga', '$barang_id', '$keranjang_qty', '$keranjang_id_kasir', '$keranjang_id_cek')";
		
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

function hapusKeranjangPembelian($id) {
	global $conn;

	mysqli_query( $conn, "DELETE FROM keranjang_pembelian WHERE keranjang_id = $id");

	return mysqli_affected_rows($conn);
}

function updateQTYpembelian($data) {
	global $conn;
	$id = $data["keranjang_id"];

	// ambil data dari tiap elemen dalam form
	$keranjang_qty = htmlspecialchars($data['keranjang_qty']);
	$stock_brg = $data['stock_brg'];


	// query update data
	$query = "UPDATE keranjang_pembelian SET 
				keranjang_qty   = '$keranjang_qty'
				WHERE keranjang_id = $id
			";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
	
}

// ============================================== Transaksi Pembelian ======================== //
function updateStockPembelian($data) {
	global $conn;
	$id                  = $data["barang_ids"];
	$keranjang_qty       = $data["keranjang_qty"];
	$keranjang_id_kasir  = $data['keranjang_id_kasir'];
	$pembelian_invoice   = $data['pembelian_invoice'];
	$kik                 = $data['kik'];
	$barang_harga_beli   = $data['barang_harga_beli'];

	$pembelian_invoice2  = $data['pembelian_invoice2'];
	$invoice_tgl         = date("d F Y g:i:s a");
	$invoice_supplier    = $data['invoice_supplier'];
	$invoice_total       = $data['invoice_total'];
	$invoice_bayar       = $data['angka1'];
	$invoice_kembali     = $invoice_bayar - $invoice_total;
	$invoice_date        = date("Y-m-d");
	$pembelian_date      = $data['pembelian_date'];

	$jumlah = count($keranjang_id_kasir);
	
	// $stock = mysqli_query( $conn, "select barang_stock from barang where barang_id = $id");
	// $kn = mysqli_fetch_array($stock); 
	// $nKn = $kn['barang_stock'];
    
 //    $stoks = $nKn - $keranjang_qty;


	// $query = "UPDATE barang SET barang_stock = $stoks WHERE barang_id = $id";
	// mysqli_query($conn, $query);

	// query insert invoice
	$query1 = "INSERT INTO invoice_pembelian VALUES ('', '$pembelian_invoice2', '$invoice_tgl', '$invoice_supplier', '$invoice_total', '$invoice_bayar', '$invoice_kembali', '$kik', '$invoice_date', ' ', ' ', '$invoice_total', '$invoice_bayar', '$invoice_kembali')";
	// var_dump($query1); die();
	mysqli_query($conn, $query1);


	for( $x=0; $x<$jumlah; $x++ ){
		$query = "INSERT INTO pembelian VALUES ('', '$id[$x]', '$keranjang_qty[$x]', '$keranjang_id_kasir[$x]', '$pembelian_invoice[$x]' , '$pembelian_date[$x]', '$keranjang_qty[$x]', '$keranjang_qty[$x]', '$barang_harga_beli[$x]')";
		// $query2 = "INSERT INTO terlaris VALUES ('', '$id[$x]', '$keranjang_qty[$x]')";

		mysqli_query($conn, $query);
		// mysqli_query($conn, $query2);
	}
	

	mysqli_query( $conn, "DELETE FROM keranjang_pembelian WHERE keranjang_id_kasir = $kik");
	return mysqli_affected_rows($conn);

}

// ======================================== Pembelian Edit ================================ //
function updateQTY2pembelian($data) {
	global $conn;
	$id = $data["pembelian_id"];
	$bid = $data["barang_id"];

	// ambil data dari tiap elemen dalam form
	$barang_qty      = htmlspecialchars($data['barang_qty']);
	$barang_qty_lama = $data['barang_qty_lama'];

	// retur
	$barang_stock           = $data['barang_stock'];
	$barang_stock_kurang    = $barang_qty_lama - $barang_qty;
	$barang_stock_hasil     = $barang_stock - $barang_stock_kurang;
	// var_dump($barang_stock_hasil); die();

	if ( $barang_qty > $barang_qty_lama ) {
		echo"
			<script>
				alert('Jika Anda Ingin Menambahkan QTY Barang.. Lakukan Transaksi Invoice Baru !!!');
			</script>
		";
	} else {
		// query update data
		$query = "UPDATE pembelian SET 
					barang_qty       = '$barang_qty',
					barang_qty_lama  = '$barang_qty'
					WHERE pembelian_id = $id
					";
		$query1 = "UPDATE barang SET 
					barang_stock   = '$barang_stock_hasil'
					WHERE barang_id = $bid
					";
		mysqli_query($conn, $query1);
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
		// $query1 = "INSERT INTO retur VALUES ('', '$retur_barang_id', '$retur_invoice', '$retur_admin_id', '$retur_date', ' ', '$barang_stock')";
		// mysqli_query($conn, $query1);
		
	} 
}

function updateInvoicePembelian($data) {
	global $conn;
	$id = $data["invoice_pembelian_id"];

	// ambil data dari tiap elemen dalam form
	$invoice_total        = htmlspecialchars($data['invoice_total']);
	$invoice_bayar        = htmlspecialchars($data['angka1']);
	$invoice_kembali      = $invoice_bayar - $invoice_total;
	$invoice_kasir_edit   = $data['invoice_kasir_edit'];
	$invoice_date_edit    = date('Y-m-d');

		// query update data
		$query = "UPDATE invoice_pembelian SET 
					invoice_total      = '$invoice_total',
					invoice_bayar      = '$invoice_bayar',
					invoice_kembali    = '$invoice_kembali',
					invoice_date_edit  = '$invoice_date_edit',
					invoice_kasir_edit = '$invoice_kasir_edit'
					WHERE invoice_pembelian_id = $id
					";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
}

function hapusPembelianInvoice($id) {
	global $conn;
	mysqli_query( $conn, "DELETE FROM pembelian WHERE pembelian_invoice = $id");
	mysqli_query( $conn, "DELETE FROM invoice_pembelian WHERE pembelian_invoice = $id");

	return mysqli_affected_rows($conn);
}


?>