<?php 
session_start();
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
                exit;
    }
    require 'function.php';
        
if (isset($_POST['submit'])) {
     
    //cek apakah data berhasil ditambah atau tidak
    if (tambahStock($_POST)>0) {
        echo "
        <script>
            alert(' Berhasil Ditambahkan');
            document.location.href='masuk.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data Gagal Ditambahkan');
            document.location.href='keluar.php';
        </script>
        ";
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">TIGA BARU</a>
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
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
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
                        <h1 class="mt-4">Barang Masuk</h1>

                        <!-- tambah barang -->
                        <form method="post" action="" >
                            <div class="modal-body">
                            <select name="id_barang" class="form-control" >
                             <option>-- Pilih Barang -- </option>
                                <?php foreach ($dataStock as $dts ) : ?>

                                    <option value="<?= $dts["id_barang"]; ?>"><?= $dts["nama_barang"]; ?></option>
              
                                <?php endforeach; ?>
                                
                            </select>
                           
                            <input type="number" name="jumlah" placeholder="Jumlah"  class="form-control mt-2" required>
                             <input type="text" name="keterangan" placeholder="Keterangan"  class="form-control mt-2" required>
                            <button type="submit" name="submitMasuk" class="btn btn-primary form-control mt-2">
                                <i class="fa-solid fa-arrow-down"></i>
                                Barang Masuk
                            </button>
                            </div>
                        </form>
                        <!-- tutup tambah barang -->
                        
                       <div class="card mb-4">
                            <div class="card-header bg-dark ">
                                <!-- Button to Open the Modal -->
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    tambah barang
                                </button> -->
                                <h1 style="color: grey; text-align: center;"> Riwayat Barang Masuk </h1>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th class="text-sm-center">NO</th>
                                            <th class="text-sm-center">Tanggal</th>
                                            <th class="text-sm-center">Nama Barang</th>
                                            <th class="text-sm-center">Jumlah</th>
                                            <th class="text-sm-center">Keterangan</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($dataMasuk as $dms ) : ?>
                                        <tr>
                                            <td class="text-sm-center"><?= $i; ?></td>
                                            <td class="text-sm-center"><?= $dms["tanggal"]; ?></td>
                                            <td class="text-sm-center"><?= $dms["nama_barang"]; ?></td>
                                            <td class="text-sm-center"><?= $dms["jumlah"]; ?></td>
                                            <td class="text-sm-center"><?= $dms["keterangan"]; ?></td>
                                            
                                            
                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                        
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
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Modal Headding</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <form method="post" action="">
                    <div class="modal-body">
                    <select name="barangnya" class="form-control">
                        <?php 
                            $ambilsemuadata = mysqli_query($conn, "SELECT * FROM stock");
                            while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {
                                 $namabarangnya = $fetcharray['namabarang'];
                                 $idbarangnya = $fetcharray['idbarang'];

                        ?>  
                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya ?></option>
                        <?php
                             } 

                        ?>
                    </select>
                    
                    <input type="text" name="penerima" placeholder="Penerima"  class="form-control mt-2" required>
                    <input type="number" name="qty" placeholder="qtymasuk"  class="form-control mt-2" required>
                    <button type="submit" name="barangmasuk" class="btn btn-primary form-control mt-2">Submit</button>
                    </div>
                </form>
                
             
                
            </div>
            </div>
        </div>
</html>