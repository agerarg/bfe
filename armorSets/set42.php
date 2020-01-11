<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==173 AND $idGloves==201 AND $idFoot==228)
{
	
	$pj['SET_UP'][$setOrdId]['nombre']="Majestic Robe";
	$pj['SET_UP'][$setOrdId]['img']="robe/MajesticRobe.jpg";
	$pj['CSpeed']-=4;
	$pj['CriticoMagico']+=5;
	$pj['ManaLimit']+=1000;
	$pj['AtaqueMagico']+=80;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
