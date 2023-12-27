<?php
include("connection.php");
session_start();

if (!(isset($_SESSION["loggedin"]) && $_SESSION["isadmin"] == TRUE && $_SESSION["loggedin"] == TRUE)) {
    echo "<script>" . "window.location.href='./admin_login.php'" . "</script>";
    exit;
}

$username = $_SESSION["username"];
echo $username;


if (isset($_POST['register'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $dob = $_POST['dob'];
    $grade = $_POST['grade'];
    $email = $_POST['email'];

    if ($grade >= 90) {
        $dep = "d001";
    } else if ($grade >= 80) {
        $dep = "d002";
    } else if ($grade >= 60) {
        $dep = "d003";
    } else {
        $dep = "d004";
    }
    $password = strtolower($dob . $lastname);




    $query = "INSERT INTO `students`(`id`, `firstName`, `middleName`, `lastName`, `age`, `sex`, `DOB`, `depaptment`, `grade`, `email`, `password`) 
    VALUES ('$id','$firstname','$middlename','$lastname','$age','$sex','$dob','$dep','$grade','$email','$password')";
    $result = mysqli_query($conn, $query);



    if ($result) {
        echo "inserted sucessfully ";
        $desplay = "SELECT * FROM `department` WHERE id = '$dep' ";
        $result = mysqli_query($conn, $desplay);
        if ($row = mysqli_fetch_assoc($result)) {
            echo "Your department is Name  " . $row['Name'] . "<br />";
            echo "Your department is Location  " . $row['location'];
        }
    } else {
        echo "not insted ";
    }


    if (isset($_POST["addresult"])) {
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>

</head>

<body>
    <form action="admin_login.php" method="post">
        <input type="submit" value="logout" name="logout" />
    </form>

    <form method="post">
        <div class="input_group">
            <label for="id"> ID</label>
            <input type="text" name="id">
        </div>
        <div class="input_group">
            <label for="firstname"> Fist Name</label>
            <input type="text" name="firstname">
        </div>
        <div class="input_group">
            <label for="middlename"> Middle Name</label>
            <input type="text" name="middlename">
        </div>
        <div class="input_group">
            <label for="lastname"> Last Name</label>
            <input type="text" name="lastname">
        </div>
        <div class="input_group">
            <label for="age"> Age</label>
            <input type="number" name="age">
        </div>
        <div class="input_group">
            <label for="sex"> sex</label>
            <select name="sex" id="">
                <option value="M">Male</option>
                <option value="F">Fmaile</option>
            </select>
        </div>
        <div class="input_group">
            <label for="dob"> dob</label>
            <input type="date" name="dob">
        </div>
        <div class="input_group">
            <label for="grade"> Grade</label>
            <input type="number" name="grade">
        </div>
        <div class="input_group">
            <label for="email"> Email</label>
            <input type="email" name="email">
        </div>


        <input type="submit" value="register" name="register">



    </form>
    <table>
        <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Age </th>
            <th> Sex </th>
            <th> Email</th>
            <th> Department </th>
        </tr>

        <?php

        $res_stu = mysqli_query($conn,  "SELECT * FROM `students`");
        while ($rowS = mysqli_fetch_assoc($res_stu)) {
        ?>
            <tr>
                <td><?php echo $rowS['id']  ?></td>
                <td><?php echo $rowS['firstName'] . " " . $rowS['middleName'] . " " . $rowS['lastName']; ?> </td>
                <td><?php echo $rowS['age']  ?></td>
                <td><?php echo $rowS['sex']  ?></td>
                <td><?php echo $rowS['email']  ?></td>

                <?php
                $department = $rowS['depaptment'];
                $dep = mysqli_query($conn, "SELECT * FROM `department` where id = '$department'");
                if ($dep_row = mysqli_fetch_assoc($dep)) {
                    echo "<td>" . $dep_row["Name"] . "</td>";
                }

                ?>
                <td> <a href="admin_edit_student.php?id=<?php echo $rowS['id'] ?>"> edit </a> </td>
                <td>
                    <form action="admin_delete_student.php" method="POST" id="delete_form">
                        <input type="hidden" name="id" value="<?php echo $rowS['id'] ?>">
                        <input type="submit" value="Delete" name="delete">
                    </form>
                </td>

            </tr>
        <?php
        }



        ?>


    </table>
    <script src="./js/admin_dashboard.js"></script>


</body>

</html>