<?php

$conf = include('config.php');

$hostname = $conf['hostname'];
$username = $conf['username'];
$password = $conf['password'];
$db = $conf['bd'];

$con = mysqli_connect($hostname, $username, $password,$db);
$con -> set_charset("utf8");

if (!$con) {
die("Failed to establish connection");
}
echo "Connection established successfully";