<?php
if($mision['idMisionOn'])
{
	$EWC = mt_rand(50,100);
	$msg = "<div class='questEnd'>DooM Destroyer terminado!</div><div class='questDrop'>".$EWC." Crafts S</div>";
	add_item(403,$EWC,$mision['idCuenta'],0);
		
}
else
	die("GTFO!");
?>
