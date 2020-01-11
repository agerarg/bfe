<?php
//set Radamane
if($idHead==435 AND $idGloves==436 AND $idFoot==437 OR $pj['ManipulatorRing'])
{
		$pj['SET_UP'][$setOrdId]['nombre']="Radamante Robe";
		$pj['SET_UP'][$setOrdId]['img']="robe/alienrobe.jpg";
		$pj['ManaLimit']+=2000;
		$pj['Defensa']+=100;
	    $pj['CSpeed']-= 4;
		$pj['AtaqueMagico']+=250;
		$pj['CriticoMagico']+=5;
}
?>
