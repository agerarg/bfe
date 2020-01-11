<?php
switch($aura['nivel'])
{
	case 1:
		$pj['Ataque']+=25;
		$pj['Critico']+=10;
	break;
	case 2:
		$pj['Ataque']+=50;
		$pj['Critico']+=15;
	break;
}

?>
