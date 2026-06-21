<?php
$host="localhost";
$username="root";
$password="";
$database="task-manager";
$conn=mysqli_connect($host,$username,$password,$database);

if(!$conn){

    die('Database connection failes' . mysqli_connect_error());

}