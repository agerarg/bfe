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
		$query = 'SELECT i.*,inv.*
			FROM item i JOIN inventario inv USING ( idItem ) 
			WHERE inv.cantidad > 0 AND inv.idCuenta = '.$log->get("idCuenta").' ORDER BY inv.idInventario DESC  Limit 0,1000';
		$itemsq = $db->sql_query($query);
		while($item = $db->sql_fetchrow($itemsq))
		{
			switch($item['value'])
				{
					case 1:
						$item['Ataque']+=intval($item['Ataque']/4);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/4);
						$item['Defensa']+=intval($item['Defensa']/4);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/4);
					break;
					case 2:
						$item['Ataque']+=intval($item['Ataque']/3);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/3);
						$item['Defensa']+=intval($item['Defensa']/3);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/3);
					break;
					case 3:
						$item['Ataque']+=intval($item['Ataque']/2);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/2);
						$item['Defensa']+=intval($item['Defensa']/2);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/2);
					break;
					case 4:
						$item['Ataque']+=intval($item['Ataque']);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']);
						$item['Defensa']+=intval($item['Defensa']);
						$item['DefensaMagica']+=intval($item['DefensaMagica']);
					break;
				}
			if($item['conNombre']==1)
			{
				if(strpos($item['nameCheck'], "_"))
				{
					$query = 'SELECT  nombre
					FROM jnombre
					WHERE idNombre = '.$item['idNombre'];
					$wnamesq = $db->sql_query($query);
					$wname = $db->sql_fetchrow($wnamesq);
					
					$query = 'SELECT  apellido
					FROM japellido
					WHERE idApellido = '.$item['idApellido'];
					$wlasNamesq = $db->sql_query($query);
					$wlasName = $db->sql_fetchrow($wlasNamesq);
					$db->sql_query("UPDATE inventario SET nameCheck='".$wname['nombre'].' '.$wlasName['apellido']."' WHERE idInventario = '".$item['idInventario']."'");
				}
					
				$item['Ataque']+=intval($item['Ataque']/3);
				$item['AtaqueMagico']+=intval($item['AtaqueMagico']/3);
				$item['nameWeapon']=$item['nameCheck'];
			}

			$data["litem"][] = $item;
		}
		$data["error"] = "";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 