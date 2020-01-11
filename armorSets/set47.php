<?php
//Armor Set hell heavy
if($idHead==324 AND $idGloves==323 AND $idFoot==322 OR $pj['ManipulatorRing'])
{
	$pj['SET_UP'][$setOrdId]['nombre']="Infernal Heavy";
	$pj['SET_UP'][$setOrdId]['img']="heavy/Infernalheavy.jpg";
	
	$pj['VidaLimit']+=2500;
	$pj['PSpeed']-=2;
	$pj['Defensa']+=200;
	
	$pj['Ataque']+=125;
	
	$pj['VampireStance']+=100;
}
?>
