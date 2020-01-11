<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==162 AND $idGloves==188 AND $idFoot==215)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Theca";
		$pj['SET_UP'][$setOrdId]['img']="light/ThecaLeatherArmor.jpg";
	
	
	$pj['PSpeed']-=1;
	$pj['Ataque'] += 15;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
