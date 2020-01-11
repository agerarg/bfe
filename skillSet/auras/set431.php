<?php
switch($aura['nivel'])
{
	case 1:
		$pj['Ataque']=potenciar($pj['Ataque'],5);
	break;
	case 2:
		$pj['Ataque']=potenciar($pj['Ataque'],10);
	break;
	case 3:
		$pj['Ataque']=potenciar($pj['Ataque'],15);
	break;
}

?>
