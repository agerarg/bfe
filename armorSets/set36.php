<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==172 AND $idGloves==199 AND $idFoot==226)
{

	$pj['SET_UP'][$setOrdId]['nombre']="Tallum Tunic";
	$pj['SET_UP'][$setOrdId]['img']="robe/TallumTunic.jpg";
	
	$pj['AtaqueMagico']+=35;
	$pj['ManaLimit'] += 500;
	$pj['CSpeed']-=4;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
