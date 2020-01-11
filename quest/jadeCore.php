<?php
if($mision['idMisionOn'])
{
	$EWC = mt_rand(5,10);
	$craftS = mt_rand(25,50);
	$msg = "<div class='questDrop'>
	".$EWC." Jade Stones<br>
	".$craftS." Craft S<br>
	</div>";
	add_item(426,$EWC,$mision['idCuenta'],0);
	add_item(403,$craftS,$mision['idCuenta'],0);	
}
else
	die("GTFO!");
?>
