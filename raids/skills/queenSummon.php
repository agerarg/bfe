<?php
		
			for ($i = 1; $i <= 5; $i++) {
				$ant = mt_rand(33,34);
				switch($ant)
				{
					case 33:
						 $db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																	VALUES("33","2","91","30000")');
					break;
					case 34:
						 $db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																	VALUES("34","2","91","20000")');
					break;
				}
			}
		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> summon 5 Ants!!!";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');				
?>
