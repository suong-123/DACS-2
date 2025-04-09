<?php
    require_once 'connect.php';
    $sql =  "SELECT * FROM phong inner join loaiphong on phong.nameloaiphong = loaiphong.maloaiphong ORDER BY maphong";
    $query = mysqli_query($conn,$sql);

    // dang ky
    if(isset($_POST['dangky'])){
        $ten = $_POST['ten'];
        $ten = filter_var($ten,FILTER_SANITIZE_STRING);
        $phone = $_POST['phone'];
        $phone = filter_var($phone,FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email,FILTER_SANITIZE_STRING);
        $address = $_POST['address'];
        $address = filter_var($address,FILTER_SANITIZE_STRING);
        $cccd = $_POST['cccd'];
        $cccd = filter_var($cccd,FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass,FILTER_SANITIZE_STRING);
        $image = $_FILES ['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name']; 
        $image_folder = './img/'.$image;
        $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($select) > 0){
            echo 'Người dùng đã tồn tại!';
        }else{
            $insert = mysqli_query($conn,"INSERT INTO users (username,ava,cccd,address,phone,email,pass)
            VALUES ('$ten','$image','$cccd','$address','$phone','$email','$pass')");
            if($insert){
                move_uploaded_file($image_tmp,$image_folder);
            }
        }
    }

    // dang nhap
    if(isset($_POST['dangnhap'])){
        $email = $_POST['email'];
        $email = filter_var($email,FILTER_SANITIZE_STRING);
        $pass = $_POST['password'];
        $pass = filter_var($pass,FILTER_SANITIZE_STRING);

        $select = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($conn,$select);

        $truyvan = mysqli_fetch_assoc($query);

        
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $pass;
        
        $db_name = $truyvan['username'];
        $_SESSION['username'] = $db_name;

        $db_img = $truyvan['ava'];
        $_SESSION['ava'] = $db_img;

        $db_address = $truyvan['address'];
        $_SESSION['address'] = $db_address;

        $db_phone = $truyvan['phone'];
        $_SESSION['phone'] = $db_phone;

        $db_cccd = $truyvan['cccd'];
        $_SESSION['cccd'] = $db_cccd;
        
        if($truyvan['pass'] == $pass){
            $_SESSION['email'] = $email;
            header('location: index.php');
        }else{
            echo '<div class="alert alert-danger" style="width: 30%; margin-left:70%"><i class="bi bi-exclamation-circle"></i> Đăng nhập không thành công</a></div>';
        }  
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
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item" >
                        <a class="nav-link me-2" aria-current="page" href="chualogin.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mb-2" href="room.php">Phòng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-2" href="booking.php">Đánh giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-2" href="contact.php">Liên hệ</a>
                    </li>
                </ul>
        
                <div class="d-flex">
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-2" data-bs-toggle="modal" data-bs-target="#dangnhapModal">
                        Đăng nhập
                    </button> 
                    <button type="button" class="btn btn-outline-dark shadow-none " data-bs-toggle="modal" data-bs-target="#dangkyModal" style="padding-left: 20px;">
                        <span style="margin-right: 10px;">Đăng ký</span>
                    </button> 
                </div>
            </div>
        </div>
   </nav>
    
    <!-- Dang nhap -->
    <div class="modal fade" id="dangnhapModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i> Đăng nhập
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" required class="form-control shadow-none" >
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" required class="form-control shadow-none" >
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button onclick="confirmAction()" type="submit" name="dangnhap"  class="btn btn-dark shadow-none">LOGIN</button>
                            <label>Bạn chưa có tài khoản ? Đăng ký ngay !</label>
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
                <form method="post" enctype="multipart/form-data">
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
                                    <input type="text" name="ten" class="form-control shadow-none" >
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="number" name="phone" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Hình ảnh</label>
                                    <input type="file" name="image" class="form-control shadow-none" required accept="image/jpg, image/png, image/jpeg">
                                </div>
                                <div class="col-md-12 p-0 mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <textarea class="form-control shadow-none" name="address" rows="1" required></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">CCCD</label>
                                    <input type="number" name="cccd" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Mật khẩu</label>
                                    <input type="password" name="pass" class="form-control shadow-none"required >
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" value="register now" class="btn btn-dark shadow-none" name="dangky">Đăng ký</button>                       
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

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">BỘ LỌC</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> 
                        <form action="" method="get">
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                           <div class="border bg-light p-3 rounded mb-2">
                                <div class="mb-2">
                                <label class="form-label" >Check-in</label>
                                <input type="date" class="form-control shadow-none mb-3" name="checkin" required value="<?= isset($_GET['date']) == true ? $_GET['date']:'' ?>">
                                <label class="form-label" >Check-out</label>
                                <input type="date" class="form-control shadow-none" name="checkout" required value="<?= isset($_GET['date']) == true ? $_GET['date']:'' ?>">
                                </div>
                           </div>
                           <div class="border bg-light p-3 rounded mb-2">
                                <h5 class="mb-3" style="font-size: 18px;">KHÁCH</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Người lớn</label>
                                        <select class="form-select shadow-none"style="width: 100px;" name="nguoilon" required>
                                            <option value="1" <?= isset($_GET['nguoilon']) == true ? ($_GET['nguoilon'] =='1' ? 'selected':'') :'' ?>>1</option>
                                            <option value="2" <?= isset($_GET['nguoilon']) == true ? ($_GET['nguoilon'] =='2' ? 'selected':'') :'' ?>>2</option>
                                            <option value="3" <?= isset($_GET['nguoilon']) == true ? ($_GET['nguoilon'] =='3' ? 'selected':'') :'' ?>>3</option>
                                            <option value="4" <?= isset($_GET['nguoilon']) == true ? ($_GET['nguoilon'] =='4' ? 'selected':'') :'' ?>>4</option>
                                        </select>
                                    </div><br>
                                    <div>
                                        <label class="form-label" >Trẻ em</label>
                                        <select class="form-select shadow-none" style="width: 100px;" name="treem" required>
                                            <option value="1" <?= isset($_GET['treem']) == true ? ($_GET['treem']=='1' ? 'selected':'') :'' ?>>1</option>
                                            <option value="2" <?= isset($_GET['treem']) == true ? ($_GET['treem']=='2' ? 'selected':'') :'' ?>>2</option>
                                            <option value="3" <?= isset($_GET['treem']) == true ? ($_GET['treem']=='3' ? 'selected':'') :'' ?>>3</option>
                                            <option value="4" <?= isset($_GET['treem']) == true ? ($_GET['treem']=='4' ? 'selected':'') :'' ?>>4</option>
                                        </select>
                                    </div>
                                </div>
                           </div>
                           <div class="col-lg-1 mb-lg-3 mt-2" style="margin-left: 25px;">
                            <button  type="submit" class="btn text-white shadow-none custom-bg" style="width: 150px;" name="timkiem">Tìm kiếm</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </nav>
            </div>
            <div class=" col-lg-9 col-md-12 px-4 ">
                <?php
                    function currency_format($amount) {
                        // Your currency formatting logic here
                        return number_format($amount, 0, ',', '.') . ' VND';
                    }
                    if(isset($_GET['nguoilon']) && isset($_GET['treem'])){
                        $nguoilon = $_GET['nguoilon'];
                        $treem = $_GET['treem'];
                    
                        $sql_timkiem =  "SELECT * FROM phong WHERE nguoilon='$nguoilon' AND treem='$treem' ";
                        $query_timkiem = mysqli_query($conn, $sql_timkiem);
                    }else{
                        $sql =  "SELECT * FROM phong inner join loaiphong on phong.nameloaiphong = loaiphong.maloaiphong ORDER BY maphong";
                        $query_timkiem = mysqli_query($conn,$sql);
                    }
                ?>
                <?php
                    while($r = mysqli_fetch_array($query_timkiem)){
                ?>
                <div class="danhsach card mb-4 border-0 shadow" >
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-4 mb-lg-0 mb-md-0 mb-3">
                            <img src="./admin/img/<?php echo $r['anh'] ?>" class="card-img-top">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0" >
                            <h5 class="mb-3"><?php echo $r['tenphong']?></h5>
                            <div class="features mb-4">
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <i class="fa fa-bed me-2" style="color: #16d7fe;"></i> 1 giường
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <i class="fa fa-bath me-2"style="color: #16d7fe;"></i> 1 phòng tắm
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <i class="fa fa-wifi me-2"style="color: #16d7fe;"></i> wifi
                                </span>
                            </div>
                            <div class="guests mb-4">
                                <h5 class="mb-1">Khách</h5>
                                <span class="badge rounded-pill bg-light text-dark text-wrap"><?php echo $r['nguoilon']?> người lớn</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap"><?php echo $r['treem']?> trẻ em</span>
                            </div>
                            <div class="rating mb-2">
                            <!-- <span class="badge rounded-pill bg-light"> -->
                                
                            <!-- </span> -->
                        </div>
                        </div>
                        <div class="col-md-3 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6 class="mb-4"><?php echo currency_format($r['gia'])?>/đêm</h6>
                            <a onclick="myFunction()" class="btn btn-sm text-white custom-bg shadow-none mb-2" style="width: 80%;">Đặt ngay</a>
                            <a href="chitietphong.php?id= <?php echo $r['maphong'] ?>" class="btn btn-sm btn-outline-dark shadow-none" style="width: 80%;">Xem chi tiết</a>
                        </div>
                    </div>
                </div><?php }  ?>
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