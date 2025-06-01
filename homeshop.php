
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}
// to wishlist
include('./inc/conn.php');
$user_id= $_SESSION['user_id'];

if (isset($_POST['add_to_wishlist'])) {
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
    }else{
        mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`,`pid`,`name`,`price`,`image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
        $message[]='product successfully added in your wishlist';
    }
}
//to cart
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
    else{
        mysqli_query($conn, "INSERT INTO `cart`(`user_id`,`pid`,`name`,`price`,`quantity`,`image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
        $message[]='product successfully added in your cart';
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
    <!---default css link......-->
    <link rel="stylesheet" href="main1.css" />
    <title>Shop</title>
</head>

<body>
    <?php include ('header.php'); ?>
    <div class="banner">
        <div class="detail">
            <h1>Our Shop</h1>
        </div>
    </div>
    <div class="line"></div>
    <section class="shop">
        <h1 class="title">SHOP BEST SELLERS</h1>

        <?php
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '
<div class="message">
<span>' . $msg . '</span>
<i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
</div>
';
            }
        }
        ?>
        <div class="popular-brands-content">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                    <form method="post" class="box">
                        <div class="card">
                            <img src="image/<?php echo $fetch_products['image']; ?>">
                            <div class="price"><?php echo $fetch_products['price']; ?></div>
                            <div class="name"><?php echo $fetch_products['name']; ?></div>
                            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                            <input type="hidden" name="product_quantity" value="1" min="1">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                            <div class="icon">
                                <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bi bi-eye-fill"></a>
                                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                            </div>
                        </div>
                    </form>
                <?php
                }
            } else {
                echo '<p class="empty">No Products Added Yet!</p>';
            }
            ?>
        </div>
    </section>

    <?php include ('footer.php'); ?>
    <script type="text/javascript" src="script2.js"></script>
</body>

</html>
