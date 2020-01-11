<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==168 AND $idGloves==194 AND $idFoot==223)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Avadon Heavy";
		$pj['SET_UP'][$setOrdId]['img']="heavy/AvadonBreastplate.jpg";
	
	$pj['Defensa']+=20;
	$pj['VidaLimit']+=300;
	if($Wtipo=="blunt")
		$pj['Ataque']+=25;
	if($idShield==94)
		$pj['Defensa']+=5;

	$pj['EXPBONUS']+=25;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
