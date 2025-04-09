<?php
    session_start();
    require_once '../connect.php';
if (isset($_POST['dangnhap'])) {
    $name = $_POST['admin_name'];
    $pass = $_POST['admin_pass'];

    $sql = "SELECT * FROM adminlogin WHERE admin_name='$name' AND admin_pass='$pass'";
    $query = mysqli_query($conn, $sql);

    // Check if any rows are returned
    if ($query && mysqli_num_rows($query) > 0) {
        $truyvan = mysqli_fetch_assoc($query);

        $_SESSION['admin_name'] = $truyvan['admin_name'];
        $_SESSION['admin_pass'] = $truyvan['admin_pass'];
        $_SESSION['hovaten'] = $truyvan['hovaten'];

        header('location: index.php');
    } else {
        echo '<div class="alert alert-danger" style="width: 30%; margin-left:70%"><i class="bi bi-exclamation-circle"></i> Đăng nhập không thành công</a><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
    }

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

    <title>Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 7%;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0" >
                        <!-- Nested Row within Card Body -->
                        <div class="row" >
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6"><br><br><br>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN !</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input class="form-control form-control-user" 
                                               name="admin_name" required type="text"  placeholder="Tên đăng nhập" >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="admin_pass" placeholder="Mật khẩu" required>
                                        </div>
                                        <button name="dangnhap"  type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>