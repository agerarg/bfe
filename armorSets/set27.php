<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==169 AND $idGloves==196 AND $idFoot==221)
{
	
	$pj['SET_UP'][$setOrdId]['nombre']="Doom Plate";
	$pj['SET_UP'][$setOrdId]['img']="heavy/DoomPlateArmor.jpg";
	
	$pj['VidaLimit'] += 500;	
	$pj['Defensa']+=30;
	if($Wtipo=="blunt")
		$pj['Ataque']+=35;
	if($idShield==95)
		$pj['ShieldRate']+=25;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
