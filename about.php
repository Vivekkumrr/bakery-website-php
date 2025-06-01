        <?php
        session_start();

        // Include the connection file
        include ('./inc/conn.php');

$user_id = $_SESSION['user_id'] ?? null;
$message = [];

// Clear all session data on logout
if (isset($_POST['logout']) && $user_id) {
    // Clear session data
    $_SESSION = [];
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    
    // Redirect to login
    header('Location: login.php');
    exit();
}

// Retrieve user ID and name from session
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
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
    <link rel="stylesheet" href="main1.css" />
    <title>About Us</title>
</head>

<body>
    <?php include ('header.php'); ?>
    <div class="banner">
        <div class="detail">
            <h1>About Us</h1>
        </div>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <div class="about-us">
        <div class="row">
            <div class="box">
                <div class="title">
                    <span>ABOUT OUR ONLINE STORE</span>
                    <h1>Hello, With 25 years of experience</h1>
                </div>
                <p>Over 25 years Ecommerce helping companies reach their financial and branding goals.
                    The perfect way to enjoy brewing tea on low hanging fruit to identify. Duis autem vel eum iriure
                    dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                    facilisis. For me,
                    the most important part of improving at photography.</p>
            </div>
            <div class="img-box">
                <img src="img/about3.jpg">
            </div>
        </div>
    </div>
    <div class="line4"></div>
    <---features section--->
        <div class="features">
            <div class="title">
                <h1>Complete Customer Ideas</h1>
                <span>best features</span>
            </div>
            <div class="row">
                <div class="box">
                    <img src="img/icon2.png">
                    <h4>24x7</h4>
                    <p>Online Support 24/7</p>
                </div>
                <div class="box">
                    <img src="img/icon.png">
                    <h4>Money Back Gurantee</h4>
                    <p>100% Secure Payment</p>
                </div>
                <div class="box">
                    <img src="img/icon0.png">
                    <h4>Special Gift Card</h4>
                    <p>Give the Perfect Gift</p>
                </div>
                <div class="box">
                    <img src="img/icon3.png">
                    <h4>Worldwide Shipping</h4>
                    <p>On Order Over $99</p>
                </div>
                <div class="line"></div>

            <div class="line"></div>
            <div class="line2"></div>
            <div class="ideas">
                <div class="title">
                    <h1>We and Our Clients are happy to Cooperate with our company</h1>
                    <span>our features</span>
                </div>
                <div class="row">
                    <div class="box">
                        <i class="bi bi-stack"></i>
                        <div class="detail">
                            <h2>What We Really Do</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis quisquam molestias, odio enim obcaecati perspiciatis quis voluptatem mollitia eos provident! Sequi velit officia hic fugit incidunt sit explicabo excepturi dignissimos.</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <div class="detail">
                            <h2>History of Beginning</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis quisquam molestias, odio enim obcaecati perspiciatis quis voluptatem mollitia eos provident! Sequi velit officia hic fugit incidunt sit explicabo excepturi dignissimos.</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="bi bi-tropical-storm"></i>
                        <div class="detail">
                            <h2>Our Vision</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis quisquam molestias, odio enim obcaecati perspiciatis quis voluptatem mollitia eos provident! Sequi velit officia hic fugit incidunt sit explicabo excepturi dignissimos.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php include ('footer.php'); ?>
            <script type="text/javascript" src="script2.js"></script>
</body>

</html>