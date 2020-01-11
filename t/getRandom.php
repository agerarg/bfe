<?php
include('../system/conexion.php');
$db = new sql_db;
if($_GET['pw']="123i")
{
	$randomUser = file_get_contents('http://2g.be/twitch/randomviewer.php?channel=agerarg');
	$db->sql_query("UPDATE twitch SET randomName = '".$randomUser."'");
	$now =time();
	$msg = "<div class='goblindead'>Twitch: ".$randomUser." gano un premio!<br>Entra a <a href='https://www.twitch.tv/agerarg'>AgerArg</a> para reclamarlo!</div>";
	$db->sql_query('INSERT INTO  chat(global,mensaje,tempo) 
			VALUES(1,"'.$msg.'",'.$now.')');
	echo $randomUser;
}
?>