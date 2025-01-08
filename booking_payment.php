<?php

$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');
if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];


$query = "SELECT * FROM `order` WHERE user_email='$email'"; 
$result = mysqli_query($sto, $query);
$totalAmount = 0;
$cartItems = []; 

while ($item = mysqli_fetch_assoc($result)) {
    if (is_numeric($item['price']) && is_numeric($item['quantity'])) {
        $totalPrice = $item['price'] * $item['quantity'];
        $totalAmount += $totalPrice;
        $cartItems[] = [
            'id' => $item['id'], 
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book And Pay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; }
        .container { margin-top: 50px; }
        .table { width: 60%; margin: auto; }
        .paypal-button { display: flex; justify-content: center; margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h3 class="text-center">Products in Cart</h3>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            mysqli_data_seek($result, 0);
            while ($item = mysqli_fetch_assoc($result)) : 
                $totalPrice = $item['price'] * $item['quantity'];
            ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['price']; ?> OMR</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($totalPrice, 2); ?> OMR</td>
                </tr>
            <?php endwhile; ?>
            <tr>
                <td><strong>Total Amount</strong></td>
                <td colspan="2"></td>
                <td><strong><?php echo number_format($totalAmount, 2); ?> OMR</strong></td>
            </tr>
        </tbody>
    </table>
    <div class="paypal-button">
        <div id="paypal-button-container"></div>
        <p id="result-message"></p>

        <!-- Initialize the JS-SDK -->
        <script src="https://www.paypal.com/sdk/js?client-id=AeZlCAFV_gp35ZWiWf2ROhJf7E7nKkwfykgydysSYh1hiW1PCVf2T7uPWxHwveoFK1mCETS9RXu7Bvaz&currency=USD"></script>
        <script>
            window.paypal.Buttons({
                style: {
                    shape: "rect",
                    layout: "vertical",
                    color: "gold",
                    label: "paypal",
                },
                async createOrder() {
                    try {
                        const response = await fetch('paypal_integration.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                action: 'create_order',
                                cart: <?php echo json_encode($cartItems); ?>,
                                totalAmount: <?php echo $totalAmount; ?>
                            })
                        });

                        if (!response.ok) {
                            const textResponse = await response.text();
                            throw new Error(`HTTP error! Status: ${response.status}, Response: ${textResponse}`);
                        }

                        const orderData = await response.json();
                        if (!orderData.id) {
                            throw new Error(`Invalid response: ${JSON.stringify(orderData)}`);
                        }

                        return orderData.id;
                    } catch (error) {
                        console.error("Error in createOrder:", error);
                        resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                    }
                },

                async onApprove(data) {
                    try {
                        const response = await fetch('paypal_integration.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                action: 'capture_order',
                                orderID: data.orderID,
                                cart: <?php echo json_encode($cartItems); ?>
                            })
                        });

                        const orderData = await response.json();
                        if (orderData.status === 'COMPLETED') {
                            resultMessage(`The transaction was completed successfully <br>order number: <br> ${orderData.id}`);
                        } else {
                            throw new Error(`Transaction not found: ${JSON.stringify(orderData)}`);
                        }
                    } catch (error) {
                        console.error("Error in onApprove:", error);
                        resultMessage(`Sorry, the payment system was unable to process your transaction...<br><br>${error}`);
                    }
                },

                onError: function (err) {
                    console.error(err);
                    resultMessage('An error occurred during the transaction.');
                }

            }).render('#paypal-button-container');

            function resultMessage(message) {
                const container = document.querySelector("#result-message");
                container.innerHTML = message;
            }
        </script>
    </div>
</div>
    <center>
        <a href="store.php" class="btn btn-secondary">Back to Product Page</a>
    </center>
</body>
</html>
