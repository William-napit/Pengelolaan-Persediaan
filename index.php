<?php 
session_start();
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
                exit;
    }
require 'function.php';
    
if (isset($_POST['submit'])) {
     

    //cek apakah data berhasil ditambah atau tidak
    if (tambah($_POST)>0) {
        echo "
        <script>
            alert('Data Berhasil Ditambahkan');
            document.location.href='masuk.php.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data Gagal Ditambahkan');
            document.location.href='masuk.php.php';
        </script>
        ";
    }
    
}

    $data_master = query("SELECT * FROM data_master");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock Barang</title>
        <link rel="stylesheet" type="text/css" href="index.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
      

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html" >TIGA BARU</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Keluar
                            </a>
                        </div>
                    </div>

                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Stok Barang</h1>
                        
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <a href="tambah_barang.php"> 
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        tambah barang
                                    </button>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th class="text-sm-center">NO</th>
                                            <th class="text-sm-center">Nama Barang</th>
                                            
                                            <th class="text-sm-center">Harga Masuk</th>
                                            <th class="text-sm-center">Harga Jual</th>
                                            <th class="text-sm-center">Stock</th>
                                            
                                            <th class="text-sm-center">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data_master as $dtm ) : ?>
                                        <tr>
                                            <td class="text-sm-center"><?= $i; ?></td>
                                            <td class="  text-sm-center"><?= $dtm["nama_barang"]; ?></td>
                                            
                                            <td class="text-sm-center"><?= $dtm["harga_masuk"]; ?></td>
                                            <td class="text-sm-center"><?= $dtm["harga_jual"]; ?></td>
                                            <td class="text-sm-center"><?= $dtm["stock"]; ?></td>
                                            
                                            <td class="text-sm-center">
                                               <a href="ubah.php?id_barang=<?= $dtm["id_barang"]; ?>"> <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit " value="">
                                                   Ubah
                                                </button>
                                                </a>
                                                <input type="hidden" name="idbarangyangmaudihapus" value="">
                                                <a  href="delete.php?id_barang=<?= $dtm["id_barang"]; ?>" onclick="
                                                return confirm('yakin?')">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="delete">
                                                    Delete
                                                </button> 
                                                </a>
                                                
                                            </td>
                                        </tr>

                                        <?php $i++; ?>
                                        <?php endforeach; ?>

                                        <!-- The Modal -->
     

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    </body>
</html>
