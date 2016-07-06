<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$user = "";

$upassword = "";
 
$salt = "SecuritySalt";

$password = hash('sha256', $salt.$upassword);
 
echo $password;

$gehitu="INSERT INTO users (username,password) VALUES ('$user','$password')";
mysql_query($gehitu);

echo "user created";

?>