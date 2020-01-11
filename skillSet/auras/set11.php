<?php
//Revive
switch($aura['nivel'])
{
	case 1:
		$pj['VidaLimit'] = $pj['VidaLimit']+intval($pj['VidaLimit']*1.2);
		$stats['VidaLimit'] = $pj['VidaLimit'];	
	break;
}
?>
