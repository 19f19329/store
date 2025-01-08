<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];



$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');

if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['add'])) {
    $product_id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity_requested = $_POST['stock'];

    
    $check_quantity_query = "SELECT stock FROM perfumes WHERE id = '$product_id'";
    $result = mysqli_query($sto, $check_quantity_query);
    $available_quantity = mysqli_fetch_assoc($result)['stock'];

    if ($available_quantity >= $quantity_requested) {
        
        $query = "INSERT INTO `order` (id, name, price, quantity, user_email) 
          VALUES ('$product_id', '$name', '$price', '$quantity_requested', '$email') 
          ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";
        if (mysqli_query($sto, $query)) {
            
            
            $update_quantity_query = "UPDATE perfumes SET stock = stock - $quantity_requested WHERE id = '$product_id'";
            mysqli_query($sto, $update_quantity_query);
            echo "<script>alert('Product added to cart!');</script>";
            header("Location: card.php");
            exit();
        } else {
            echo "<script>alert('Error: ');</script>" . mysqli_error($sto);
        }
    } else {
        echo "<script>alert('Not enough stock available!');</script>";
    }
}
?>
