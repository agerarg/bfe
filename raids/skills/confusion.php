<?php
		$query = 'SELECT idPlayer
			FROM inmundo
			WHERE mundo = '.$check['mundo'].'';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{
			mt_srand((double)microtime()*1000000);
			if(mt_rand(1,10)!=mt_rand(1,10))
				$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$targets['idPlayer'].'","119","0",72,'.($now+60).')');
			else
				$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
							VALUES("'.$targets['idPlayer'].'","Confusion avoid!")');	
		
		}
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> use confusion!";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');				
?>
