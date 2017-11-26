<?php
$host="localhost";
$username="root";
$database="tuts";
$password="";
$nameerr="";
$eerr="";
$pwerr="";
$emailerr="";
$passworderr="";

$connect=mysqli_connect($host,$username,$password,$database);

if(!$connect){

	echo"Something went wrong";
}

?>