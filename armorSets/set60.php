<?php
//set heal
if($idArmor==378 OR $pj['ManipulatorRing'])
$part++;
if($idHead==377 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==376 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==375 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Hexxa";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['interruptCd'] = 1;
$pj['Ataque']+=100;
$pj['Critico']+=5;
$pj['PSpeed']-=1;
}
if($part>=3)
{
$pj['PSpeed']-=1;
$pj['Critico']+=5;
$pj['Ataque']+=200;
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['DestructorBlowCd'] = 1;
	$pj['NinjitsuCd'] = 1;
}
if($part>=4)
{
                $pj['PSpeed']-=1;
                $pj['Critico']+=5;
                $pj['Ataque']+=200;
                 $pj['removeBreak'] = 1;
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
}
?>
