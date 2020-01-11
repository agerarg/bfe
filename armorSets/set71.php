<?php
//set Solador
if($idHead==622 AND $idGloves==621 AND $idFoot==620)
{
		$pj['SET_UP'][$setOrdId]['nombre']="Solador Robe";
		$pj['SET_UP'][$setOrdId]['img']="robe/zrobe.jpg";
		$pj['VidaLimit']+=10000;
		$pj['Defensa']+=600;
		$pj['DefensaMagica']+=800;
	    $pj['CSpeed']-= 5;
		$pj['AtaqueMagico']+=350;
		$pj['CriticoMagico']+=10;
}
?>
