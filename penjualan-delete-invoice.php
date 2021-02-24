<?php 
include 'aksi/functions.php';

$id = $_GET["id"];

if( hapusPenjualanInvoice($id) > 0) {
	echo "
		<script>
			document.location.href = 'penjualan';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus');
			document.location.href = 'penjualan';
		</script>
	";
}

?>