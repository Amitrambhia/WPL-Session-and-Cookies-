<?php
session_start();
include "db.php";

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()) {
        if(password_verify($password, $row['password'])) {
            
            $_SESSION['user'] = $row['username'];

            if(isset($_POST['remember'])) {
                setcookie("user", $row['username'], time() + (86400 * 7), "/");
            }

            header("Location: dashboard.php");
        } else {
            echo "<script>alert('Invalid Password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #43cea2, #185a9d);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    padding: 30px;
    border-radius: 12px;
    width: 320px;
    color: white;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.remember {
    margin: 10px 0;
}

.remember label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    cursor: pointer;
}

.remember input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #ff7eb3;
    cursor: pointer;
}

input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: none;
    border-radius: 6px;
    outline: none;
}

button {
    width: 100%;
    padding: 10px;
    background: #ff7eb3;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

button:hover {
    background: #ff4f81;
}

label {
    font-size: 14px;
}

a {
    color: #ffd;
    text-decoration: none;
}

p {
    text-align: center;
    margin-top: 10px;
}
</style>
</head>

<body>

<div class="container">
<form method="POST">

<h2>Login</h2>

<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<div class="remember">
    <label>
        <input type="checkbox" name="remember">
        <span>Remember Me</span>
    </label>
</div>

<button name="login">Login</button>

<p>Don't have an account? <a href="register.php">Register</a></p>

</form>
</div>

</body>
</html>