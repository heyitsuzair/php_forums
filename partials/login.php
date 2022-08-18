<?php
$error = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $email = $_POST['loginemail'];
    $pass = $_POST['loginpass'];
    
    $sql = "SELECT * FROM `signup` WHERE email='$email'";
    $result = mysqli_query($connection, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['Password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['Email'] = $email;
            $_SESSION['username'] = $row['username'];
           
        }
        header("Location: /phpdevelopmentvsforumpro/index.php");  
    }
    header("Location: /phpdevelopmentvsforumpro/index.php");  
}

?>