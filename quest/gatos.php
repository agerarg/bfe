<?php
if($mision['idMisionOn'])
{

	$material = mt_rand(50,100);
	add_item(400,$material,$mision['idCuenta']);
	$msg = "<div class='questEnd'>Great Cat Spown!</div><div>Ganaste ".$material." Craft C</div>";
	//IN GATO MACHO
		$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																VALUES("23","2",
																"'.$check['mundo'].'","5000")');
	///////
}
else
	die("GTFO!");
?>
