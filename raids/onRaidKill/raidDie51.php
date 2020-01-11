<?php
		/*$query = 'SELECT p.nombre, p.nivel, p.idPersonaje
										FROM personaje p
					WHERE p.location = '.$check['mundo'].' AND p.attackCooldown > '.($now-600).' AND p.party='.$pj['party'];
		$targetssq = $db->sql_query($query);
		
		$randomDimen=mt_rand(2,2);
		switch($randomDimen)
		{
			case 2:
			//Hell
				$place="Hell Dimension";
				$idSkillReal=100;
				$idSkill=169;
				$idPlace= 96;
			break;
		}
		while($targets = $db->sql_fetchrow($targetssq))
		{
			$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$targets['idPersonaje'].'","'.$idSkill.'","0",'.$idSkillReal.','.($now+3600).')');
			 $db->sql_query("UPDATE personaje SET  
			 				location = '".$idPlace."'
				 WHERE idPersonaje = '".$targets['idPersonaje']."'");				
							
		}
	$msgs = "<spam class='ShamanSkill'>Dimen Master send u to ".$place."!</spam>";
	$db->sql_query('INSERT INTO  chat(party,mensaje) 
					VALUES("'.$pj['party'].'","'.$msgs.'")');	*/
?>
