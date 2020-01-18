<?php
if($cascoAstral==1 AND $guantesAstrales==1 AND $botasAstrales==1)
{
		$pj['SET_UP'][$setOrdId]['nombre']="Astral Light";
		$pj['SET_UP'][$setOrdId]['img']="light/astralLight.jpg";
	$pj['VidaLimit']+=15000;
		$pj['Defensa']+=700;
		$pj['DefensaMagica']+=900;
	    $pj['PSpeed']-=5;
		$pj['Ataque']+=500;
		$pj['Critico']+=20;
		$pj['PC']+=150;
		$pj['ResistLimit']+=1;
		$item['extraLevel']=10;
		if(file_exists("runasSet/runa".$pj['armor_bonusRuna1'].".php"))
							@include("runasSet/runa".$pj['armor_bonusRuna1'].".php");
						else
							@include("../runasSet/runa".$pj['armor_bonusRuna1'].".php");

		if(file_exists("runasSet/runa".$pj['armor_bonusRuna2'].".php"))
							@include("runasSet/runa".$pj['armor_bonusRuna2'].".php");
						else
							@include("../runasSet/runa".$pj['armor_bonusRuna2'].".php");

		if($armaAstral==1)
		{
			$pj['ArmaAstralOn']=1;
		}	
}
?>
