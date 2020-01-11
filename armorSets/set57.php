<?php
if($idHead==365 AND $idGloves==364 AND $idFoot==363 OR $pj['ManipulatorRing'])
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Destructor";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=125;
		$pj['Ataque']+=150;
		$pj['PSpeed']-=2;
		if($Wtipo=="bigsword")
		$pj['Critico'] += 8;
}
?>
