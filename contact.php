<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Fellow Coders - Forums</title>
  </head>
  <body>
    <?php include "partials/dbconnect.php";?>
    <?php include "partials/header.php" ?>
    <?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = $_POST['yourname'];
  $email = $_POST['youremail'];
  $title = $_POST['title'];
  $desc = $_POST['desc'];
  $sql = "INSERT INTO `contact` (`name`, `email`, `title`, `description`) VALUES ('$name', '$email', '$title', '$desc')";
  $result = mysqli_query($connection, $sql);
  if($result){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> We will contact you shortly.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
?>
<div class="text-center my-2">
  <h1>  
    Get In Touch
  </h1>
</div>
    <div class="container my-3">
      <form action="contact.php" method = "post">
        <div class="form-floating">
          <div class="form-floating mb-3">
            <input type="text" class="form-control my-3" id="floatingname" name="yourname" placeholder="Write your name">
            <label for="floatingInput">Your Name</label>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingemail" name="youremail" placeholder="Write your email address">
            <label for="floatingPassword">Your Email</label>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control my-2" id="floatingemail" name="title" placeholder="Write your email address">
            <label for="floatingPassword">Title</label>
          </div>
          <div class="form-floating">
  <textarea class="form-control my-2" placeholder="Leave a comment here" name = "desc" id="desc"></textarea>
  <label for="floatingTextarea">Description</label>
</div>
          <button class="btn btn btn-primary my-2">Submit</button>
        </form>
</div>
    </div>
    <?php include "partials/footer.php" ?>
      
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>