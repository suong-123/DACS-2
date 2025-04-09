<?php
session_start();
    require_once 'connect.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM datphong WHERE id_book = $id";
    $query = mysqli_query($conn, $sql);

    $r = mysqli_fetch_assoc($query);
    $checkin = date("d-m-Y", strtotime($r['checkin']));
    $checkout = date("d-m-Y", strtotime($r['checkout']));
    
      if (isset($_SESSION['email']) && ($_SESSION['email'])!="") {
        $email = $_SESSION['email'];
    }
    if (isset($_SESSION['pass']) && ($_SESSION['pass'])!="") {
        $pass = $_SESSION['pass'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
     <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/common.css">
    <title>BLUE HOTEL</title>
    <style>
       .availability-form{
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }
        @media screen  and (max-width: 575px) {
           .availability-form{
            margin-top: 25px;
            padding: 0 35px;
        }
    }
    </style>

</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">                
        <div class="container-fluid">
            <h1 class="name" href="index.php">BLUE HOTEL</h1>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin: 7px;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                    <li class="nav-item">
                    <a class="nav-link me-2" active aria-current="page" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link mb-2" href="roomlg.php">Phòng</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link mb-2" href="bookinglg.php">Đánh giá</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link mb-2" href="contactlg.php">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <?php echo $_SESSION['username']  ?> 
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#thongtinModal" class="dropdown-item" >Thông tin</button></li>
                        <li><a class="dropdown-item" href="mybooking.php" >Booking</a></li>
                        <li><a class="dropdown-item" href="dangxuat.php" >Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- thong tin -->
    <div class="modal fade" id="thongtinModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center ">
                            <i class="bi bi-person-lines-fill  fs-3 me-2"></i>  Thông tin khách hàng
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div>
                                <img style="width: 200px;margin-left: 28%;" src="./img/<?php echo $_SESSION['ava'] ?>">    
                            </div><br>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label" style="font-weight: bold;margin-left: 27%;">Họ và tên : </label> <?php echo $_SESSION['username']  ?> 
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label" style="font-weight: bold;margin-left: 26%;">CCCD : </label> <?php echo $_SESSION['cccd'] ?>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label" style="font-weight: bold;margin-left: 26%;">Địa chỉ : </label> <?php echo $_SESSION['address'] ?>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label" style="font-weight: bold;margin-left: 26%;">Số điện thoại : </label> <?php echo $_SESSION['phone'] ?>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label" style="font-weight: bold;margin-left: 26%;">Email : </label> <?php echo $_SESSION['email']  ?> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
   <!-- <div class="flex-box" > -->
        
   <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
            </div>

            <div class="col-lg-6 col-md-12 px-4" style="margin-left: 25%;">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <?php
                                function currency_format($amount) {
                                    // Your currency formatting logic here
                                    return number_format($amount, 0, ',', '.') . ' VND';
                                } ?>
                        <form action="pay.php" onsubmit="return confirm('Xác nhận đặt phòng')" method="post">
                            
                            <h3 style="text-align: center;" class="mb-3" >KIỂM TRA THÔNG TIN</h3><BR>
                            <div class="row">
                                <div class="col-md-6 mb-4" style="margin-left: 8%;">
                                    <h4 style="margin-top: -2px"  name="phong"><?php echo $r['phong']?></h4>
                                </div>
                                <div class="col-md-6 mb-4" style="margin-left: -8%;" >
                                     <h5 style="margin-top: 2px;" id="Gia" name="gia"><?php echo currency_format($r['giaphong'])?> / đêm</h5>
                                </div>
                            </div>
                    
                   
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" style="margin-left: 0%;">Họ và tên: </label> <?php echo $r['tenkh']?>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Số điện thoại: </label> <?php echo $r['phonekh']?>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" style="margin-left: 18%;">Check-in: </label> <?php echo $checkin ?>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Check-out: </label> <?php echo $checkout?>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" style="margin-left: 18%; font-weight: bold; font-size: 20px;">Tổng: <?php echo ' '.currency_format($r['tong'])?></label>
                                </div>
                                <div class="d-flex">
                                    <button class="btn w-100 text-white custom-bg shadow-none mb-1" name="payUrl" name="submit">Thanh toán</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
   </div>

    <!-- Footer -->
     <div class="container-fluid bg-white mt-5">
        <div class="row">
            <div class="col-lg-4 p-4" style="margin-left: 20px;">
                <h3 class="welcome fw-bold fs-3 mb-2">BLUE HOTEL</h3><br>
            <p class="mb-0">
                Cảm ơn quý khách đã lựa chọn <a class="text-uppercase" style="color: #16d7fe;">BLUE HOTEL</a> .
                Chúng tôi mong được chào đón bạn và đảm bảo rằng kỳ nghỉ của
                bạn với chúng tôi sẽ tràn ngập sự thoải mái và những kỷ niệm đẹp.
				</p>
            </div>
            <div class="col-lg-2 p-4" style="margin-left: 70px;" >
                <h5>Follow us</h5>
                <a href="https://www.tiktok.com/@suongg724?is_from_webapp=1&sender_device=pc" class="d-d-inline-block text-dark text-decoration-none mb-2">
                    <span class="badge bg-light text-dark fs-6 p-2">
                    <i class="bi bi-tiktok"></i> Tiktok </span>
                </a><br><br>
                <a href="https://web.facebook.com/suong724ne/" class="d-d-inline-block text-dark text-decoration-none mb-2">
                    <span class="badge bg-light text-dark fs-6 p-2">
                    <i class="bi bi-facebook"></i> Facebook</span>
                </a><br><br>
                <a href="https://www.instagram.com/suongg724?fbclid=IwAR3fYE5IOSJGyYrkU9UTD1RhR-RWouE4O6R7TLVC8zpwlJXkJByrXGQw1e8" class="d-d-inline-block text-dark text-decoration-none mb-2">
                    <span class="badge bg-light text-dark fs-6 p-2">
                    <i class="bi bi-instagram"></i> Instagram</span>
                </a>
            </div>
            <div class="col-lg-2 p-4" style="margin-left: 70px;" >
                <h5 class="mb-3">Liên hệ nhanh</h5>
                <a href="./index.php" class="d-d-inline-block mb-2 text-dark text-decoration-none">Trang chủ</a><br>
                <a href="./room.php" class="d-d-inline-block mb-2 text-dark text-decoration-none">Phòng</a><br>
                <a href="./booking.php" class="d-d-inline-block mb-2 text-dark text-decoration-none">Đánh giá</a><br>
                <a href="./contact.php" class="d-d-inline-block mb-2 text-dark text-decoration-none">Liên hệ</a><br>
            </div>
            <div class="col-lg-2 p-4" style="margin-left: 70px;" >
                <h5 class="mb-3">Dịch vụ</h5>
                <a class="d-d-inline-block mb-2 text-dark text-decoration-none">Món ăn</a><br>
                <a class="d-d-inline-block mb-2 text-dark text-decoration-none">Trung tâm thể hình</a><br>
                <a class="d-d-inline-block mb-2 text-dark text-decoration-none">Bể bơi</a><br>
                <a class="d-d-inline-block mb-2 text-dark text-decoration-none">Sự kiện & tiệc tùng</a><br>
                <a class="d-d-inline-block mb-2 text-dark text-decoration-none">Khám phá địa phương</a><br>
            </div>
            
        </div>

     </div>
    
    <script>
    var checkoutInput = document.getElementById('checkout');
    checkoutInput.addEventListener('input', function () {
        var checkinDate = document.getElementById('checkin').value;
        var checkoutDate = checkoutInput.value;
        if (checkinDate && checkoutDate) {
            var numberOfDays = calculateNumberOfDays(checkinDate, checkoutDate);
            document.getElementById('result').innerHTML = 'Thời gian đặt phòng là: ' + numberOfDays + ' ngày';

            // Calculate and display the total price
            calculateAndDisplayTotal();
        }
    });

    function calculateAndDisplayTotal() {
        var checkinDate = document.getElementById('checkin').value;
        var checkoutDate = checkoutInput.value;
        var numberOfDays = calculateNumberOfDays(checkinDate, checkoutDate);

        // Assuming $row['gia'] is a PHP variable with a numeric value
        var giaText = document.getElementById('Gia').textContent;
        var jsVariable = parseFloat(giaText);

        // Calculate sum
        var total = numberOfDays * jsVariable;
        document.getElementById('results').innerHTML = 'Tổng tiền: ' + total.toLocaleString('en-US') + ' vnd';
    }

    function calculateNumberOfDays(checkinDate, checkoutDate) {
        var checkinDateTime = new Date(checkinDate);
        var checkoutDateTime = new Date(checkoutDate);
        var time = checkoutDateTime - checkinDateTime;
        var numberOfDays = Math.floor(time / (1000 * 60 * 60 * 24));
        return numberOfDays;
    }

   


</script>

</body>
</html>