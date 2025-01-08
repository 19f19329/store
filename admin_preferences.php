<?php
$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');
if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}




$query = "SELECT * FROM customer_preferences";
$result = mysqli_query($sto, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin preferences</title>
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
    <h2 style="text-align: center;">Customer Preferences</h2>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Scent Type</th>
                <th>Occasion</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['scent_type']; ?></td>
                    <td><?php echo $row['occasion']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    
</body>
</html>
