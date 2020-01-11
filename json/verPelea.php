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
		$id = intval($_GET['id']);
		$query = 'SELECT th.*, s.imagen
					FROM torneo_history th LEFT JOIN skill s on th.skilluse = s.idSkill
					WHERE idPosicion = '.$id.'';
		$historysq = $db->sql_query($query);
						while($history = $db->sql_fetchrow($historysq))
						{
							if(!$history['imagen'])
								$history['imagen']="basicAttack.jpg";
							$data["H"][] = array("VIDA1"=>$history["vida1"],"VIDA2"=>$history["vida2"],"IMG"=>$history["imagen"],"DMG"=>$history["damage"],"PJ"=>$history["playerMove"]);
				
						}
					
}
echo json_encode($data);
?> 