<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==175 AND $idGloves==204 AND $idFoot==231 OR $pj['ManipulatorRing'])
{
	$pj['SET_UP'][$setOrdId]['nombre']="Imperial Crusader";
	$pj['SET_UP'][$setOrdId]['img']="heavy/ImperialCrusaderBreastplate.jpg";
	
	$pj['VidaLimit']+=1000;
	$pj['PSpeed']-=1;
	$pj['Defensa']+=100;
	if($idShield==98)
	{
		$pj['Defensa']+=50;
		$pj['DefensaMagica']+=100;
	}
	else
	{
		$pj['Ataque']+=100;
		$pj['PSpeed']-=1;
	}
	/*
	if($Wtipo=="blunt")
		$pj['Ataque'] = potenciar($pj['Ataque'],8);
	if($idShield = 92)
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],10);
		*/
}
?>
