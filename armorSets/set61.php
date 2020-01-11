<?php
if($idHead==381 AND $idGloves==380 AND $idFoot==379 OR $pj['ManipulatorRing'])
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Assassin";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
	
	if($Wtipo=="dagger" OR $Wtipo=="dual")
		$pj['PC']+=15;		
  $pj['Ataque']+=150;
  $pj['Critico']+=8;
  $pj['PSpeed']-=3;
}

?>
