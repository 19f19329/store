<?php

$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');
if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email'];



$requestData = json_decode(file_get_contents('php://input'), true);
$action = $requestData['action'];


$clientID = 'AeZlCAFV_gp35ZWiWf2ROhJf7E7nKkwfykgydysSYh1hiW1PCVf2T7uPWxHwveoFK1mCETS9RXu7Bvaz';
$secret = 'EJyPhm0UxOHTrwtNinSrRzxqoVE5PhxNpAW8PJWKB8n7rVX2wDM1ENQR2vMvlH-IIZFIuzTwj8UaIKZY'; 
$apiUrl = 'https://api.sandbox.paypal.com/v2/checkout/orders';


if ($action === 'create_order') {
    $totalAmount = $requestData['totalAmount'];
    
    
    $orderData = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => $totalAmount
                ]
            ]
        ]
    ];

    
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($clientID . ':' . $secret)
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    
    $responseData = json_decode($response, true);
    
    header('Content-Type: application/json');

    if (isset($responseData['id'])) {
        echo json_encode(['id' => $responseData['id']]);
    } else {
        echo json_encode(['error' => 'Unable to create PayPal order', 'details' => $responseData]);
    }
    exit();
}



if ($action === 'capture_order') {
    $orderID = $requestData['orderID'];
    $cart = $requestData['cart'];
    
    
    $captureUrl = "https://api.sandbox.paypal.com/v2/checkout/orders/{$orderID}/capture";
    
    $ch = curl_init($captureUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($clientID . ':' . $secret)
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    
    $response = curl_exec($ch);
    curl_close($ch);

    $captureData = json_decode($response, true);
    
    if (isset($captureData['status']) && $captureData['status'] === 'COMPLETED') {
       
       
        
        foreach ($cart as $item) {
            $perfumesId = $item['id'];
            $quantityPurchased = $item['quantity'];
            $totalAmount = $item['quantity'] * $item['price'];

            
        $insertOrderQuery = "INSERT INTO customers_orders (order_id, user_email, perfume_id, quantity, total_amount) 
                             VALUES ('$orderID', '$email', $perfumesId, $quantityPurchased, $totalAmount)";
        mysqli_query($sto, $insertOrderQuery);

            
            $updateQuery = "UPDATE perfumes SET stock = stock - $quantityPurchased WHERE id = $perfumesId";
            mysqli_query($sto, $updateQuery);

               
        }
        

        echo json_encode(['status' => 'COMPLETED', 'id' => $orderID]);
    } else {
        echo json_encode(['status' => 'FAILED', 'message' => 'Payment not completed']);
    }
    exit();
}
?>

