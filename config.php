
<?php

$host="localhost:3307";
$user="root";
$password="";
$database="login_sample_db";

$conn=new mysqli($host, $user, $password, $database);

if($conn->connect_error){
    die("Failed to Establish Cannection: ".$conn->connect_error);
}

?>