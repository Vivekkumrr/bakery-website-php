<?php
$conn=mysqli_connect("localhost",'root','','shop_db');
if(!$conn){
    die(mysqli_error($conn));
}
?>