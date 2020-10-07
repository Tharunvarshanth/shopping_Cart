<?php 

session_start();
// remove all session variables
session_unset();
session_destroy(); 
// destroy the session 
header('location:http://localhost/shoppingcard/index.php');








?>