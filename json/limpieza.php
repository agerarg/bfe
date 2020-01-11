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
	switch($_GET['grado'])
	{
		case 1:
			$sqlAdds ="i.grado = 1";
		break;
		case 2:
			$sqlAdds ="i.grado = 2";
		break;
		case 3:
			$sqlAdds ="i.grado = 3 OR i.grado = 4";
			$materialID= 400; //craft C
			$materialName="Craft C";
		break;
		case 4:
			$sqlAdds ="i.grado = 5 OR i.grado = 6";
			$materialID= 401; //craft b
			$materialName="Craft B";
		break;
		case 5:
			$sqlAdds ="i.grado = 7";
			$materialID= 402; //craft a
			$materialName="Craft A";
		break;
		case 6:
			$sqlAdds ="i.grado = 8";
			$materialID= 403; //craft s
			$materialName="Craft S";
		break;
		case 7:
			$sqlAdds ="i.grado = 9";
			$materialID= 438; //craft x
			$materialName="Craft X";
		break;
		case 8:
			$sqlAdds ="i.grado = 10";
			$materialID= 449; //craft Y
			$materialName="Craft Y";
		break;
		case 9:
			$sqlAdds ="i.grado = 11";
			$materialID= 450; //craft Z
			$materialName="Craft Z";
		break;
		default:
			die();
		break;
	}
	$query = 'SELECT inv.idInventario , inv.value, i.tipo, i.grado
			FROM inventario inv JOIN item i USING ( idItem )
			WHERE ('.$sqlAdds.') 
			AND usadoPor = 0 
			AND masterWork = 0
			AND enVenta = 0
			AND contable = 0
			AND idCuenta = '.$log->get("idCuenta");
			
			$checkitemsq = $db->sql_query($query);
			$craftSumatoria=0;
			$deleteSql="";
			$romperCant=0;
			$sqlOR="";
			$someItemWillDelete=false;
			$goldGen=0;
			while($item = $db->sql_fetchrow($checkitemsq))
			{
				$someItemWillDelete=true;
				$romperCant=0;
				switch($item['value'])
				{
					case 4:
						if($item['tipo']=="W")
							$romperCant=25;
						else
							$romperCant=15;
					break;
					case 3:
						if($item['tipo']=="W")
							$romperCant=15;
						else
							$romperCant=8;
					break;
					case 2:
						if($item['tipo']=="W")
							$romperCant=8;
						else
							$romperCant=3;
					break;
					default:
						if($item['tipo']=="W")
							$romperCant=3;
						else
							$romperCant=1;
					break;
				}

				if($item['grado']==1)
					$goldGen+=50;
				if($item['grado']==2)
					$goldGen+=100;
				
				$craftSumatoria+=$romperCant;
				$deleteSql .= $sqlOR." idInventario = ".$item['idInventario'];
				$sqlOR = " OR ";
			}
			
			if($someItemWillDelete)
			{
				if($materialID>0)
				{
					add_item($materialID,$craftSumatoria,false);
					$msg = "Consiguio ".$craftSumatoria." ".$materialName;
					systemLog("self",$msg);
				}
				else
				{
					$msg = "Consiguio ".$goldGen." de oro";
					$db->sql_query("UPDATE cuenta SET oro = (oro+".$goldGen.") WHERE idCuenta = ".$log->get("idCuenta"));
					systemLog("self",$msg);
				}
				$db->sql_query("DELETE FROM inventario WHERE (".$deleteSql.") AND idCuenta = ".$log->get("idCuenta"));

			}
			$data['ok'];

}
else
{
	$data['msg'] = "Error: user not login";
}
 echo json_encode($data);
?> 