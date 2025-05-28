<?php
include ('admin_header.php');
?>
<?php
include ('./inc/conn.php');
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']["tmp_name"];
    $image_folder = 'image/' . $image;


    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$product_name'");
    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'product name already exist';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `products` (name, price, product_detail, image) VALUES ('$product_name', '$product_price', '$product_detail', '$image')");
        if ($insert_product) {
            if ($image_size > 2000000000) {
                $message[] = 'image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message = 'product added successfully';
            }
        }
    }
}


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $select_delete_image = mysqli_query($conn, "SELECT image FROM products WHERE id='$delete_id'");
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('image/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_id'");
    mysqli_query($conn, "DELETE FROM cart WHERE pid = '$delete_id'");
    mysqli_query($conn, "DELETE FROM wishlist WHERE pid = '$delete_id'");

    header('location:admin_product.php');
}

if (isset($_POST['update_product'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];
    $update_detail = $_POST['update_detail'];
    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'image/' . $update_image;
    
    $update_query = mysqli_query($conn, "UPDATE products SET id='$update_id', name = '$update_name', 'price'='$
    '$update_price', 'product_detail'='$update_detail', 'image' = '$update_image' WHERE id = '$update_id'");
    if ($update_query) {
        move_uploaded_file($update_image_tmp_name, $update_image_folder);
        header('location: admin_product.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Products</title>
</head>

<body>
    
    <div class="line2"></div>
    <section class="add-products form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="input-field">
                <label>product name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-field">
                <label>product price</label>
                <input type="text" name="price" required>
            </div>
            <div class="input-field">
                <label>product detail</label>
                <textarea name="detail" required></textarea>
            </div>
            <div class="input-field">
                <label>product image</label>
                <input type="file" name="image" accept-"image/jpg, image/jpeg, image/png, image/webp" required>
            </div>
            <input type="submit" name="add_product" value="addproduct" class="btn">
        </form>
    </section>
    <script type="text/javascript" src="script.js"></script>
    <?php
    $select_products = mysqli_query($conn, "SELECT * FROM products") or die('query failed');
    if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
            <div class="box">
                <img src="image/<?php echo $fetch_products['image']; ?>">
                <p>price: $<?php echo $fetch_products['price']; ?> </p>
                <h4><?php echo $fetch_products['name']; ?></h4>
                <details> <?php echo $fetch_products['product_detail']; ?></details> <a
                    href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit">Edit</a>
                <a href="admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete" onclick="
return confirm('want to delete this product');">Delete</a>
            </div>
            <?php

        }
    } else {
        echo '
        <div class="empty">
            <p>no products added yet!</p>
        </div>
    ';
    }
    ?>
    <div class="line"></div>
                </section>

</html>