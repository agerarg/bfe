<?php
switch($aura['nivel'])
	{
		case 1:
			$pj['Defensa'] = potenciar($pj['Defensa'],2);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],2);
		break;
		case 2:
			$pj['Defensa'] = potenciar($pj['Defensa'],4);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],4);
		break;
		case 3:
			$pj['Defensa'] = potenciar($pj['Defensa'],8);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],8);
		break;
		case 4:
			$pj['Defensa'] = potenciar($pj['Defensa'],12);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],12);
		break;
		case 5:
			$pj['Defensa'] = potenciar($pj['Defensa'],16);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],16);		
		break;
		case 6:
			$pj['Defensa'] = potenciar($pj['Defensa'],20);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],20);	
		break;
		case 7:
			$pj['Defensa'] = potenciar($pj['Defensa'],24);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],24);	
		break;
		case 8:
			$pj['Defensa'] = potenciar($pj['Defensa'],28);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],28);	
		break;
		case 9:
			$pj['Defensa'] = potenciar($pj['Defensa'],35);
			$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],35);	
		break;
	}
$pj['Defensa']+= $aura['acumuleitor'];
$pj['DefensaMagica']+= $aura['acumuleitor'];
?>
