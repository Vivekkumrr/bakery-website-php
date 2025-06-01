<?php
include('./inc/conn.php');
session_start();

$message = [];

if (isset($_POST['submit'])) {
    // Sanitize inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Don't escape passwords
    
    // Direct query (with proper escaping)
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Temporary bypass for testing (remove in production)
        $bypass_verification = false; // SET TO FALSE FOR PRODUCTION
        
        if ($bypass_verification || password_verify($password, $row['password'])) {
            // Regenerate session ID for security
            session_regenerate_id();
            
            if ($row['user_type'] == 'admin') {
                                error_log("Admin login successful: " . $row['email']); // Add this line
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['user_id'];
                header('location:adminpanel.php');
            } else if ($row['user_type'] == 'user') {
                                error_log("User login successful: " . $row['email']); // Add this line
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['user_id'];
                header('Location:index.php');
                exit();
            }
        } else {
            $message[] = 'Incorrect password';
        }
    } else {
        $message[] = 'Email not found';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title>Log In to Your Account</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --primary-color: #ffe6cc;
            --secondary-color: #ff9933;
            --text-color: #333;
            --box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f9f9f9;
        }

        a {
            text-decoration: none;
            color: var(--secondary-color);
            transition: var(--transition);
        }

        a:hover {
            color: #e67300;
        }

        .btn {
            padding: 12px 25px;
            text-transform: uppercase;
            background: var(--secondary-color);
            color: white;
            border-radius: 30px;
            cursor: pointer;
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: var(--transition);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background: #e67300;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .message {
            text-align: center;
            margin: 0 auto 20px auto;
            width: 85%;
            padding: 10px 15px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ff6b6b;
            color: white;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message i {
            cursor: pointer;
        }

        .form-container {
            background: linear-gradient(135deg, var(--primary-color) 0%, #ffcc99 100%);
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            background: url('img/6.png');
            top: -5%;
            left: -10px;
            width: 255px;
            height: 650px;
            background-size: 225px;
            background-repeat: no-repeat;
            opacity: 0.7;
            z-index: 1;
        }

        .form-container::after {
            content: '';
            position: absolute;
            background: url('img/banner.png');
            bottom: 0;
            right: 0;
            width: 255px;
            height: 220px;
            background-size: 225px;
            background-repeat: no-repeat;
            opacity: 0.7;
            z-index: 1;
        }

        .form-container form {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--box-shadow);
            padding: 40px 30px;
            border-radius: 15px;
            position: relative;
            z-index: 2;
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .form-container form:hover {
            transform: translateY(-5px);
        }

        .form-container h1 {
            text-transform: uppercase;
            margin-bottom: 30px;
            font-size: 28px;
            text-align: center;
            color: var(--text-color);
            position: relative;
        }

        .form-container h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-container form input {
            width: 100%;
            padding: 15px 20px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 30px;
            font-size: 16px;
            transition: var(--transition);
        }

        .form-container form input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(255, 153, 51, 0.2);
        }

        .form-container form input[type="submit"] {
            background: var(--secondary-color);
            color: white;
            font-weight: 600;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            transition: var(--transition);
        }

        .form-container form input[type="submit"]:hover {
            background: #e67300;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .form-container form p {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        /* Add loading animation */
        .loading {
            display: none;
            text-align: center;
            margin-top: 15px;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 153, 51, 0.3);
            border-radius: 50%;
            border-top-color: var(--secondary-color);
            animation: spin 7s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-container form {
                padding: 30px 20px;
                width: 90%;
            }
            
            .form-container::before,
            .form-container::after {
                opacity: 0.3;
            }
        }
    </style>
</head>

<body>
    <section class="form-container">
        <form method="post" id="login-form">
            <h1>Welcome Back</h1>
            
            <?php
            if(isset($message)) {
                foreach($message as $msg) {
                    echo '<div class="message">
                            <span>'.$msg.'</span>
                            <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
                          </div>';
                }
            }
            ?>
            
            <div class="input-group">
                <input type="email" name="email" placeholder="Enter Your Email" required>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter Your Password" required>
            </div>
            
            <input type="submit" name="submit" value="Login" class="btn">
            
            <div class="loading">
                <div class="loading-spinner"></div>
                <p>Logging in...</p>
            </div>
            
            <p>Don't Have An Account? <a href="register.php">Register Now</a></p>
        </form>
    </section>

    <script>
        document.getElementById('login-form').addEventListener('submit', ()=> {
            document.querySelector('.loading').style.display = 'block';
            document.querySelector('input[type="submit"]').value = 'Please wait...';
        });
    </script>
</body>

</html>