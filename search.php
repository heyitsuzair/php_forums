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
    <style>
    .container {
        min-height: 100vh;
    }
    </style>
</head>

<body>
    <?php include "partials/dbconnect.php" ?>
    <?php include "partials/header.php" ?>

    <!-- Search Results -->
    <div class="container my-4 ">
        <h1 class="text-center">Search results for "<?php echo $_GET['search']; ?>"</h1>
        <?php

        // Remember To Alter Table

        $noresults = true;
        $query = $_GET["search"];
        $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$query')";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noresults = false;
            $threadtitle = $row['thread_title'];
            $threaddesc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "threads.php?threadid=$thread_id";
            //   Display search results
            echo '<div class=" result my-5">
                    <h4><a href="' . $url . '" class="text-dark">' . $threadtitle . '</a></h4>
                    <p>' . $threaddesc . '</p>
          </div>';
        }
        if ($noresults) {
            echo '<div class="jumbotron jumbotron-fluid px-2 py-5 my-5" style="background-color:#d74338;border-radius: 4px;color:white;>
        <div class=" container"="">
          <p class="display-4">No Results Found</p>
          <p class="lead">
                    Suggestions:<ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords</li>
                    </ul>
          </p>
        </div>';
        }
        ?>

        <!-- <?php include "partials/footer.php" ?> -->
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