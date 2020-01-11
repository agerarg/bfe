<?php

		$query = 'SELECT idPersonaje
			FROM personaje
			WHERE party = '.$pj['party'].' AND location = '.$check['mundo'].'';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{
			$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$targets['idPersonaje'].'","119","0",72,'.($now+300).')');
		}	
		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> use confusion!";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');	
							
											
?>
