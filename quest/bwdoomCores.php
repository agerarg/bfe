<?php
if($mision['idMisionOn'])
{

	$msg = "<div class='questEnd'>Blue Wolf & Doom Quest Completed!</div>";
	
			$weapMat = mt_rand(1,15);
			$whats = mt_rand(1,2);

				switch($whats)
				{
					case 1:
						add_item(273,$weapMat,$mision['idCuenta']);
						$moar = $weapMat." Blue Wolf Core";
					break;
					case 2:
						add_item(272,$weapMat,$mision['idCuenta']);
						$moar = $weapMat." Doom Core";
					break;
				}
				$msg = "<div class='questDrop'>".$mision['PJnombre']." got ".$moar."!</div>";

	
}
else
	die("GTFO!");
?>