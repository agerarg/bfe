<?php
//set Radamane
if($idHead==435 AND $idGloves==436 AND $idFoot==437 OR $pj['ManipulatorRing'])
{
		$pj['SET_UP'][$setOrdId]['nombre']="Radamante Robe";
		$pj['SET_UP'][$setOrdId]['img']="heavy/alienheavy.jpg";
		
		$pj['VidaLimit']+=2000;
		$pj['Defensa']+=300;
		$pj['DefensaMagica']+=800;
	    $pj['PSpeed']-=3;
		$pj['Ataque']+=200;
		$pj['Critico']+=8;
		$pj['PC']+=15;
}
?>
