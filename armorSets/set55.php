<?php
if($idHead==357 AND $idGloves==356 AND $idFoot==355 OR $pj['ManipulatorRing'])
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Tankoso";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
	
	$pj['PSpeed']-=1;
	$pj['VidaLimit']+=2000;
	$pj['Defensa']+=300;
	if($Wtipo=="blunt")
		$pj['Ataque']+= 200;

}
?>
