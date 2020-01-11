<?php
			$monsterVida+=2000000;
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> se curo 2kk de vida!";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');				
?>
