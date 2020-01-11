<?php
if($mision['idMisionOn'])
{
	$EWC = mt_rand(50,100);
	$msg = "<div class='questDrop'>
	".$EWC." Crafts B<br>
	</div>";
	add_item(401,$EWC,$mision['idCuenta'],0);
		
}
else
	die("GTFO!");
?>
