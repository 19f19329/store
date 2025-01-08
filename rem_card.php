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
$ID = $_GET['id'];
mysqli_query($sto, "DELETE FROM `order` WHERE id = $ID AND user_email = '$email'");
header('location: card.php');
?>
