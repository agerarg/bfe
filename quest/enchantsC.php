<?php
if($mision['idMisionOn'])
{
	$EWC = mt_rand(2,5);
	$EAA = mt_rand(5,10);
	$msg = "<div class='questDrop'>
	".$EWC." Enchant Weapon C<br>
	".$EAA." Enchant Armor C
	</div>";
	add_item(312,$EWC,$mision['idCuenta'],1);
	add_item(306,$EAA,$mision['idCuenta'],1);
		
}
else
	die("GTFO!");
?>
