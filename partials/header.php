<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/phpdevelopmentvsforumpro/index.php">Fellow Coders</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/phpdevelopmentvsforumpro/index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/phpdevelopmentvsforumpro/about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql = "SELECT category_name, category_id FROM  `categories` LIMIT 5";
$result = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  echo '<a class="dropdown-item" href="threadslist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
}
echo '</div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/phpdevelopmentvsforumpro/contact.php" tabindex="-1">Contact</a>
      </li>
    </ul></div>';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<form class="d-flex my- form-inline my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success mx-3 my-sm-0" type="submit">Search</button>
        <p class="text-light my-0 mx-2">Welcome ' . $_SESSION['username'] . ' </p>
        <a href="partials/logout.php" class="btn btn-outline-success px-4 py-2">Logout</a>
        </form>
        ';
} else {
  echo '
          <form class="d-flex" action="/phpdevelopmentvsforumpro/search.php">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
          </form>
          <div class="mx-2">
          <button class="btn btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
          <button class="btn btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#signupmodal">Sign up</button>
          </div>
          ';
}
echo ' </div>
            </div>
                </nav>';

include "partials/loginmodal.php";
include "partials/signupmodal.php";
if (isset($_GET['signupsuccess'])) {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>SUCCESS!</strong> YOU CAN LOGIN NOW.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
} else {
  if (isset($_GET['signupfalse'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Sorry!</strong> Your Passwords Donot Match Or Your Account Is Already Registered.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
}