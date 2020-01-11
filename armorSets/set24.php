<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==167 AND $idGloves==195 AND $idFoot==224)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Zubei Heavy";
		$pj['SET_UP'][$setOrdId]['img']="heavy/ZubeiBreastplate.jpg";
	
	$pj['PSpeed']-=1;
	$pj['Ataque']+=10;
	
	if($Wtipo=="bigsword")
		$pj['Critico'] += 5;
	$pj['GOLDBONUS']+=25;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
