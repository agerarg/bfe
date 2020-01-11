<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==169 AND $idGloves==196 AND $idFoot==221)
{
	$pj['SET_UP'][$setOrdId]['nombre']="Doom Leather";
	$pj['SET_UP'][$setOrdId]['img']="light/LeatherArmorOfDoom.jpg";
	
	$pj['Ataque'] +=40;
	$pj['Critico']+=5;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
