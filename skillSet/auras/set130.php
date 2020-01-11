<?php
switch($aura['nivel'])
	{
		case 1:
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],($pj['MpRegen']/30));	
		break;
		case 2:
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],($pj['MpRegen']/20));	
		break;
		case 3:
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],($pj['MpRegen']/10));	
		break;
	}

?>
