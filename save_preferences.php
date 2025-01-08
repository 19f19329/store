<?php
session_start();
$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');

if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $scent_type = $_POST['scent_type'];
    $occasion = $_POST['occasion'];

    $query = "INSERT INTO customer_preferences (email, scent_type, occasion) VALUES ('$email', '$scent_type', '$occasion')";
    if (mysqli_query($sto, $query)) {
        echo "تم حفظ التفضيلات بنجاح!";
        echo '<meta http-equiv="refresh" content="3;url=store.php">'; 
    } else {
        echo "خطأ: " . mysqli_error($sto);
    }
} else {
    
    header("Location: preferences.php");
    exit();
   
}
?>