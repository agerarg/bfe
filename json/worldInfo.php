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
				FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
				
		// FIXER
		$x = $pj["positionX"]-12;
		$y = $pj["positionY"]-12;
		$data['ourY'] =$pj['positionY'];
		$data['ourX'] =$pj['positionX'];
		
		$query = 'SELECT t.idTerrain, t.posX, t.posY, t.tipo, t.ground, t.funct, t.build
		FROM world_terrain t
		WHERE t.posX > '.$x.' AND t.posX < '.($x+12).' AND t.posY > '.$y.' AND t.posY < '.($y+12).'  AND idWorld = 1';
		
		$resultado = $db->sql_query($query);
		while($row = $db->sql_fetchrow($resultado))
		 	{
				
				$row["realX"]=$row["posX"];
				$row["realY"]=$row["posY"];
				$row["posY"]=$pj['positionY']-$row["posY"];
				$row["posX"]=$pj['positionX']-$row["posX"];
				if($row["ground"]==0)
					 $data["ground"][$row["posY"]."_".$row["posX"]] = array("tipo"=>$row["tipo"],"realX"=>$row["realX"],"realY"=>$row["realY"],"idTerra"=>$row["idTerrain"]);
				else
					$data["ground"][$row["posY"]."_".$row["posX"]."obj"] = array("tipo"=>$row["tipo"],"funct"=>$row["funct"],"realX"=>$row["realX"],"realY"=>$row["realY"],"idTerra"=>$row["idTerrain"]);
				
			}
}
echo json_encode($data);
?> 