<?php
//Special Ability
	switch($item['grado'])
	{
		case 3:
		case 4:
			$mataque+= 70;
		break;
		case 5:
		case 6:
			$mataque+= 100;
			$pj['CriticoMagico']+=1;
		break;
		case 7:
			$mataque+= 150;
			$pj['CriticoMagico']+=2;
		break;
		case 8:
			$mataque+= 200;
			$pj['CriticoMagico']+=3;
		break;
		case 9:
			$mataque+= 250;
			$pj['CriticoMagico']+=4;
		break;
		case 10:
			$mataque+= 300;
			$pj['CriticoMagico']+=5;
		break;
		case 11:
			$mataque+= 400;
			$pj['CriticoMagico']+=5;
		break;
		case 12:
			$mataque+= 500;
			$pj['CriticoMagico']+=5;
		break;
	}
?>
