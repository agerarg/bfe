<?php
if($mision['idMisionOn'])
{
	$EWC = mt_rand(5,10);
	$msg = "<div class='questDrop'>
	".$EWC." Radamante Cores<br>
	</div>";
	add_item(439,$EWC,$mision['idCuenta'],0);
		
}
else
	die("GTFO!");
?>
