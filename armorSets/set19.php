<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==168 AND $idGloves==194 AND $idFoot==223)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Avadon Robe";
		$pj['SET_UP'][$setOrdId]['img']="robe/AvadonRobe.jpg";
	
	
	$pj['CSpeed']-=4;
	if($idShield==94)
		$pj['AtaqueMagico']+=10;

	$pj['EXPBONUS']+=25;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
