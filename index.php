<?php
include('./inc/conn.php');
    session_start();

// Initialize variables
$user_id = $_SESSION['user_id'] ?? null;
$message = [];

// Clear all session data on logout
if (isset($_POST['logout']) && $user_id) {
    // Clear session data
    $_SESSION = [];
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    
    // Redirect to login
    header('Location: login.php');
    exit();
}
if (!$user_id && (isset($_POST['add_to_wishlist']) || isset($_POST['add_to_cart']))) {
    $_SESSION['redirect_message'] = 'Please login to continue';
    header('Location: login.php');
    exit();
}
// Get products (for all users)
//$products = [];
//$product_query = mysqli_query($conn, "SELECT * FROM `products` LIMIT 12");
//if ($product_query) {
//    while ($row = mysqli_fetch_assoc($product_query)) {
//        $products[] = $row;
//    }
//}
// to wishlist
if (isset($_POST['add_to_wishlist'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price']; 
    $product_image = $_POST['product_image'];
    $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'");
    $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");
    if (mysqli_num_rows($wishlist_number) > 0) {
        $message[]='product already exist in wishlist';
    }else if (mysqli_num_rows($cart_num) > 0) {
        $message[]='product already exist in cart';
    }else {
        $insert_wishlist = mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`,`pid`,`name','price','image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_image')");
        if (!$insert_wishlist){
            $message[]='Failed to Add product to wishlist';
        } else{
            $message[]='product successfuly added in your wishlist';
        }
    }
}
//to cart
// Handle cart addition only if user is logged in
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price']; 
    $product_image = $_POST['product_image'];
    $product_quantity= $_POST['product_quantity'];
    $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");
    if (mysqli_num_rows($cart_num)>0) {
        $message[]='product already exist in cart';
    }
    else {
        $insert_cart = mysqli_query($conn, "INSERT INTO `cart`(`user_id`, `pid`, `name`, `price`, `image`,`quantity`) 
                                        SELECT '$user_id', '$product_id', '$product_name', '$product_price', '$product_image' ,'$product_quantity'
                                        FROM DUAL 
                                        WHERE NOT EXISTS (
                                         SELECT 1 FROM `cart` 
                                            WHERE name = '$product_name' AND user_id = '$user_id'
                                        ) LIMIT 1");

        if (!$insert_cart){
            $message[]='Failed to add product to cart';
        } else{
            $message[]='product successfuly added to the cart';
        }
    }
}


?>
<style type="text/css">
    <?php
    include ('main.css');
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--slider link--->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <title>User Page</title>
</head>

    <?php include ('header.php'); ?>

    <!--home slider--->
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="img/bakeryslider.jpg" alt="Fresh Bakery">
                <div class="slider-caption">
                    <span>Discover Our Delicious</span>
                    <h1>Freshly Baked <br>Bread & Pastries</h1>
                    <p>Indulge in our artisanal bread and pastries made with the finest ingredients, crafted with love!</p>
                    <a href="homeshop.php" class="btn">Order Now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/bakeryslider2.jpg" alt="Sweet Treats">
                <div class="slider-caption">
                    <span>Experience Our Sweet</span>
                    <h1>Fresh <br>Cakes, Muffins and Pastries</h1>
                    <p>Experience the mouth-watering sweet taste of our freshly baked items, perfect for any occasion!</p>
                    <a href="homeshop.php" class="btn">Explore More</a>
                </div>
            </div>
        </div>
    <div class="control">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
    </div>
       <!-- Decorative Line -->
       <div class="line"></div>
               <?php if (!empty($message)): ?>
        <div class="messages">
            <?php foreach ($message as $msg): ?>
                <p><?= htmlspecialchars($msg) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
       <div class="services">
       <h2>Our Services</h2>
       <div class="row">
            <div class="box">
                <img src="img/bakery-icon1.png" alt="Fresh Baked">
                <div>
                    <h1>Freshly Baked Goods</h1>
                    <p>Enjoy a wide selection of freshly baked bread, cakes, and pastries every day!</p>
                </div>
            </div>
            <div class="box">
                <img src="img/bakery-icon2.png" alt="Custom Orders">
                <div>
                    <h1>Custom Creations</h1>
                    <p>Let us create custom cakes and pastries for your special occasions, tailored to your tastes!</p>
                </div>
            </div>
            <div class="box">
                <img src="img/bakery-icon3.png" alt="Delivery">
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>24/7 delivery service available. We ensure your orders arrive fresh and on time!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line2"></div>
    <div class="story">
        <div class="row">
            <div class="box">
                <span>Our Bakery Story</span>
                <h1>Delighting Taste Buds Since 1990</h1>
                <p>At Sweet Delights Bakery, we've been crafting mouthwatering treats for over three decades. Our journey began with a small kitchen and big dreams, evolving into the beloved bakery you see today.</p>
                <p>We believe in using only the finest ingredients, traditional baking methods, and a sprinkle of innovation to create pastries that not only satisfy your sweet tooth but also warm your heart. Every product is baked with passion and care, ensuring a delightful experience with every bite.</p>
                <a href="shop.php" class="btn">Shop Now</a>
            </div>
            <div class="box">
                <img src="img/pastry2.png" alt="Our Bakery">
            </div>
        </div>
    </div>
    <div class="line3"></div>

<!-- Testimonial Section -->
<div class="testimonial-fluid">
    <h1 class="title">What Our Customers Say</h1>
    <div class="testimonial-slider">
        <div class="testimonial-item">
            <img src="img/3.jpg" alt="Customer">
            <div class="testimonial-caption">
                <span>Sweet Delight</span>
                <h1>Emma's Blissful Bites</h1>
                <p>I couldn't resist the temptation! Emma's Blissful Bites are simply divine. Each bite is a burst of flavor that transports me to dessert heaven. The cakes are incredibly moist, and the frosting is perfectly balanced – not too sweet and not too rich. I've tried many bakeries, but this one stands out for its quality and attention to detail.</p>
            </div>
        </div>
        <div class="testimonial-item">
            <img src="img/4.jpg" alt="Customer">
            <div class="testimonial-caption">
                <span>Indulgence Redefined</span>
                <h1>Max's Sweet Symphony</h1>
                <p>Max's Sweet Symphony is a masterpiece of sweetness! Every dessert is meticulously crafted to perfection, leaving me craving for more. The staff is so friendly and accommodating, always ready to help with special requests. I ordered a custom birthday cake that exceeded all expectations – both in appearance and taste. Now I won't go anywhere else for my sweet treats!</p>
            </div>
        </div>
        <div class="testimonial-item">
            <img src="img/profile.jpg" alt="Customer">
            <div class="testimonial-caption">
                <span>Sweet Satisfaction Guaranteed</span>
                <h1>Lily's Dessert Haven</h1>
                <p>Lily's Dessert Haven never fails to delight my taste buds. Their desserts are the epitome of sweetness and joy. Absolutely love it! The pastries have a unique homemade quality that you just can't find elsewhere. I especially love their seasonal specialties – the autumn pumpkin rolls and winter gingerbread cookies are simply out of this world. A must-visit for anyone with a sweet tooth!</p>
            </div>
        </div>
    </div>
    <div class="controls">
        <i class="bi bi-chevron-left prev1"></i>
        <i class="bi bi-chevron-right next1"></i>
    </div>
</div>

<!-- Decorative Lines -->
<div class="line"></div>
<div class="line2"></div>

<!-- Discover Section -->
<div class="discover">
    <div class="detail">
        <h1 class="title">Sweet Treats Galore!</h1>
        <span>Indulge Now And Enjoy 25% Off!</span>
        <p>Craving something sweet? Dive into a world of delectable desserts crafted just for you. From heavenly cakes to irresistible pastries, our treats will surely satisfy your sweet tooth.</p>
        <p>For a limited time, enjoy 25% off on all our signature pastries. Don't miss this opportunity to treat yourself and your loved ones to our award-winning creations!</p>
        <a href="homeshop.php" class="btn">Discover Now</a>
    </div>
    <div class="img-box">
        <img src="img/discover1.jpg" alt="Sweet Treats">
    </div>
</div>

<!-- Decorative Line -->
<div class="line3"></div>

    <div class="line3"></div>
    <!--<div class="line4"></div>-->
    <?php include ('shop.php')?>
        
    <!-- Product Display (visible to everyone) -->
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p>Price: $<?= number_format($product['price'], 2) ?></p>
                
                <?php if ($user_id): ?>
                    <!-- Logged-in user actions -->
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
                        <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                        <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image']) ?>">
                        
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                        <button type="submit" name="add_to_wishlist">Add to Wishlist</button>
                    </form>
                <?php else: ?>
                                        <!-- Guest user actions -->
                    <div class="guest-actions">
                        <a href="login.php" class="btn">Login to Purchase</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
<!-- Footer Section -->
<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Sweet Delights Bakery</h3>
            <p>Indulge in our artisanal baked goods crafted with love and the finest ingredients. From bread to pastries, we've got your cravings covered!</p>
            <div class="social-links">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-pinterest"></i></a>
            </div>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul class="footer-links">
                <li><a href="index.php"><i class="bi bi-chevron-right"></i> Home</a></li>
                <li><a href="about.php"><i class="bi bi-chevron-right"></i> About Us</a></li>
                <li><a href="homeshop.php"><i class="bi bi-chevron-right"></i> Shop</a></li>
                <li><a href="contact.php"><i class="bi bi-chevron-right"></i> Contact</a></li>
                <li><a href="cart.php"><i class="bi bi-chevron-right"></i> Cart</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact Info</h3>
            <ul class="footer-links">
                <li><i class="bi bi-geo-alt-fill"></i> 123 Bakery Street, Sweet City</li>
                <li><i class="bi bi-telephone-fill"></i> +1 (555) 123-4567</li>
                <li><i class="bi bi-envelope-fill"></i> info@sweetdelights.com</li>
                <li><i class="bi bi-clock-fill"></i> Mon-Sat: 7:00 AM - 8:00 PM</li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Newsletter</h3>
            <p>Subscribe to our newsletter for exclusive offers, recipes, and updates!</p>
            <div class="subscribe-form">
                <input type="email" placeholder="Enter your email">
                <button type="submit"><i class="bi bi-send"></i></button>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 Sweet Delights Bakery. All Rights Reserved.</p>
    </div>
</footer>

    <!--slider js link--->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="script2.js"></script>
</body>

</html>