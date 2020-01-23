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
		$now=time();
		$query = 'SELECT * FROM personaje p
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		$sqlsd="";
		if($pj['showBuffs'])
			$sqlsd = "AND (acumuleitor > 0 OR static=0)";

		$query = 'SELECT a.idPersonaje, a.idSkillReal, s.idSkill, a.idAura, a.timeOut, s.nombre, s.imagen, a.static, a.acumuleitor, s.nivel
		FROM aura a JOIN skill s USING ( idSkill ) 
		WHERE (a.idPersonaje = '.$log->get("pjSelected").' AND s.pasive=0  '.$sqlsd.') OR global=1';
		$skillsq = $db->sql_query($query);
		$data['something'] = 0;
		while($aura = $db->sql_fetchrow($skillsq))
		{
			if($aura['timeOut']<$now AND $aura['static']==0)
			{
				$db->sql_query("DELETE FROM aura WHERE idAura = '".$aura['idAura']."'");
			}
			else
			{
				if(!$neveragain[$aura['idSkillReal']])
					{
							$neveragain[$aura['idSkillReal']]=true;
							$cadena = tratadoDesc($aura['desc']);
							if($aura['static']==1)
								$aura['timeOut']=$aura['acumuleitor'];
							else
								$aura['timeOut']=($aura['timeOut']-$now);
						$data['aura'][] = array("idSkill"=>$aura['idSkillReal'],"timeOut"=>$aura['timeOut'],"static"=>$aura['static'],"lvl"=>$aura['nivel']);		
							$data['something'] = 1;
				}
			}
		}
		$data['error'] = 0;
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 