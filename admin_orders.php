<?php
include ('./inc/conn.php');

if (isset($_GET['delete'])) {
    $orders_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$orders_id'");

    header('location:admin_message.php');
}

if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $update_payment=$_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status ='complete' WHERE id='$order_id'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Orders</title>
</head>

<body>
    <?php
    include ('admin_header.php');
    ?>
    <div class="line4"></div>
    <section class="order-container">
        <h1 class="title">Orders</h1>
        <div class="box-container">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`");
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                    ?>
                    <div class="box">
                        <p>user name: <span><?php echo $fetch_orders['name']; ?></span></p>
                        <p>user id: <span><?php echo $fetch_orders['user_id']; ?></span></p>
                        <p>placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                        <p>number: <span><?php echo $fetch_orders['number']; ?></span></p>
                        <p>email: <span><?php echo $fetch_orders['email']; ?></span></p>
                        <p>total price: <span><?php echo $fetch_orders['total_price']; ?></span></p>
                        <p>method: <span><?php echo $fetch_orders['method']; ?></span></p>
                        <p>address: <span><?php echo $fetch_orders['address']; ?></span></p>
                        <p>total product: <span><?php echo $fetch_orders['total_products']; ?></span></p>
                        <form method="post">
                            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                            <select name="update_payment">
                                <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <input type="submit" name="update_order" value="update payment" class="btn">
                        </form>
                        <a href="admin_orders.php?delete <?php echo $fetch_orders['id']; ?>;"
                            onclick="return confirm('delete this message');" class="delete">delete</a>
                    </div>
                    <?php
                }
            } else {
                echo '
                <div class="empty">
                <p>no orders added yet!</p>
                </div>';
            }
            ?>

        </div>
    </section>

    <div class="line"></div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>