<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Keys Armas C done!</div>";
	$whats = mt_rand(1,8);
	
	$weapMat = mt_rand(5,15);
	switch($whats)
	{
		case 1:
		add_item(239,$weapMat,$mision['idCuenta']);
		$moar .= $weapMat." Yaksa Mace Head<br>";
		break;
		case 2:
		add_item(240,$weapMat,$mision['idCuenta']);
		$moar .= $weapMat." Homunkulus Head<br>";
		break;
		case 3:
		add_item(241,$weapMat,$mision['idCuenta']);
		$moar .= $weapMat." Samurai Head<br>";
		break;
		case 4:
		add_item(242,$weapMat,$mision['idCuenta']);
		$moar .= $weapMat." Great Pata Head<br>";
		break;
		case 5:
		add_item(243,$weapMat,$mision['idCuenta']);
		$moar .= $weapMat." Demon Staff Head<br>";
		break;
		case 6:
		add_item(244,$weapMat,$mision['idCuenta']);
		$moar .= $weapMat." Eminence Bow Head<br>";
		break;
		case 7:
		add_item(245,$weapMat,$mision['idCuenta']);
		$moar .= $weapMat." Berserker Blade Head<br>";
		break;
		case 8:
		add_item(246,$weapMat,$mision['idCuenta']);
		$moar .= $weapMat." Crystal Dagger Head<br>";
		break;
	}
	$msg = "<div class='questDrop'>
	".$moar."
	</div>";
			
}
else
	die("GTFO!");
?>
