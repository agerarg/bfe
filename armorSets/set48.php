<?php
//Armor Set hell light
if($idHead==324 AND $idGloves==323 AND $idFoot==322 OR $pj['ManipulatorRing'])
{
	$pj['VidaLimit']+=1000;
	$pj['Ataque']+=200;
	
	$pj['SET_UP'][$setOrdId]['nombre']="Infernal Light";
	$pj['SET_UP'][$setOrdId]['img']="light/InfernalLight.jpg";
	
	$pj['PC']+=35;
	$pj['VampireStance']+=100;
	$pj['mStrikeShitOn']=1;
	$pj['manaHealStr']+=100;
}
?>
