<?php
//set Invoker
if($idHead==337 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==336 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==335 OR $pj['ManipulatorRing'])
$part++;
if($idArmor==338 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{
		$pj['SET_UP'][$setOrdId]['nombre']="Invoker";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
		
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
		
                $pj['CSpeed']-=1;
		$pj['AtaqueMagico']+=50;
               $pj['CriticoMagico']+=1;
}
if($part>=3)
{
               $pj['CriticoMagico']+=2;
               $pj['CSpeed']-=2;
		$pj['VidaLimit']+=1000;
                $pj['AtaqueMagico']+=50;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=50;
	       $pj['noFaith']=1;
}
if($part>=4)
{
               $pj['CriticoMagico']+=2;
               $pj['CSpeed']-=2;
                $pj['AtaqueMagico']+=50;
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=50;
	        $pj['SmiteDmg']+=100;
}
?>
