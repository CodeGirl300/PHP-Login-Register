<?php
session_start();
require ('connect.php');

//You are now logged in
echo "Hi " .$_SESSION['email']. " <a href='logout.php'>Logout</a>";

?>