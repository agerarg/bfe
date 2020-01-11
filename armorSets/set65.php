<?php
//set heal
if($idArmor==398 OR $pj['ManipulatorRing'])
$part++;
if($idHead==397 OR $pj['ManipulatorRing'])
$part++;
if($idGloves==396 OR $pj['ManipulatorRing'])
$part++;
if($idFoot==395 OR $pj['ManipulatorRing'])
$part++;

if($part>=2)
{
	
		$pj['SET_UP'][$setOrdId]['nombre']="Blood Lord";
		$pj['SET_UP'][$setOrdId]['img']="head/infernalhead.jpg";
	
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
}
if($part>=3)
{
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	        $pj['bloodyComboCd']=1;
}
if($part>=4)
{
		$pj['VidaLimit']+=1000;
		$pj['Defensa']+=100;
		$pj['DefensaMagica']+=100;
	        $pj['BloodLordDuration']=1;
}
?>
