<?php
if($mision['idMisionOn'])
{
	$EWS = mt_rand(1,2);
	$EAS = mt_rand(2,3);
	$msg = "<div class='questEnd'>Enchanted Valley terminado!</div><div class='questDrop'>".$EWS." Enchants Weapon S<br>".$EAS." Enchants Weapon S</div>";
	add_item(316,$EWS,$mision['idCuenta'],0);
	add_item(310,$EAS,$mision['idCuenta'],0);
		
}
else
	die("GTFO!");
?>
