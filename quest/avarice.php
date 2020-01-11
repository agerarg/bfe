<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Avarice completed!</div>";
			$Material = mt_rand(50,100);
			$Piece = mt_rand(25,50);
			$Blade = mt_rand(25,50);
			$whats = mt_rand(1,8);
			$weapMat = mt_rand(5,10);

					add_item(236,$Material,$mision['idCuenta']);
					add_item(238,$Piece,$mision['idCuenta']);
					add_item(237,$Blade,$mision['idCuenta']);
				switch($whats)
				{
					case 1:
					add_item(248,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Art Of Battle Axe Head<br>";
					break;
					case 2:
					add_item(249,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Bellion Cestus Head<br>";
					break;
					case 3:
					add_item(250,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Bow Of Peril Head<br>";
					break;
					case 4:
					add_item(251,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Evil Staff Head<br>";
					break;
					case 5:
					add_item(252,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Guardian Sword Head<br>";
					break;
					case 6:
					add_item(253,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Wizard Tear Head<br>";
					break;
					case 7:
					add_item(254,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Sword Of Damascus Head<br>";
					break;
					case 8:
					add_item(255,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Demon Dagger Head<br>";
					break;
				}
				$msg = "<div class='questDrop'>".$mision['PJnombre']." got ".$moar." and B Materials!</div>";

	
}
else
	die("GTFO!");
?>
