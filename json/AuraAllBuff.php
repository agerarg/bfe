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


		if($pj['SubClassFrom']>0)
		{
			$query = 'SELECT *
						FROM logros WHERE idPersonaje = '.$pj['SubClassFrom'].'';
			$logosq = $db->sql_query($query);
			$logros = $db->sql_fetchrow($logosq);
		}
		else
		{
			$query = 'SELECT *
						FROM logros WHERE idPersonaje = '.$log->get("pjSelected").'';
		}
		$logosq = $db->sql_query($query);
		$logros = $db->sql_fetchrow($logosq);
		if($logros['NPCaura'])
		{
		$data["error"]=1;
		
		$query = 'SELECT *
			FROM skill
			WHERE buffSell = 1';
		$itemsq = $db->sql_query($query);
		$realGold = $log->realGold();
		$costo = intval($pj['nivel']*$pj['nivel']*$pj['nivel']/100 + 100);

		$buffall = (int)$_GET['all'];

		if($buffall==0)
			$costo=$costo*9;
		else
			$costo=$costo*8;
		if($costo<=$realGold)
		{
			$data['auraRowCheck']=true;
			while($item = $db->sql_fetchrow($itemsq))
				{
					if($buffall==1 && $item['idRealSkill']!=370 || $buffall==0)
					{
						insertBuff($log->get("pjSelected"),$item['idSkill'],$item['idRealSkill'],3600);
						$data['aura'][] = array("idSkill"=>$item['idRealSkill'],"lvl"=>$item["nivel"],"auraTimeOut"=>3600,"pasive"=>0);	
					}
				}
			$result=$realGold-$costo;
			$data["error"]=0;
			$log->set("oro",$result);
			$db->sql_query("UPDATE cuenta SET oro = (oro-".$costo.") WHERE idCuenta = ".$log->get("idCuenta"));
			$data["gold"]=$result;
		}
		else
		{
			$data["error"]=1;
			$data['error_msg'] = "Error: no tienes suficiente oro, necesitas ".$costo." de oro";
		}
	}
	else
	{
		$data["error"]=1;
		$data['error_msg'] = "Error: nop";
	}
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 