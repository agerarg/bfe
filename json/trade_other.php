<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{

				$data="";
				$query = 'SELECT *
				FROM trade
				WHERE usr1 = '.$log->get("idCuenta").' OR usr2 = '.$log->get("idCuenta").' ';
				$tradesq = $db->sql_query($query);
				$trade = $db->sql_fetchrow($tradesq);
				if($trade)
				{
					$query = 'SELECT i.*, inv.idInventario, inv.usadoPor, inv.enVenta, inv.trade, il.atributos, inv.legendary, inv.cantidadTrade, inv.enchant, inv.SA, inv.SAchar
						FROM item i JOIN inventario inv USING ( idItem ) LEFT JOIN inventario_legend il on il.idInventario = inv.idInventario 
						WHERE inv.tradeTo = '.$log->get("idCuenta").' AND i.idItem = inv.idItem ORDER BY inv.idInventario DESC';
					$itemsq = $db->sql_query($query);
					while($item = $db->sql_fetchrow($itemsq))
					{
						$data["litem"][] = $item;
						
					}
					$data["close"] = 0;
					if($trade['usr1']==$log->get("idCuenta"))
						$he=2;
					else
						$he=1;
					
					$data["oro"] = intval($trade['gold'.$he]);
					$data["estado"] = intval($trade['comfirmado'.$he]);
				}
				else
				{
					$data["close"] = 1;
				}
				$data["error"] = "";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 