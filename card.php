<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];


$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');

if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM `order` WHERE user_email='$email'";
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
    <title>My Cart</title>
    <style>
        h3 {
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-weight: bold;
            margin-top: 20px;
        }
        main {
            width: 40%;
            margin-top: 30px;
            margin-left: 25em;
        }
        table {
            box-shadow: 1px 1px 10px silver;
        }
        thead {
            background-color: darkslateblue;
            color: white;
            text-align: center;
        }
        tbody {
            text-align: center;
        }
        .btn-secondary{
            margin-top: 20px;
            margin-right: 10px;
        }
        .btn-primary{
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <center>
        <h3>Reserved Products</h3>
    </center>
    <main>
        <form action="update_quantity.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalAmount = 0; while ($item = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['price']; ?> OMR</td>
                            <td>
                                <input type="number" name="quantity[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" />
                            </td>
                            <td>
                                <?php 
                                
                                $totalPrice = $item['price'] * $item['quantity'];
                                echo $totalPrice . " OMR"; 
                                $totalAmount += $totalPrice;
                                ?>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Update Quantities</button>
                            </td>
                            <td>
                                <a href="rem_card.php?id=<?php echo $item['id']; ?>" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tr>
                    <td><strong>Total</strong></td>
                    <td colspan="3"><strong><?php echo number_format($totalAmount, 2); ?> OMR</strong></td>
                </tr>
            </table>
        </form>
    </main>
    <center>
        <a href="store.php" class="btn btn-secondary">Back to Product Page</a>
        <a href="booking_payment.php" class="btn btn-primary">Proceed to Payment</a>
    </center>
</body>
</html>
