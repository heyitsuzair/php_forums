<?php
$error = 'false';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'dbconnect.php';
    $username = $_POST['signupusername'];
    $email = $_POST['signupemail'];
    $password = $_POST['signuppassword'];
    $cpassword = $_POST['signupcpassword'];

    // Check whether username already exists or not
    $exist = "SELECT * FROM signup WHERE email = '$email'";
    $result = mysqli_query($connection, $exist);
    $rows = mysqli_num_rows($result);
    if($rows>0){
        echo "<script>window.open(/index.php?emailalready)</script>";
    }
    else{
        if($password == $cpassword){
            $passhash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `signup` ( `username`,`Email`, `Password`, `Time`) VALUES ('$username','$email', '$passhash', current_timestamp())";
            $result = mysqli_query($connection, $sql);
            if($result == true){
                header('Location: /phpdevelopmentvsforumpro/index.php?signupsuccess');
                exit();
            }
        }
        else{
            header('Location: /phpdevelopmentvsforumpro/index.php?signupfalse');
        }
    }
    header("Location: /phpdevelopmentvsforumpro/index.php?signupfalse");
}