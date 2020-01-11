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
		$query = 'SELECT i.*, inv.*, cv.precio, cv.cantidadVenta, cv.idCurrency
			FROM compra_venta cv 
			JOIN inventario inv 
			USING ( idInventario ) 
			JOIN item i 
			USING ( idItem )
			WHERE cantidad>0  ORDER BY cv.precio';
		$itemsq = $db->sql_query($query);
		$arrow = array();
		while($item = $db->sql_fetchrow($itemsq))
		{
			$item["Rprecio"]=$item["precio"];
				if($item["precio"]>=1000000)
				$item["precio"]= round($item["precio"]/1000000,1)."kk";	
				else
				if($item["precio"]>=1000)
					$item["precio"]= round($item["precio"]/1000,1)."k";	
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