<?php
include ('./inc/conn.php');
session_start();

if (!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password'])) {
    $row = array(
        'name' => 'ram', // Replace with actual admin name from the database
        'email' => 'ram@gmail.com', // Replace with actual admin email from the database
        'password' => '1234'
    );
    $_SESSION['admin_name'] = $row['name'];
    $_SESSION['admin_email'] = $row['email'];
    $_SESSION['admin_password'] = $row['password'];
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Page</title>
</head>

<body>
    <?php
    include ('admin_header.php');
    ?>
    <div class="line4"></div>
    <section class="dashboard">
        <div class="box-container">
            <div class="box">
                <?php
                $total_pending = 0;
                $select_pending = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status='pending'");
                while ($fetch_pending = mysqli_fetch_assoc($select_pending)) {
                    $total_pending += $fetch_pending['id'];
                }
                ?>
                <h3> <?php echo $total_pending; ?></h3>
                <p>Total Pending Orders</p>
            </div>
            <div class="box">
                <?php
                $total_completes = 0;
                $select_completes = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status='complete'")
                    or die('query failed');
                while ($fetch_completes = mysqli_fetch_assoc($select_completes)) {
                    $total_completes += $fetch_completes['id'];
                }
                ?>
                <h3> <?php echo $total_completes; ?></h3>
                <p>Total Completed Orders</p>
            </div>
            <div class="box">
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM orders")
                    or die('query failed');
                $num_of_orders = mysqli_num_rows($select_orders);
                ?>
                <h3> <?php echo $num_of_orders; ?></h3>
                <p>Total Orders</p>
            </div>
            <div class="box">
                <?php
                $select_users = mysqli_query($conn, "SELECT * FROM users WHERE user_type='user'")
                    or die('query failed');
                $num_of_users = mysqli_num_rows($select_users);
                ?>
                <h3> <?php echo $num_of_users; ?></h3>
                <p>Total Users</p>
            </div>
            <div class="box">
                <?php
                $select_admin = mysqli_query($conn, "SELECT * FROM users WHERE user_type='admin'")
                    or die('query failed');
                $num_of_admin = mysqli_num_rows($select_admin);
                ?>
                <h3> <?php echo $num_of_admin; ?></h3>
                <p>Total Admin</p>
            </div>
    </section>
</body>

</html>