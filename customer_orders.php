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


$query = "
    SELECT co.order_id, p.name AS perfume_name, co.quantity, co.total_amount, co.order_date, co.order_status
    FROM customers_orders co
    JOIN perfumes p ON co.perfume_id = p.id
    WHERE co.user_email = '$email'
";
$result = mysqli_query($sto, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        body { 
        font-family: 'Arial', sans-serif;
        margin-top: 20px;
        }
        
        table { 
            width: 80%; 
            margin: auto; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        
        th, td { 
            padding: 10px; 
            border: 1px solid #ccc; 
            text-align: left; 
        }
        
        th { 
            background-color: #f4f4f4; 
        }
        
        .btn-secondary{
            margin-top: 20px;
            float: right;
            margin-right: 50px;
            font-size: 1.2em;
            padding-left: 18px;
            padding-right: 18px;
        }
    </style>
</head>
<body>
    <center>
        <a href="store.php" class="btn btn-secondary">Back</a>
    </center>
    <h2 style="text-align: center;">My Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Perfume Name</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['perfume_name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo number_format($row['total_amount'], 2); ?> OMR</td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['order_status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
