<?php
	if($pj['party'])
	{
		switch(mt_rand(1,2))
		{
			case 1://CANCEL
			$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje,p.idCuenta , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
										FROM personaje p , clase c
									WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
									 Vida > 0 AND attackCooldown > '.($now-300).' AND p.party>0';
				$fpjsq =$db->sql_query($query);
				while($fpj = $db->sql_fetchrow($fpjsq))
				{
						$db->sql_query("DELETE FROM aura WHERE idPersonaje = ".$fpj['idPersonaje']." AND timeOut>".$now." AND idSkillReal != 147 AND idSkillReal != 102 AND static = 0");
				}
				$msg = "<spam class='raidname'>".$monster['nombre']."</spam> cancelo todos los buffs!";
				systemLog("party",$msg);
			break;
	
			case 2:
				$query = 'SELECT idPersonaje, nombre
					FROM personaje
					WHERE party = '.$pj['party'].' AND location = '.$check['mundo'].'';
				$targetssq = $db->sql_query($query);
				while($targets = $db->sql_fetchrow($targetssq))
					insertBuff($targets['idPersonaje'],28,15,60);			
				$msg = "<spam class='raidname'>".$monster['nombre']."</spam> tiro silence!";
				systemLog("party",$msg);
				$data['aura'] = array("idSkill"=>15,"lvl"=>1,"auraTimeOut"=>60);
					$data['auraCheck']=true;
			break;
			
	}
	}
	else
	{
		switch(mt_rand(1,2))
		{
			
			case 1://CANCEL
				$msg = "<spam class='raidname'>".$monster['nombre']."</spam> tiro cancel, te saco todos los buffs.";
				
				$query = 'SELECT *
				FROM aura
				WHERE idPersonaje = '.$pj['idPersonaje'].' AND static = 0 AND idSkillReal != 147 AND idSkillReal != 102';
				$skillsq = $db->sql_query($query);
				while($aura = $db->sql_fetchrow($skillsq))
				{
					$data['auraRowCheck']=true;	
					$data['aura'][] = array("idSkill"=>$aura['idSkillReal'],"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
				}
				$db->sql_query("DELETE FROM aura WHERE idPersonaje = ".$pj['idPersonaje']." AND idSkillReal != 147 AND idSkillReal != 102 AND static = 0");
				systemLog("self",$msg);
			break;
			case 2:
				insertBuff($pj['idPersonaje'],28,15,60);				
				$msg = "<spam class='raidname'>".$monster['nombre']."</spam> tiro silencio";
				systemLog("self",$msg);
				$data['aura'] = array("idSkill"=>15,"lvl"=>1,"auraTimeOut"=>60);
					$data['auraCheck']=true;
			break;
		}
	}
?>
