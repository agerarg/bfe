<?php
include('system/conexion.php');
session_start();
$db = new sql_db;
include('system/login.php');
$log = new LOGuser;

$asd = (int)$_GET['on'];

if($log->get("idCuenta")==1)
{
    $db->sql_query("UPDATE gameactive SET twitchon=".$asd);
    echo "OK";
}

?>