<?php
if($idHead==369 AND $idGloves==368 AND $idFoot==367 OR $pj['ManipulatorRing'])
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Voodoo";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['dark']+=15;
	$pj['totemsCd'] = 1;
$pj['CSpeed']-=1;
		$pj['AtaqueMagico']+=50;
               $pj['CriticoMagico']+=1;
}
?>
