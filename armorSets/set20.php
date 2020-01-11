<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==167 AND $idGloves==195 AND $idFoot==224)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Tunic Of Zubeie";
		$pj['SET_UP'][$setOrdId]['img']="robe/TunicOfZubei.jpg";
	
	$pj['CSpeed']-=2;
	$pj['AtaqueMagico']+=25;
	$pj['GOLDBONUS']+=25;
	//$pj['fire'] += 25;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
