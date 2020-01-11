<?php
		$pj['Critico']+=10;
		$pj['CriticoMagico']+=10;

		if($aura['extraData'] == $log->get("pjSelected"))
			{
				$pj['SH_buffs']++;
				if($pj['SH_InfPower'])
				{
					$pj['Critico']+=10;
					$pj['CriticoMagico']+=10;
				}
			}
?>
