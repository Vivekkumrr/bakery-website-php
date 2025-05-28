<?php
include ('./inc/conn.php');

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
        $insert_wishlist = mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`, `pid`, `name`, `price`, `image`) 
                                        SELECT '$user_id', '$product_id', '$product_name', '$product_price', '$product_image'
                                        FROM DUAL 
                                        WHERE NOT EXISTS (
                                            SELECT 1 FROM `wishlist` 
                                            WHERE name = '$product_name' AND user_id = '$user_id'
                                        ) LIMIT 1");

        if (!$insert_wishlist){
            $message[]='Failed to Add product to wishlist';
        } else{
            $message[]='product successfuly added in your wishlist';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap icon link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- bootstrap css link-->
    <!---slick slider link--->
    <link rel="stylesheet" type="text/css" href="slick.css" />
    <!--default css link-->
    <link rel="stylesheet" href="main.css">
    <title>Shop</title>
</head>
<body>
    <div class="line"></div>
    <section class="popular-brands">
        <h2>POPULAR BRANDS</h2>
        <div class="controls">
            <i class="bi bi-chevron-left left"></i>
            <i class="bi bi-chevron-right right"></i>
        </div>
        <div class="popular-brands-content">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                <div class="card">
                    <form method="post">
                        <div class="card-image">
                            <img src="image/<?php echo htmlspecialchars($fetch_products['image']); ?>" alt="<?php echo htmlspecialchars($fetch_products['name']); ?>">
                        </div>
                        <div class="card-content">
                            <div class="price">$<?php echo htmlspecialchars($fetch_products['price']); ?>/-</div>
                            <div class="name"><?php echo htmlspecialchars($fetch_products['name']); ?></div>
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($fetch_products['id']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['price']); ?>">
                            <input type="hidden" name="product_quantity" value="1" min="1">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['image']); ?>">
                            <div class="icon">
                                <a href="view_page.php?pid=<?php echo htmlspecialchars($fetch_products['id']); ?>" class="bi bi-eye-fill"></a>
                                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
                }
            } else {
                echo '<p class="empty">No Products Added Yet!</p>';
            }
            ?>
        </div>
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo '
                <div class="message">
                    <span>' . $message . '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>
                ';
            }
        }
        ?>
    </section>
</body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="slick.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.popular-brands-content').slick({
                    lazyLoad: 'ondemand',
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    nextArrow: $('.left'),
                    prevArrow: $('.right'),
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });     
        </script>
</body>

</html>