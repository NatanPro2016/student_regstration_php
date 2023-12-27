<?php
include("connection.php");
if (isset($_POST["delete"])) {

    $id = $_POST['id'];
    echo $id;

    $delete = mysqli_query($conn, "DELETE FROM `students` WHERE id='$id'");
    if ($delete) {
        echo "deleted Suceefully deleted";
    } else {
        echo "Cannot delete  delete the results first  ";
    }
}
echo "<a href='admin_dashboard.php'> go back  </a>";
