<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==168 AND $idGloves==194 AND $idFoot==223)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Avadon Leather";
		$pj['SET_UP'][$setOrdId]['img']="light/AvadonLeatherArmor.jpg";
	
	
	$pj['PSpeed']-=1;
	$pj['ManaLimit']+=250;
	if($Wtipo=="bow")
		$pj['Ataque']+=25;
	$pj['EXPBONUS']+=25;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
