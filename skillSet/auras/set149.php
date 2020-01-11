<?php
switch($aura['nivel'])
	{
		case 1:
			$pj['Ataque'] = potenciar($pj['Ataque'],2);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],2);		
		break;
		case 2:
			$pj['Ataque'] = potenciar($pj['Ataque'],4);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],4);		
		break;
		case 3:
			$pj['Ataque'] = potenciar($pj['Ataque'],6);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],6);		
		break;
		case 4:
			$pj['Ataque'] = potenciar($pj['Ataque'],8);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],8);		
		break;
		case 5:
			$pj['Ataque'] = potenciar($pj['Ataque'],10);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],10);		
		break;
		case 6:
			$pj['Ataque'] = potenciar($pj['Ataque'],12);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],12);		
		break;
		case 7:
			$pj['Ataque'] = potenciar($pj['Ataque'],14);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],14);		
		break;
		case 8:
			$pj['Ataque'] = potenciar($pj['Ataque'],16);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],16);		
		break;
		case 9:
			$pj['Ataque'] = potenciar($pj['Ataque'],20);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],20);		
		break;
	}
$pj['Ataque']+= $aura['acumuleitor'];
$pj['AtaqueMagico']+= $aura['acumuleitor'];
?>
