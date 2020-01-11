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
					//mis items
									$query = 'SELECT idInventario
									FROM inventario
									WHERE trade=1 AND idCuenta='.$trade['usr'.$he].'';
									$invsq = $db->sql_query($query);
									while($inv = $db->sql_fetchrow($invsq))
									{
										$db->sql_query("UPDATE inventario SET 
										trade=0,	tradeTo=0
										WHERE idInventario = '".$inv['idInventario']."'");	
									}
					//items del otro
									$query = 'SELECT idInventario
									FROM inventario
									WHERE trade=1  AND idCuenta='.$trade['usr'.$my].'';
									$invsq = $db->sql_query($query);
									while($inv = $db->sql_fetchrow($invsq))
									{
										$db->sql_query("UPDATE inventario SET 
										trade=0,	tradeTo=0
										WHERE idInventario = '".$inv['idInventario']."'");	
									}
						 $regquery = "SELECT oro FROM cuenta WHERE idCuenta	= ".$trade['usr'.$my];
						 $srchuser = $db->sql_fetchrow($db->sql_query($regquery));
						$realGold = $srchuser['oro'];
						$myoro= intval($realGold + $trade['gold'.$my]);
						$db->sql_query("UPDATE cuenta 
						SET oro = ".$myoro.", evento = 1 WHERE idCuenta = ".$trade['usr'.$my]);
						
						 $regquery = "SELECT oro FROM cuenta WHERE idCuenta	= ".$trade['usr'.$he];
						 $srchuser = $db->sql_fetchrow($db->sql_query($regquery));
						$realGold = $srchuser['oro'];
						$heoro= intval($realGold + $trade['gold'.$he]);
						$db->sql_query("UPDATE cuenta 
						SET oro = ".$heoro.", evento = 1 WHERE idCuenta = ".$trade['usr'.$he]);
						
						$db->sql_query("DELETE FROM trade WHERE idTrade  = '".$trade['idTrade']."'");
						$data['error'] = 0;
				}
				else
				{
					$data['error'] = "Error: no existe el trade";
				}
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 