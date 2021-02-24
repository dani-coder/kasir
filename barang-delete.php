<?php 
include 'aksi/functions.php';

$id = $_GET["id"];

if( hapusBarang($id) > 0) {
	echo "
		<script>
			document.location.href = 'barang';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus');
			document.location.href = 'barang';
		</script>
	";
}

?>