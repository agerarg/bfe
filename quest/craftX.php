<?php
if($mision['idMisionOn'])
{
	$EWC = mt_rand(50,100);
	$msg = "<div class='questDrop'>
	".$EWC." Crafts X<br>
	</div>";
	add_item(438,$EWC,$mision['idCuenta'],0);
		
}
else
	die("GTFO!");
?>
