<?php
include("connection.php");
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["isadmin"] == TRUE && $_SESSION["loggedin"] == TRUE) {
  echo "<script>" . "window.location.href='./admin_dashboard.php'" . "</script>";
  exit;
}

if ((isset($_SESSION["loggedin"]) &&  $_SESSION["isstudent"] = TRUE && $_SESSION["loggedin"] == TRUE)) {
  echo "<script>" . "window.location.href='./student_dashboard.php'" . "</script>";
  exit;
}
if (isset($_POST['search'])) {
  $stuid = $_POST['id'];
  $query = "SELECT * FROM `students` WHERE id = '$stuid'";

  $result = mysqli_query($conn, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    echo "name " . $row['firstName'];
    $depid = $row['depaptment'];
    $department = "SELECT * FROM `department` WHERE `id` = '$depid'";
    $res = mysqli_query($conn, $department);
    if ($rowD = mysqli_fetch_assoc($res)) {
      echo "Dep Name  " . $rowD["Name"] . " Location" . $rowD["location"];
    }
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School website</title>
</head>

<body>
  <a href="admin_login.php"> login as teacher</a>
  <a href="student_login.php"> login as student</a>
  <form method="post">
    <h2> find yourself by your register id </h2>
    <input type="text" name="id" placeholder="Your id ">
    <input type="submit" name="search" value="find yourself ">
  </form>


</body>

</html>