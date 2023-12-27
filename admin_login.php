<?php
session_start();

include "connection.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = 'SELECT * FROM `office`';
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $email) {
            $found = TRUE;

            if ($row['password'] == $password) {
                echo "sucess full login";

                $_SESSION["id"] = $row['id'];
                $_SESSION["username"] = $row['Name'];
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["isadmin"] = TRUE;
                echo "<script>" . "window.location.href='./admin_dashboard.php'" . "</script>";
            } else {
                echo "password is incorrect";
            }
            break;
        } else {
            $found = FALSE;
        }
    }
    if (!$found) {
        echo "No user With email";
    }
}
if (isset($_POST["logout"])) {
    session_destroy();
}

if (isset($_SESSION["loggedin"]) && $_SESSION["isadmin"] == TRUE && $_SESSION["loggedin"] == TRUE) {
    echo "<script>" . "window.location.href='./admin_dashboard.php'" . "</script>";
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form method="post">
        <input type="text" name="email" placeholder="Enter Unser Name">
        <input type="text" name="password" placeholder="password">
        <input type="submit" value="Login" name="login">
        <a href="./index.php">Go home </a>
    </form>

</body>

</html>