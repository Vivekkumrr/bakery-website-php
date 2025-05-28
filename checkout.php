<?php
include ('./inc/conn.php');
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
} else {
    header('location:index.php');
    exit();
}


if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}
// to wishlist

if (isset($_POST['order-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $placed_on = date('d-M-Y');
    $cart_total=0;
    $cart_product[]='';
    
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'");

    if (mysqli_num_rows($cart_query) > 0) {
        while($cart_item=mysqli_fetch_assoc($cart_query)){
            $cart_product[]=$cart_item['name'].' ('.$cart_item['quantity'].')';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total+=$sub_total;
        }
        echo 'message already sent';
    } 
    $total_products = implode(', ', $cart_product);
    mysqli_query($conn, "INSERT INTO `orders` (`user_id`, `name`, `number`, `email`, `method`, `address`,
    `total_products`, `total_price`, `placed_on`) VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_product', '$cart_total', '$placed_on')");
    
    mysqli_query($conn,"DELETE FROM `cart` WHERE user_id='$user_id'");
    $message[]='order placed successfully';
    header('location:checkout.php');
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
    <title>checkout Page</title>
</head>

<body>
    <section>
    <?php include ('header.php'); ?>
    <div class="banner">
        <div class="detail">
            <h1>Orders</h1>
        </div>
    </div>
    <div class="line"></div>
    <div class="checkout-form">
        <div class="title">
            <h1 class="title">Payment Process</h1>
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
            <div class="display-order">
                <?php
                $select_cart= mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id'");
                $total = 0;
                $grand_total = 0;
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart=mysqli_fetch_assoc($select_cart)) {
                        $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                        $grand_total = $total += $total_price;
                    ?> <div class="box-container">
                        <div class="box">
                            <img src="image/<?php echo $fetch_cart['image'];?>">
                            <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>
                <span class="grand-total">Total Amount Payable : $<?= $grand_total; ?></span>
            </div>
            <form method="post">
                <div class="input-field">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter Name">
                </div>
                <div class="input-field">
                <label>Number</label>
                    <input type="number" name="number" placeholder="Enter Number">
                </div>
                <div class="input-field">
                <label>Email</label>
                    <input type="text" name="email" placeholder="Enter Email">
                </div>
                <div class="input-field">
                <label>Select Payment Method</label>
                <select name="method">
                    <option selected disabled>Select payment Method</option>
                    <option value="cash on delivery">Cash On Delivery</option>
                    <option value="credit card">Credit Card</option>
                    <option value="debit card">Debit Card</option>
                    </select>
                </div>
                <div class="input-field">
                <label>Address</label>
                    <input type="text" name="address" placeholder="Enter address">
                </div>
                <input type="submit" name="order-btn" class="btn" value="order now">
                </div>
        </form>
    </div>
    

    <div class="line"></div>

    <?php include ('footer.php'); ?>
    <script type="text/javascript" src="script2.js"></script>
    </section>
</body>

</html>