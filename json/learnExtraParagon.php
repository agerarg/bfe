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


		$query = 'SELECT COUNT(*) AS CONTA FROM clase_skill cs JOIN skill s USING ( idSkill ) LEFT JOIN skilllearn sl on sl.idSkill = s.idSkill AND sl.idPersonaje = '.$log->get("pjSelected").' WHERE cs.idClase=9 AND sl.idSkillLearn > 0';
		$skillsq = $db->sql_query($query);
		$skill = $db->sql_fetchrow($skillsq);

		$count = (int)$skill['CONTA'];
		if($count==54)
		{
				$query = 'SELECT paragonNow
				FROM personaje p
			WHERE p.idPersonaje = '.$log->get("pjSelected").'';
			$pj = $db->sql_fetchrow($db->sql_query($query));

			if($pj['paragonNow']>0)
			{
				$data['error']=0;
				$db->sql_query("UPDATE personaje SET paragonNow=(paragonNow-1), paragonDmg=(paragonDmg+1) WHERE idPersonaje = ".$log->get("pjSelected"));
			}
			else
			{
				$data['error']=1;
				$data['error_msg']="No tienes suficientes puntos de paragon.";
			}

		}
		else
		{
			$data['error']=1;
			$data['error_msg']="No tienes todos los paragon skills aprendidos.";
		}
}
else
{
	$data['error']=1;
}		
 echo json_encode($data);
?> 