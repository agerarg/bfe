<?php
	// ANT NURSE
		$curada = 10000;
		$healReport=$curada;
		if(($monsterVida+$curada)>$monster['VidaLimit'])
		{
				$healReport = $monster['VidaLimit']-$monsterVida;
				$monsterVida=$monster['VidaLimit'];
		}
		else
			$monsterVida=$monsterVida+$curada;
		$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> heal ".$healReport." life!";
		$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');				
?>
