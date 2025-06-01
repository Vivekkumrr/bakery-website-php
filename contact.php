<?php
include('./inc/conn.php');
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id=$_SESSION['user_id'];
        $user_name=$_SESSION['user_name'];
    }else{
        header('location:index.php');
        exit();
    }


if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}
// to wishlist
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

if (isset($_POST['submit-btn'])) {
    $name =mysqli_real_escape_string($conn, $_POST['name']);
    $email =mysqli_real_escape_string($conn, $_POST['email']); 
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $message =mysqli_real_escape_string($conn, $_POST['message']);
    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name='$name' AND email='$email' AND number='$number' AND message ='$message'");

    if (mysqli_num_rows($select_message)>0) {
    }else{
        $insert_message=mysqli_query($conn, "INSERT INTO `message`(`user_id`, `name`, `email`, `number`,`message`) 
                                        SELECT '$user_id', '$name', '$email', '$number', '$message'
                                        FROM DUAL 
                                        WHERE NOT EXISTS ( 
                                            SELECT 1 FROM `message` 
                                            WHERE name='$name' AND email='$email' AND number='$number' AND message ='$message'
                                        ) LIMIT 1");
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
    <link rel="stylesheet" type="text/css" href="slick.css" />
    <!---default css link......-->
    <link rel="stylesheet" href="main.css" />
    <title>Contact Page</title>
</head>

<body>
    <?php include ('header.php'); ?>
    <div class="banner">
        <div class="detail">
            <h1>contact us</h1>
        </div>
    </div>
    
    <div class="line"></div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="img/0.png">
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/1.png">
                <div>
                    <h1>Money Back & Guarantee</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/2.png">
                <div>
                    <h1>Online Support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line4"></div>
    <div class="form-container">
        <h1 class="title">leave a message</h1>
        <form method="post">

            <div class="input-field">
                <label>your name</label><br>
                <input type="text" name="name">
            </div>
            <div class="input-field">
                <label>your emailo</label><br>
                <input type="text" name="email">
            </div>
            <div class="input-field">
                <label>your number</label><br>
                <input type="number" name="number">
            </div>
            <div class="input-field">
                <label>your message</label><br>
                <textarea name="message"></textarea>
            </div>
            <button type="submit" name="submit-btn">Send Message</button>
        </form>
</div>
            <?php include ('footer.php'); ?>
            <script type="text/javascript" src="script2.js"></script>
</body>

</html>