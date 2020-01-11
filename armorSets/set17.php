<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==158 AND $idGloves==184 AND $idFoot==211)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Divine";
		$pj['SET_UP'][$setOrdId]['img']="robe/DivineTunic.jpg";
	
	
	$pj['Defensa'] +=5;
	$pj['CSpeed']-=4;
	
	$pj['ManaLimit']+=250;
	
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
