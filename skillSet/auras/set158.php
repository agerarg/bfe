<?php
switch($aura['nivel'])
	{
		case 1:
			$pj['VidaLimit']+=200;
		break;
		case 2:
			$pj['VidaLimit']+=500;
		break;
		case 3:
			$pj['VidaLimit']+=1000;
		break;
		case 4:
			$pj['VidaLimit']+=1500;
		break;
		case 5:
			$pj['VidaLimit']+=2000;
		break;
	}
$pj['VidaLimit']+= ($aura['acumuleitor']*25);
?>
