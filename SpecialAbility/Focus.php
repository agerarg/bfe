<?php
//Special Ability
	switch($item['grado'])
	{
		case 3:
		case 4:
			$criticalBonus+=5;
		break;
		case 5:
		case 6:
			$criticalBonus+=8;
		break;
		case 7:
			$criticalBonus+=10;
		break;
		case 8:
			$criticalBonus+=13;
			$pj['Ataque']+=70;
		break;
		case 9:
			$criticalBonus+=15;
			$pj['Ataque']+=80;
		break;
		case 10:
			$criticalBonus+=15;
			$pj['Ataque']+=100;
		break;
			case 11:
			$criticalBonus+=15;
			$pj['Ataque']+=200;
		break;
			case 12:
			$criticalBonus+=15;
			$pj['Ataque']+=300;
		break;
	}
?>
