   
<?php
//mysql connection 
$dbserver= "localhost";
$dbuser = "root";
$dbpassword = "";
$database = "studentdb";

$conn = mysqli_connect($dbserver,$dbuser,$dbpassword,$database) or die('mysql connection error:'.mysqli_connect_error());


?>
