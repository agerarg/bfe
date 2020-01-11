<?php
//set Radamane
if($idHead==435 AND $idGloves==436 AND $idFoot==437 OR $pj['ManipulatorRing'])
{
		$pj['SET_UP'][$setOrdId]['nombre']="Radamante Light";
		$pj['SET_UP'][$setOrdId]['img']="light/alienlight.jpg";
		$pj['ManaLimit']+=1000;
		$pj['Defensa']+=100;
	    $pj['PSpeed']-=3;
		$pj['Ataque']+=250;
		$pj['Critico']+=5;
		$pj['PC']+=15;
}
?>
