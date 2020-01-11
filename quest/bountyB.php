<?php
if($mision['idMisionOn'])
{
	include("../system/legendary.php");
	$msg .=  "<div class='questEnd'>Bounty B terminado!</div>";
	
		for($i=0;$i<10;$i++)
		{
			$type = randomShit();
			$itemId = createLegendary($type,0,0,5,false,1,$mision['idCuenta'],$mision['idClase']);
			$moar .= "+1 Legendary Item<br>";
		}
	$msg = "<div class='questDrop'>
	".$moar."
	</div>";
}
else
	die("GTFO!");
?>
