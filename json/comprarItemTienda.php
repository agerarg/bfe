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
		$id = intval($_GET['id']);
		$data="";
		$query = 'SELECT i.Nombre, i.contable, i.idItem, t.precio, t.idTienda
			FROM item i JOIN tienda t USING ( idItem )
			WHERE t.idTienda = "'.$id.'"';
		$itemsq = $db->sql_query($query);
		$item = $db->sql_fetchrow($itemsq);
		if($item['idTienda'])
		{
					$realGold = $log->realGold();
			if($item['contable']==0)		
			{		

			if($item['precio']<=$realGold)
					{
						$result = $realGold-$item['precio'];
						
						$log->set("oro",$result);
						
						$db->sql_query("UPDATE cuenta SET oro = (oro-".$item['precio'].") WHERE idCuenta = ".$log->get("idCuenta"));
						systemLog("self","<div class=recompensa>Compraste (".$item['Nombre'].")</div> ");
						add_item($item['idItem']);
						$data["error"] = 0;
						$data["gold"] = $result;
								
						
							if($item['idItem']==300)
							{
											////////////////
											/// QUEST
											$query = 'SELECT idMisionOn
																	FROM misiononplayer
																	WHERE idPersonaje = "'.$log->get("pjSelected").'" AND idMision = 39 AND finalizado=0';
														$questsq = $db->sql_query($query);
														$quest = $db->sql_fetchrow($questsq);
														if($quest)
														{
																$questName = "Use Special Hability";
																
																$db->sql_query("UPDATE misiononplayer SET
																	follow = 46
																  WHERE idMisionOn  = '".$quest['idMisionOn']."'");
																  
																$msg = "<div class='questMeta'>Mission: ".$questName ."<br>
															Nueva meta: Anda al [Inventario] y usa el Crystal lvl 1.</div>";
																systemLog("self",$msg);
														}
							}				
						
					}
					else
						$data["error"] = "No tienes suficiente oro.";
			}
			else
			{
				$canti=intval($_GET['cantidad']);
				if($canti>0 AND $canti<1000)
				{
					if(($item['precio']*$canti)<=$realGold)
					{
						$result = $realGold-($item['precio']*$canti);
						$log->set("oro",$result);
						$db->sql_query("UPDATE cuenta SET oro = (oro-".($item['precio']*$canti).") WHERE idCuenta = ".$log->get("idCuenta"));
						systemLog("self","<div class=recompensa>Compraste (".$canti." x ".$item['Nombre'].")</div> ");
						add_item($item['idItem'],$canti);
						$data["error"] = 0;
						$data["gold"] = $result;
					}
					else
					$data["error"] = "No tienes suficiente oro.";
				}
				else
					$data["error"] = "El monto es incorrecto.";
			}
	
		}
		else
			$data["error"] = "El item no existe.";
}
else
{
	$data['error'] = "Error: user not logged";
}
 echo json_encode($data);
?> 