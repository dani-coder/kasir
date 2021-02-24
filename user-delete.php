<?php 
include 'aksi/functions.php';

$id = $_GET["id"];

if( hapusUser($id) > 0) {
	echo "
		<script>
			document.location.href = 'users';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus');
			document.location.href = 'users';
		</script>
	";
}

?>