<?php
if($mision['idMisionOn'])
{
	$query = 'SELECT nivel
					FROM clan WHERE idClan = '.$mision["clan"].'';
	$lidersq = $db->sql_query($query);
	$lidercheck = $db->sql_fetchrow($lidersq);
	if($lidercheck==2)
	{
		$db->sql_query("UPDATE clan SET
				nivel = 3
			  WHERE idClan  = '".$mision['clan']."'");
		
		systemLog("clan","<div class='questEnd'>El clan es ahora nivel 3!</div>",$mision['clan']);
	}
	else
	{
		systemLog("clan","<div class='questEnd'>El clan requiere ser nivel 2.</div>",$mision['clan']);
	}
}
else
	die("GTFO!");
?>
