<?php
//set heal
if($idArmor==354 OR $pj['ManipulatorRing'])
$part++;
if($idHead==353 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==352 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==351 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Mad Zombie";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		$pj['VidaLimit']+=2000;
		$pj['Defensa']+=200;
		$pj['DefensaMagica']+=200;
	$pj['MortalStrikeCd']=1;
}
if($part>=3)
{
	$pj['VidaLimit']+=2000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['Ataque']=potenciar($pj['Ataque'],$pj['return']);
}
if($part>=4)
{
	$pj['VidaLimit']+=2000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['MortalStrikeDmg']+=125;
}
?>
