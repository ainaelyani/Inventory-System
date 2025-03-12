<?php
$servername="localhost";
$username="root";
$password="";
$dbname="inventory_db";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if (!$conn){
    die ("Conncetion failed ".mysqli_connect_error());
}


?>