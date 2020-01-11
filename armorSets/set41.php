<?php
//Armor Set potenciar($pj['Defensa'],5);
if($idHead==173 AND $idGloves==201 AND $idFoot==228)
{
	$pj['SET_UP'][$setOrdId]['nombre']="Majestic Leather";
	$pj['SET_UP'][$setOrdId]['img']="light/MajesticLeatherArmor.jpg";
	
	$pj['ManaLimit']+=500;
	$pj['Ataque']+=70;
	if($Wtipo=="bow")
		$pj['Ataque']+=30;
	
}
?>
