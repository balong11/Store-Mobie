<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "dienthoai";
// Create connection
$con = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$con) {
   die("Connection failed: " . mysqli_connect_error());
}
// echo "connect";


function Redirect($url, $permanent = false)
{
   header('Location: ' . $url, true, $permanent ? 301 : 302);

   exit();
}


?>    