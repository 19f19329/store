<?php

$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');

if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['upload'])) {
    $NAME = $_POST['name'];
    $INF = $_POST['information'];
    $PRICE = $_POST['price'];
    $STATUS = $_POST['status'];
    $STOCK = $_POST['stock']; 
    $IMAGE = $_FILES['image'];
    $IMG_LOCATION = $_FILES['image']['tmp_name'];
    $IMG_NAME = $_FILES['image']['name'];
    $IMG_UPLOAD = "image/" . $IMG_NAME;
    $ADD = "INSERT INTO perfumes (name, information, price, status, image, stock) VALUES ('$NAME', '$INF', '$PRICE', '$STATUS', '$IMG_UPLOAD', '$STOCK')";
    
    mysqli_query($sto, $ADD);

    if (move_uploaded_file($IMG_LOCATION, 'image/' . $IMG_NAME)) {
        echo "<script>alert('The perfume has been uploaded');</script>";
    } else {
        echo "<script>alert('There is a problem, the perfume was not uploaded');</script>";
    }
    header('location: admin.php');
}
?>
