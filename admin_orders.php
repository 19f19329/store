<?php
$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');
if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = mysqli_real_escape_string($sto, $_POST['order_id']);
    $status = $_POST['action'] === 'accept' ? 'Accepted' : 'Rejected';

    $updateQuery = "UPDATE customers_orders SET order_status = '$status' WHERE order_id = '$order_id'";
    mysqli_query($sto, $updateQuery);
}


$query = "
    SELECT co.order_id, co.user_email, p.name AS perfume_name, co.quantity, co.total_amount, co.order_date, co.order_status
    FROM customers_orders co
    JOIN perfumes p ON co.perfume_id = p.id
";
$result = mysqli_query($sto, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <style>
        body { 
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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

        form { 
            display: inline; 
        }

        .btn-btn-primary{
            background-color: green;
            color: #fff;
            padding: 5px;
            margin: 3px;
            cursor: pointer;
        }

        .btn-btn-warning{
            background-color: red;
            color: #fff;
            padding: 5px;
            margin: 3px;
            cursor: pointer;
        }

        .btn-primary{
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
    <a href="admin.php" class="btn btn-primary" >Back</a>
    </center>
    <h2 style="text-align: center;">Customer Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Email</th>
                <th>Perfume Name</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['user_email']; ?></td>
                    <td><?php echo $row['perfume_name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo number_format($row['total_amount'], 2); ?> OMR</td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['order_status']; ?></td>
                    <td>
                        <?php if ($row['order_status'] === 'Pending') : ?>
                            <form method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                <button type="submit" name="action" class="btn-btn-primary" value="accept">Accept</button>
                                <button type="submit" name="action" class="btn-btn-warning" value="reject">Reject</button>
                            </form>
                        <?php else : ?>
                            <?php echo $row['order_status']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
