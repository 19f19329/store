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


if (isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        
        $quantity = intval($quantity);
        if ($quantity > 0) {
            mysqli_query($sto, "UPDATE `order` SET quantity = $quantity WHERE id = $id AND user_email = '$email'");
        }
    }
}


header('location: card.php');
?>
