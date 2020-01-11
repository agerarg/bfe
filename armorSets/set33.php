<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==171 AND $idGloves==198 AND $idFoot==225)
{
	$pj['SET_UP'][$setOrdId]['nombre']="Dark Crystal Heavy";
	$pj['SET_UP'][$setOrdId]['img']="heavy/DarkCrystalBreastplate.jpg";
	
	$pj['Defensa']+=50;
	$pj['VidaLimit']+= 800;
	if($idShield = 96)
			$pj['ShieldRate']+=25;
	if($Wtipo=="blunt")
		$pj['Ataque']+=45;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
