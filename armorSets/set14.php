<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==163 AND $idGloves==192 AND $idFoot==219)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Composite";
		$pj['SET_UP'][$setOrdId]['img']="heavy/CompositeArmor.jpg";
		
	$pj['VidaLimit']+=50;
	$pj['Defensa']+=15;
	if($Wtipo=="blunt")
		$pj['Ataque']+=15;
	if($idShield==92)
		$pj['DefensaMagica']+=10;
}
?>
