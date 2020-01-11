<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==174 AND $idGloves==200 AND $idFoot==227)
{
	$pj['SET_UP'][$setOrdId]['nombre']="Nightmare Robe";
	$pj['SET_UP'][$setOrdId]['img']="robe/NightmareRobe.jpg";
	
	$pj['CSpeed']-=4;
	$pj['AtaqueMagico']+=125;
	
	
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
