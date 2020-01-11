<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>".$mision['nombre']." done!</div>";
	$msg .= "<div class='questDrop'>
	+2500 exp
	</div>";
	///LEVEL UP
	$db->sql_query("UPDATE personaje SET
			exp = (exp+2500)
		  WHERE idPersonaje  = '".$mision['idPersonaje']."'");
}
else
	die("GTFO!");
?>
