<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" 
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Log In to Your Account</title>
    <style>
header{
    position: fixed;
    width: 100%;
    top: 0;
    right: 0;
    z-index: 99;
    display: flex;
    justify-content:space-between;
    padding: 20px 100px;
    transition: 0.1s linear;
    background: var(--text-color);
}
body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    color: var(--text-color);
    margin:50px;
}
.navbar{
    display: flex;
}
.navbar a{
    padding: 8px 17px;
    color: var(--bg-color);
    font-size: 1rem;
    text-transform: uppercase;
    font-weight: 500;
}
.navbar a:hover{
    background-color: var(--main-color);
    border-radius: 0.2rem;
    transition: 0.2s all linear;
}
.header-icon{
    font-size: 22px;
    cursor: pointer;
    z-index: 10000;
    display: flex;
    column-gap: 0.8rem;
}
.header-icon .bx {
    color: var(--bg-color);
}
.header-icon .bx:hover {
    color: var(--main-color);
}
.navbar .btnLogin-popup{
    width: 130px;
    height: 50px;
    background: transparent;
    border: 2px solid #fff;
    outline: none;
    border-radius: 6px;
}
.wrapper{
    width: 600px;
    height: 540px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .5);
    border-radius: 20px;
    box-shadow: 0 0 30px rgba(0, 0, 0, .5);
    display: flex;
    justify-content: center;
    align-items: center;
}
.wrapper .form-box{
    width: 100%;
    padding: 60px;
}
.wrapper .form-box.register{
    position: absolute;
}
.form-box h2{
    font-size: 2rem;
    color: #162938;
    text-align: center;

}
.input-box{
    position: relative;
    width: 100%;
    height: 70px;
    border-bottom: 2px solid #162938;
    margin-right: 30px;
    margin-bottom: 30px;

}
.input-box input{
    width: 100%;
    height:100%;
    background: transparent;
    border:none;
    outline:none;
    font-size: 1em;
    color: #162938;
    font-size: 600;
    padding: 0 35px 0 5px;
}
.input-box label{
    position: absolute;
    top: 4px;
    left: 1px;
    transform: translateY(-50%);
    font-size: 1em;
    color: #162938;
    font-weight: 500;
    pointer-events: none;
    transition: .5s;
}
.input-box .icon{
    position:absolute;
    right:8px;
    font-size: 1.2em;
    color: #162938;
    line-height: 57px;
}
.input-box input:focus~label,
.input-box input:valid~label{
    top: -5px;
}
.remember-forgot {
    font-size: .9em;
    color: #162938;
    font-weight: 500;
    margin: -15px 0 15px;
    display: flex;
    justify-content: space-between;
}
.remember-forgot label input{
    accent-color: #162938;
}
.remember-forgot a{
    color: #162938;
    text-decoration: none;
}
.remember-forgot a:hover{
    text-decoration: underline;
}
.btn{
    width: 100%;
    height: 45px;
    background: #162938;
    border: none;
    outline: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
    color: #fff;
    font-weight: 500;
}
.login-register{
    font-size: .9em;
    color: #162938;
    text-align: center;
    font-weight: 500;
    margin: 25px 0 10px;
}
.login-register p a{
    color: #162938;
    text-decoration: none;
    font-weight: 600;
}
.login-register p a:hover{
    text-decoration: underline;
}
</style>
<header>
<ul class="navbar">
        <li><a href="homepage.php">Home Page</a></li>
        <li><a href="about us">About Us</a></li>
        <li><a href="products">Products</a></li>
        <li><a href="customers">Customers</a></li>
        <li><a href="login">Login</a></li>
    </ul>
    <div class="header-icon">
        <i class='bx bx-cart-alt' ></i>
        <i class='bx bx-search' id="search-icon"></i>
    </div>
    </header>
    <section>
        <div class="wrapper">
            <div class="form-box login">
                <h2>Login</h2>
                <form action="login.php" method="post">
                    <div class="input-box">
                        <span class="icon">
                        <i class='bx bxs-envelope' ></i>
                        </span>
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                        </span>
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox"> Remember Me</label>
                        <a href="user">Forgot Password?</a>
                    </div>
                    <button type="submit" name="loginsubmit" class="btn" value="login">Login</button>
                    <div class="login-register">
                        <p>Don't Have An Account?<a href="register.php" class="register-link">  Register</a></p>      
                    </div>
                </form>
            </div>
        </div>
    </section>        