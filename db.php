<?php 
$host = "localhost";
$username = 'root';
$password = '';
$dbname = 'ajax-cart';

$conn = new mysqli($host,$username,$password,$dbname);

if(!$conn){
    die('connection Failed'. mysqli_error($conn));
}