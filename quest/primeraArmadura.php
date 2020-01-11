<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Get Armor done!</div>";
	switch($mision['idClase'])
	{
		case 1:
		$msg .= "<div class='questDrop'>Ganaste Brigandine</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("121","'.$mision['idCuenta'].'")');
		break;
		case 2:
		$msg .= "<div class='questDrop'>Ganaste Mithril Tunic</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("136","'.$mision['idCuenta'].'")');
		break;
		case 3:
		$msg .= "<div class='questDrop'>Ganaste Reinforced</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("108","'.$mision['idCuenta'].'")');
		break;
		case 4:
		$msg .= "<div class='questDrop'>Ganaste Manticore</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("107","'.$mision['idCuenta'].'")');
		break;
		case 5:
		$msg .= "<div class='questDrop'>Ganaste Tunic Of Knowledge</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("137","'.$mision['idCuenta'].'")');
		break;
		case 6:
		$msg .= "<div class='questDrop'>Ganaste Reinforced</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("108","'.$mision['idCuenta'].'")');
		break;
		case 7:
		$msg .= "<div class='questDrop'>Ganaste Mithril Heavy</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("122","'.$mision['idCuenta'].'")');
		break;
		case 8:
		$msg .= "<div class='questDrop'>Ganaste Mithril Tunic</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("136","'.$mision['idCuenta'].'")');
		break;
	}

}
else
	die("GTFO!");
?>
