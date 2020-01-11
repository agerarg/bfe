<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==157 AND $idGloves==183 AND $idFoot==210)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Mithril";
		$pj['SET_UP'][$setOrdId]['img']="heavy/MithrilBreastplate.jpg";

	
	$pj['Defensa'] += 14;
	if($idShield == 89)
		$pj['VidaLimit']+= 125;
}
?>
