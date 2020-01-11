<?php
if($mision['idMisionOn'])
{
	$questExp = intval($mision['Qexp']);
	$questGold = intval($mision['Qgold']);
	$msg = "<div class='questEnd'>".$mision['nombre']." completa!</div>";
	$msg .= "<div class='questDrop'>
	+".$questExp." exp<br>
	+".$questGold." oro<br>
	</div>";
	///LEVEL UP
	$db->sql_query("UPDATE personaje SET
			exp = (exp+".$questExp.")
		  WHERE idPersonaje  = '".$mision['idPersonaje']."'");
	$db->sql_query("UPDATE cuenta SET oro = (oro+".$questGold.") WHERE idCuenta = ".$mision['idCuenta']);
}
else
	die("GTFO!");
?>
