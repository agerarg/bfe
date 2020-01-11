<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
define('SWORDON', 1);
include('../system/funciones.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{

		$data['error']=0;
		$id = intval($_GET['id']);
		$data['id']=$id;
		$query = 'SELECT p . * 
			FROM personaje p
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").' AND p.desactivada=0';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		$text = "";
		if($pj['godLevelSpend']>0)
		{

			$globalLvl = $pj['godlvlAttack']+$pj['godlvlCritico']+$pj['godlvlDefensa']+$pj['godlvlVida']+$pj['godlvlElem'];

			$lvlup=false;
			$whut="";
			switch($id)
			{
				case 1:
					// ataque
					$whut="godlvlAttack";
					$level = $pj['godlvlAttack'];

					if((int)($globalLvl/5)>=$level)
					{
						$lvlup=true;

						$level++;
					}

					$text = "Nivel: ".$level." <br>Aumenta ".$level."% los Ataques";
				break;
				case 2:
					//critico
					$whut="godlvlCritico";
					$level = $pj['godlvlCritico'];

					if((int)($globalLvl/5)>=$level)
					{
						$lvlup=true;

						$level++;
					}
					$text = "Nivel: ".$level." <br>Aumenta ".$level."% los Daños Criticos";
				break;
				case 3:
					//defensas
					$whut="godlvlDefensa";
					$level = $pj['godlvlDefensa'];

					if((int)($globalLvl/5)>=$level)
					{
						$lvlup=true;

						$level++;
					}
					$text = "Nivel: ".$level." <br>Aumenta ".$level."% las Defensas";
				break;
				case 4:
					// vida
					$whut="godlvlVida";
					$level = $pj['godlvlVida'];

					if((int)($globalLvl/5)>=$level)
					{
						$lvlup=true;

						$level++;
					}
					$text = "Nivel: ".$level." <br>Aumenta ".($level*5)."% la Vida";
				break;
				case 5:
					// elemental
					$whut="godlvlElem";
					$level = $pj['godlvlElem'];

					if((int)($globalLvl/5)>=$level)
					{
						$lvlup=true;

						$level++;
					}
					$text = "Nivel: ".$level." <br>Aumenta ".$level."% Elemento";
				break;
			}


			if($lvlup)
			{
				$pj['godLevelSpend']--;
				$data['newText']=$text;
				$data['puntos']=$pj['godLevelSpend'];
				$db->sql_query("UPDATE personaje SET ".$whut."=(".$whut."+1), godLevelSpend = (godLevelSpend-1) WHERE idPersonaje = '".$pj['idPersonaje']."'");
			}
			else
			{
				$data['error']=1;
				$data['error_msg']="Para subir un nivel todas las otras habilidades tienen que ser del mismo nivel";
			}

		}
		else
		{
			$data['error']=1;
			$data['error_msg']="Necesitas putos God Level.";
		}
}
else
{
	$data['error']=1;
}		
 echo json_encode($data);
?> 