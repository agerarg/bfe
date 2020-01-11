<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==156 AND $idGloves==182 AND $idFoot==209)
{
	
	
		$pj['SET_UP'][$setOrdId]['nombre']="Brigandine";
		$pj['SET_UP'][$setOrdId]['img']="heavy/BrigandineTunic.jpg";
	
	$pj['Defensa'] += 15;
	
	if($idShield == 90)
	$pj['VidaLimit']+= 100;
}
?>
