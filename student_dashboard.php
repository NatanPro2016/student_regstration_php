<?php
session_start();
include("connection.php");

if (!(isset($_SESSION["loggedin"]) &&  $_SESSION["isstudent"] = TRUE && $_SESSION["loggedin"] == TRUE)) {
    echo "<script>" . "window.location.href='./student_login.php'" . "</script>";
    exit;
}

$stuid = $_SESSION["id"];
$query = "SELECT * FROM `students` WHERE id = '$stuid'";
$result = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($result)) {
    echo "your full name " . " " . $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];
    $depid = $row['depaptment'];
    $department = "SELECT * FROM `department` WHERE `id` = '$depid'";
    $res = mysqli_query($conn, $department);
    if ($rowD = mysqli_fetch_assoc($res)) {
        echo "Dep Name  " . $rowD["Name"] . " Location" . $rowD["location"];
    }
}

$res1 = mysqli_query($conn, "SELECT * FROM `result` WHERE `student` = '$stuid'");
while ($row = mysqli_fetch_assoc($res1)) {

    echo "uc1 " . $row["uc1"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student dashboard </title>
</head>

<body>




    <form method="post" action="student_login.php">
        <input type="submit" value="logout" name="logout">
    </form>

</body>

</html>