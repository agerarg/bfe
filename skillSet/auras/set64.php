<?php
		$pj['VidaLimit'] = potenciar($pj['VidaLimit'],20);
		$pj['ManaLimit'] = potenciar($pj['ManaLimit'],20);

		if($aura['extraData'] == $log->get("pjSelected"))
		{
			$pj['SH_buffs']++;
			if($pj['SH_InfPower'])
			{
				$pj['VidaLimit'] = potenciar($pj['VidaLimit'],20);
				$pj['ManaLimit'] = potenciar($pj['ManaLimit'],20);
			}
		}
?>
