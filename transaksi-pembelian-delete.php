<?php 
include 'aksi/functions.php';

$id = $_GET["id"];

if( hapusKeranjangPembelian($id) > 0) {
	echo "
		<script>
			document.location.href = 'transaksi-pembelian';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus');
			document.location.href = 'transaksi-pembelian';
		</script>
	";
}

?>