<?php 
session_start();
	if(!isset($_SESSION['login'])){
		header("Location: login.php");
			 	exit;
	}

require 'function.php';

	$id_barang = $_GET['id_barang'];

	if (hapus($id_barang) > 0 ) {
		echo "
		<script>
			alert('Data Berhasil Dihapus');
			document.location.href='index.php';
		</script>
		";
	}else{
		echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href='index.php';
		</script>
		";
	}

?>