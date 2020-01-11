<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Exp Hunter done!</div>";
	$msg .= "<div class='questDrop'>
	15000 Exp<br>
	</div>";
	$expBonus=15000;
	$db->sql_query("UPDATE personaje SET exp=(exp+".$expBonus.") WHERE idPersonaje = '".$mision['idPersonaje']."'");
	
}
else
	die("GTFO!");
?>
