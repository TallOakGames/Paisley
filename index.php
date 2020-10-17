<?php
$server = "localhost"; //Change later?
$username = "edward";
$password = "idontlikesand";

//Connect to the server
$connection = new mysqli($server, $username, $password);

if ($connection->connect_error) {
    //Print error
    die("Connection failed: ".$connection->connect_error);
} else {
    echo "Connected successfully";
}