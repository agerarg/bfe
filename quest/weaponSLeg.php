<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Arma Legendaria!</div>";
	switch($mision['idClase'])
	{
		case 1:
		$msg .= "<div class='questDrop'>Ganaste un Basalt Battlehammer Legendario!</div>";
		$itemId = createLegendary(24,1,$mision['idCuenta'],0,4);
		break;
		case 2:
		$msg .= "<div class='questDrop'>Ganaste un Imperial Staff Legendario!</div>";
		$itemId = createLegendary(50,1,$mision['idCuenta'],0,4);
		break;
		case 3:
		$msg .= "<div class='questDrop'>Ganaste un Angel Slayer Legendario!</div>";
		$itemId = createLegendary(10,1,$mision['idCuenta'],0,4);
		break;
		case 4:
		$msg .= "<div class='questDrop'>Ganaste un Draconic Bow Legendario!</div>";
		$itemId = createLegendary(60,1,$mision['idCuenta'],0,4);
		break;
		case 5:
		$msg .= "<div class='questDrop'>Ganaste un Dark Legion * Dark Legion Legendario!</div>";
		$itemId = createLegendary(105,1,$mision['idCuenta'],0,4);
		break;
		case 6:
		$msg .= "<div class='questDrop'>Ganaste un Demon Splinter Legendario!</div>";
		$itemId = createLegendary(86,1,$mision['idCuenta'],0,4);
		break;
		case 7:
		$msg .= "<div class='questDrop'>Ganaste un Heaven Divider Legendario!</div>";
		$itemId = createLegendary(76,1,$mision['idCuenta'],0,4);
		break;
		case 8:
		$msg .= "<div class='questDrop'>Ganaste un Imperial Staff Legendario!</div>";
		$itemId = createLegendary(50,1,$mision['idCuenta'],0,4);
		break;
		case 10:
		$msg .= "<div class='questDrop'>Ganaste un Dark Legion * Dark Legion Legendario!</div>";
		$itemId = createLegendary(105,1,$mision['idCuenta'],0,4);
		break;
	}

}
else
	die("GTFO!");
?>
