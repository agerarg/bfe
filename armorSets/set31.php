<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==171 AND $idGloves==198 AND $idFoot==225)
{
	
	$pj['SET_UP'][$setOrdId]['nombre']="Dark Crystal Leather";
	$pj['SET_UP'][$setOrdId]['img']="light/DarkCrystalLeatherArmor.jpg";
	
	$pj['PSpeed']-=2;
	$pj['Ataque']+=50;
	if($Wtipo=="dagger")
		$pj['PC'] += 15;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
