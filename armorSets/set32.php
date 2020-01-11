<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==171 AND $idGloves==198 AND $idFoot==225)
{

	$pj['SET_UP'][$setOrdId]['nombre']="Dark Crystal Robe";
	$pj['SET_UP'][$setOrdId]['img']="robe/DarkCrystalRobe.jpg";
	
	$pj['CSpeed']-=2;
	$pj['AtaqueMagico'] +=50;
	if($idShield==96)
		$pj['CSpeed'] -= 2;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
