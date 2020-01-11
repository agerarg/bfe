<?php
if($mision['idMisionOn'])
{
	$questExp = 2500;
	$questGold = 500;
	$msg = "<div class='questEnd'>".$mision['nombre']." done!</div>";
	$msg .= "<div class='questDrop'>
	+".$questExp." exp<br>
	+".$questGold." gold<br>
	</div>";
	///LEVEL UP
	$db->sql_query("UPDATE personaje SET
			exp = (exp+2500)
		  WHERE idPersonaje  = '".$mision['idPersonaje']."'");
	$db->sql_query("UPDATE cuenta SET oro = (oro+".$questGold.") WHERE idCuenta = ".$mision['idCuenta']);
}
else
	die("GTFO!");
?>
