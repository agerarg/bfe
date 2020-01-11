<?php
switch($aura['nivel'])
{
	case 1:
		$pj['VidaLimit']=potenciar($pj['VidaLimit'],20);
	break;
	case 2:
		$pj['VidaLimit']=potenciar($pj['VidaLimit'],40);
	break;
	case 3:
		$pj['VidaLimit']=potenciar($pj['VidaLimit'],60);
	break;
}

?>
