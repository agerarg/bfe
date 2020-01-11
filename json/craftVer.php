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
$grado=1;
$mundoBlacksmith=intval($_GET['mundo']);

		$grado=intval($_GET['grade']);
		$id = intval($_GET['id']);
 $runz =intval($_GET['runz']) ;
             
$query = 'SELECT c.*, i.nombre, i.imagen, i.subtipo
		FROM craft c JOIN item i USING ( idItem )
		WHERE c.runz = '.$runz.' AND c.idCraft='.$id;

		$craftsq = $db->sql_query($query);
		$craft = $db->sql_fetchrow($craftsq);
		
		$data["IMG"]= $craft['subtipo'].'/'.$craft['imagen'];
		$data["NOMBRE"]=  $craft['nombre'];
			$data["COSTO"]= $craft['cost'];

		
		
		
	$query = 'SELECT i.idItem, i.imagen, i.subtipo, i.nombre, cm.cantidad, inv.cantidad AS IHAVE, i.contable
				FROM item i  JOIN craft_mats cm USING ( idItem )  LEFT JOIN inventario inv on inv.idItem = cm.idItem AND cm.unico = 0
				AND inv.idCuenta = '.$log->get("idCuenta").' AND inv.usadoPor = 0 AND inv.enVenta = 0
				WHERE  cm.idCraft = '.intval($craft['idCraft']).'';
		$dropsq = $db->sql_query($query);
						
		while($drop = $db->sql_fetchrow($dropsq))
		{

			if($drop['contable']==1)
				$drop['HAVE'] = intval($drop['IHAVE']);
			else
			{
				if($craft['masterWork'])
						$drop['nombre'].=" (Legendario)";
				if(!isset($ChekCuanty[$drop['idItem']]))
				{
					$sqlLeg="";
					if($craft['masterWork'])
						$sqlLeg=" AND value=4 ";
					$query = 'SELECT count(*) as CONTA 
							  FROM inventario WHERE idItem = '.$drop['idItem'].'
			AND idCuenta = '.$log->get("idCuenta").' '.$sqlLeg.' AND usadoPor = 0 AND enVenta = 0';
					$count = $db->sql_fetchrow($db->sql_query($query));
					$ChekCuanty[$drop['idItem']]=intval($count['CONTA']);
				}
				
				if($ChekCuanty[$drop['idItem']]>0)
				{
					$ChekCuanty[$drop['idItem']]--;
					$drop['HAVE']=1;
				}
				else
					$drop['HAVE']=0;
				
			}
			$data["litem"][] = $drop;
			
		}
		$data["error"] = "";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 