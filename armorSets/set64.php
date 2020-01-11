<?php
//set heal
if($idArmor==394 OR $pj['ManipulatorRing'])
$part++;
if($idHead==393 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==392 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==391 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Integra";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
	
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
		$pj['PSpeed']-=2;
}
if($part>=3)
{
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	       $pj['Ataque']+=250;
               $pj['AtaqueMagico']+=250;
}
if($part>=4)
{
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	        $pj['BloodBlastDmg']+=50;
}
?>
