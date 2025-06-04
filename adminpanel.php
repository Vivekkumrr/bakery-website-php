<?php
include('./inc/conn.php');
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
    <title>Admin DashBoard</title>
</head>

<body>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div class="admin-logo">
                <h2><i class='bx bxs-dashboard'></i> Admin Panel</h2>
            </div>
            <nav class="admin-nav">
                <ul>
                    <li><a href="adminpanel.php" class="active"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
                    <li><a href="admin_orders.php"><i class='bx bxs-shopping-bag'></i>Orders</a></li>
                    <li><a href="admin_product.php"><i class='bx bxs-package'></i>Products</a></li>
                    <li><a href="admin_users.php"><i class='bx bxs-user'></i>Users</a></li>
                    <li><a href="admin_message.php"><i class='bx bxs-message'></i>Message</a></li>
                    <li><a href="reports.php"><i class='bx bxs-report'></i>Reports</a></li>
                    <li><a href="settings.php"><i class='bx bxs-cog'></i>Setting</a></li>
                </ul>
            </nav>
        </div>
        <div class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <h1>Dashboard</h1>
                    <p>Welcome back, <?php echo $_SESSION['admin_name']; ?>!</p>
                </div>
                <div class="header-right">
                    <div class="admin-profile">
                        <span><?php echo $_SESSION['admin_name']; ?></span>
                        <form method="post" style="display: inline;">
                            <button type="submit" name="logout" class="logout-btn">
                                <i class='bx bx-log-out'></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            <!-- Dashboard Content-->
            <!-- Dashboard Content -->
            <main class="dashboard-content">
                <div class="stats-grid">
                    <!-- Total Orders -->
                    <div class="stat-card">
                        <div class="stat-icon orders">
                            <i class='bx bxs-shopping-bag'></i>
                        </div>
                        <div class="stat-info">
                            <?php
                            $select_orders = mysqli_query($conn, "SELECT * FROM orders") or die('query failed');
                            $num_of_orders = mysqli_num_rows($select_orders);
                            ?>
                            <h3><?php echo $num_of_orders; ?></h3>
                            <p>Total Orders</p>
                        </div>
                    </div>
                    <!--Pending Orders -->
                    <div class="stat-card">
                        <div class="stat-icon pending">
                            <i class="bx bxs-time"></i>
                        </div>
                        <div class="stat-info">
                            <?php
                            $select_pending = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status='pending'");
                            $num_pending = mysqli_num_rows($select_pending);
                            ?>
                            <h3><?php echo $num_pending; ?></h3>
                            <p>Pending Orders</p>
                        </div>
                    </div>
                    <!-- Completed Orders-->
                    <div class="stat-card">
                        <div class="stat-icon completed">
                            <i class="bx bxs-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <?php
                            $select_completed = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'complete'");
                            $num_completed = mysqli_num_rows($select_completed);
                            ?>
                            <h3><?php echo $num_completed; ?></h3>
                            <p>Completed Orders</p>
                        </div>
                    </div>
                    <!--Total Users-->
                    <div class="stat-card">
                        <div class="stat-icon users">
                            <i class="bx bxs-user"></i>
                        </div>
                        <div class="stat-info">
                            <?php
                            $select_users = mysqli_query($conn, "SELECT * FROM users WHERE user_type='user'");
                            $num_of_users = mysqli_num_rows($select_users);
                            ?>
                            <h3><?php echo $num_of_users; ?></h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                    <!--Total Admins-->
                    <div class="stat-card">
                        <div class="stat-icon admins"></div>
                        <i class="bx bxs-crown"></i>
                    </div>
                    <div class="stat-info">
                        <?php
                        $select_admin = mysqli_query($conn, "SELECT * FROM users WHERE user_type='admin'");
                        $num_of_admin = mysqli_num_rows($select_admin);
                        ?>
                        <h3><?php echo $num_of_admin; ?></h3>
                        <p>Total Admins</p>
                    </div>
                </div>
                <!--Revenue-->
                <div class="stat-card">
                    <div class="stat-icon revenue"></div>
                    <i class="bx bxs-dollar-circle"></i>
                </div>
                <div class="stat-info">
                    <?php
                    $select_revenue = mysqli_query($conn, "SELECT SUM(total_price) as total FROM orders WHERE payment_status='complete'");
                    $revenue_data = mysqli_fetch_assoc($select_revenue);
                    $total_revenue = $revenue_data['total'] ?? 0;
                    ?>
                    <h3><?php echo number_format($total_revenue, 2); ?></h3>
                    <p>Total Revenue</p>
                </div>
        </div>
    </div>
    <!--Recent Orders-->
    <div class="recent-section">
        <div class="section-header">
            <h2>Recent Orders</h2>
            <a href="admin_orders.php" class="view-all-btn">View All</a>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $recent_orders = mysqli_query($conn, "SELECT o.*, u.name FROM orders o LEFT JOIN users u ON o.user_id = u.id ORDER BY o.id DESC LIMIT 5");
                    while ($order = mysqli_fetch_assoc($recent_orders)) {
                        echo "<tr>";
                        echo "<td>#" . $order['id'] . "</td>";
                        echo "<td>" . ($order['name'] ?? 'Guest') . "</td>";
                        echo "<td>$" . number_format($order['total_price'], 2) . "</td>";
                        echo "<td><span class='status " . $order['payment_status'] . "'>" . ucfirst($order['payment_status']) . "</span></td>";
                        echo "<td>" . date('M d, Y', strtotime($order['placed_on'])) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>