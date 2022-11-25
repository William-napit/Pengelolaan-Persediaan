<?php 
	$conn = mysqli_connect("localhost","root","","toko");


function query($query){
	global$conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}



function tambah($data){
	global $conn;
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	
	$harga_masuk = htmlspecialchars($data["harga_masuk"]);
	$harga_jual = htmlspecialchars($data["harga_jual"]);
	$stock = htmlspecialchars($data["stock"]);
	


	//query insert data
	$query = "INSERT INTO data_master
		VALUES
		('','$nama_barang', '$harga_masuk', '$harga_jual', '$stock')"; 
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
	
	function ubah($data){
	global $conn;

	$id_barang=$data["id_barang"];
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$harga_masuk = htmlspecialchars($data["harga_masuk"]);
	$harga_jual = htmlspecialchars($data["harga_jual"]);
	$stock = htmlspecialchars($data["stock"]);
	

	//query insert data
	$query = "UPDATE data_master SET
		nama_barang = '$nama_barang',
		harga_masuk = '$harga_masuk',
		harga_jual = '$harga_jual',
		stock = '$stock'
		WHERE id_barang = $id_barang"; 

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//databarang
	$dataStock = query("SELECT * FROM data_master");
	$dataMasuk = query("SELECT * FROM barang_masuk m, data_master d WHERE d.id_barang = m.id_barang");
	$dataKeluar = query("SELECT * FROM barang_keluar k, data_master d WHERE d.id_barang = k.id_barang");

// if (isset($_POST['submit'])) {   // jika ada yang terjadi dengan tombol
// 		$id_barang = $_POST['id_barang'];
// 		$keterangan = $_POST['keterangan'];
// 		$jumlah = $_POST['jumlah'];


// 		$addtomasuk = mysqli_query($conn, "INSERT INTO barang_masuk(id_barang, keterangan, jumlah)values(
// 			'$id_barang','$keterangan','$jumlah') ");

// 		$cekstoksekarang =  mysqli_query($conn, "SELECT * FROM data_master WHERE id_barang= '$id_barang' ");
// 		$ambildatanya = mysqli_fetch_array($cekstoksekarang);

// 		$stokSekarang = $ambildatanya['stock'];
// 		$tambahkanStockSekarangdeganQyt = $stokSekarang + $jumlah;

// 		$updatetoStockMsuk = mysqli_query($conn, "UPDATE data_master set stock= '$tambahkanStockSekarangdeganQyt' WHERE id_barang='$id_barang' ");
// 		if ($addtomasuk&& $updatetoStockMsuk) {
// 			// header('Location : index.php');
// 			echo "
//         <script>
//             alert('Data Berhasil Ditambahkan');
//             document.location.href='index.php';
//         </script>
//         ";
// 		}else{
// 			echo "
//         <script>
//             alert('Data Gagal Ditambahkan');
//             document.location.href='index.php';
//         </script>
//         ";
// 		}
// 	}


//databarang
// Barang Masuk
if (isset($_POST['submitMasuk'])) {   // jika ada yang terjadi dengan tombol
		$id_barang = $_POST['id_barang'];
		$keterangan = $_POST['keterangan'];
		$jumlah = $_POST['jumlah'];


		$addtomasuk = mysqli_query($conn, "INSERT INTO barang_masuk(id_barang, keterangan, jumlah)values(
			'$id_barang','$keterangan','$jumlah') ");

		$cekstoksekarang =  mysqli_query($conn, "SELECT * FROM data_master WHERE id_barang= '$id_barang' ");
		$ambildatanya = mysqli_fetch_array($cekstoksekarang);

		$stokSekarang = $ambildatanya['stock'];
		$tambahkanStockSekarangdeganQyt = $stokSekarang + $jumlah;

		$updatetoStockMsuk = mysqli_query($conn, "UPDATE data_master set stock= '$tambahkanStockSekarangdeganQyt' WHERE id_barang='$id_barang' ");
		if ($addtomasuk&& $updatetoStockMsuk) {
			// header('Location : index.php');
			echo "
        <script>
            alert('Data Berhasil Ditambahkan');
            document.location.href='index.php';
        </script>
        ";
		}else{
			echo "
        <script>
            alert('Data Gagal Ditambahkan');
            document.location.href='index.php';
        </script>
        ";
		}
	}

// Barang Keluar
if (isset($_POST['submitKeluar'])) {   // jika ada yang terjadi dengan tombol
		$id_barang = $_POST['id_barang'];
		$keterangan = $_POST['keterangan'];
		$jumlah = $_POST['jumlah'];


		$addtomasuk = mysqli_query($conn, "INSERT INTO barang_keluar(id_barang, keterangan, jumlah)values(
			'$id_barang','$keterangan','$jumlah') ");

		$cekstoksekarang =  mysqli_query($conn, "SELECT * FROM data_master WHERE id_barang= '$id_barang' ");
		$ambildatanya = mysqli_fetch_array($cekstoksekarang);

		$stokSekarang = $ambildatanya['stock'];
		$tambahkanStockSekarangdeganQyt = $stokSekarang - $jumlah;

		$updatetoStockMsuk = mysqli_query($conn, "UPDATE data_master set stock= '$tambahkanStockSekarangdeganQyt' WHERE id_barang='$id_barang' ");
		if ($addtomasuk&& $updatetoStockMsuk) {
			// header('Location : index.php');
			echo "
        <script>
            alert('Data Berhasil Ditambahkan');
            document.location.href='index.php';
        </script>
        ";
		}else{
			echo "
        <script>
            alert('Data Gagal Ditambahkan');
            document.location.href='index.php';
        </script>
        ";
		}
	}

	function hapus($id_barang){
	global $conn;
	mysqli_query($conn,"DELETE FROM data_master WHERE id_barang = $id_barang");

	return mysqli_affected_rows($conn);
}
function registrasi($data){
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

	if (mysqli_fetch_assoc($result)) {
		echo "
		<script>
			alert('User nama sudah terdaftar');
		</script>";
		return false;
	}

	//cek konfirmasi password
	if ($password !== $password2) {
		echo "
		<script>
			alert('Konfirmasi password anda tidak sesuai');
		</script>";
		return false;
	}
	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	//tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");
	return mysqli_affected_rows($conn);
}















?>