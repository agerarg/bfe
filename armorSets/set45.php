<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==176 AND $idGloves==203 AND $idFoot==230 OR $pj['ManipulatorRing'])
{
	$pj['SET_UP'][$setOrdId]['nombre']="Draconic Leather";
	$pj['SET_UP'][$setOrdId]['img']="light/DraconicLeatherArmor.jpg";
	$pj['ManaLimit'] +=1000;
	$pj['Ataque']+=100;
	$pj['PSpeed']-=3;
	$pj['Critico']+=5;
	if($Wtipo=="bow")
		$pj['Ataque']+=30;
		
	if($Wtipo=="dagger" OR $Wtipo=="dual")
		$pj['PC']+=15;
}
?>
