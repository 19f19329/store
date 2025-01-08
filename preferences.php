<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer preferences</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <center>

        <a href="store.php" class="btn btn-secondary">Back</a>
    
        <h3>Give us your preferences and scent cues to improve the experience</h3>
    </center>
    <div class="container">
        <div class="preferences-form">
            <h2>Choose your preferences</h2>
            <form action="save_preferences.php" method="post">
                <div class="form-group">
                    <label for="scent_type">Favorite scent type:</label>
                    <select name="scent_type" id="scent_type" class="form-control" required>
                        <option value="floral">floral</option>
                        <option value="fruity">fruity</option>
                        <option value="woody">woody</option>
                        <option value="spicy">spicy</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="occasion">occasion:</label>
                    <select name="occasion" id="occasion" class="form-control" required>
                        <option value="daily">daily</option>
                        <option value="party">party</option>
                        <option value="wedding">wedding</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save preferences</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

h3 {
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: -50px;
        }

body {
    font-family:'Times New Roman', Times, serif;
    background-color: #f8f9fa;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.preferences-form {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 20px #000000;
    width: 400px;
}

.preferences-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #343a40;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    color: #495057;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    width: 100%;
    margin-top: 9px;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
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
</body>
</html>