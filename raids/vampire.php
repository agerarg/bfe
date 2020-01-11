<?php
		
			$monsterVida+=$ataque_monster;
			$cosanew = "<div class='raidcast'>".$monster['nombre']." se curo ".$ataque_monster."!</div >";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$cosanew.'")');
?>
