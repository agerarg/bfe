<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Trolls Hunt completed!</div>";


			$Material = mt_rand(3,5);

			add_item(314,$Material,$mision['idCuenta'],1);
			$msg .= "<div class='questDrop'>".$mision['PJnombre']." got ".$Material." EWB!</div>";
		
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$pj['party'].'","'.$msg.'")');

}
else
	die("GTFO!");
?>
