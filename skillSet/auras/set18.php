<?php
//Soul Capsule
switch($aura['nivel'])
{
	case 1:
		$pj['VidaLimit'] += intval($pj['soulAcumulate']*2);
	break;
	case 2:
		$pj['VidaLimit'] += intval($pj['soulAcumulate']*4);
	break;
}
?>
