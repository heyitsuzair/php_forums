<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Fellow Coders - Forums</title>
</head>

<body>
    <?php include "partials/dbconnect.php" ?>
    <?php include "partials/header.php" ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($connection,$sql);
    while($row = mysqli_fetch_assoc($result)){
      $catname = $row['category_name'];
      $catdesc = $row['category_desc'];
    }
    ?>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $showalert = false;
      // Insert into thread database
      $th_title = $_POST['threadtitle'];
      $th_desc = $_POST['threaddesc'];


      $th_title = str_replace("<","&lt;","$th_title");
      $th_title = str_replace(">","&gt;","$th_title");

      $th_desc = str_replace("<","&lt;","$th_desc");
      $th_desc = str_replace(">","&gt;","$th_desc");


      $sno = $_POST['sno'];
      $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_userid`, `thread_catid`, `Timestamp`) VALUES ( '$th_title', '$th_desc', '$sno', '$id', current_timestamp())";
      $result = mysqli_query($connection,$sql);
      $showalert = true;
      if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Question Has Been Successfully Submitted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> Your Question Has Not Been Successfully Submitted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    }
    ?>
    <div class="container my-5 py-5" style="background-color:#9DFFBD;border-radius: 4px;">
        <div class="jumbotron">
            <h3 class="display-4 py-2">Welcome To <?php echo $catname ?> Forum</h3>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo'<div class="container my-4">
        <h2 class="py-3">Start A Discussion</h2>
        <form action="'. $_SERVER["REQUEST_URI"] .'" method="post">
        <div class="form-floating mb-3">
        <input type="text" class="form-control" id="threadtitle" name="threadtitle" placeholder="Problem Title">
        <label for="floatingInput">Problem Title</label>
        </div>
        <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a problem here" id="threaddesc"
        name="threaddesc"></textarea>
        <label for="floatingTextarea">Describe Your Problem</label>
        </div>
        <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
        <button class="btn btn btn-primary my-3">Submit</button>
        </form>
        </div>';
    }
    else{
        echo'<div class="container">
        <h2 class="py-3">Start A Discussion</h2>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>You are not logged in.
        <strong><button class="btn btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button></strong> to start a discussion.
        </div>
        </div>
        </div>';
    }
    ?>
    <div class="container">
        <h3 style="margin-top:22px;" class="py-2">Browse Questions</h3>
        <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_catid = $id";
    $result = mysqli_query($connection,$sql);
    $noresult = true;
    while($row = mysqli_fetch_assoc($result)){
      $noresult = false;
      $title = $row['thread_title'];
      $desc = $row['thread_desc'];
      $id = $row['thread_id'];
      $thread_time = $row['Timestamp'];
      $thread_userid = $row['thread_userid'];
      $sql2 = "SELECT username FROM `signup` WHERE sno = '$thread_userid'";
      $result2 = mysqli_query($connection,$sql2);
      $row2 = mysqli_fetch_assoc($result2);
      
       echo' <div class="container d-flex my-4">
            <div class="flex-shrink-0">
                <img src="img/userdef2.png" width="55px" alt="...">
            </div>
            <div class="flex-grow-1 ms-2">
            <p class=" my-1">Asked By <strong>'.$row2['username'].'</strong> at '. $thread_time . '</p>
                <h5> <a href="threads.php?threadid='. $id .'">'. $title .' </a></h5>
                <p>'. $desc .'</p>
            </div>
        </div>
    </div>';
    }
        if($noresult){
      echo '<div class="jumbotron jumbotron-fluid px-2 py-5" style="background-color:#9DFFBD;border-radius: 4px;>
      <div class="container">
        <p class="display-4">No Threads Found</p>
        <p class="lead"><b>Be The First Person To Ask a Question</b></p>
      </div>
    </div>';
    }
    ?>
        <?php include "partials/footer.php" ?>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>