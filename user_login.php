<?php
include('./inc/conn.php');
if(isset($_POST['loginsubmit'])){
    $email = $_POST['email'];
	$password = $_POST['password'];

	
	$sql = "SELECT * FROM customer WHERE email= '$email' AND password = '$password' ";
	$result = mysqli_query($conn,$sql); // connecting to DB
	$final = mysqli_num_rows($result);  // returning number of rows

	if($final > 0){
		 while ($row=mysqli_fetch_array($result)) {
		 $_SESSION['loggedin'] = TRUE;
     	 $_SESSION['email'] = $row['email'];
     	 $_SESSION['password'] = $row['password'];
         echo "<script> alert('Login Successful')</script>";
		  // redirecting or linking to a new page called doctorpanel.php
         echo "<script>window.open('login.php')</script>";
		 echo"runninngg";
        }
 }else{
        echo "error";
		echo "<script>alert('Enter Your Details')</script>";
		echo "<script>window.open('login.php')</script>";
		
	}
}