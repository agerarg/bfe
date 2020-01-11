<?php
switch($aura['nivel'])
	{
		case 1:
			$pj['HpRegen']+=5;
			$pj['MpRegen']+=5;
		break;
		case 2:
			$pj['HpRegen']+=10;
			$pj['MpRegen']+=10;
		break;
		case 3:
			$pj['HpRegen']+=15;
			$pj['MpRegen']+=15;
		break;
		case 4:
			$pj['HpRegen']+=20;
			$pj['MpRegen']+=20;
		break;
		case 5:
			$pj['HpRegen']+=25;
			$pj['MpRegen']+=25;	
		break;
		case 6:
			$pj['HpRegen']+=30;
			$pj['MpRegen']+=30;
		break;
		case 7:
			$pj['HpRegen']+=35;
			$pj['MpRegen']+=35;
		break;
		case 8:
			$pj['HpRegen']+=40;
			$pj['MpRegen']+=40;
		break;
		case 9:
			$pj['HpRegen']+=50;
			$pj['MpRegen']+=50;
		break;
	}
?>
