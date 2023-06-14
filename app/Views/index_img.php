<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Galleries</title>
    <link rel="icon" type="image/x-icon" href="/task06MVC/public/assets/img/logo.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400, 500, 700&amp;display=swap&amp;subset=vietnamese" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/task06MVC/public/assets/css/themicon/themify-icons.css" />
    <link rel="stylesheet" href="/task06MVC/public/assets/css/style.css?v=1.23" />
    <link rel="stylesheet" href="/task06MVC/public/assets/css/grid.css" />
    <link rel="stylesheet" href="/task06MVC/public/assets/css/responsive.css" />
</head>

<body>
    <div class="appcontainer" style="
        position: relative;
        display: grid;
        grid-template-rows: 0 auto auto 1fr auto;
        height: 100vh;
      ">
        <div id="scrollBar">
            <div id="scrollProgress"></div>
        </div>
        <div class="headerbgmb">
            <div class="headertop grid wide">
                <div class="header__mb row">
                    <p class="" style="font-weight: 600">Language:</p>
                    <img src="/task06MVC/public/assets/img/us.svg" alt="us" />
                    <p>English</p>
                </div>
            </div>
        </div>
        <div class="app grid wide">
            <div class="app_header row">
                <div class="header_logo col l-4 ls-4 m-4 c-6 cs-6">
                    <img src="/task06MVC/public/assets/img/logoheader.png" alt="logoheader" />
                </div>
                <div class="header_option col l-8 ls-8 m-8 c-6 cs-6">
                    <div class="header_option_contact">
                        <p>Liên hệ</p>
                    </div>
                    <div class="header_option_language">
                        <img src="/task06MVC/public/assets/img/us.svg" alt="us" />
                        <p>English</p>
                    </div>
                    <div class="header_option_search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <p>Tìm kiếm</p>
                    </div>
                    <div class="header_option_cart">
                        <p>Mua ngay</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="header_nav">
            <div class="nav grid wide">
                <div class="nav_row row">
                    <div class="menutable l-0 ls-0 m-10">
                        <i id="open" class="fa-solid fa-bars iconmenu"></i>
                        <i id="close" class="fa-solid fa-arrow-up iconmenuarow"></i>
                        <p>Menu</p>
                    </div>
                    <div class="nav_menu col l-10 ls-10 m-12 c-12 cs-12">
                        <ul>
                            <li class="main">
                                <div>
                                    <img src="/task06MVC/public/assets/img/house.png" alt="" />
                                    <a href="#">Trang chủ</a>
                                    <i class="fa-solid fa-chevron-down down"></i>
                                    <div class="plus_minus">
                                        <i class="fa-solid fa-plus plus active"></i>
                                        <i class="fa-solid fa-minus minus disable"></i>
                                    </div>
                                </div>
                                <ul class="mini_menu disable">
                                    <li><a href="#">Trang chủ chính</a></li>
                                    <li><a href="#">Trang chủ 2</a></li>
                                    <li><a href="#">Trang chủ 3</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Du lịch</a>
                            </li>
                            <li>
                                <a href="#">Điểm đến</a>
                            </li>
                            <li>
                                <a href="#">Khách sạn</a>
                            </li>
                            <li>
                                <a href="#">Phong cách sống</a>
                            </li>
                            <li>
                                <a href="#">Tin tức</a>
                            </li>
                            <li>
                                <a class="lib" href="#">Thư viện ảnh</a>
                            </li>
                            <li class="opinfo">
                                <div>
                                    <a href="#">Giao diện tin tức</a>
                                    <i class="fa-solid fa-chevron-down down"></i>
                                    <div class="plus_minus">
                                        <i class="fa-solid fa-plus plus active"></i>
                                        <i class="fa-solid fa-minus minus disable"></i>
                                    </div>
                                </div>
                                <ul class="mini_menu disable">
                                    <li><a href="#">Dạng lưới</a></li>
                                    <li><a href="#">Dạng danh sách</a></li>
                                    <li><a href="#">Giao diện lớn</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav_iconcontact col l-2 ls-2 m-2">
                        <div class="navicon">
                            <img src="/task06MVC/public/assets/img/fb.png" alt="" />
                        </div>
                        <div class="navicon">
                            <img src="/task06MVC/public/assets/img/tw.png" alt="" />
                        </div>
                        <div class="navicon">
                            <img src="/task06MVC/public/assets/img/ln.png" alt="" />
                        </div>
                        <div class="navicon">
                            <img src="/task06MVC/public/assets/img/mn.png" alt="" id="nav--option" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="grid wide">

                <div class="row block_searchImg">
                    <?php if (!empty($urlimgsearch)) : ?>
                        <?php for ($i = 0; $i < count($urlimgsearch); $i++) : ?>
                            <div class="container_img col l-4 ls-4 m-4">
                                <div class="container_img--option">
                                    <img src="<?= $urlimgsearch[$i]['url'] ?>" alt="" class="imgSearch" />
                                    <div class="container_option">
                                        <a href="#">PERFECT</a>
                                        <p>Theo Rue Rouji</p>
                                    </div>
                                    <div class="dowload_img">
                                        <i class="fa-solid fa-cloud-arrow-down"></i>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php else : ?>
                        <div class="container_img col l-4 ls-4 m-4">
                            <div class="container_img--option">
                                <img src="/task06MVC/public/getImages?id=16&size=2" alt="" class="imgSearch" />
                                <div class="container_option">
                                    <a href="#">PERFECT</a>
                                    <p>Theo Rue Rouji</p>
                                </div>
                                <div class="dowload_img">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="container_img col l-4 ls-4 m-4">
                            <div class="container_img--option">
                                <img src="/task06MVC/public/getImages?id=15&size=2" alt="" class="imgSearch" />
                                <div class="container_option">
                                    <a href="#">NEW DAY</a>
                                    <p>Theo Rue Rouji</p>
                                </div>
                                <div class="dowload_img">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="container_img col l-4 ls-4 m-4">
                            <div class="container_img--option">
                                <img src="/task06MVC/public/getImages?id=2&size=2" alt="" class="imgSearch" />
                                <div class="container_option">
                                    <a href="#">HAPPY DAY</a>
                                    <p>Theo Rue Rouji</p>
                                </div>
                                <div class="dowload_img">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="container_img col l-4 ls-4 m-4">
                            <div class="container_img--option">
                                <img src="/task06MVC/public/getImages?id=19&size=2" alt="" class="imgSearch" />
                                <div class="container_option">
                                    <a href="#">NATURE</a>
                                    <p>Theo Rue Rouji</p>
                                </div>
                                <div class="dowload_img">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="container_img col l-4 ls-4 m-4">
                            <div class="container_img--option">
                                <img src="/task06MVC/public/getImages?id=18&size=2" alt="" class="imgSearch" />
                                <div class="container_option">
                                    <a href="#">MORNING</a>
                                    <p>Theo Rue Rouji</p>
                                </div>
                                <div class="dowload_img">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="container_img col l-4 ls-4 m-4">
                            <div class="container_img--option">
                                <img src="/task06MVC/public/getImages?id=6&size=2" alt="" class="imgSearch" />
                                <div class="container_option">
                                    <a href="#">PHOTOGRAPHY</a>
                                    <p>Theo Rue Rouji</p>
                                </div>
                                <div class="dowload_img">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row nextandprepage closed">
                    <div class="btn_control">
                        <div class="controll_page">
                            <i class="ti-angle-left pre "></i>
                            <button class="currentPage">Page 1</button>
                            <i class="ti-angle-right next"></i>

                        </div>
                        <div class="controll_page">
                            <i class="ti-angle-left derPage "></i>
                            <button class="currentNumImage">6 Image</button>
                            <i class="ti-angle-right inrPage"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="grid wide">
                <div class="footer_contents row">
                    <div class="footer_gt col l-3 ls-3 m-6 c-12 cs-12">
                        <p class="content" style="color: #212529; font-weight: 600">
                            ABOUT ME
                        </p>
                        <p class="footergt_text" style="color: #212529">
                            Bắt đầu viết, không có vấn đề gì. Nước
                            <br />
                            không chảy cho đến khi vòi được bật.
                        </p>
                        <p class="footergt_text" style="color: #212529">
                            <span style="color: #212529; font-weight: 600"> Địa chỉ </span>
                            <br />

                            At now you can see me here :D
                        </p>
                        <p class="footergt_text" style="color: #212529">Follow me</p>
                        <div class="nav_iconcontact col l-2 ls-2 m-2 c-12 cs-12">
                            <div class="navicon">
                                <img src="/task06MVC/public/assets/img/fb.png" alt="" />
                            </div>
                            <div class="navicon">
                                <img src="/task06MVC/public/assets/img/tw.png" alt="" />
                            </div>
                            <div class="navicon">
                                <img src="/task06MVC/public/assets/img/ln.png" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="footer_mn col l-2 ls-2 m-6 c-12 cs-12">
                        <p class="content" style="color: #212529; font-weight: 600">
                            LIÊN KẾT NHANH
                        </p>
                        <p>Trang chủ</p>
                        <p>Liên hệ</p>
                        <p>Tin tức</p>
                        <p>Du lịch</p>
                        <p>Thư viện ảnh</p>
                    </div>
                    <div class="footer_tag col l-3 ls-3 m-6 c-12 cs-12">
                        <p class="content" style="color: #212529; font-weight: 600">
                            TAGS
                        </p>
                        <div class="footer_tag--item">
                            <div class="tagbd">
                                <p>General</p>
                            </div>
                            <div class="tagbd">
                                <p>Design</p>
                            </div>
                            <div class="tagbd">
                                <p>Fashion</p>
                            </div>
                            <div class="tagbd">
                                <p>Branding</p>
                            </div>
                            <div class="tagbd">
                                <p>Modern</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer_sig col l-4 ls-4 m-6 c-12 cs-12">
                        <p class="content" style="color: #212529; font-weight: 600">
                            ĐĂNG KÍ BẢN TIN
                        </p>
                        <p class="footergt_text" style="color: #212529">
                            Subscribe to our newsletter and get our newest updates<br />
                            right on your inbox.
                        </p>
                        <div class="footer_sig--form">
                            <input type="text" placeholder="Enter your email" />
                            <button>
                                <p>Theo dõi</p>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="footer_finish row">
                    <p>©2023 Stories - Rue</p>
                    <p>Designed by Rue | All rights reserved.</p>
                </div>
            </div>
        </div>
        <div class="srolltop">
            <a href="#">
                <i class="fa-solid fa-arrow-up"></i>
            </a>
        </div>
        <div class="footer_sidebar closed">
            <div class="footer_overlow">
                <div class="footer_contents grid">
                    <div class="row">
                        <div class="footer_ct col l-3 l-o-9 ls-4 ls-o-8 m-5 m-o-7 c-10 c-o-2 cs-o-2">
                            <i class="fa-solid fa-xmark" id="closenav--js"></i>
                            <div class="footer_sidebar--item">
                                <p class="content" style="color: #212529; font-weight: 600">
                                    HOT TOPICS
                                </p>
                                <p>Travel <span>8</span></p>
                                <p>Food<span>8</span></p>
                                <p>Review<span>6</span></p>
                                <p>Guides<span>4</span></p>
                                <p>Destination<span>3</span></p>
                            </div>
                            <div class="footer_sidebar--item">
                                <p class="content" style="color: #212529; font-weight: 600">
                                    DON'T MISS
                                </p>
                                <div class="footer_sidebar--option imgopmini">
                                    <img src="/task06MVC/public/getImages?id=7&size=2" alt="" />
                                    <p>
                                        Sexy Clutches: How to Buy <br />
                                        &amp; Wear a Designer Clutch...<content style="
                          font-size: 10px;
                          color: #687385;
                          margin-top: 12px;
                          font-weight: 400;
                        ">TH02 20, 2023 . 2,160 VIEWS</content>
                                    </p>
                                </div>

                                <div class="footer_sidebar--option imgopmini">
                                    <img src="/task06MVC/public/getImages?id=8&size=2" alt="" />
                                    <p>
                                        4 Expert Tips On How To <br />
                                        Choose The Right Men’s Wallet<content style="
                          font-size: 10px;
                          color: #687385;
                          margin-top: 12px;
                          font-weight: 400;
                        ">TH02 20, 2023 . 927 VIEWS</content>
                                    </p>
                                </div>
                                <div class="footer_sidebar--option imgopmini">
                                    <img src="/task06MVC/public/getImages?id=9&size=2" alt="" />
                                    <p>
                                        Unlock The Secrets Of Selling <br />
                                        High Ticket Items<content style="
                          font-size: 10px;
                          color: #687385;
                          margin-top: 12px;
                          font-weight: 400;
                        ">TH02 20, 2023 . 2,030 VIEWS</content>
                                    </p>
                                </div>
                            </div>
                            <div class="footer_sidebar--item imgfooter_op">
                                <p class="content" style="color: #212529; font-weight: 600">
                                    ADVERTISE BANNER
                                </p>
                                <img src="/task06MVC/public/getImages?id=14&size=2" alt="" class="imgfn" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block_search">
            <div class="item_search">
                <div class="block_input">
                    <label for="" id="find">Tìm kiếm</label>
                    <input id="search_img" type="text" placeholder="Tìm kiếm hình ảnh">
                </div>
                <div class="block_valueImg">


                </div>
            </div>
        </div>
    </div>

    <script src="/task06MVC/public/assets/js/main.js?v=1.11"></script>
    <script src="/task06MVC/public/assets/js/search.js?v=1.16"></script>
</body>

</html>