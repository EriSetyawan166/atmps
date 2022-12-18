<?php
   include "koneksi.php";
   $no = 1;
//    $data = mysqli_query($conn,"select * from tweet2");

   if(isset($_POST['sentimen']))
    {	
    $id = $_POST['id'];
    $halaman = $_POST['halaman'];
    
    
    $sentiment=$_POST['sentimen'];
    if($sentiment == 'Positif'){
        $hasil = 1;
    } else if($sentiment == 'Negatif'){
        $hasil = 0;
    } else{
        $hasil = 2;
    }
    // var_dump($sentiment);
    
        
    // update user data
    $result = mysqli_query($conn, "UPDATE tweet2 SET sentiment=$hasil WHERE id=$id");
    // $result2 = mysqli_query($conn, "UPDATE tweet_bersih SET sentiment=$hasil WHERE id=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: labeling.php?halaman=" . $halaman);
    }


    if(isset($_POST['cari']))
    {
        mysqli_query($conn, "DELETE FROM tweet2");
        $name = $_POST['name'];
        $halaman = $_POST['halaman'];
        var_dump($name);
        $output = passthru("python twitter2.py $name");
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ATMPS</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ATMPS <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-gears"></i>
                    <span>Training</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php">Tarik Data</a>
                        <a class="collapse-item" href="preprocessing.php">Preprocessing</a>
                        <a class="collapse-item active" href="labeling.php">Labeling</a>
                        <a class="collapse-item" href="analisa.php">Analisa</a>
                        <a class="collapse-item" href="evaluasi.php">Evaluasi</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            

            
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-brain"></i>
                    <span>testing</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="tarik_data_2.php">Tarik Data</a>
                        <a class="collapse-item" href="preprocessing2.php">Preprocessing</a>
                        <a class="collapse-item active" href="labeling2.php">Labeling With Model</a>
                        <a class="collapse-item" href="analisa2.php">Analisa</a>
                    </div>
                </div>
            </li>

            <!-- Heading -->
            

           

           

           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">kelompok 4</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    
                    
                    <div class="row">
                    
                    
                        
                        <div class="col-xl-12">
                            
                            <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Labeling</h6>
                            </div>
                                <!-- Card Header - Dropdown -->
                                <div>
                                  
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="table-responsive mt-3">
                                        <table id="datatableSimple" class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Tweet</th>
                                                <th>Sentimen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                                $batas = 20;
                                                $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                                                $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
                                
                                                $previous = $halaman - 1;
                                                $next = $halaman + 1;
                                                
                                                $data = mysqli_query($conn,"select * from tweet2");
                                                $jumlah_data = mysqli_num_rows($data);
                                                $total_halaman = ceil($jumlah_data / $batas);
                                
                                                $data = mysqli_query($conn,"select * from tweet2 limit $halaman_awal, $batas");
                                                $nomor = $halaman_awal+1;
                                                while($d = mysqli_fetch_array($data)){
                                                    ?>
                                                    
                                                    <form name="update_sentimen" method="post" >
                                                        
                                                        <input type="hidden" name="halaman" value="<?php echo $halaman ?>"> 
                                                    <tr>
                                                        
                                                        <td><?php echo $nomor++; ?></td>
                                                        <td><?php echo $d['user_screen_name'] ?></td>
                                                        <td><?php echo $d['text'] ?></td>
                                                        <td>
                                                        
                                                        
                                                        <input type="hidden" name="id" value="<?php echo $d['id'] ?>"> 
                                                        
                                                        <!-- <button class="btn btn-primary" type="submit" name="sentimen" value="negatif">Test</button> -->

                                                        <div class="dropdown show d-flex justified" >
                                                            <a style="background: #143454;color: white !important" class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <?php
                                                                $hasil = $d['sentiment'];
                                                                if($hasil == 1){
                                                                    $hasil = "Positif";
                                                                } else if($hasil == 0){
                                                                    $hasil = "Negatif";
                                                                } else{
                                                                    $hasil = "Netral";
                                                                }

                                                                echo $hasil;
                                                            ?>
                                                            </a>
                                                           
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">  
                                                                <a class="dropdown-item"><input type="submit" class="btn btn-default" name="sentimen" value="Positif"></a>
                                                                <a class="dropdown-item"><input type="submit" class="btn btn-default" name="sentimen" value="Negatif"></a>
                                                                <a class="dropdown-item"><input type="submit" class="btn btn-default" name="sentimen" value="Netral"></a>
                                                            </div>

                                                        </div>
                                                        
                                                        </div>
                                                        </td
                                                       
                                                        
                                                    </tr>
                                                    </form>
                                                    <?php
                                                }
                                            ?>
                                            
                                        </tbody>
                                        </table>
                                        
                                        
                                    </div>
                                    <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" style="background-color: ;" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
                                        </li>
                                        <?php 
                                        for($x=1;$x<=$total_halaman;$x++){
                                            ?> 
                                            <li class="page-item"><a class="page-link" <?php if($x == $halaman){ echo 'style="background-color:#21274D"';}?>  href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                            <?php 
                                        }
                                        ?>				
                                        <li class="page-item">
                                            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
                                        </li>
                                    </ul>
                                </nav>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            
                        </div>

                        
                    </div>
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer> -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>