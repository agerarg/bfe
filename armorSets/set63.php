<?php
if($idHead==389 AND $idGloves==388 AND $idFoot==387 OR $pj['ManipulatorRing'])
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Maurulio";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		$pj['ManaLimit']+=1000;
		$pj['Ataque']+=165;
		if($Wtipo=="bow")
			$pj['Ataque']+=35;
}
?>
