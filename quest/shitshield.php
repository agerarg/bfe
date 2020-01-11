<?php
if($mision['idMisionOn'])
{
	
	add_item(318,1,$mision['idCuenta']); 
	$msg = "<div class='questEnd'>Shit Completed!</div>";
	$msg .= "<div class='questDrop'>
	Ganaste Shield of Shit<br>
	</div>";

	
}
else
	die("GTFO!");
?>
