<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
    <style>
        .main{
    width: 40%;
    background-color: azure;
    box-shadow: 1px 1px 10px silver;
    margin-top: 38px;
    padding: 10px;
}

h2{
    font-family: 'Courier New', Courier, monospace;
}

input{
    margin-bottom: 10px;
    width: 60%;
    padding: 5px;
    font-family: 'Courier New', Courier, monospace;
    font-size: 15px;
    font-weight: bold;
}

button{
    border: none;
    padding: 10px;
    width: 40%;
    font-weight: bold;
    font-size: 15px;
    background-color: green;
    cursor: pointer;
    font-family: 'Courier New', Courier, monospace;
    margin-bottom: 15px;
}

label{
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    font-size: 15px;
    background-color: cornflowerblue;
    font-family: 'Courier New', Courier, monospace;
    color: white;
}

a{
    text-decoration: none;
    font-size: 25px;
    color: crimson;
    font-family: 'Courier New', Courier, monospace;
    font-weight: bold;
}
    </style>
</head>
<body>
<?php
    
    $sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');
    if (!$sto) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM perfumes WHERE id = '$id'";
        $result = mysqli_query($sto, $query);
        $data = mysqli_fetch_assoc($result);
    }
    ?>
    <center>
        <div class="main">
            <form action="update.php" method="post" enctype="multipart/form-data">
                <h2>Edit the Products</h2>
                <input type="hidden" name="id" value="<?php echo $data["id"]?>">
                <input type="hidden" name="current_image" value="<?php echo $data['image'] ?>">
                <br>
                <input type="text" name="name" value="<?php echo $data["name"]?>">
                <br>
                <input type="text" name="information" value="<?php echo $data["information"]?>">
                <br>
                <input type="text" name="status" value="<?php echo $data["status"]?>">
                <br>
                <input type="text" name="price" value="<?php echo $data["price"]?>">
                <br>
                <input type="number" name="stock" value="<?php echo $data["stock"]; ?>" min="0"> <!-- الكمية المتاحة -->
                <br>
                <input type="file" id="file" name="image" style="display:none;">
                <label for="file">Update Product Image</label>
                <button name="update" type="submit">Edit the Product</button>
                <br><br>
                <a href="perfumes.php">VIEW ALL PRODUCTS</a>
            </form>
        </div>
    </center>
</body>
</html>
