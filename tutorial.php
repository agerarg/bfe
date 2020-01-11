<?php
include('system/conexion.php');
session_start();
$db = new sql_db;
include('system/login.php');
$log = new LOGuser;

include('system/template_engine.php');
$template = new Template;
$template->set_filenames(array(
	'body' => 'templates/tutorial.html' )
);
$template->pparse('body');

?>