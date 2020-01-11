<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==173 AND $idGloves==201 AND $idFoot==228)
{
	
	$pj['SET_UP'][$setOrdId]['nombre']="Majestic Plate";
	$pj['SET_UP'][$setOrdId]['img']="heavy/MajesticPlateArmor.jpg";
	
	$pj['PSpeed']-=2;
	
	$pj['VidaLimit']+= 250;
	
	$pj['Ataque']+=20;
	$pj['Defensa']+=50;
	if($Wtipo=="bigsword")
		$pj['Critico']+=8;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
