<?php
//
switch($aura['nivel'])
{
	case 1:
		$pj['VidaLimit']=potenciar($pj['VidaLimit'],200);	
		
		$pj['Ataque']=potenciar($pj['Ataque'],60);	
		$pj['AtaqueMagico']=potenciar($pj['AtaqueMagico'],60);	
		
		$pj['Defensa']=potenciar($pj['Defensa'],50);	
		$pj['DefensaMagica']=potenciar($pj['DefensaMagica'],50);	
		
		$pj['Critico']+=20;	
		$pj['CriticoMagico']+=20;
		
		$pj['PSpeed']-=1;
		$pj['CSpeed']-=1;
	break;
}
?>
