<?php
//Special Ability
	switch($item['grado'])
	{
		case 3:
		case 4:
			$bonusCriticoMagico+= 5;
		break;
		case 5:
		case 6:
			$bonusCriticoMagico+= 8;
		break;
		case 7:
			$bonusCriticoMagico+= 10;
		break;
		case 8:
			$bonusCriticoMagico+= 13;
		break;
		case 9:
			$bonusCriticoMagico+= 15;
		break;
		case 10:
			$bonusCriticoMagico+= 16;
		break;
		case 11:
			$bonusCriticoMagico+= 17;
		break;
		case 12:
			$bonusCriticoMagico+= 18;
		break;
	}
?>
