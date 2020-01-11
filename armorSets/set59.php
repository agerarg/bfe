<?php
//set heal
if($idArmor==374 OR $pj['ManipulatorRing'])
$part++;
if($idHead==373 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==372 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==371 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Warlock";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['pumaTotemsTime'] = 1;
	$pj['ritualTime'] = 1;
        $pj['Ataque']+=50;
}
if($part>=3)
{
$pj['Ataque']+=50;
 $pj['PSpeed']-=1;
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['DarkSpikePhisc'] = 1;
}
if($part>=4)
{
$pj['Ataque']+=50;
 $pj['PSpeed']-=1;
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['DarkSpikeCd'] = 1;
	$pj['StunStrikeCd'] = 1;
}
?>
