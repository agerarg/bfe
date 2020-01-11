<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==170 AND $idGloves==197 AND $idFoot==222)
{
	$pj['SET_UP'][$setOrdId]['nombre']="Blue Wolf Heavy";
	$pj['SET_UP'][$setOrdId]['img']="heavy/BlueWolfBreastplate.jpg";
	
	$pj['PSpeed']-=1;
	
	$pj['Ataque']+=30;
	$pj['Critico']+=8;
	if($Wtipo=="bigsowrd")
		$pj['Ataque'] += 8;
	
	/*if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
