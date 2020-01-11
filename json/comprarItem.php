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
		if(isset($_GET['cantidad']))
			$cantidad = intval($_GET['cantidad']);
		else
			$cantidad = 1;
		$data="";
		$query = 'SELECT p.idCuenta, p.nombre, p.idPersonaje, p.nivel, p.idPersonaje, p.idClase, p.nivel, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
		FROM personaje p JOIN clase c USING ( idClase )
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		
		$query = 'SELECT i.idItem, i.Nombre, i.contable, inv.idInventario, inv.cantidad, cv.precio, inv.idCuenta, cv.cantidadVenta, cv.idCurrency
			FROM inventario inv JOIN item i USING ( idItem ) JOIN compra_venta cv USING ( idInventario )
			WHERE inv.idInventario = '.$id.' AND enVenta = 1';
		$itemsq = $db->sql_query($query);
		$item = $db->sql_fetchrow($itemsq);
		if($item['idInventario'])
		{
			if($item['idCuenta']!=$log->get("idCuenta"))
				{
					
					if($item['idCurrency']==0)
					{
						$realGold=$log->realGold();
					}
					else
					{
						$query = 'SELECT cantidad
						FROM inventario 
						WHERE idCuenta = '.$log->get("idCuenta").' AND idItem = '.$item['idCurrency'];
						$itemsq = $db->sql_query($query);
						$moneda = $db->sql_fetchrow($itemsq);
						$realGold=intval($moneda['cantidad']);
					}
					if($item['contable'])
					{
						if($cantidad<0 OR $cantidad>$item['cantidadVenta'])
						{
							$data["error"] = "monto incorrecto!";
						}
						else
						{
							$precio = $cantidad * $item['precio'];

							if($precio<=$realGold)
							{
								
								$resto = $item['cantidadVenta']-$cantidad;
								$db->sql_query("UPDATE inventario SET 
									cantidad = (cantidad-".$cantidad.")
									WHERE idInventario = ".$item['idInventario']);
								if($resto>0)
								{
									$db->sql_query("UPDATE compra_venta SET 
									cantidadVenta = (cantidadVenta-".$cantidad.")
									WHERE idInventario = ".$item['idInventario']);
								}
								else
								{		
									$db->sql_query("UPDATE inventario SET 
									enVenta = 0
									WHERE idInventario = ".$item['idInventario']);
									$db->sql_query("DELETE FROM compra_venta WHERE idInventario = ".$item['idInventario']);	

								}
								add_item($item['idItem'],$cantidad);
								$query = 'SELECT pjSelected
								FROM cuenta
									WHERE idCuenta = '.$item['idCuenta'].'';
								$vendedorPj = $db->sql_fetchrow($db->sql_query($query));
								if($vendedorPj)
								{
									if($item['contable']==1)
										$msg=$pj['nombre']." te compro ".$cantidad." ".$item['Nombre']."!<br>Ganaste ".$precio." de oro!";
								
									systemLog("other",$msg,$vendedorPj['pjSelected']);
								}
								$msg = "Compraste ".$cantidad." ".$item['Nombre']."!";
								systemLog("self",$msg);

								//// COBRAR
								if($item['idCurrency']==0)
								{
									$db->sql_query("UPDATE cuenta SET oro = (oro-".$precio.") WHERE idCuenta = ".$log->get("idCuenta"));
									$db->sql_query("UPDATE cuenta SET oro = (oro+".$precio.") WHERE idCuenta = ".$item['idCuenta']);
									$result = $realGold-$precio;
									$data["gold"] = $result;
								}
								else
								{
									add_item($item['idCurrency'],$precio,$item['idCuenta']);
									$db->sql_query("UPDATE inventario SET 
									cantidad = (cantidad-".$precio.")
									WHERE idCuenta = ".$log->get("idCuenta")."
									AND idItem = ".$item['idCurrency']);
								}
								
								
								$data["error"] = 0;
							}
							else
								$data["error"] = "No tienes lo requerido.";
						}
					}
					else
					{
						if($item['precio']<=$realGold)
						{
							

							$precio = $item['precio'];
							$db->sql_query("UPDATE inventario SET idCuenta = ".$log->get("idCuenta").", enVenta = 0 
							WHERE idInventario = ".$item['idInventario']);

							$db->sql_query("DELETE FROM compra_venta WHERE idInventario = ".$item['idInventario']);		
							$data["error"] = 0;
							$query = 'SELECT pjSelected
								FROM cuenta
									WHERE idCuenta = '.$item['idCuenta'].'';
								$vendedorPj = $db->sql_fetchrow($db->sql_query($query));
								if($vendedorPj)
								{
									$msg=$pj['nombre']." te compro ".$item['Nombre']."!</div>";
									systemLog("other",$msg,$vendedorPj['pjSelected']);
								}
								$msg = "Compraste ".$item['Nombre']."!";
								systemLog("self",$msg);
								//// COBRAR
								if($item['idCurrency']==0)
								{
									$db->sql_query("UPDATE cuenta SET oro = (oro-".$precio.") WHERE idCuenta = ".$log->get("idCuenta"));
									$db->sql_query("UPDATE cuenta SET oro = (oro+".$precio.") WHERE idCuenta = ".$item['idCuenta']);
									$result = $realGold-$precio;
									$data["gold"] = $result;
								}
								else
								{
									add_item($item['idCurrency'],$precio,$item['idCuenta']);
									$db->sql_query("UPDATE inventario SET 
									cantidad = (cantidad-".$precio.")
									WHERE idCuenta = ".$log->get("idCuenta")." 
									AND idItem = ".$item['idCurrency']);
								}
						}
						else
							$data["error"] = "No tienes lo requerido.";
					}
				}
				else
					$data["error"] = "No puedes comprar tus propios items.";		
		}
		else
			$data["error"] = "El item no existe.";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 