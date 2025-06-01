
<?php
// Start the session (if not already started)
session_start();

// Check if the admin's name and email are set in the session, if not, fetch from the database
if (!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_email'])) {
    // Assuming $row is fetched from the database and contains the admin's details
    // Replace this with your actual database fetching code
    $row = array(
        'name' => 'ram', // Replace with actual admin name from the database
        'email' => 'ram@gmail.com' // Replace with actual admin email from the database
    );

    // Assign admin's name and email to session variables
    $_SESSION['admin_name'] = $row['name'];
    $_SESSION['admin_email'] = $row['email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href='https://unpkg.com/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --box-shadow: 0px 0px 0px 6px rgb(255 255 255/40%);
            --orange: #fcc927;
        }

        a {
            text-decoration: none;
        }

        ul {
            list-style: none;
        }

        .btn {
            padding: .8rem 2.5em;
            text-transform: uppercase;
            background: #fff;
            color: var(--orange);
            border-radius: 10px;
            cursor: pointer;
        }

        .btn:hover {
            background: black;
        }

        title {
            text-align: center;
            margin-bottom: 1rem;
        }

        .title h1 {
            font-size: 3rem;
            text-transform: uppercase;
        }

        .title span {
            font-size: 1.2rem;
            text-transform: uppercase;
            Line-height: 2;
            color: var(--orange);
        }

        .line,
        .line4 {
            background-image: url('img/5.png');
            width: 100%;
            height: 100px;
            margin-top: -3.6rem;
        }

        .line {
            margin-bottom: 10rem;
        }

        .line2,
        .line3 {
            background-image: url('img/14.png');
            width: 100%;
            height: 100px;
            margin-top: -3.5rem;
        }

        .line3 {
            margin-top: -3.5rem;
            margin-bottom: 7rem;
        }

        .message,
        .empty {
            text-align: center;
            text-transform: capitalize;
            margin: 0 auto;
            margin-bottom: 2rem;
            width: 59%;
            padding: .5rem 1.5rem;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            background: #000;
            color: #fff;
        }

        .message i {
            cursor: pointer;
        }

        .empty {
            text-align: center;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        img {
            width: 25%;
            height: 15%;
        }

        input,
        button,
        textarea,
        select {
            outline: none;
            border: 1px solid #55555544;
            background: transparent;
            width: 100%;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin: 1rem 0;
        }

        button {
            cursor: pointer;
        }

        input[type=submit] {
            cursor: pointer;
        }

        /*torm containr-.......-*/
        .form-container {
            background-color: #fcc927;
            width: 100%;
            padding: 4rem 0;
            position: relative;
            min-height: 100vh;
        }

        .form-container::before,
        .show-products::before,
        .message-container::before,
        .order-container::before {
            content: '';
            background: url('img/6.png');
            position: absolute;
            top: -5%;
            Left: -15px;
            width: 225px;
            height: 650px;
            background-size: 225px;
            background-repeat: no-repeat;
            z-index: 100;
        }

        .banner {
            background: var(--orange);
            width: 100%;
            height: 50vh;
            position: relative;
            z-index: 1;
        }

        .banner::before {
            position: absolute;
            content: '';
            bottom: -18%;
            right: 0;
            background-image: url('img/14.png');
            width: 316px;
            height: 245px;
            background-size: 316px;
        }

        .banner .detail {
            position: absolute;
            padding: 7rem 0;
            left: 35%;
            text-align: center;
            z-index: 200;
        }

        .banner .detail h1 {
            font-size: 4rem;
            color: #fff;
            text-transform: capitalize;
        }

        .banner .detail p {
            font-size: 18px;
            line-height: 2;
        }

        .banner .detail a {
            text-transform: uppercase;
            color: #000;
        }

        .banner .detail span {
            color: #fff;
        }


        /*header*/
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 101;
            transition: .3s;
        }

        header .scrolled {
            background: #fff;
            box-shadow: 0 5px 20px 0.1px rgba(0, 5, 0, 0.1);
            backdrop-filter: blur(20px);
            position: fixed;
        }

        header .scrolled a {
            color: var(--orange);
        }

        .flex {
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin: 0 auto;
        }

        .navbar a {
            margin: 0 1rem;
            font-size: 1rem;
            color: #000;
            text-transform: uppercase;
        }

        .navbar a:hover,
        header .icons i:hover {
            color: #000;
            text-decoration: none;
        }

        .header .icons {
            display: flex;
        }

        .header .icons i {
            margin-left: 1.2rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: #000;
            position: fixed;
        }

        #menu-btn {
            display: none;
        }

        #search-icon {
            display: inline-block;
            /* Change from "none" to "inline-block" */
            margin-left: 1.2rem;
            /* Add margin */
            font-size: 1.5rem;
            cursor: pointer;
            color: #000;
        }

        .header .user-box {
            position: absolute;
            top: 120%;
            right: 0rem;
            background: rgb(255 255 255/ 30%);
            box-shadow: var(--box-shadow);
            border-radius: .5rem;
            padding: 1rem;
            text-align: center;
            width: 20rem;
            transform: scale(1.0);
            transform-origin: top right;
            line-height: 2;
            z-index: 1000;
            /* Ensure it's above other content */
            display: none;
            /* Initially hide the user box */
        }

        #cart-icon {
            display: inline-block;
            /* Change from "none" to "inline-block" */
            font-size: 1.5rem;
            cursor: pointer;
            color: #000;
        }

        .logout-btn {
            background: #000;
            color: #fff;
            text-transform: uppercase;
            width: 10rem;
            border-radius: 4px;
        }

        .header .user-box.active {
            display: inline-block;
            transform: scale(1.0);
            transform-origin: top right;
            transition: .2s linear;
        }


        .dashboard {
            background: var(--orange);
            padding: 3rem;
            margin-top: -3.5rem;
            position: relative;
        }

        .dashboard::before {
            position: absolute;
            content: '';
            top: -25%;
            Left: -10px;
            background-image: url('img/10.png');
            width: 225px;
            height: 220px;
            background-size: 225px;
            background-repeat: no-repeat;
            z-index: 100;
        }

        .box-container {
            padding: 2% 8%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
            column-gap: 1rem;
        }

        .box {
            background: #fff;
            box-shadow: var(--box-shadow);
            border-radius: 5px;
        }

        .dashboard h3 {
            text-align: center;
            font-size: 2rem;
        }

        .dashboard p {
            font-size: 20px;
            text-transform: capitalize;
            margin: .5rem;
        }

        .add-products {
            margin-top: -3.5rem;
            height: auto;
            background: #f5f5f5;
            position: relative;
        }

        .show-products,
        .message-container,
        .order-container {
            position: relative;
            background: var(--orange);
            margin-top: -3.5rem;
        }

        .show-products::before,
        .order-container::before {
            background-image: url('img/14.png');
            top: 100px;
        }

        .show-products {
            position: relative;
            background: var(--orange);
            margin-top: -3.5rem;
        }

        .show-products.box-container {
            grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
        }

        .box-container.box {
            line-height: 2;
        }

        .box-container .box h4 {
            text-transform: capitalize;
        }

        .box-container.box img {
            width: 100%;
            margin-bottom: 1rem;
        }

        .edit,
        .delete {
            color: black;
            background: var(--orange);
            padding: .5rem 1.5rem;
            text-transform: capitalize;
            Line-height: 2;
        }

        .update-container {
            position: fixed;
            top: 0;
            Left: 0;
            right: 0;
            width: 100%;
            overflow-y: auto;
            background: var(--orange);
            z-index: 1100;
            padding: 2rem;
            align-items: center;
            justify-content: center;
            display: block;
            flex-direction: column;
        }

        .update-container form {
            box-shadow: var(--box-shadow);
            width: 50%;
            background: #fff;
            padding: 1rem;
            margin: 2rem auto;
            text-align: center;
        }

        .update-container.edit,
        .update-container .btn {
            width: 40%;
            cursor: pointer;
        }

        .update-container form img {
            width: 60%;
        }

        .message-container.title,
        .order-container .title {
            text-transform: uppercase;
            padding-top: 3rem;
        }

        .order-container {
            padding: 3% 7%;
        }

        .order-container .box-container {
            grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
            justify-content: center;
            align-items: flex-start;
        }

        .message-container .title {
            text-transform: uppercase;
            padding-top: 3rem;
        }

        .box-container .box {
            text-align: left;
            padding: 1rem 2rem;
        }

        .order-container .box p {
            margin-bottom: .5rem;
            text-transform: capitalize;
            color: hotpink;
        }

        .order-container .box span {
            color: #555;
        }

        .order-container form {
            text-align: center;
        }

        .order-container form select {
            width: 100%;
            margin: trem auto;
            padding: 5rem 0;
            cursor: pointer;
        }

        .order-container form input{
            width: 40%;
            border-radius: unset;
            border: none;
            background: var(--orange);
            color: #000;
            text-transform: capitalize;
        }

        .order-container form input:hover{
            color:#fff;
        }

        .order-container .delete{
          width: 100%;

        }

        /*media*/
        @media (max-width: 991px) {
            #menu-btn {
                display: block;
            }

            .header .flex .navbar {
                position: absolute;
                top: 149%;
                left: 0;
                display: block;
                right: 0;
                border-top: 1px solid #000;
                background: #fff;
                transition: .3s ease;
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 0);
            }

            .header .flex .navbar.active {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }

            .header .flex .navbar a {
                display: block;
                margin: 2rem;
            }
            .header .flex .navbar a:hover{
                color: var(--orange);
            }

            .banner .detail {
                left: 10%;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="adminpanel.php" class="logo"><img src="img/logo.png" alt=""></a>
            <nav class="navbar">
                <a href="adminpanel.php">Home</a>
                <a href="admin_product.php">Products</a>
                <a href="admin_message.php">Messages</a>
                <a href="admin_orders.php">Orders</a>
                <a href="admin_users.php">Users</a>
            </nav>
            <br>
                <form action="login.php" method="post">
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
        </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>Admin Page</h1>
        </div>
    </div>
    <script type="text/javascript" src="script1.js"></script>
</body>

</html>