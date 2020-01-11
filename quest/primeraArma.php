<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>Get a weapon done!</div>";
	switch($mision['idClase'])
	{
		case 1:
		$msg .= "<div class='questDrop'>Ganaste un Surgeon Sword</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("330","'.$mision['idCuenta'].'")');
		break;
		case 2:
		$msg .= "<div class='questDrop'>Ganaste un Staff Of Mana</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("43","'.$mision['idCuenta'].'")');
		break;
		case 3:
		$msg .= "<div class='questDrop'>Ganaste un Assassin Knife</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("3","'.$mision['idCuenta'].'")');
		break;
		case 4:
		$msg .= "<div class='questDrop'>Ganaste un Strengthened Bow</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("53","'.$mision['idCuenta'].'")');
		break;
		case 5:
		$msg .= "<div class='questDrop'>Ganaste un Saber*Saber</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("99","'.$mision['idCuenta'].'")');
		break;
		case 6:
		$msg .= "<div class='questDrop'>Ganaste un Bagh-Nakh</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("73","'.$mision['idCuenta'].'")');
		break;
		case 7:
		$msg .= "<div class='questDrop'>Ganaste un Surgeon Sword</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("330","'.$mision['idCuenta'].'")');
		break;
		case 8:
		$msg .= "<div class='questDrop'>Ganaste un Staff Of Mana</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("43","'.$mision['idCuenta'].'")');
		break;
		case 10:
		$msg .= "<div class='questDrop'>Ganaste un Saber*Saber</div>";
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta) VALUES("99","'.$mision['idCuenta'].'")');
		break;
	}

}
else
	die("GTFO!");
?>
