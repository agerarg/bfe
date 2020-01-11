<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Alien Study!</div>";

			$Material = mt_rand(20,30);
			$lowCore = mt_rand(10,20);
			$topCore = mt_rand(5,10);
			$whats = mt_rand(1,8);
			$weapMat = mt_rand(5,15);
					add_item(285,$Material,$mision['idCuenta']);
					add_item(286,$lowCore,$mision['idCuenta']);
					add_item(287,$topCore,$mision['idCuenta']);
				switch($whats)
				{
					case 1:
					add_item(262,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Miracles Head<br>";
					break;
					case 2:
					add_item(261,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Elysian Head<br>";
					break;
					case 3:
					add_item(260,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Dragon Skull Head<br>";
					break;
					case 4:
					add_item(259,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Soul Bow Head<br>";
					break;
					case 5:
					add_item(258,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Dragon Slayer Head<br>";
					break;
					case 6:
					add_item(257,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Mother Tree Head<br>";
					break;
					case 7:
					add_item(256,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Dark Legion Head<br>";
					break;
					case 8:
					add_item(293,$weapMat,$mision['idCuenta']);
					$moar .= $weapMat." Soul Separator Head<br>";
					break;
				}
				$msg .= "<div class='questDrop'>".$targets['nombre']." got ".$moar." and A Materials!</div>";
}
else
	die("GTFO!");
?>
