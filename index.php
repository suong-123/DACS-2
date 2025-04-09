<?php
    session_start();
    require_once 'connect.php';
    $sql =  "SELECT * FROM phong inner join loaiphong on phong.nameloaiphong = loaiphong.maloaiphong ORDER BY maphong LIMIT 3";
    $query = mysqli_query($conn,$sql);

    $sql_danhgia = "SELECT * FROM danhgia";
    $query1 = mysqli_query($conn,$sql_danhgia);

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
                    <a class="nav-link active me-2" active aria-current="page" href="index.php">Trang chủ</a>
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
    <!-- Caroudel -->

    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide ">
                    <img src="./img/home/IMG_15372.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="./img/home/IMG_40905.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="./img/home/IMG_55677.png" class="w-100 d-block" >
                </div>
                <div class="swiper-slide">
                    <img src="./img/home/IMG_62045.png" class="w-100 d-block" >
                </div>
            </div>
        </div>
    </div>

    <!-- Kiem tra dat phong-->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Kiểm tra đặt chỗ</h5>
                <form action="./room_timkiemlg.php" method="get">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;;">Check-in</label>
                            <input type="date" style="width: 210px; " class="form-control shadow-none" name="checkin" required value="<?= isset($_GET['date']) == true ? $_GET['date']:'' ?>">
                        </div>
                        <div class="col-lg-3  mb-3" style="margin-left: -33px;">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" style="width: 210px;" class="form-control shadow-none" name="checkout" required value="<?= isset($_GET['date']) == true ? $_GET['date']:'' ?>">
                        </div>
                        <div class="col-lg-3  mb-3" style="margin-left: -33px;">
                            <label class="form-label" style="font-weight: 500;;">Người lớn</label>
                            <select class="form-select shadow-none"style="width: 210px;" name="nguoilon" required>
                                <option value="1" <?= isset($_GET['nguoilon']) == true ? ($_GET['nguoilon'] =='1' ? 'selected':'') :'' ?>>1</option>
                                <option value="2" <?= isset($_GET['nguoilon']) == true ? ($_GET['nguoilon'] =='2' ? 'selected':'') :'' ?>>2</option>
                                <option value="3" <?= isset($_GET['nguoilon']) == true ? ($_GET['nguoilon'] =='3' ? 'selected':'') :'' ?>>3</option>
                                <option value="4" <?= isset($_GET['nguoilon']) == true ? ($_GET['nguoilon'] =='4' ? 'selected':'') :'' ?>>4</option>
                            </select>
                        </div>
                        <div class="col-lg-2  mb-3" style="margin-left: -33px;">
                            <label class="form-label" style="font-weight: 500;">Trẻ em</label>
                            <select class="form-select shadow-none" style="width: 210px;" name="treem" required>
                                <option value="1" <?= isset($_GET['treem']) == true ? ($_GET['treem']=='1' ? 'selected':'') :'' ?>>1</option>
                                <option value="2" <?= isset($_GET['treem']) == true ? ($_GET['treem']=='2' ? 'selected':'') :'' ?>>2</option>
                                <option value="3" <?= isset($_GET['treem']) == true ? ($_GET['treem']=='3' ? 'selected':'') :'' ?>>3</option>
                                <option value="4" <?= isset($_GET['treem']) == true ? ($_GET['treem']=='4' ? 'selected':'') :'' ?>>4</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2" style="margin-left: 25px;">
                            <button  type="submit" class="btn text-white shadow-none custom-bg" style="width: 150px;" name="timkiem">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="text-uppercase"  style="color: #16d7fe;font-weight: bold;">Về chúng tôi </h6>
                        <h1 class=" mb-4">Chào mừng đến với <span class="text-uppercase" style="color: #16d7fe;"> BLUE HOTEL</span></h1>
                        <p class="mb-4">Tại Blue Hotel, chúng tôi tự hào không chỉ là nơi lưu trú. Chúng tôi là điểm đến nơi sự thoải mái, sang trọng và dịch vụ cá nhân kết hợp với nhau để tạo ra những kỷ niệm khó quên cho khách hàng.</p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-hotel fa-2x mb-2" style="color: #16d7fe;"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">
                                            <?php
                                                    $phong_query = "SELECT * FROM phong";
                                                    $phong_query_run = mysqli_query($conn,$phong_query);
                                                    if($tong_phong = mysqli_num_rows($phong_query_run)){
                                                        echo '<h4 class="mb-0 h5 mb-0 font-weight-bold text-dark">'.$tong_phong.'</h4>';
                                                    }else{
                                                        echo '<h4>Khong co du lieu !</h4>';
                                                    }
                                                ?>
                                        </h2>
                                        <p class="mb-0">Phòng</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users-cog fa-2x mb-2" style="color: #16d7fe;"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">
                                            <?php
                                                    $datphong = "SELECT * FROM datphong";
                                                    $datphong_run = mysqli_query($conn,$datphong);
                                                    if($tong = mysqli_num_rows($datphong_run)){
                                                        echo '<h4 class="mb-0 h5 mb-0 font-weight-bold text-dark">'.$tong.'</h4>';
                                                    }else{
                                                        echo '<h4>Khong co du lieu !</h4>';
                                                    }
                                                ?>
                                        </h2>
                                        <p class="mb-0">Booking</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users fa-2x mb-2" style="color: #16d7fe;"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">
                                            <?php
                                                    $user_query = "SELECT * FROM users";
                                                    $user_query_run = mysqli_query($conn,$user_query);
                                                    if($tong_user = mysqli_num_rows($user_query_run)){
                                                        echo '<h4 class="mb-0 h5 mb-0 font-weight-bold text-dark">'.$tong_user.'</h4>';
                                                    }else{
                                                        echo '<h4>Khong co du lieu !</h4>';
                                                    }
                                                ?>
                                        </h2>
                                        <p class="mb-0">Khách hàng</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <a class="btn btn-primary py-3 px-5 mt-2" href=""></a> -->
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/about-2.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/about-3.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/about-4.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- About End -->


    <!-- Phong -->
    <div class="text-center">
        <h1 class="mb-5 text-uppercase" style="color: #16d7fe;">Phòng</span></h1>
    
    </div><br>
    <div class="container">
        <div class="row">
            <?php
                function currency_format($amount) {
                    // Your currency formatting logic here
                    return number_format($amount, 0, ',', '.') . ' VND';
                }
                while($row = mysqli_fetch_assoc($query)){
            ?>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="./admin/img/<?php echo $row['anh'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5><?php echo $row['tenphong']?></h5>
                        <h6 class="mb-4"><?php echo currency_format($row['gia'])?></h6>
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
                                <span class="badge rounded-pill bg-light text-dark text-wrap"><?php echo $row['nguoilon']?> người lớn</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap"><?php echo $row['treem']?> trẻ em</span>
                        </div>
                        <!-- <div class="rating mb-4">
                            <span class="badge rounded-pill bg-light"> -->
                                <!-- <small class="fa fa-star text-warning"></small>
                                <small class="fa fa-star text-warning"></small>
                                <small class="fa fa-star text-warning"></small>
                                <small class="fa fa-star text-warning"></small>
                                <small class="fa fa-star text-warning"></small> -->
                            <!-- </span> -->
                        <!-- </div>  -->
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="booknow.php?id= <?php echo $row['maphong'] ?>" class="btn btn-sm text-white custom-bg shadow-none">Đặt ngay</a>
                            <a href="chitietphonglg.php?id= <?php echo $row['maphong'] ?>" class="btn btn-sm btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div> <?php }   ?>
        </div>
        <div class="col-lg-12 text-center mt-5">
                <a href="room.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Xem thêm >>></a>
            </div>
    </div>
    <br><br>

    <!-- Dich vu -->
    <div class="text-center">
        <h1 class="mb-5 text-uppercase" style="color: #16d7fe;">DỊCH VỤ</span></h1>
    </div>
        <div class="container">
            <div class="row ">
            <div class="zoom col-lg-4 col-md-6 my-3 text-center rounded py-4 ">
                <div class="card border-0 shadow" style="max-width: 370px; margin: auto;height: 250px">
                    <i class="fa fa-hotel fa-2x mb-2" style="color: #16d7fe; width: 80px; margin-left: 38%; margin-top: 17px;"></i>
                    <h5 class="mb-3">Phòng</h5>
                    <p class="text-body mb-0" style="font-size: 14px; text-align: center;">Chọn từ các phòng được thiết kế chu đáo của
                    chúng<br> tôi để tìm không gian hoàn hảo cho kỳ nghỉ của bạn.<br> Các phòng của chúng tôi được trang bị tiện
                    nghi hiện<br> đại, nội thất tiện nghi và phong cách trang trí đầy thân<br> thiện để bạn cảm thấy như đang ở nhà.</p>
                </div>
            </div>
            <div class="zoom col-lg-4 col-md-6 my-3 text-center rounded py-4 ">
                <div class="card border-0 shadow" style="max-width: 370px; margin: auto;height: 250px">
                    <i class="fa fa-utensils fa-2x" style="color: #16d7fe; width: 80px; margin-left: 38%;margin-top: 17px;"></i>
                    <h5 class="mb-3">Món ăn</h5>
                        <p class="text-body mb-0 " style="font-size: 14px;">Thưởng thức các món ăn ngon tại nhà hàng trong<br> nhà  của chúng tôi.
                        Các đầu bếp đã chuẩn bị thực đơn<br> đa dạng lấy cảm hứng từ ẩm thực địa phương và toàn<br> cầu.
                        Cho dù bạn đang tìm kiếm một bữa sáng thịnh<br> soạn hay một bữa tối lãng mạn, chúng tôi đều đáp<br> ứng được nhu cầu của bạn.</p>
                </div>
            </div>
            <div class="zoom col-lg-4 col-md-6 my-3 text-center rounded py-4 ">
                <div class="card border-0 shadow" style="max-width: 370px; margin: auto;height: 250px">
                    <i class="fa fa-dumbbell fa-2x" style="color: #16d7fe; width: 80px; margin-left: 38%;margin-top: 17px"></i>
                    <h5 class="mb-3">Trung tâm thể hình</h5>
                        <p class="text-body mb-0 " style="font-size: 14px;">Luôn năng động trong suốt thời gian lưu trú với
                        trung<br> tâm thể hình được trang bị tốt của chúng tôi. Được mở<br> cửa 24/7, vì vậy bạn có thể duy trì thói quen tập luyện<br> của mình một cách thuận tiện.</p>
                </div>
            </div>
            <div class="zoom col-lg-4 col-md-6 my-3 text-center rounded py-4 ">
                <div class="card border-0 shadow" style="max-width: 370px; margin: auto;height: 250px">
                    <i class="fa fa-swimmer fa-2x " style="color: #16d7fe; width: 80px; margin-left: 38%;margin-top: 17px"></i>
                    <h5 class="mb-3">Bể bơi</h5>
                    <p class="text-body mb-0" style="font-size: 14px;">Hãy ngâm mình sảng khoái trong hồ bơi ngoài trời<br> của chúng tôi hoặc nằm dài bên hồ bơi để tắm nắng.</p>
                </div>
            </div>
            <div class="zoom col-lg-4 col-md-6 my-3 text-center rounded py-4 ">
                <div class="card border-0 shadow" style="max-width: 370px; margin: auto;height: 250px">
                    <i class="fa fa-glass-cheers fa-2x" style="color: #16d7fe; width: 80px; margin-left: 38%;margin-top: 17px"></i>
                    <h5 class="mb-3">Sự kiện & tiệc tùng</h5>
                    <p class="text-body mb-0" style="font-size: 14px;">Blue Hotel cung cấp không gian tổ chức sự kiện linh<br> hoạt cho các hội nghị, cuộc họp và các dịp đặc biệt.<br> 
                    Đội ngũ tổ chức sự kiện chuyên nghiệp của chúng tôi<br> luôn sẵn sàng hỗ trợ lập kế hoạch, đảm bảo sự thành<br> công cho sự kiện của bạn.</p>
                </div>
            </div>
            <div class="zoom col-lg-4 col-md-6 my-3 text-center rounded py-4 ">
                <div class="card border-0 shadow" style="max-width: 370px; margin: auto; height: 250px;">
                    <i class="fa fa-spa fa-2x" style="color: #16d7fe; width: 80px; margin-left: 38%;margin-top: 17px"></i>
                    <h5 class="mb-3">Khám phá địa phương</h5>
                    <p class="text-body mb-0" style="font-size: 14px;">Quầy lễ tân của chúng tôi có thể cung cấp thông tin về<br> các điểm tham quan,
                    mua sắm và giải trí gần đó để làm<br> cho kỳ nghỉ của bạn trở nên thú vị hơn.</p>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    <!-- Phản hồi của khách hàng -->
    <div class="text-center">
        <h1 class="section-title text-center text-uppercase" style="color: #16d7fe;">Phản hồi của khách hàng</h1>
    </div>
    <div class="container mt-5">
        <div class="swiper swiper-phanhoi">
            <div class="swiper-wrapper">
                <?php
                        while($row = mysqli_fetch_assoc($query1)){
                
                ?>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <i class="bi bi-person-circle fs-3 me-2"></i>
                        <h6 class="m-0 ms-2"> <?php echo $row['ten']?></h6>
                    </div>
                    <p><?php echo $row['danhgia']?></p>
                    
                </div>
                <?php } ?>
            </div>
        <div class="swiper-pagination"></div>
  </div>
    </div>
    <br><br>



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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        }
        });

        var swiper = new Swiper(".swiper-phanhoi", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        }, 
    }
    });
        function myFunction() {
  alert("Vui lòng đăng nhập trước khi đặt phòng");
        }
    </script>
  
</body>
</html>