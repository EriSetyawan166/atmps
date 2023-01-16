<?php

include 'koneksi.php';
error_reporting(0);
ini_set('display_errors', 0);

$query = "SELECT COUNT(*) as total FROM tweet2 WHERE sentiment = 1";
$result = mysqli_query($conn, $query);
$sentiment1 = mysqli_fetch_assoc($result)['total'];

$query = "SELECT COUNT(*) as total FROM tweet2 WHERE sentiment = 0";
$result = mysqli_query($conn, $query);
$sentiment0 = mysqli_fetch_assoc($result)['total'];
$selisih = abs($sentiment1 - $sentiment0);
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
            
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-gears"></i>
                    <span>Training</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php">Tarik Data</a>
                        <a class="collapse-item" href="preprocessing.php">Preprocessing</a>
                        <a class="collapse-item" href="labeling.php">Labeling</a>
                        <a class="collapse-item" href="analisa.php">Analisa</a>
                        <a class="collapse-item active" href="evaluasi.php">Evaluasi</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            
            <li class="nav-item">
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
                        <a class="collapse-item" href="labeling2.php">Labeling With Model</a>
                        <a class="collapse-item" href="analisa2.php">Analisa</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link hapus-data" href="javascript:void(0)">
                <i class="fa-solid fa-trash"></i>
                    <span>Hapus Data</span>
                </a>
            </li>

   

            <div id="deleteModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn nav-link" data-dismiss="modal">Tidak</button>
                            <button type="button" class="btn nav-link" id="deleteData">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
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
                                <h6 class="m-0 font-weight-bold text-primary">Training</h6>
                            </div>
                                <!-- Card Header - Dropdown -->
                                <div>
                                  
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                <div>
                                    <?php if ($selisih > 25) {
                                        echo "Terjadi ketidakseimbangan data, disarankan untuk melakukan oversampling atau undersampling";
                                        echo "<br>";
                                        echo "Data positif = ".$sentiment1;
                                        echo "<br>";
                                        echo "Data Negatif = ".$sentiment0;
                                        echo "<br>";
                                        echo "Selisih data = ".$selisih;
                                        
                                    }?>
                                    <form method="POST">
                                        <input class="btn btn-primary mb-4 mt-4" type="submit" name="evaluasi" value="train">
                                        <?php if ($selisih > 25) { ?>
                                            <input class="btn btn-primary mb-4 mt-4" type="submit" name="evaluasi_oversampling" value="Oversampling">
                                            <input class="btn btn-primary mb-4 mt-4" type="submit" name="evaluasi_undersampling" value="Undersampling">
                                        <?php } ?>
                                    </form>
                                </div>

                                
                                
                                    
                                
                                    
                                    <?php
                                    if(isset($_POST['evaluasi']))
                                    {
                                            $test = exec("python training.py", $output);
                                    } 

                                    if(isset($_POST['evaluasi_oversampling']))
                                    {
                                        $test = exec("python training_oversampling.py", $output);
                                    }

                                    if(isset($_POST['evaluasi_undersampling']))
                                    {
                                        $test = exec("python training_undersampling.py", $output);
                                    }
                                    ?>
                                    <p><?= $output[0] ?></p>
                                    <p><?= $output[1] ?></p>
                                    <p><?= $output[2] ?></p>
                                    <p><?= $output[3] ?></p>

                                    
                                    
                                    
                                    
                                    

                               



                                

                                    
                                <nav>
                                    
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
    <!-- <script src="js/demo/chart-pie-demo.js"></script> -->

    <script>
        $(document).ready(function() {
            // Get the modal
            var modal = $("#deleteModal");

            // Get the button that opens the modal
            var btn = $(".nav-link.hapus-data");

            // When the user clicks the button, open the modal 
            btn.click(function() {
                modal.modal("show");
            });

            // Get the "Ya" button in the modal
            var deleteBtn = $("#deleteData");

            // When the user clicks the "Ya" button, delete the data
            deleteBtn.click(function() {
            $.post("", {delete: true}, function(response) {
                console.log("Data deleted successfully");
                alert("Data Berhasil Dihapus");
                location.reload();
            });
            modal.modal("hide");
        });
        });
    </script>

<?php
    if (isset($_POST["delete"])) {
        $sql = "DELETE FROM tweet2";
        mysqli_query($conn, $sql);
        
    }
?>


</body>

</html>

<script>

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Positif", "Negatif", "Netral"],
    datasets: [{
      data: [<?php echo $row_positif?>, <?php echo $row_negatif?>, <?php echo $row_netral?>],
      backgroundColor: ['#28C837', '#E21111' ,'#ACACAC'],
      hoverBackgroundColor: ['#49FF00', '#FF0000', '#6E6E6E'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Positif", "Negatif", "Netral"],
    datasets: [{
      label: "Total",
      backgroundColor: ["#38FF50","#FF3838", "#BDBDBD"],
      hoverBackgroundColor: ["#00FF1F", "#FC0000", "#7D7D7D"],
      borderColor: "#4e73df",
      data: [<?php echo $row_positif?>, <?php echo $row_negatif?>, <?php echo   $row_netral?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 200,
          maxTicksLimit: 10,
          padding: 10,
          // Include a dollar sign in the ticks
        //   callback: function(value, index, values) {
        //     return '$' + number_format(value);
        //   }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      
    },
  }
});


</script>