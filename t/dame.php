<?php
include('../system/conexion.php');
function textIntoSql($text)
{
	global $mysqli;
	$text = htmlspecialchars($text);
	$text = $mysqli->real_escape_string($text);
	if(strlen($text)>100)
		die("ERROR");
	return $text;
}
$db = new sql_db;
$user = textIntoSql($_GET['query']);
$twitch = textIntoSql($_GET['usr']);
$query = 'SELECT idCuenta, nombre
				FROM personaje p 
			WHERE nombre LIKE "'.$user.'"';
$pj = $db->sql_fetchrow($db->sql_query($query));
if($pj)
{
	$query = 'SELECT *
				FROM twitch
			WHERE randomName LIKE "'.$twitch.' "';
	$winner = $db->sql_fetchrow($db->sql_query($query));
	if($winner)
	{
		echo $twitch ." tu personaje ".$pj['nombre']." obtuvo un regalo PogChamp !";
		$db->sql_query("UPDATE twitch SET randomName = ''");
		$query = 'SELECT inv.idInventario, i.contable, inv.cantidad
								FROM inventario inv JOIN item i USING ( idItem )
								WHERE inv.idCuenta = '.$pj['idCuenta'].' AND inv.idItem = 636';
		$itemsq = $db->sql_query($query);
		$item = $db->sql_fetchrow($itemsq);
		if($item AND $item['contable'])
		{
				$db->sql_query("UPDATE inventario SET
						cantidad = (cantidad+1)
						WHERE idInventario = ".$item['idInventario']);					
		}
		else
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta,cantidad,intradeable) 
			VALUES(636,"'.$pj['idCuenta'].'","1","1")');
	}
	else
		echo $twitch . " No tienes ningun premio para reclamar WutFace";
}
else
{
    echo $user." no existe!";
}
?>