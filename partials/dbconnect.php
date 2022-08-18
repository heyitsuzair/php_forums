<?php
// Script to connect to the databse
$server = "localhost";
$username = 'root';
$password = '';
$databasename = "fellowco_phpproject";

$connection = mysqli_connect($server, $username, $password, $databasename);