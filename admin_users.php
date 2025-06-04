<?php
include ('./inc/conn.php');

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE user_id = '$delete_id'");
    $message[] = "user removed from website";
    header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total User Account</title>
</head>

<body>
    <?php
    include ('admin_header.php');
    ?>
    <div class="line4"></div>
    <section class="message-container">
        <h1 class="title">Users Accessing This Website</h1>
        <div class="box-container">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'");
            if (mysqli_num_rows($select_users) > 0) {
                while ($fetch_users = mysqli_fetch_assoc($select_users)) {
                    ?>
                    <div class="box">
                        <p>user id: <span><?php echo $fetch_users['user_id']; ?></span></p>
                        <p>name: <span><?php echo $fetch_users['name']; ?></span></p>
                        <p>email: <span><?php echo $fetch_users['email']; ?></span></p>
                        <p>user type:<span style="color: <?php if ($fetch_users['user_type'] == 'admin') {
                            echo 'orange';    
                        }
                        ; ?>">
                                <?php echo $fetch_users['user_type']; ?></span></p>
                        <a href="admin_users.php?delete=<?php echo $fetch_users['user_id']; ?>"
                            onclick="return confirm('Delete this User');" class="delete">Delete</a>
                    </div>
                    <?php
                }
            } else {
                echo '
                <div class="empty">
                <p>no users added yet!</p>
                </div>';
            }
            ?>

        </div>
    </section>

    <div class="line"></div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>