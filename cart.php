<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}
// to wishlist
include ('./inc/conn.php');
$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_wishlist'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'");
    $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");
    if (mysqli_num_rows($wishlist_number) > 0) {
        $message[] = 'product already exist in wishlist';
    } else if (mysqli_num_rows($cart_num) > 0) {
        $message[] = 'product already exist in cart';
    } else {
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
//Addto cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");
    if (mysqli_num_rows($cart_num) > 0) {
        $message[] = 'product already exist in cart';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(`user_id`,`pid`,`name',`price`,`quantity`,,`image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
        $message[] = 'product successfuly added in your cart';
    }
}
//update qty
if (isset($_POST['update_qty_btn'])) { 
    $update_qty_id = $_POST['update_qty_id'];
    $update_value = $_POST['update_qty'];
    $update_query= mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id='$update_qty_id'");
    if($update_query){
        header('location:cart.php');
    }
}
//delete product from cart
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE pid = $delete_id");
    header('location:cart.php');
    }

//delete all products
if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = $user_id");
    header('location:cart.php');
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap icon link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="slick.css" />
    <!---default css link......-->
    <link rel="stylesheet" href="main.css" />
    <title>Cart Page</title>
</head>

<body>
    <?php include ('header.php'); ?>
    <div class="banner">
        <div class="detail">
            <h1>Cart</h1>
        </div>
    </div>
    <div class="line"></div>
    <section class="view_page">
        <h1 class="title">Products added in Cart</h1>

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

        <div class="box-container">
            <?php
            $grand_total=0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {


                    ?>
                    <div class="box">
                        <div class="icon">
                                <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>" class="bi bi-eye-fill"></a>
                                <a href="cart.php?delete=<?php echo $fetch_cart['pid']; ?>" class="bi bi-x" onclick="
                                return confirm('do you want to delete all items from your cart')"></a>
                                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                            </div>
                        <img src="image/<?php echo $fetch_cart['image']; ?>">
                            <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
                            <div class="name"><?php echo $fetch_cart['name']; ?></div>
                            <form method="post">
                                <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id'];?>">
                                <div class="qty">
                                <input type="number" min="1" name="update_qty" value="<?php echo $fetch_cart['quantity'];?>">
                                <input type="submit" name="update_qty_btn" value="Update">
                                </div>
                            </form>
                            <div class="total-amt">
                                Total Amount: <span><?php echo $total_amt = ($fetch_cart['price']*$fetch_cart['quantity']) ?></span>
                            </div>
                </div>
                    <?php
                    $grand_total+=$total_amt;
                }
            }else{
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
            </div>
            <div class="wishlist_total">
                <p>total amount payable: <span><?php echo $grand_total; ?>/-</span></p>
                <a href="homeshop.php" class="btn">Continue Shopping</a>
                <a href="cart.php?delete_all" class="btn"  onclick="return confirm('Do you want to delete all items in your Cart')">delete all</a>
                <a href="checkout.php" class="btn" <?php echo ($grand_total>1)?'':'disabled'?>"  onclick="return confirm('Do you want to Proceed to Checkout')">proceed to checkout</a>    
            </div>
    </section>

    <?php include ('footer.php'); ?>
    <script type="text/javascript" src="script2.js"></script>
</body>

</html>