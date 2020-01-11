<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
		$query = 'SELECT *
		FROM personaje p
		WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").' AND p.desactivada=0';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		$id = intval($_GET['id']);
		$data["error"]=1;
		
		$query = 'SELECT *
			FROM skill
			WHERE idSkill = '.$id.' AND buffSell = 1';
		$itemsq = $db->sql_query($query);
		$item = $db->sql_fetchrow($itemsq);
		$realGold = $log->realGold();
		$costo = intval($pj['nivel']*$pj['nivel']*$pj['nivel']/100 + 100);
		if($item['idSkill'])
		{
						if($costo<=$realGold)
						{
							$result=$realGold-$costo;
							$data["error"]=0;
							insertBuff($log->get("pjSelected"),$item['idSkill'],$item['idRealSkill'],3600);

							$log->set("oro",$result);
							$db->sql_query("UPDATE cuenta SET oro = (oro-".$costo.") WHERE idCuenta = ".$log->get("idCuenta"));

							$data["id"]=$item['idRealSkill'];
							$data["gold"]=$result;
						}
						else
							$data["error"] = "No tienes suficiente oro.";
		}
		else
			$data["error"] = "El aura no existe.";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 