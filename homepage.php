<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Bakery Website</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" 
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <header>
        <a href="#" class="logo">
            <img src="img/logo.png" alt="">
    </a>
    <i class='bx bx-menu' id="menu-icon"></i>
    <ul class="navbar">
        <li><a href="homepage.php">Home Page</a></li>
        <li><a href="about us">About Us</a></li>
        <li><a href="products">Products</a></li>
        <li><a href="customers">Customers</a></li>
    </ul>
    <div class="cart-icon">
        <i class='bx bx-cart-alt' ></i>
    </div>
    <div class="header-icon">
        <i class='bx bx-search' id="search-icon"></i>
    </div>
    <div class="search-box">
        <input type="search" name="search" id="search" placeholder="Search Here">
    </div>
</header>
<center>
<section class="home" id="home">
    <!--homepage-->
    <div class="home-text">
        <h1>Start Your Day With <br>A Cup of Coffee</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui debitis placeat ea eius. Excepturi, repellat.</p>
        <a href="login.php" class="btn">Shop Now</a>
    </div>
    <div class="home-img">
        <img src="img/.png" alt="">
    </div>
</section>
<!--aboutus-->
<section class="about" id="about">
    <div class="about-img">
        <img src="img/about.jpg" alt="">
    </div>
    <div class="about-text">
        <h2>Our History</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni, laboriosam rem repellat fugit fugiat cum dicta expedita! Eaque laudantium sed, nemo accusamus architecto sit repellendus eos non, amet nobis nam?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus ullam facere ut harum!</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur veniam suscipit sed doloremque perspiciatis ullam.</p>
    <a href="#" class="btn">Learn More</a>
    </div>
</section>
<!--products-->
<section class="products" id="products">
    <div class="heading">
        <h2>Our Popular Products</h2>
        <div class="products-container">
            <div class="box">
                <img src="img/p1.png" alt="">
                <h3>Americano Pure</h3>
                <div class="content">
                    <span>$25</span>
                    <a href="#">Add to Cart</a>
                </div>
            </div>
            <div class="box">
                <img src="img/p2.png" alt="">
                <h3>Americano Pure</h3>
                <div class="content">
                    <span>$25</span>
                    <a href="#">Add to Cart</a>
                </div>
            </div>
            <div class="box">
                <img src="img/p3.png" alt="">
                <h3>Americano Pure</h3>
                <div class="content">
                    <span>$25</span>
                    <a href="#">Add to Cart</a>
                </div>
            </div>
            <div class="box">
                <img src="img/p4.png" alt="">
                <h3>Americano Pure</h3>
                <div class="content">
                    <span>$25</span>
                    <a href="#">Add to Cart</a>
                </div>
            </div>
            <div class="box">
                <img src="img/p5.png" alt="">
                <h3>Americano Pure</h3>
                <div class="content">
                    <span>$25</span>
                    <a href="#">Add to Cart</a>
                </div>
            </div>
            <div class="box">
                <img src="img/p6.png" alt="">
                <h3>Americano Pure</h3>
                <div class="content">
                    <span>$25</span>
                    <a href="#">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--customers-->
<section class="customers" id="customers">
    <div class="heading">
        <h2>Our Customers</h2>
        <div class="customers-container">
            <div class="box">
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia porro culpa sequi qui ipsum quos.</p>
                <h2>Yasin</h2>
                <img src="img/rev1.jpg" alt="">
            </div>
            <div class="box">
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia porro culpa sequi qui ipsum quos.</p>
                <h2>Yasin</h2>
                <img src="img/rev2.jpg" alt="">
            </div>
            <div class="box">
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <img src="img/rev3.jpg" alt="">
                <h2>Mia Darling</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia porro culpa sequi qui ipsum quos.</p>
            </div>
        </div>
    </div>
</section>
<section class="footer">
    <div class="footer-box">
        <h2>Coffee Shop</h2>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui beatae incidunt porro repellendus reprehenderit mollitia!</p>
        <div class="social">
            <a href="#" ><i class='bx bxl-facebook'></i></a>
            <a href="#" ><i class='bx bxl-twitter'></i></a>
            <a href="#" ><i class='bx bxl-instagram'></i></a>
            <a href="#" ><i class='bx bxl-tiktok'></i></a>
        </div>
        <div class="footer-box">
            <h2>Support</h2>
            <li><a href="#">Product</a></li>
            <li><a href="#">Help & Support</a></li>
            <li><a href="#">Return Policy</a></li>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Product</a></li>
        </div>
        <div class="footer-box">
            <h2>View Guides</h2>
            <li><a href="#">Features</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Blog Posts</a></li>
            <li><a href="#">Our Branches</a></li>
            <li><a href="#">Product</a></li>
        </div>
        <div class="footer-box">
            <h3>Contact</h3>
            <span><i class='bx bxs-map'></i>250 New York City, USA 10001</span>
            <span><i class='bx bx-phone'></i>+1 444 744 8444</span>
            <span<i class='bx bxs-envelope'></i>>coffee@shop.com</span>
        </div>
    </div>
</section>
<div class="copyright">
    <p>&#169; CarpoolVenom All Right Reserved</p>
</div>
</center>
    <script src="main.js"></script>
</body>
</html>

<!--products-->