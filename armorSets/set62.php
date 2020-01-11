<?php
//set heal
if($idArmor==386 OR $pj['ManipulatorRing'])
$part++;
if($idHead==385 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==384 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==383 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Ireal";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
		$pj['Ataque']+=100;
		$pj['dobleFlechas'] = 1;		
}
if($part>=3)
{
$pj['Ataque']+=200;
$pj['Critico']+=5;
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['hitandrunCd'] = 1;	
}
if($part>=4)
{
		$pj['Ataque']+=300;
		$pj['Critico']+=5;
		$potenciarAtaque+=15;
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
}
?>
