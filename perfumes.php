<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin control</title>
    <style>
        h3{
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            margin-top: 20px;
        }
        .card{
            float: left;
            margin-top: 20px;
            margin-left: 10px;
            margin-right: 10px;
        }
        .card img{
            width: 100%;
            height: 230px;
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
        main{
            width: 95%;
        }
    </style>
</head>
<body>
   <center>
    <h3>Admin control page</h3>
   </center>
   <center>
        <main>
            <?php
            
            $sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');
            if (!$sto) {
                die("Connection failed: " . mysqli_connect_error());
            }

            
            $query = "SELECT * FROM perfumes";
            $result = mysqli_query($sto, $query);

            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='card' style='width: 18rem;'>
    <img src='{$row['image']}' class='card-img-top'>
    <div class='card-body'>
        <h5 class='card-title'>{$row['name']}</h5>
        <p class='card-text'>Ingredients: {$row['information']}</p>
        <p class='card-text'>Price: {$row['price']} OMR</p>
        <p class='card-text-status'>{$row['status']}</p>
        <p class='card-text'>Available stock: {$row['stock']}</p>
        <a href='remove.php?id={$row['id']}' class='btn btn-danger'>Delete product</a>
        <a href='edit.php?id={$row['id']}' class='btn btn-primary'>Edit product</a>
    </div>
</div>";
            }
            ?>
        </main>
        <a href="admin.php" class="btn btn-primary" >Back</a>
    </center>

</body>
</html>