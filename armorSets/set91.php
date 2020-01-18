<?php
if($cascoAstral==1 AND $guantesAstrales==1 AND $botasAstrales==1)
{
		$pj['SET_UP'][$setOrdId]['nombre']="Astral Robe";
		$pj['SET_UP'][$setOrdId]['img']="robe/astralRobe.jpg";
		$pj['VidaLimit']+=15000;
		$pj['Defensa']+=700;
		$pj['DefensaMagica']+=900;
	    $pj['CSpeed']-= 6;
		$pj['AtaqueMagico']+=450;
		$pj['CriticoMagico']+=20;
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
