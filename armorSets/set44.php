<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==177 AND $idGloves==202 AND $idFoot==229 OR $pj['ManipulatorRing'])
{
	
	$pj['SET_UP'][$setOrdId]['nombre']="Major Arcana";
	$pj['SET_UP'][$setOrdId]['img']="robe/MajorArcanaRobe.jpg";
	
	$pj['ManaLimit']+=1000;
	$pj['AtaqueMagico']+=150;
	$pj['CSpeed']-=4;
	$pj['CriticoMagico']+=5;
	
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
