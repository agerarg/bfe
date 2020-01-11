<?php
		$query = 'SELECT idMonster
			FROM inmundo
			WHERE mundo = 117 AND tipo = 2';
		$targetssq = $db->sql_query($query);
		$target = $db->sql_fetchrow($targetssq);
		if($target)
		{
			$monster['Defensa']=10000;
			$monster['DefensaMagica']=10000;
		}
?>
