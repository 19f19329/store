<?php

$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');

if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}
$ID = $_GET['id'];
mysqli_query($sto, "DELETE FROM perfumes WHERE id=$ID");
header('location: perfumes.php')
?>