<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==174 AND $idGloves==200 AND $idFoot==227)
{
	$pj['SET_UP'][$setOrdId]['nombre']="Armor Of Nightmare";
	$pj['SET_UP'][$setOrdId]['img']="heavy/ArmorOfNightmare.jpg";
	
	$pj['VidaLimit']+= 1000;
	
	$pj['Defensa']+=80;
	
	if($idShield == 97)
			$pj['ShieldRate']+=25;
	if($Wtipo=="blunt")
		$pj['Ataque']+=65;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
