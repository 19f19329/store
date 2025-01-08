<?php

$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');

if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_GET['id'];
$query = "SELECT * FROM perfumes WHERE id = $id";
$result = mysqli_query($sto, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirm</title>
    <style>
        input{
            display: none;
        }
        .main{
            width: 30%;
            padding: 20px;
            box-shadow: 1px 1px 10px silver;
            margin-top: 50px;
        }
        a{
    text-decoration: none;
    font-size: 25px;
    color: black;
    font-family: 'Courier New', Courier, monospace;
    background-color: red;
    border-radius: 8px;
    padding: 2px;
}
    </style>
</head>
<body>
<center>
        <div class="main">
            <form action="add_card.php" method="post">
                <h2>Do you want to buy the product?</h2>
                <input type="hidden" name="id" value='<?php echo $data['id']; ?>'>
                <input type="hidden" name="name" value='<?php echo $data['name']; ?>'>
                <input type="hidden" name="price" value='<?php echo $data['price']; ?>'>
                <input type="number" name="stock" value="1" min="1" max="<?php echo $data['stock']; ?>"> <!-- اختيار الكمية -->
                <button name="add" type="submit" class="btn btn-warning">Confirm adding the product to the cart</button>
                <br>
                <a href="store.php">Cancel</a>
            </form>
        </div>
    </center>
</body>
</html>