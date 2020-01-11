<?php
		$pj['Ataque'] = potenciar($pj['Ataque'],15);
		$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],15);

		if($aura['extraData'] == $log->get("pjSelected"))
		{
			$pj['SH_buffs']++;
			if($pj['SH_InfPower'])
			{
				$pj['Ataque'] = potenciar($pj['Ataque'],15);
				$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],15);
			}
		}
?>
