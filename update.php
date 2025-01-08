<?php

$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');
if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $information = $_POST['information'];
    $status = $_POST['status'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    
    if (!empty($_FILES['image']['name'])) {
        $image = 'image/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        
        $image = $_POST['current_image'];
    }

    $query = "UPDATE perfumes SET name='$name', information='$information', status='$status', stock='$stock', price='$price', image='$image' WHERE id='$id'";
    if (mysqli_query($sto, $query)) {
        echo "Product updated successfully!";
        header("Location: perfumes.php");
    } else {
        echo "Error updating product: " . mysqli_error($sto);
    }
}
?>
