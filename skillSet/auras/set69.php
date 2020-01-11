<?php
	switch($aura['nivel'])
	{
		case 1:
			$pj['Ataque']+=15;
			$pj['PC']+=50;
		break;
		case 2:
			$pj['Ataque']+=20;
			$pj['PC']+=150;
		break;
		case 3:
			$pj['Ataque']+=50;
			$pj['PC']+=250;
		break;
	}
?>
