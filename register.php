<?php

$sto = mysqli_connect('localhost', 'omar', '95112238', 'storedb');

if (!$sto) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($sto, $_POST['username']);
    $email = mysqli_real_escape_string($sto, $_POST['email']);
    $password = mysqli_real_escape_string($sto, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($sto, $_POST['confirm_password']);

    
    if ($password != $confirm_password) {
        echo "Passwords do not match!";
    } else {
        
        $check_email_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
        $result = mysqli_query($sto, $check_email_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            echo "Email already exists!";
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if (mysqli_query($sto, $query)) {
                echo "Registration successful!";
                
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($sto);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>
<body>

<div class="container">
    <div class="main">
        <div class="register">
            <form class="form" action="register.php" method="post">
                <label for="chk" aria-hidden="true">Register</label>
                <input class="input" type="text" name="username" placeholder="Username" required>
                <input class="input" type="email" name="email" placeholder="Email" required>
                <input class="input" type="password" name="password" placeholder="Password" required>
                <input class="input" type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </div>
</div>

<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

.container {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
}

.main {
    position: relative;
    display: flex;
    flex-direction: column;
    background-color: #23a39f;
    max-height: 450px;
    width: 400px;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: #3b0082 0px 30px 90px;
}


.register {
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding: 24px;
    justify-content: center;
    align-items: center;
    color: #fff; 
    text-align: center;
    font-size: 1.5rem; 

}

.input {
    width: 100%;
    height: 40px;
    font-size: 1rem;
    background: #e0dede;
    padding: 10px;
    margin-top: 15px;
    border: none;
    outline: none;
    border-radius: 4px;
}

button {
    width: 70%;
    height: 40px;
    margin: 15px auto 10%;
    color: #fff;
    background: #573b8a;
    font-size: 1rem;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: .2s ease-in;
}

button:hover {
    background-color: #6d44b8;
}

</style>
</body>
</html>