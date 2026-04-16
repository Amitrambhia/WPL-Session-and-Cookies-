<?php
session_start();

if(!isset($_SESSION['user'])) {
    if(isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
    } else {
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['user']; ?></h2>

<a href="logout.php">Logout</a>

</body>
</html>