<?php
    session_start();
    require_once 'connect.php';
    $sql =  "SELECT * FROM phong inner join loaiphong on phong.nameloaiphong = loaiphong.maloaiphong ORDER BY maphong";
    $query = mysqli_query($conn,$sql);

    
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
    
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center" style="color: #16d7fe;">PHÒNG</h2>
        <div class="h-line bg dark"></div>
    </div>

    <!--  -->
    <div class="container">
       <div class="row">
            <?php
                function currency_format($amount) {
                    // Your currency formatting logic here
                    return number_format($amount, 0, ',', '.') . ' vnđ';
                }
                if(isset($_GET['nguoilon']) != '' && isset($_GET['treem']) != ''){
                    $nguoilon = $_GET['nguoilon'];
                    $treem = $_GET['treem'];
                    
                    $sql_timkiem =  "SELECT * FROM phong WHERE nguoilon='$nguoilon' AND treem='$treem' ";
                    $query_timkiem = mysqli_query($conn,$sql_timkiem);
                }
                while($row = mysqli_fetch_assoc($query_timkiem)){
            ?>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="./admin/img/<?php echo $row['anh'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5><?php echo $row['tenphong']?></h5>
                        <h6 class="mb-4"><?php echo currency_format($row['gia'])?>/đêm</h6>
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
                        <div class="rating mb-4">
                            <!-- <span class="badge rounded-pill bg-light"> -->
                                <small class="fa fa-star text-warning"></small>
                                <small class="fa fa-star text-warning"></small>
                                <small class="fa fa-star text-warning"></small>
                                <small class="fa fa-star text-warning"></small>
                                <small class="fa fa-star text-warning"></small>
                            <!-- </span> -->
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="booknow.php?id= <?php echo $row['maphong'] ?>" class="btn btn-sm text-white custom-bg shadow-none">Đặt ngay</a>
                            <a href="chitietphonglg.php?id= <?php echo $row['maphong'] ?>" class="btn btn-sm btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div> <?php }   ?>
            <div class="col-lg-12 text-center mt-5">
                <a href="roomlg.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Xem thêm >>></a>
            </div>
        </div>
    </div>
  

        <!-- Footer -->
        <div class="container-fluid bg-white mt-5">
            <div class="row">
                <div class="col-lg-4 p-4" >
                    <h3 class="welcome fw-bold fs-3 mb-2">BLUE HOTEL</h3><br>
                    <p class="mb-0">
                    Cảm ơn quý khách đã lựa chọn <a class="text-uppercase" style="color: #16d7fe;">BLUE HOTEL</a> ,
                    Chúng tôi mong được chào đón bạn và đảm bảo rằng kỳ nghỉ của
                    bạn với chúng tôi sẽ tràn ngập sự thoải mái và những kỷ niệm đẹp.
                    </p>
                </div>
                <div class="col-lg-3 p-4" >
                    <h5>Follow us</h5>
                    <a href="#" class="d-d-inline-block text-dark text-decoration-none mb-2">
                        <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-twitter"></i> Twitter</span>
                    </a><br><br>
                    <a href="#" class="d-d-inline-block text-dark text-decoration-none mb-2">
                        <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-facebook"></i> Facebook</span>
                    </a><br><br>
                    <a href="#" class="d-d-inline-block text-dark text-decoration-none mb-2">
                        <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-instagram"></i> Instagram</span>
                    </a>
                </div>
                <div class="col-lg-2 p-4" >
                    <h5 class="mb-3">Liên hệ nhanh</h5>
                    <a href="./index.php" class="d-d-inline-block mb-2 text-dark text-decoration-none">Trang chủ</a><br>
                    <a href="./room.php" class="d-d-inline-block mb-2 text-dark text-decoration-none">Phòng</a><br>
                    <a href="./booking.php" class="d-d-inline-block mb-2 text-dark text-decoration-none">Đánh giá</a><br>
                    <a href="./contact.php" class="d-d-inline-block mb-2 text-dark text-decoration-none">Liên hệ</a><br>
                </div>
                <div class="col-lg-2 p-4" >
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
    </script>
</body>
</html>