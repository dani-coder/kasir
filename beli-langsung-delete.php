<?php 
include 'aksi/functions.php';

$id = $_GET["id"];

if( hapusKeranjang($id) > 0) {
	echo "
		<script>
			document.location.href = 'beli-langsung';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus');
			document.location.href = 'beli-langsung';
		</script>
	";
}

?>