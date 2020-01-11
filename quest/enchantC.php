<?php
if($mision['idMisionOn'])
{
	$EWC = mt_rand(5,10);
	$EAC = mt_rand(10,20);
	$msg = "<div class='questDrop'>
	".$EWC." Enchant Weapon C<br>
	".$EAC." Enchant Armor C<br>
	</div>";
	add_item(312,$EWC,$mision['idCuenta'],1);
	add_item(306,$EAC,$mision['idCuenta'],1);
}
else
	die("GTFO!");
?>
