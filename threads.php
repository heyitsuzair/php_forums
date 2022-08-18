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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($connection,$sql);
    while($row = mysqli_fetch_assoc($result)){
      $threadtitle = $row['thread_title'];
      $threaddesc = $row['thread_desc'];
      $thread_user_id = $row['thread_userid'];

      // QUERY THE SIGNUP TABLE TO FINDOUT NAME OF COMMENT POSTER
      $sql2 = "SELECT username FROM `signup` WHERE sno = '$thread_user_id'";
      $result2 = mysqli_query($connection, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $posted_by = $row2['username'];
    }
    ?>

    <?php
        $showalert = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Insert into comment database
      $comment = $_POST['comment'];
      $comment = str_replace("<","&lt;","$comment");
      $comment = str_replace(">","&gt;","$comment");
      $sno = $_POST['sno'];
      $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ( '$comment', '$id', current_timestamp(), '$sno');
      ";
      $result = mysqli_query($connection,$sql);
      $showalert = true;
      if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Comment Has Been Posted Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> Your Comment Has Not Been Posted Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    }
    ?>

    <div class="container my-5 py-5" style="background-color:#9DFFBD;border-radius: 4px;">
        <div class="jumbotron">
            <h3 class="display-4 py-2"><?php echo $threadtitle; ?> Forum</h3>
            <p class="lead"><?php echo $threaddesc; ?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
            <p>Posted By <strong><?php echo $posted_by; ?></strong></p>
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo'<div class="container my-4">
        <h2 class="py-3">Post A Comment</h2>
        <form action="'. $_SERVER["REQUEST_URI"] .'" method="post">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a problem here" id="comment"
                name="comment"></textarea>
                <label for="floatingTextarea">Type Your Comment</label>
            </div>
            <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
            <button class="btn btn btn-primary my-3">Post Comment</button>
        </form>
    </div>';
    }
    else{
        echo'<div class="container">
        <h2 class="py-3">Post a comment</h2>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>You are not logged in.
        <strong><button class="btn btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button></strong> to post a comment.
        </div>
        </div>
        </div>';
    }
    ?>
    <div class="container">
        <h3 style="margin-top:22px;" class="py-2">Discussion</h3>
        <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
    $result = mysqli_query($connection,$sql);
    $noresult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noresult = false;
      $content = $row['comment_content'];
      $comment_time = $row['comment_time'];
      $thread_user_id = $row['comment_by'];
      $sql2 = "SELECT username FROM `signup` WHERE sno = '$thread_user_id'";
      $result2 = mysqli_query($connection, $sql2);
      $row2 = mysqli_fetch_assoc($result2);

       echo' <div class="container d-flex my-4">
            <div class="flex-shrink-0">
                <img src="img/userdef2.png" width="55px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
            <p class=" my-1"><strong>'. $row2['username'] .'</strong> at '. $comment_time . '</p>
                '. $content .'
            </div>
        </div>
    </div>';
  }
  if($noresult){
      echo '<div class="container my-5 py-5" style="background-color:#9DFFBD;border-radius: 4px;">
      <div class="jumbotron">
          <h3 class="display-4 py-2">No comments found</h3>
          <p class="lead">Be the first person to comment.</p>
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