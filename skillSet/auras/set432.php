<?php
switch($aura['nivel'])
{
	case 1:
		$pj['Defensa']=potenciar($pj['Defensa'],20);
	break;
	case 2:
		$pj['Defensa']=potenciar($pj['Defensa'],40);
	break;
	case 3:
		$pj['Defensa']=potenciar($pj['Defensa'],60);
	break;
}

?>
