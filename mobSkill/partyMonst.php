<?php
	if($pj['party'])
	{
		switch(mt_rand(1,4))
		{
			case 1://CONFUSION
				$query = 'SELECT idPersonaje, nombre
					FROM personaje
					WHERE party = '.$pj['party'].' AND location = '.$check['mundo'].'';
				$targetssq = $db->sql_query($query);
				while($targets = $db->sql_fetchrow($targetssq))
				{
					if(mt_rand(1,3)==2)
					{
					$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
									VALUES("'.$targets['idPersonaje'].'","119","0",72,'.($now+120).')');
					$msg = "<spam class='raidname'>".$monster['nombre']."</spam> cast confusion on ".$targets['nombre'];
					systemLog("party",$msg);
					}
				}	
			break;
			case 2://CANCEL
			$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje,p.idCuenta , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
										FROM personaje p , clase c
									WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
									 Vida > 0 AND attackCooldown > '.($now-300).' AND p.party>0';
				$fpjsq =$db->sql_query($query);
				while($fpj = $db->sql_fetchrow($fpjsq))
				{
						$db->sql_query("DELETE FROM aura WHERE idPersonaje = ".$fpj['idPersonaje']." AND timeOut>".$now." AND static = 0");
				}
				$msg = "<spam class='raidname'>".$monster['nombre']."</spam> cancel all buffs!";
				systemLog("party",$msg);
			break;
			case 3:
				$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
								FROM personaje p , clase c
							WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
							 Vida > 0 AND attackCooldown > '.($now-300).' ORDER BY RAND() LIMIT 1';
				$fpj = $db->sql_fetchrow($db->sql_query($query));
				$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
				$OtherVidaModifier=$fpj['Vida'];
					$ataque_monster = critical($monster['Ataque']*2,$monster['PC']);
					$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
					$timemuerto=DEATHTIME;
						if($badluck['deathRise']==1)
							$timemuerto = 90;
					if($ataque_monster>$OtherVidaModifier)
						$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$target['idPersonaje']."'");
					else
						$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$target['idPersonaje']."'");	
				
					if($fpj['idPersonaje']==$log->get("pjSelected"))			
					$vidaModifier=$vidaModifier-$ataque_monster;
				
					$msg = "<spam class='raidname'>".$monster['nombre']."</spam> use ".$monster['nombre']." Blast hit for ".$ataque_monster." damage to ".$fpj['nombre']."";
					systemLog("party",$msg);
			break;
			case 4:
				$curada = intval($monster['VidaLimit']/4);
				$healReport=$curada;
				if(($monsterVida+$curada)>$monster['VidaLimit'])
				{
						$healReport = $monster['VidaLimit']-$monsterVida;
						$monsterVida=$monster['VidaLimit'];
				}
				else
					$monsterVida=$monsterVida+$curada;
				$msg = "<spam class='raidname'>".$monster['nombre']."</spam> heal for ".$healReport." life!";
				systemLog("party",$msg);		
			break;
			
	}
	}
	else
	{
		$data['info'] .= "<spam class='raidname'>".$monster['nombre']."</spam> hahaha your alone!";	
		$vidaModifier=0;	
	}
?>
