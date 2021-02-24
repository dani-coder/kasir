<?php 
include 'aksi/functions.php';

$id = $_GET["id"];

if( hapusPembelianInvoice($id) > 0) {
	echo "
		<script>
			document.location.href = 'pembelian';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus');
			document.location.href = 'pembelian';
		</script>
	";
}

?>