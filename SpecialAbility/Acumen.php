<?php
//Special Ability
	switch($item['grado'])
	{
		case 3:
		case 4:
			$CastSpeedBonus+= 1;
		break;
		case 5:
		case 6:
			$CastSpeedBonus+= 2;
		break;
		case 7:
			$CastSpeedBonus+= 2;
			$pj['AtaqueMagico']+=20;
		break;
		case 8:
			$CastSpeedBonus+= 2;
			$pj['AtaqueMagico']+=50;
		break;
			case 9:
			$CastSpeedBonus+= 2;
			$pj['AtaqueMagico']+=75;
		break;
			case 10:
			$CastSpeedBonus+= 2;
			$pj['AtaqueMagico']+=150;
		break;
		case 11:
			$CastSpeedBonus+= 2;
			$pj['AtaqueMagico']+=200;
		break;
		case 12:
			$CastSpeedBonus+= 2;
			$pj['AtaqueMagico']+=250;
		break;
	}
?>
