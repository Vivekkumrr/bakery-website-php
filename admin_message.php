<?php
include ('./inc/conn.php');

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE user_id = '$delete_id'");

    header('location:admin_message.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
</head>

<body>
    <?php
    include ('admin_header.php');
    ?>
    <div class="line4"></div>
    <section class="message-container">
        <h1 class="title">Unread Message</h1>
        <div class="box-container">
            <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message`");
            if (mysqli_num_rows($select_message) > 0) {
                while ($fetch_message = mysqli_fetch_assoc($select_message)) {
                    ?>
                    <div class="box">
                        <p>user id: <span><?php echo $fetch_message['id']; ?></span></p>
                        <p>name: <span><?php echo $fetch_message['name']; ?></span></p>
                        <p>email: <span><?php echo $fetch_message['email']; ?></span></p>
                        <p><?php echo $fetch_message['message']; ?></p>
                        <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>;"
                            onclick="return confirm('Delete this message');" class="delete">Delete</a>
                    </div>
                    <?php
                }
            } else {
                echo '
                <div class="empty">
                <p>no products added yet!</p>
                </div>';
            }
            ?>

        </div>
    </section>

    <div class="line"></div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>