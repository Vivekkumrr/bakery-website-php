<?php
include('./inc/conn.php');


// Check actual login state
$logged_in = isset($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main1.css">
    <link href='https://unpkg.com/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="index.php" class="logo">
                <img src="img/37.png" alt=""></a>
            <nav class="navbar">
                <a href="home.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="homeshop.php">Shop</a>
                <a href="order.php">Order</a>
                <a href="contact.php">Contact</a>
            </nav>
            <div class="header-icons">
                
                <i class='bi bi-person' id="user-btn"></i>
                <?php
                $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id='$user_id'");
                $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <a href="wishlist.php"><i class="bi bi-heart"></i><sup><?php echo $wishlist_num_rows; ?></sup></a>
                <?php
                $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id='$user_id'");
                $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'");
                $cart_num_rows = mysqli_num_rows($select_cart);
                ?>
                <a href="cart.php"><i class="bi bi-cart"></i><sup><?php echo $cart_num_rows; ?></sup></a>
                <i class='bx bx-search' id="menu-btn"></i>
            </div>
        <?php if ($logged_in): ?>
            <form method="post" style="display:inline;">
                <button type="submit" name="logout">Logout</button>
            </form>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
            <div class="user-box">
                <p>username:<span>'<?php echo $_SESSION['user_name'];?>'</span></p>
                <p>email:<span>'<?php echo $_SESSION['user_email'];?>'</span></p>
                <form action="login.php" method="post">
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </div>
        </div>
        </div>
    </header>

</body>

</html>