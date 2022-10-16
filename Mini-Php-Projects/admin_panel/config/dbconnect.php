<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "swiss_collection";

$conn = mysqli_connect($server,$user,$password,$db);

if(!$conn) {
    die("Connection Failed:".mysqli_connect_error());
}

?>