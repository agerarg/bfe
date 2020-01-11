<?php

	// ANT WARRIOR
		$ataque_monster = critical($monster['Ataque']*3,$monster['PC']);
		
		$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
								FROM personaje p , clase c
							WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
							 Vida > 0 AND attackCooldown > '.($now-300).' ORDER BY RAND() LIMIT 1';
		$fpj = $db->sql_fetchrow($db->sql_query($query));
		$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
		$OtherVidaModifier=$fpj['Vida'];
		$timemuerto=DEATHTIME;
				if($badluck['deathRise']==1)
					$timemuerto = 90;
		$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$fpj['idPersonaje']."'");

		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> use Assassination‎ killing ".$fpj['nombre']."";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');			
							
											
?>
