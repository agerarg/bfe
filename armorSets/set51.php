<?php
//set heal
if($idArmor==342 OR $pj['ManipulatorRing'])
$part++;
if($idHead==341 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==340 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==339 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{

		$pj['SET_UP'][$setOrdId]['nombre']="Heal";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
	$pj['groupHealCd']=1;
	
	$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	 $pj['CSpeed']-=1;
		$pj['AtaqueMagico']+=50;
               $pj['CriticoMagico']+=1;
}
if($part>=3)
{
        $pj['CSpeed']-=2;
		$pj['AtaqueMagico']+=50;
               $pj['CriticoMagico']+=2;

	$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['miracleCd']=1;
}
if($part>=4)
{
       $pj['CSpeed']-=2;
		$pj['AtaqueMagico']+=50;
               $pj['CriticoMagico']+=2;

	$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	$pj['DDHeal']=1;
}
?>
