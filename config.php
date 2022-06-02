<?php
$host = "localhost";
$username = "root";
$password = "";
$dbName = "deliverysite";

$mysqli = new mysqli("localhost", "root", "", "deliverysite");

if (!defined('SITEURL')) define('SITEURL', 'http://localhost/site_delivery/');

if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>