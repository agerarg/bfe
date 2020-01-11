<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Get stronger done!</div>";
	$msg .= "<div class='questDrop'>
	+1000 exp
	</div>";
	///LEVEL UP
	$db->sql_query("UPDATE personaje SET
			exp = (exp+1000)
		  WHERE idPersonaje  = '".$mision['idPersonaje']."'");
}
else
	die("GTFO!");
?>
