<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Dragon Hunter terminada!</div>";
	$query = 'SELECT Nombre, idItem
			FROM item
			WHERE (idItem=464 OR idItem=465 OR idItem=466 OR idItem=467 OR idItem=468 OR idItem=469) ORDER BY RAND() LIMIT 0, 1';
		$itemsq = $db->sql_query($query);
		$item = $db->sql_fetchrow($itemsq);
			
		$cantidad = mt_rand(1,2);
		$msg = "<div class='questDrop'>Encontraste (".$drop['Nombre']." x ".$cantidad.")</div>";
		add_item($item['idItem'],$cantidad);
}
else
	die("GTFO!");

?>
