<?php
if($mision['idMisionOn'])
{

        $EWC = mt_rand(50,100);
	$msg = "<div class='questEnd'>Ant Keeper Spown!</div><div class='questDrop'>
	".$EWC." Crafts A encontrados<br>
	</div>";
	add_item(402,$EWC,$mision['idCuenta'],0);
	
$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																VALUES("35","2",
																"'.$check['mundo'].'","50000")');
}
else
	die("GTFO!");
?>
