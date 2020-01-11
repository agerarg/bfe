<?php
if($mision['idMisionOn'])
{
	
	add_item(278,1,$mision['idCuenta']); 
	$msg = "<div class='questEnd'>The magic ring</div>";
	$msg .= "<div class='questDrop'>
	+3000 exp<br>
	Elven Ring
	</div>";
	///LEVEL UP
	$db->sql_query("UPDATE personaje SET
			exp = (exp+3000)
		  WHERE idPersonaje  = '".$mision['idPersonaje']."'");
}
else
	die("GTFO!");
?>
