<?php
//Soul Capsule
switch($aura['nivel'])
{
	case 1:
		$pj['ManaLimit'] += intval($pj['soulAcumulate']*1.5);
	break;
	case 2:
		$pj['ManaLimit'] += intval($pj['soulAcumulate']*3);
	break;
}
?>
