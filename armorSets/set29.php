<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==170 AND $idGloves==197 AND $idFoot==222)
{
	$pj['SET_UP'][$setOrdId]['nombre']="Blue Wolf Leather";
	$pj['SET_UP'][$setOrdId]['img']="light/BlueWolfLeatherArmor.jpg";
	
	$pj['PSpeed']-=2;
	$pj['ManaLimit'] +=500;
	$pj['Ataque']+=30;
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
