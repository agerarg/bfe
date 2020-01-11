<?php
		$query = 'SELECT idMonster
			FROM inmundo
			WHERE mundo = 91 AND tipo = 2';
		$targetssq = $db->sql_query($query);
		while($target = $db->sql_fetchrow($targetssq))
		{
			switch($target['idMonster'])
			{
				case 34:
					$curada = 10000;
					$healReport=$curada;
					if(($monsterVida+$curada)>$monster['VidaLimit'])
					{
							$healReport = $monster['VidaLimit']-$monsterVida;
							$monsterVida=$monster['VidaLimit'];
					}
					else
						$monsterVida=$monsterVida+$curada;
					$justforparty = "<spam class='raidname'>Ant Nurse</spam> le curo ".$healReport." de vida a Ant Queen!<br>";
					$db->sql_query('INSERT INTO  chat(party,mensaje) 
										VALUES("'.$fpj['party'].'","'.$justforparty.'")');
				break;
				case 33:
					// ANT WARRIOR
						$ataque_monster = 5000;
						
						$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
												FROM personaje p , clase c
											WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
											 Vida > 0 AND attackCooldown > '.($now-300).' ORDER BY RAND() LIMIT 1';
						$fpj = $db->sql_fetchrow($db->sql_query($query));
						$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
						$OtherVidaModifier=$fpj['Vida'];
				
							$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
							if($ataque_monster>$target['vida'])
								$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+60)."', killer = 'Ant Warrior te mato' WHERE idPersonaje = '".$target['idPersonaje']."'");
							else
								$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$target['idPersonaje']."'");	
						
							if($fpj['idPersonaje']==$log->get("pjSelected"))			
							$vidaModifier=$vidaModifier-$ataque_monster;
						
							$justforparty = "<spam class='raidname'>Ant Warrior</spam> hizo ".$ataque_monster." de daño a ".$fpj['nombre']."<br>";
							$db->sql_query('INSERT INTO  chat(party,mensaje) 
											VALUES("'.$fpj['party'].'","'.$justforparty.'")');		
				break;
			}
		}

		if(mt_rand(1,100)<30)
		{
			
			$ant = mt_rand(33,34);
			switch($ant)
			{
				case 33:
					 $db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																VALUES("33","2","91","30000")');
					$quat = "Ant Warrior";
				break;
				case 34:
					 $db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																VALUES("34","2","91","20000")');
					$quat = "Ant Nurse";
				break;
			}
					$data['counter'] = "<div class='raidcast'>".$monster['nombre']." creo una ".$quat."!</div >";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');
		}
?>
