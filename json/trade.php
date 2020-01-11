<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
include('../system/login.php');
function add_item($id,$cantidad=1,$idCuenta=false,$intradeable=0)
{
	global $db,$log;
	if($idCuenta==false)
		$idCuenta=$log->get("idCuenta");
	if($cantidad<1)
	$cantidad=1;
	$query = 'SELECT inv.idInventario, i.contable, inv.cantidad
								FROM inventario inv JOIN item i USING ( idItem )
								WHERE inv.idCuenta = '.$idCuenta.' AND inv.idItem = '.$id.'';
	$itemsq = $db->sql_query($query);
	$item = $db->sql_fetchrow($itemsq);
	if($item AND $item['contable'])
	{
		if($item['cantidad']>0)
			$db->sql_query("UPDATE inventario SET
					cantidad = (cantidad+".$cantidad.")
					WHERE idInventario = ".$item['idInventario']);
		else
			$db->sql_query("UPDATE inventario SET
					cantidad = (".$cantidad.")
					WHERE idInventario = ".$item['idInventario']);
				
	}
	else
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta,cantidad,intradeable) VALUES("'.$id.'","'.$idCuenta.'","'.$cantidad.'","'.$intradeable.'")');
}
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
	switch($_GET['act'])
	{
		case 'comfirmar':
			$query = 'SELECT *
				FROM trade
				WHERE usr1 = '.$log->get("idCuenta").' OR usr2 = '.$log->get("idCuenta").' ';
				$tradesq = $db->sql_query($query);
				$trade = $db->sql_fetchrow($tradesq);
				$data['close'] = 0;
			if($trade)
			{
				if($trade['usr1']==$log->get("idCuenta"))
					{
						$my=1;
						$he=2;
					}
					else
					{
						$my=2;
						$he=1;
					}	
				if($trade['comfirmado1']==1 AND $trade['comfirmado2']==1)
				{
					$db->sql_query("UPDATE trade SET comfirmado".$my." = 2 WHERE idTrade = '".$trade['idTrade']."'");
					$data['error'] = 0;
					$data['info'] = "tiene que esperar que la otra persona acepte tambien";
				}
				else if($trade['comfirmado'.$my]==1 AND $trade['comfirmado'.$he]==2)
				{
					//mis items
									$query = 'SELECT idInventario, cantidadTrade, idItem
									FROM inventario
									WHERE trade=1 AND enVenta=0 AND usadoPor=0 AND tradeTo='.$trade['usr'.$my].' AND idCuenta='.$trade['usr'.$he].'';
									$invsq = $db->sql_query($query);
									while($inv = $db->sql_fetchrow($invsq))
									{
										if($inv['cantidadTrade']>1)
										{
											$db->sql_query("UPDATE inventario SET cantidad=(cantidad-".$inv['cantidadTrade']."),
											trade=0,	tradeTo=0, cantidadTrade=0
											WHERE idInventario = '".$inv['idInventario']."'");	
											add_item($inv['idItem'],$inv['cantidadTrade'],$trade['usr'.$my]);
											
										}
										else
										{
											$db->sql_query("UPDATE inventario SET idCuenta = ".$trade['usr'.$my]." ,
											trade=0,	tradeTo=0
											WHERE idInventario = '".$inv['idInventario']."'");	
										}
									}
					//items del otro
									$query = 'SELECT idInventario, cantidadTrade, idItem
									FROM inventario
									WHERE trade=1 AND enVenta=0 AND usadoPor=0 AND tradeTo='.$trade['usr'.$he].' AND idCuenta='.$trade['usr'.$my].'';
									$invsq = $db->sql_query($query);
									while($inv = $db->sql_fetchrow($invsq))
									{
										if($inv['cantidadTrade']>1)
										{
											$db->sql_query("UPDATE inventario SET cantidad=(cantidad-".$inv['cantidadTrade']."),
											trade=0,	tradeTo=0, cantidadTrade=0
											WHERE idInventario = '".$inv['idInventario']."'");	
											add_item($inv['idItem'],$inv['cantidadTrade'],$trade['usr'.$he]);
											
										}
										else
										{
											$db->sql_query("UPDATE inventario SET idCuenta = ".$trade['usr'.$he]." ,
											trade=0,	tradeTo=0
											WHERE idInventario = '".$inv['idInventario']."'");	
										}
									}
						
						//$balance = intval($trade['gold'.$he] - $trade['gold'.$my]);
						$db->sql_query("UPDATE cuenta 
						SET oro = (oro+".$trade['gold'.$he]."), evento = 1 WHERE idCuenta = ".$trade['usr'.$my]);
						
						//$balance = intval($trade['gold'.$my] - $trade['gold'.$he]);
						$db->sql_query("UPDATE cuenta 
						SET oro = (oro+".$trade['gold'.$my]."), evento = 1 WHERE idCuenta = ".$trade['usr'.$he]);
						
						
						$db->sql_query("DELETE FROM trade WHERE idTrade  = '".$trade['idTrade']."'");
						$data['error'] = 0;
						$data['info'] = "Los items han sido transferidos";
						$data['close'] = 1;
				}
				else
					$data['error'] = "Problema loco";
			}
			else
				$data['error'] = "El trade ya no existe";
		break;
		case 'agregar':
			$proc = htmlspecialchars($_GET['process']);
			$proc = explode(",",$proc);
			$oro = intval($_GET['oro']);
			$orok=0;
			$realGold = $log->realGold();
			if($oro<0)
				$data['error'] = "Error: el oro tiene que ser mayor a 0";
			else
			if($oro>$realGold)
				$data['error'] = "Error: no tienes suficiente oro";
			else
				$orok=1;
			
			if($orok==1)
			{
				if(count($proc)<20)
				{
					$query = 'SELECT *
					FROM trade
					WHERE usr1 = '.$log->get("idCuenta").' OR usr2 = '.$log->get("idCuenta").' ';
					$tradesq = $db->sql_query($query);
					$trade = $db->sql_fetchrow($tradesq);
				if($trade)
				{		
					if($trade['usr1']==$log->get("idCuenta"))
					{
						$idDelOtro = $trade['usr2'];
						$my=1;
						$he=2;
					}
					else
					{
						$idDelOtro = $trade['usr1'];
						$my=2;
						$he=1;
					}
					
					if($trade['comfirmado'.$my]==0)
					{	
						foreach ($proc as $valor) {
							$idinv = intval($valor);
							if($idinv>0)
							{
								if(isset($_GET['id'.$valor]))
								{
									$cant=intval($_GET['id'.$valor]);
									
									$query = 'SELECT idInventario, cantidad
									FROM inventario
									WHERE trade=1 AND enVenta=0 AND usadoPor=0 AND (cantidad >= '.$cant.') AND idInventario = "'.$valor.'"';
									$cantChek = $db->sql_query($query);
									if($cantChek)
									{
									$db->sql_query("UPDATE inventario SET trade=1,	tradeTo=".$idDelOtro.", cantidadTrade=".$cant."
								WHERE idCuenta = '".$log->get("idCuenta")."' AND idInventario = '".$valor."' AND intradeable=0 AND usadoPor=0 AND enVenta=0 AND cantidad > 0");
									}
								}
								else
								$db->sql_query("UPDATE inventario SET trade=1,	tradeTo=".$idDelOtro."
							WHERE idCuenta = '".$log->get("idCuenta")."' AND idInventario = '".$valor."' AND intradeable=0 AND usadoPor=0 AND enVenta=0");
							}
						}	
						$result = $realGold-$oro;
						if($oro>=1 AND $result>=0)
						{
						 $goldPuter = ", gold".$my." = ".$oro." ";
							 $db->sql_query("UPDATE cuenta 
							SET oro = ".$result." WHERE idCuenta = ".$trade['usr'.$my]);
						}
						$db->sql_query("UPDATE trade SET 
						comfirmado".$my." = 1 
						".$goldPuter."
						WHERE idTrade = '".$trade['idTrade']."'");
						$data['error'] = 0;
						
					}
					else
						$data['error'] = "Operacion fuera de terminos";
						
				}
				else
					$data['error'] = "El trade ya no existe";
					
				}
				else
				{
					$data['error'] = "Error: items exedidos";
				}
			}
		break;
		default:
			$data['error'] = "Error: no hay accion";
		break;
	}
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 