<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==172 AND $idGloves==199 AND $idFoot==226)
{
	$pj['SET_UP'][$setOrdId]['nombre']="Tallum Leather";
		$pj['SET_UP'][$setOrdId]['img']="light/TallumLeatherArmor.jpg";
	
	$pj['Ataque']+=40;
	$pj['ManaLimit']+= 500;
	
	if($Wtipo=="bow")
		$pj['Ataque']+=35;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
