<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==170 AND $idGloves==197 AND $idFoot==222)
{
	
	$pj['SET_UP'][$setOrdId]['nombre']="Blue Wolf Tunic";
	$pj['SET_UP'][$setOrdId]['img']="robe/BlueWolfTunic.jpg";
	
	$pj['CSpeed']-=3;
	$pj['ManaLimit']+=800;
	$pj['AtaqueMagico'] +=10;
	if($Wtipo=="bigblunt")
	{
		$pj['CriticoMagico']+=5;
		$pj['CSpeed']-=1;
	}
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
