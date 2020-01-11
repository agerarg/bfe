<?php
//set Solador
if($idHead==622 AND $idGloves==621 AND $idFoot==620)
{
		$pj['SET_UP'][$setOrdId]['nombre']="Solador Heavy";
		$pj['SET_UP'][$setOrdId]['img']="heavy/zheavy.jpg";
		
		$pj['VidaLimit']+=10000;
		$pj['Defensa']+=600;
		$pj['DefensaMagica']+=800;
	    $pj['PSpeed']-=1;
		$pj['Ataque']+=350;
		$pj['Critico']+=10;
		$pj['PC']+=30;
}
?>
