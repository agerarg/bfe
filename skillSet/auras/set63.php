<?php
		$pj['Defensa'] = potenciar($pj['Defensa'],15);
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],15);

		if($aura['extraData'] == $log->get("pjSelected"))
		{
			$pj['SH_buffs']++;
			if($pj['SH_InfPower'])
			{
				$pj['Defensa'] = potenciar($pj['Defensa'],15);
				$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],15);
			}
		}
?>
