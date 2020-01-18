<?php
if($cascoAstral==1 AND $guantesAstrales==1 AND $botasAstrales==1)
{
		$pj['SET_UP'][$setOrdId]['nombre']="Astral Heavy";
		$pj['SET_UP'][$setOrdId]['img']="heavy/astralHeavy.jpg";
		$pj['VidaLimit']+=15000;
		$pj['Defensa']+=700;
		$pj['DefensaMagica']+=900;
	    $pj['PSpeed']-=2;
		$pj['Ataque']+=450;
		$pj['Critico']+=25;
		$pj['PC']+=60;
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
