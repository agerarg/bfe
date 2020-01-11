<?php
if($mision['idMisionOn'])
{
	///LEVEL UP
	$db->sql_query("UPDATE clan SET
			nivel = 2
		  WHERE idClan  = '".$mision['clan']."'");
	
	systemLog("clan","<div class='questEnd'>El clan es ahora nivel 2!</div>",$mision['clan']);
}
else
	die("GTFO!");
?>
