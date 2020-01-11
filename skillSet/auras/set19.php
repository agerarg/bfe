<?php
//Soul Capsule
switch($aura['nivel'])
{
	case 1:
		$pj['AtaqueMagico'] += intval($pj['soulAcumulate']*10);
              
	break;
	case 2:
		$pj['AtaqueMagico'] += intval($pj['soulAcumulate']*50);
	break;
}

?>
