<?php
			$pj['Ataque'] = potenciar($pj['Ataque'],25);		
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],25);	
			$pj['Critico']+=10;
			$pj['PC']+=25;
			$pj['CriticoMagico']+=10;
			$pj['PCMagico']+=25;

			if($aura['extraData'] == $log->get("pjSelected"))
			{
				$pj['SH_buffs']++;
				if($pj['SH_InfPower'])
				{
					$pj['Ataque'] = potenciar($pj['Ataque'],25);		
					$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],25);	
					$pj['Critico']+=10;
					$pj['PC']+=25;
					$pj['CriticoMagico']+=10;
					$pj['PCMagico']+=25;
				}
			}
?>
