<?php
if($mision['idMisionOn'])
{
	
	add_item(283,10,$mision['idCuenta']); 
	add_item(284,5,$mision['idCuenta']); 
	$msg = "<div class='questEnd'>Wellcome a Swordon</div>";
	$msg .= "<div class='questDrop'>
	+500 exp<br>
	10 Life Potions<br>
	5 Mana Potions
	</div>";
	///LEVEL UP
	$db->sql_query("UPDATE personaje SET
			exp = (exp+500)
		  WHERE idPersonaje  = '".$mision['idPersonaje']."'");
}
else
	die("GTFO!");
?>
