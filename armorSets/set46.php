<?php
//Armor Set hell Robe
if($idHead==324 AND $idGloves==323 AND $idFoot==322 OR $pj['ManipulatorRing'])
{
	$pj['SET_UP'][$setOrdId]['nombre']="Infernal Robe";
	$pj['SET_UP'][$setOrdId]['img']="robe/Infernalrobe.jpg";
	$pj['CSpeed']-=4;
	$pj['AtaqueMagico']+=125;
	$pj['ManaLimit']+=500;
	$pj['VidaLimit']+=1000;
	
}
?>
