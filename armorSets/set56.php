<?php
//set heal
if($idArmor==362 OR $pj['ManipulatorRing'])
$part++;
if($idHead==361 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==360 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==359 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Cabron";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['BladesCd'] = 1;
}
if($part>=3)
{
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['BladesEnchant'] = 1;
}
if($part>=4)
{
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['RampageCd'] = 1;
	$pj['ActivateCd'] = 1;
}
?>
