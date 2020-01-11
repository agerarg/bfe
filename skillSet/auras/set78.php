<?php
//
switch($aura['nivel'])
{
	case 1:
		$pj['Defensa']=potenciar($pj['Defensa'],15);	
		$pj['DefensaMagica']=potenciar($pj['DefensaMagica'],15);	
	break;
	case 2:
		$pj['Defensa']=potenciar($pj['Defensa'],20);	
		$pj['DefensaMagica']=potenciar($pj['DefensaMagica'],20);	
	break;
	case 3:
		$pj['Defensa']=potenciar($pj['Defensa'],25);	
		$pj['DefensaMagica']=potenciar($pj['DefensaMagica'],25);	
	break;
}


?>
