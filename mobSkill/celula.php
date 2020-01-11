<?php
		$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,dificulty,idInstance) 
											VALUES("85","2",
											1,"5000",0,1,'.$check['idInstance'].')');
		$msg2 = "<spam class='raidname'>".$monster['nombre']."</spam> creo otra celula!";	
		systemLog("self",$msg2);
?>
