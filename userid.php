<?php


//Conexion a la db
require_once "todoslosarchivos.php";
$conf = include 'Config/config.php';
set_time_limit(3600);
ini_set('memory_limit', '9999999999999G');
ini_set('max_execution_time', 3600);
ini_set('max_input_time', 3600);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = $conf['hostname'];
$username = $conf['username'];
$password = $conf['password'];
$db = $conf['bd'];
$arrayDbConf['host'] = 'localhost';


$con = mysqli_connect($hostname, $username, $password, $db);
if (!$con) {
    die("Failed to establish connection");
}


$id = 0;
/*
$id++;
$consultasiexiste = "SELECT `usuario`, `sucursal_id`,`id` FROM `usuario`";

$row = null;

$consultasiexiste = mysqli_query($con, $consultasiexiste);
while ($row = mysqli_fetch_assoc($consultasiexiste)) {
    $user = $row["usuario"];
    $sucid = $row["sucursal_id"];
    $idu = $row["id"];



    $obj = new MySqlBackupLite();
    $obj->zipcreation($user, $sucid);
}*/

//Recorre la tabla usuario para obtener la sucursales

$consultasiexiste = "SELECT DISTINCT sucursal_id FROM `usuario`";

$row = null;

$consultasiexiste = mysqli_query($con, $consultasiexiste);
while ($row = mysqli_fetch_assoc($consultasiexiste)) {
    $user = "";
    $sucid = $row["sucursal_id"];
    //$idu = $row["id"];


    //se direje a la funcion para crear y consultar tablas de los zips
    
    $obj = new MySqlBackupLite();
    $obj->zipcreation($user, $sucid);
}

