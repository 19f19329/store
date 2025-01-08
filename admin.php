<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Alyousfi Store</title>
    <style>
.top-bar {
    background-color: #fff5e1;
    padding: 15px 0;
    box-shadow: 0 2px 5px #000000;
}

.navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.1em;
    padding: 0.5px 150px 0px 200px;
}

.logo{
    text-decoration: none;
    color: #23a39f;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 1.8em;
}

.navigation a{
    color: #23a39f;
    text-decoration: none;
    font-size: 1.2em;
    font-weight: 540;
    padding-left: 30px;
}

.navigation a:hover{
    color: blueviolet;
}

.main{
    width: 40%;
    background-color: #23a39f;
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
    background-color: goldenrod;
    font-family: 'Courier New', Courier, monospace;
    color: black;
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
<div class="top-bar">
<div class="container">
        <a href="Home.html" class="logo">Alyousfi store</a>
        <nav class="navigation">
            <a href="perfumes.php">Manage Products</a>
            <a href="admin_orders.php">View Orders</a>
            <a href="admin_preferences.php">Customer preferences</a>
            <a href="https://app.powerbi.com/groups/me/reports/697d7aa6-55e3-4168-a5e1-bb5a7e99298b/2202038c2a711c90c053?ctid=77c75b48-9083-448a-812a-f4ab81b7861d&experience=power-bi">Dashboard</a>
            <a href="login.php">Log out</a>
        </nav>
        </div>
        </div>
    <center>
        <div class="main">
        <form action="add.php" method="post" enctype="multipart/form-data">
    <h2>Alyousfi Perfumes Store</h2>
    <img src="logoAPS.jpeg" alt="logo" width="300px">
    <input type="text" name="name" placeholder="product name">
    <br>
    <input type="text" name="information" placeholder="product information">
    <br>
    <input type="text" name="price" placeholder="price">
    <br>
    <input type="text" name="status" placeholder="status">
    <br>
    <input type="number" name="stock" placeholder="Stock Quantity" min="1">
    <br>
    <input type="file" id="file" name="image" style="display:none;">
    <label for="file">upload image</label>
    <button name="upload">upload the product</button>
    <br><br>
    <a href="perfumes.php">VIEW ALL PRODUCTS</a>
</form>

        </div>
    </center>
</body>
</html>