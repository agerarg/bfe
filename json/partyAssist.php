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
		$query = 'SELECT nombre, idPersonaje, party
		FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		$id = intval($_GET['id']);
		$query = 'SELECT nombre, idPersonaje, party, targeting, targetingNature
		FROM personaje
			WHERE idPersonaje = '.$id.' AND party = '.$pj['party'].'';
		$checked = $db->sql_fetchrow($db->sql_query($query));
		if($checked)
		{
			switch($checked['targetingNature'])
			{
				case 2:
					$query = 'SELECT idInMundo
							FROM inmundo
								WHERE idInMundo = '.$checked['targeting'].' AND currentLife>0';
					$objetive = $db->sql_fetchrow($db->sql_query($query));
					if($objetive)
						{
							$data["goForIt"]=1;
							$data["target"]=$checked['targeting'];
							$data["nature"]=$checked['targetingNature'];
						}
						else
						 $data["mensaje"] = "El objetivo ya esta muerto";
				break;
                                case 4:
                                      $targt = explode(",",$checked['targeting']);
                                       $data["goForIt"]=1;
				       $data["targ1"]=$targt[0];
				       $data["targ2"]=$targt[1];
				       $data["targ3"]=$targt[2];
				       $data["targ4"]=$targt[3];
				       $data["targ5"]=$targt[4];
				       $data["nature"]=$checked['targetingNature'];
                                break;
				case 1:
					$query = 'SELECT idInMundo
							FROM inmundo im LEFT JOIN personaje p ON im.idPlayer = p.idPersonaje
								WHERE im.idInMundo = '.$checked['targeting'].' AND p.Vida > 0';
					$objetive = $db->sql_fetchrow($db->sql_query($query));
					if($objetive)
						{
							$data["goForIt"]=1;
							$data["target"]=$checked['targeting'];
							$data["nature"]=$checked['targetingNature'];
						}
					else
						 $data["mensaje"] = "El objetivo ya esta muerto";
				break;
				default:
				 $data["mensaje"] = "No le esta pegando a nada";
				break;
			}
			
		}
		else
		{
			$data["mensaje"] = "El personaje ya no esta en la party";
		}
}
else
{
	$data['mensaje'] = "Error: not logged";
}
 echo json_encode($data);
?> 