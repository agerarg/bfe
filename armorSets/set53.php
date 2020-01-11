<?php
//set heal
if($idHead==349 AND $idGloves==348 AND $idFoot==347 OR $pj['ManipulatorRing'])
{
		$pj['SET_UP'][$setOrdId]['nombre']="Fulminar";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
	    
        $pj['CSpeed']-=4;
		$pj['AtaqueMagico']+=200;
        $pj['CriticoMagico']+=5;
		if($Wtipo=="blunt")
			$pj['AtaqueMagico']+= 50;
}
?>
