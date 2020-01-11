<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==172 AND $idGloves==199 AND $idFoot==226)
{

	$pj['SET_UP'][$setOrdId]['nombre']="Tallum Plate";
	$pj['SET_UP'][$setOrdId]['img']="heavy/TallumPlateArmor.jpg";
	
	$pj['VidaLimit']+=500;
	$pj['Ataque']+=30;
	$pj['Defensa']+=15;
	$pj['PSpeed']-=2;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
