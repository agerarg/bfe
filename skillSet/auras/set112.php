<?php
	switch($aura['nivel'])
	{
		case 1:
			$pj['VidaLimit']+= $pj['Ataque'];
		break;
		case 2:
			$pj['VidaLimit']+= $pj['Ataque']*2;
		break;
		case 3:
			$pj['VidaLimit']+= $pj['Ataque']*3;
		break;
	}
?>
