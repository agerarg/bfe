<?php
/*
		$ataque_monster = critical($monster['Ataque']*3,$monster['PC']);
		$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
		
		if($pj['party']>0)
		{
                        $query = 'SELECT idPersonaje, nombre
			FROM personaje
			WHERE party = '.$pj['party'].' AND Vida>0 AND location=111';
		        $targetssq = $db->sql_query($query);
			
			$nombres="";
			while($target = $db->sql_fetchrow($targetssq))
			{
				if($ataque_monster>$target['Vida'])
				{
					$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+DEATHTIME)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$target['idPersonaje']."'");
					systemLog("party","<spam class='raidname'>".$monster['nombre']."</spam> golpeo por ".$ataque_monster." a ".$target['nombre']." y lo mato!");
				}
				else
				{
					$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$target['idPersonaje']."'");	
					systemLog("party","<spam class='raidname'>".$monster['nombre']."</spam> golpeo por ".$ataque_monster." a ".$target['nombre']."");
				}
			}				
		}
		else
			systemLog("self","<spam class='raidname'>".$monster['nombre']."</spam> golpeo por ".$ataque_monster."");	
		
		$vidaModifier=$vidaModifier-$ataque_monster;
*/
?>
