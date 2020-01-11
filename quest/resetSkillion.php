<?php
if($mision['idMisionOn'])
{
	$skillPoints = 1+intval($mision['nivel']/5);
	$db->sql_query("UPDATE personaje SET
		skillPoints = '".$skillPoints."'
		  WHERE idPersonaje  = '".$mision['idPersonaje']."'");
	
	$db->sql_query("DELETE FROM skilllearn WHERE idPersonaje = '".$mision['idPersonaje']."'");
	
	$db->sql_query("DELETE FROM aura WHERE idPersonaje = '".$mision['idPersonaje']."'");
	
	
	$msg = "<div class='questEnd'>Reset Skill Done</div>";
}
else
	die("GTFO!");
?>
