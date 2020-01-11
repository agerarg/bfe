<?php
		
			for ($i = 1; $i <= 5; $i++) {
				
						 $db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																	VALUES("103","2","117","100000")');
			}
		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> creo 5 Witch Guards!!!";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');				
?>
