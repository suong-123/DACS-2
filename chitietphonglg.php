<?php
    session_start();
    require_once 'connect.php';
    $id = $_GET['id'];
    $sql =  "SELECT * FROM phong inner join loaiphong on phong.nameloaiphong = loaiphong.maloaiphong WHERE maphong=$id ";
    $query = mysqli_query($conn,$sql);

    $sqlshow =  "SELECT * FROM phong inner join loaiphong on phong.nameloaiphong = loaiphong.maloaiphong ORDER BY maphong LIMIT 3";
    $queryshow = mysqli_query($conn,$sqlshow);

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
                        <li><button   class="dropdown-item" >Booking</button></li>
                        <li><a class="dropdown-item" href="dangxuat.php" >Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

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

    <!-- Dang nhap -->
    <div class="modal fade" id="dangnhapModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i> Đăng nhâp
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none" >
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control shadow-none" >
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a> 
                        </div>
                    
                    </div>
                </form>
            </div>  
        </div>
    </div>
    <!-- Dang ky -->
    <div class="modal fade" id="dangkyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center ">
                            <i class="bi bi-person-lines-fill  fs-3 me-2"></i>  Đăng ký
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                            Chú ý: Thông tin của bạn phải khớp với giấy tờ tùy thân (cccd, giấy phép lái xe,
                            họo chếu), sẽ được yêu cầu khi nhận phòng.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="email" class="form-control shadow-none" >
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control shadow-none" >
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="number" class="form-control shadow-none" >
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control shadow-none" >
                                </div>
                                <div class="col-md-12 p-0 mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <textarea class="form-control shadow-none" rows="1"></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">CCCD</label>
                                    <input type="number" class="form-control shadow-none" >
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Ngày sinh</label>
                                    <input type="date" class="form-control shadow-none" >
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control shadow-none" >
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control shadow-none" >
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" class="btn btn-dark shadow-none">Đăng ký</button>                       
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>

    <section class="banner">
        <div class="container">
            <div class="banner-content">
        <?php
            while($row = mysqli_fetch_assoc($query)){
        ?>
                <div class="banner-title">
                    <div class="url"><a href="./user.php">Trang chủ </a> > <a href="./room.php">phòng </a> ><?php echo $row['tenphong']?></div>
                    <h1 class="banner-title" style="font-family: Jost, sans-serif ;">
                        Xem chi tiết
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="flex-box" >
        
        <div class="left" style="margin-top: 2%;margin-bottom: 3%; margin-left:3%">
            <div class="pname"><?php echo $row['tenphong']?></div>
            <div class="price" style="color: #16d7fe;"><?php echo currency_format($row['gia'])?></div>
            <div class="big-img">
                <img src="./admin/img/<?php echo $row['anh'] ?>" style="width: 110%;">
            </div>
            <div class="room-service">
                <div class="row">
                    <div class="col-md-6">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-bed"></i>
                            </div>
                            <div class="content">
                                <h3>giường</h3>
                                <span>1 gường đôi</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-child"></i>
                            </div>
                            <div class="content">
                                <h3>người lớn</h3>
                                <span><?php echo $row['nguoilon']?> người lớn</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-baby"></i>
                            </div>
                            <div class="content">
                                <h3>trẻ em</h3>
                                <span><?php echo $row['treem']?> trẻ em</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-compress"></i>
                            </div>
                            <div class="content">
                                <h3>không gian phòng</h3>
                                <span>30 m<sup>2</sup></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="right" style="margin-top: 5%;margin-bottom: 3%;margin-right:2%">
            <div class="room-amenities">
                <h3 class="title">
                    Tiện nghi phòng
                </h3><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-utensils"></i>
                            </div>
                            <div class="icon-wrap">
                                <h3>
                                    Bữa sáng
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-dumbbell"></i>
                            </div>
                            <div class="icon-wrap">
                                <h3>
                                    gym
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-wifi"></i>
                            </div>
                            <div class="icon-wrap">
                                <h3>
                                    wifi
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-motorcycle"></i>
                            </div>
                            <div class="icon-wrap">
                                <h3>
                                    xe máy
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-spa"></i>
                            </div>
                            <div class="icon-wrap">
                                <h3>
                                    spa
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-bath"></i>
                            </div>
                            <div class="icon-wrap">
                                <h3>
                                    Bồn tắm
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="room-rules">
                <h3>
                    Quy định của khách sạn 
                </h3>
                <ul class="list-rules">
                    <li>
                        <i class="fa fa-smoking"></i>
                        Không hút thuốc
                    </li>
                    <li>
                        <i class="fa fa-paw"></i>
                         không nuôi thú cưng
                    </li>
                    <li>
                        <i class="fa fa-door-closed"></i>
                        Hồ bơi đóng cửa lúc 8.00pm - 6.00am
                    </li>
                </ul>
            </div>       
            <div class="product-content-button">
                <div class="product-content-botton-content-big">
                    <div class="product-content-botton-content-title row">
                        <div class="product-content-botton-content-title-item mota" style="margin-top: 2%;">
                            <p>BLUE HOTEL tự hào có phong cách mang lại cảm giác thư giãn và trang nhã. 
                                Mỗi phòng tại BLUE HOTEL là sự kết hợp giữa vẻ đẹp, tính thẩm mỹ và nghệ thuật. Phòng nhỏ được bố trí với diện tích hợp lý
                                30 m2 và được trang bị đầy đủ tiện nghi hiện đại.</p>
                        </div>
                    </div>
                </div>
            </div>     
            <div class="btn-box" style="margin-left:30%; margin-top: 3%;">
                <a href="booknow.php?id= <?php echo $row['maphong'] ?>" class="btn btn-sm text-white custom-bg shadow-none">Đặt ngay</a>
            </div>
        </div> 
        <?php }   ?>
    </div>
    <!-- Products Start -->
    <div>
        <h1 class="mb-5 text-uppercase text-center" style="color: #16d7fe;">Các phòng khác</span></h1>

        <div class="container">
       <div class="row">
            <?php
                function currency_format($amount) {
                    // Your currency formatting logic here
                    return number_format($amount, 0, ',', '.') . ' VND';
                }
                while($rowshow = mysqli_fetch_assoc($queryshow)){
            ?>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="./admin/img/<?php echo $rowshow['anh'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5><?php echo $rowshow['tenphong']?></h5>
                        <h6 class="mb-4"><?php echo currency_format($rowshow['gia'])?>/đêm</h6>
                        <div class="features mb-4">
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                               <i class="fa fa-bed me-2" style="color: #16d7fe;"></i> giường
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                               <i class="fa fa-bath me-2"style="color: #16d7fe;"></i> phòng tắm
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                               <i class="fa fa-wifi me-2"style="color: #16d7fe;"></i> wifi
                            </span>
                        </div>
                        <div class="guests mb-4">
                                <h5 class="mb-1">Khách</h5>
                                <span class="badge rounded-pill bg-light text-dark text-wrap"><?php echo $rowshow['nguoilon']?> người lớn</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap"><?php echo $rowshow['treem']?> trẻ em</span>
                            </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="booknow.php?id= <?php echo $rowshow['maphong'] ?>" class="btn btn-sm text-white custom-bg shadow-none">Đặt ngay</a>
                            <a href="chitietphonglg.php?id= <?php echo $rowshow['maphong'] ?>" class="btn btn-sm btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div> <?php }   ?>
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
</body>
</html>