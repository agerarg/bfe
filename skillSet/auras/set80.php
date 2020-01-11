<?php
//
switch($aura['nivel'])
{
	case 1:
		$pj['VidaLimit']=potenciar($pj['VidaLimit'],80);	
		
		$pj['Ataque']=potenciar($pj['Ataque'],40);	
		$pj['AtaqueMagico']=potenciar($pj['AtaqueMagico'],40);	
		
		$pj['Defensa']=potenciar($pj['Defensa'],40);	
		$pj['DefensaMagica']=potenciar($pj['DefensaMagica'],40);	
		
		$pj['Critico']+=15;	
		$pj['CriticoMagico']+=15;
		
		$pj['PSpeed']-=1;
		$pj['CSpeed']-=1;
	break;
}


?>
