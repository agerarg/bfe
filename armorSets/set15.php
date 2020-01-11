<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==164 AND $idGloves==193 AND $idFoot==220)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Chain Mail";
		$pj['SET_UP'][$setOrdId]['img']="heavy/ChainMailShirt.jpg";
	
	
	$pj['Defensa']+=20;
	
	if($idShield = 91)
		$pj['VidaLimit']+=200;
}
?>
