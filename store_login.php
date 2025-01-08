<?php

$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');

if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM perfumes";  
$result = mysqli_query($sto, $query);
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
    <title>Products</title>
    <style>
        h3{
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            margin-top: 20px;
        }
        .card{
            float: inline-end;
            margin-top: 20px;
            margin-left: 10px;
            margin-right: 10px;
        }
        .card img{
            width: 100%;
            height: 230px;
        }
        main{
            width: 95%;
        }
        #crt{
            margin-left: 50px;
            color: #d39205;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;

        }

        .top-bar {
    background-color: #fff5e1;
    padding: 15px 0;
    box-shadow: 0 2px 5px #000000;
}

.navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.4em;
    padding: 10px 100px;
}

.top-bar a:hover {
                background-color: #23a39f;
                text-transform: uppercase;
                border-radius: 7px;
                transition: background-color 0.4s ease;
            }

            .card-text-status{
            position: absolute;
            top:18px; 
            right:-15px;
            opacity: 0.8;
            transform: rotateZ(25deg);
            padding:1px 12px;
            border-radius: 7px;
            background-color: #23a39f;
            color:#fff;
            font-size: 19px;
            box-shadow: #000 1px 1px 10px;
        }
        
    </style>
</head>
<body>
<div class="top-bar">
<div class="container">
    <nav class="navigation">
        <a id="crt" class="navbar-brand" href="login.php">My cart</a>
        <a id="crt" class="navbar-brand" href="Home.html">Home</a>
        <a id="crt" class="navbar-brand" href="login.php">login</a>

    </nav>
</div>
</div>
   <center>
    <h3>Avilable Perfumes</h3>
   </center>
   <main>
        <?php while ($product = mysqli_fetch_assoc($result)) : ?>
            <div class="card" style="width: 13rem;">
                <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text"><?php echo $product['information']; ?></p>
                    <p class="card-text-status"><?php echo $product['status']; ?></p>
                    <p class="card-text">Price: <?php echo $product['price']; ?> OMR</p>
                    <a href="login.php" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        <?php endwhile; ?>
    </main>

</body>
</html>