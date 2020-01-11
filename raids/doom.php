<?php
		$query = 'SELECT idMonster
			FROM inmundo
			WHERE mundo = 95 AND tipo = 2';
		$targetssq = $db->sql_query($query);
		while($target = $db->sql_fetchrow($targetssq))
		{
			switch($target['idMonster'])
			{
				case 42:
					// DARK MAGE
					$chance = mt_rand(1,100);
					if($chance<30)
					{
							$critical_chanse = mt_rand(1,100);
							if($monster['CriticoMagico'] > $critical_chanse)
							{
								$ataque_monster = critical(10000,125);
								$data['counter'] = "<spam class='raidname'>Dark Mage</spam> uso Darkness haciendo daño critico a todos!";
							}
							else
							{
								$ataque_monster = normal(10000);
								$data['counter'] = "<spam class='raidname'>Dark Mage</spam> uso Darkness haciendo daño a todos!";
							}
							$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
													FROM personaje p , clase c
												WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
												 Vida > 0 AND attackCooldown > '.($now-300).'';
							$fpjsq =$db->sql_query($query);
							while($fpj = $db->sql_fetchrow($fpjsq))
							{
								$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
								$OtherVidaModifier=$fpj['Vida'];
							
								$ataque_monster = defensa($ataque_monster,$badluck['DefensaMagica']);
								if($ataque_monster>$target['vida'])
									$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+DEATHTIME)."', killer = 'Dark Mage te mato' WHERE idPersonaje = '".$fpj['idPersonaje']."'");
								else
									$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$fpj['idPersonaje']."'");	
							
								if($fpj['idPersonaje']==$log->get("pjSelected"))			
								$vidaModifier=$vidaModifier-$ataque_monster;
							}
							
								$db->sql_query('INSERT INTO  chat(party,mensaje) 
												VALUES("'.$pj['party'].'","'.$data['counter'].'")');	
					}
				break;
				case 41:
					// SHADOW
					$chance = mt_rand(1,100);
					if($chance<30)
					{			
						$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
												FROM personaje p , clase c
											WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
											 Vida > 0 AND attackCooldown > '.($now-300).' ORDER BY RAND() LIMIT 1';
						$fpj = $db->sql_fetchrow($db->sql_query($query));
						$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
						$OtherVidaModifier=$fpj['Vida'];
				
						$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+DEATHTIME)."', killer = 'Shadow te mato' WHERE idPersonaje = '".$fpj['idPersonaje']."'");
				
						
							$data['counter'] = "<spam class='raidname'>Shadow</spam> uso Assassination‎ matando a ".$fpj['nombre']."";
							$db->sql_query('INSERT INTO  chat(party,mensaje) 
											VALUES("'.$fpj['party'].'","'.$data['counter'].'")');	
					}
				break;
			}
		}
		$data['counter']="";
		if(mt_rand(1,100)<30)
		{
			$ant = mt_rand(41,42);
			switch($ant)
			{
				case 42:
					 $db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																VALUES("42","2","95","80000")');
					$quat = "Dark Mage";
				break;
				case 41:
					 $db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																VALUES("41","2","95","50000")');
					$quat = "Shadow";
				break;
			}
			
					$data['counter'] = "<div class='raidcast'>".$monster['nombre']." llamo un ".$quat."!</div >";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');
		}
?>
