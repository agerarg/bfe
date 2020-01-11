<?php
//Special Ability
	switch($item['grado'])
	{
		case 3:
		case 4:
			$ataque+= 100;
		break;
		case 5:
		case 6:
			$ataque+= 150;
			$pj['Critico']+=1;
		break;
		case 7:
			$ataque+= 220;
			$pj['Critico']+=2;
		break;
		case 8:
			$ataque+= 300;
			$pj['Critico']+=3;
		break;
		case 9:
			$ataque+= 300;
			$pj['Critico']+=4;
		break;
		case 10:
			$ataque+= 350;
			$pj['Critico']+=5;
		break;
			case 11:
			$ataque+= 400;
			$pj['Critico']+=5;
		break;
			case 12:
			$ataque+= 450;
			$pj['Critico']+=5;
		break;
	}
?>
