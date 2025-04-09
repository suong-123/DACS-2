<?php
    session_start();
     require_once 'connect.php';
     $sql =  "SELECT * FROM adminlogin ORDER BY stt LIMIT 2 ";
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
                    <a class="nav-link me-2" active aria-current="page" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link mb-2" href="roomlg.php">Phòng</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link mb-2" href="bookinglg.php">Đánh giá</a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link active mb-2" href="contactlg.php">Liên hệ</a>
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
    
    <!-- Liên hệ -->
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class=" col-lg-8 col-md-4 mb-lg-0 mb-3 rounded">
                <h2 class="fw-bold h-font text-center" style="color: #16d7fe;">Liên hệ</h2><br>
                <iframe class="w-100 rounded"  height="470" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.733396098416!2d108.252355!3d15.975293100000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2sVietnam%20-%20Korea%20University%20of%20Information%20and%20Communication%20Technology.!5e0!3m2!1sen!2s!4v1699722291592!5m2!1sen!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="" style="margin-left: 20px;">
                        <h5>Địa chỉ: </h5>
                    <a class="d-d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="fa fa-map-marker me-3"></i>Trường Đại học Công nghệ Thông tin và Truyền thông Việt Hàn</p>
                    </a>
                     <h5>Hotline: </h5>
                    <a class="d-d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="fa fa-phone-alt me-3"></i>0917055377</p>
                    </a>
                    <a class="d-d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="fa fa-phone-alt me-3"></i>0334484556</p>
                    </a>
                    <a class="d-d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="fa fa-envelope me-3"></i>suongntt.22ite@gmail.com</p>
                    </a>
                    <a class="d-d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="fa fa-envelope me-3"></i>trangnth.22ite@gmail.com</p>
                    </a>
                    </div>
            </div>
            <div class=" col-lg-4 col-md-4">
                <div class="row">
                    <div class="col-lg-6 col-md-10 wow fadeInUp" style="margin-left: 20%; width: 70%; margin-bottom: 10px;" data-wow-delay="0.3s" >
                    <h2 class="fw-bold h-font text-center" style="color: #16d7fe;">Staff</h2><br>
                        <?php
                            while($row = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="rounded shadow overflow-hidden" style="margin-bottom: 10px;">
                            <div class="position-relative">
                                <img class="img-fluid" alt="" src="./admin/img/<?php echo $row['anh']?>">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square btn-primary mx-1" href="https://web.facebook.com/suong724ne/"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary mx-1" href="https://www.tiktok.com/@suongg724?is_from_webapp=1&sender_device=pc"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary mx-1" href="https://www.instagram.com/suongg724/"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0"><?php echo $row['hovaten'] ?></h5>
                            </div>
                        </div><?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    
    
    

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
    </script>
</body>
</html>