<?php
session_start();
include "db.php";

if(isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if($stmt->execute()) {
        echo "<script>alert('Registration Successful!');</script>";
    } else {
        echo "<script>alert('Email already exists');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
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
    background: #00c6ff;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

button:hover {
    background: #0072ff;
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
<form method="POST" onsubmit="return validate()">

<h2>Create Account</h2>

<input type="text" name="username" placeholder="Username" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button name="register">Register</button>

<p>Already have an account? <a href="login.php">Login</a></p>

</form>
</div>

<script>
function validate() {
    let pass = document.querySelector("input[name='password']").value;
    if(pass.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }
    return true;
}
</script>

</body>
</html>