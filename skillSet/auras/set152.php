<?php
switch($aura['nivel'])
	{
		case 1:
			$pj['Ataque']+=15;
			$pj['AtaqueMagico']+=15;
		break;
		case 2:
			$pj['Ataque']+=30;
			$pj['AtaqueMagico']+=30;
		break;
		case 3:
			$pj['Ataque']+=50;
			$pj['AtaqueMagico']+=50;
		break;
	}
?>
