<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==166 AND $idGloves==191 AND $idFoot==218)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Full Plate";
		$pj['SET_UP'][$setOrdId]['img']="heavy/FullPlateArmor.jpg";
	
	
	$pj['PSpeed']-=1;
	
	$pj['VidaLimit']+=250;
	$pj['Ataque'] += 5;
	if($idShield==93)
	{
		$pj['Defensa']+=15;
		$pj['DefensaMagica']+=15;
	}
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
