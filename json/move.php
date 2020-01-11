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
		
		$now = time();
		
		$data['fightMode']=0;
		$data['error']=0;
		
		$cuenta["positionX"]=$pj["positionX"];
		$cuenta["positionY"]=$pj["positionY"];
		if(($pj['speed'])==$now)
		{
			$data['error']=1;
			$data['eco']="Error velocidad de movimiento";
			echo json_encode($data);
			die();
		}
		
		// FIXER
		switch($_GET['move'])
		{
			case 'left':
				$cuenta["positionX"]+=1;
				$data['move']="left";
			break;
			case 'right':
				$cuenta["positionX"]-=1;
				$data['move']="right";
			break;
			case 'up':
				$cuenta["positionY"]+=1;
				$data['move']="up";
			break;
			case 'down':
				$cuenta["positionY"]-=1;
				$data['move']="down";
			break;
			default:
				$data['error']=1;
				$data['eco']="No lado";
				die();
			break;
		}
		
		$world['dimencion']=120;
		$world['dimencion']+=6;
		if($cuenta["positionX"]>$world['dimencion'] OR $cuenta["positionY"]>$world['dimencion'] OR $cuenta["positionX"]<0 OR $cuenta["positionY"]<0)
		{
			$data['error']=1;
			$data['eco']="Limite del mapa";
			echo json_encode($data);
			die();
		}
		
		$x = $cuenta["positionX"]-12;
		$y = $cuenta["positionY"]-12;
		$data['ourY'] =$cuenta['positionY'];
		$data['ourX'] =$cuenta['positionX'];
		$query = 'SELECT t.idTerrain, t.posX, t.posY, t.tipo, t.ground, t.funct, t.build
		FROM world_terrain t
		WHERE t.posX > '.$x.' AND t.posX < '.($x+12).' AND t.posY > '.$y.' AND t.posY < '.($y+12).' AND t.idWorld = 1';
		$resultado = $db->sql_query($query);
		while($row = $db->sql_fetchrow($resultado))
		 	{
				
				$row["realX"]=$row["posX"];
				$row["realY"]=$row["posY"];
				$row["posY"]=$cuenta['positionY']-$row["posY"];
				$row["posX"]=$cuenta['positionX']-$row["posX"];
				if($row["ground"]==0)
					 $data["ground"][$row["posY"]."_".$row["posX"]] = array("tipo"=>$row["tipo"],"realX"=>$row["realX"],"realY"=>$row["realY"],"idTerra"=>$row["idTerrain"]);
				else
					$data["ground"][$row["posY"]."_".$row["posX"]."obj"] = array("tipo"=>$row["tipo"],"funct"=>$row["funct"],"realX"=>$row["realX"],"realY"=>$row["realY"],"idTerra"=>$row["idTerrain"]);
				
			}
		
		$db->sql_query("UPDATE personaje SET positionX=".$cuenta["positionX"].",positionY=".$cuenta['positionY'].", speed=".$now." WHERE idPersonaje = ".$log->get("pjSelected"));
}
echo json_encode($data);
?> 