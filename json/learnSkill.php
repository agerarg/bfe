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
	$query = 'SELECT p.*,c.dicho, c.nombre AS CLASE ,c.imagen, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN
			FROM personaje p JOIN clase c USING ( idClase ) 
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
	$pj = $db->sql_fetchrow($db->sql_query($query));
	
	
	$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
	$query = 'SELECT i.*
				FROM inventario inv JOIN  item i USING ( idItem ) 
				WHERE inv.idCuenta = '.$log->get("idCuenta").' AND inv.usadoPor = '.$pj['idPersonaje'].'';
		$itemsq = $db->sql_query($query);
	while($item = $db->sql_fetchrow($itemsq))
		{
			if($item['tipo']=="armor")
				$armor = $item['subtipo'];
			if($item['tipo']=="W")
				$Wtipo = $item['subtipo'];
			if($item['tipo']=="shield")
				$shield = 1;
		}	

		$subclase = intval($_GET['subclase']);
		if(($pj['id_clase1']==$subclase OR $pj['id_clase2']==$subclase OR $pj['id_clase3']==$subclase) AND $subclase>0)
			$pj['idClase']=$subclase;
		
		$query = 'SELECT s.*, sl.idskilllearn
					FROM clase_skill cs JOIN skill s USING ( idSkill ) LEFT JOIN skilllearn sl on sl.idSkill = s.idSkill AND sl.idPersonaje = '.$pj['idPersonaje'].'
					WHERE cs.idClase='.$pj['idClase'];
					$skillsq = $db->sql_query($query);
					$newskills=0;
					while($skill = $db->sql_fetchrow($skillsq))
					{
						$id = $skill['idSkill'];
						$learn = intval($_POST['skill'.$id]);
						if(intval($skill['idskilllearn'])==0 AND $learn == 1 AND $skill['lvl_requiere']<=$pj['nivel'])
						{
							$newInsertion[$skill['idSkill']]['nivel']=$skill['nivel'];
							$newInsertion[$skill['idSkill']]['insert']=1;
							$newInsertion[$skill['idSkill']]['skill']=$skill['idSkill'];
							$newInsertion[$skill['idSkill']]['idRealSkill']=$skill['idRealSkill'];
							$newInsertion[$skill['idSkill']]['req']=intval($skill['skill_requiere']);
							if($skill['active']==0)
							{
								if($singleAura[$skill['idRealSkill']]['lvl']<$skill['nivel'])
								{
									$aurpass=true;
									switch($skill['requiere_tipo'])
									{
										case 'armor':
											if($armor!=$skill['requiere'])
												$aurpass=false;
										break;
										case 'W':
											if(!(strlen($skill['requiere'])>1 AND strpos('asd,'.$skill['requiere'].',asd', $Wtipo)))
												$aurpass=false;
										break;
										case 'shield':
											if($shield!=1)
												$aurpass=false;
										break;
									}
									if($aurpass)
									{
										$singleAura[$skill['idRealSkill']]['lvl']=$skill['nivel'];
										$singleAura[$skill['idRealSkill']]['id']=$skill['idSkill'];
										$singleAura[$skill['idRealSkill']]['nombre']=$skill['nombre'];
										$singleAura[$skill['idRealSkill']]['imagen']=$skill['imagen'];
										$singleAura[$skill['idRealSkill']]['idReal']=$skill['idRealSkill'];
									}
								}
							}
							$newskills++;
						}	
						else
						{
							$newInsertion[$skill['idSkill']]['nivel']=$skill['nivel'];
							$newInsertion[$skill['idSkill']]['insert']=0;
							$newInsertion[$skill['idSkill']]['idRealSkill']=$skill['idRealSkill'];
							$newInsertion[$skill['idSkill']]['skill']=$skill['idSkill'];
							$newInsertion[$skill['idSkill']]['req']=intval($skill['skill_requiere']);
							$newInsertion[$skill['idSkill']]['active']=$skill['active'];
						}
					}
			$puntos = $pj['skillPoints'];
			
			if($newskills<=$puntos)
			{		
			$something=0;
			
			$db->sql_query("UPDATE personaje SET
			skillPoints = (skillPoints-".$newskills.")
		  WHERE idPersonaje  = '".$log->get("pjSelected")."'");
			
			if(is_array($newInsertion))
			{
				foreach ($newInsertion as $ins) {
										
										if($ins['insert']==1 AND (is_array($newInsertion[$ins['req']]) OR $newInsertion[$ins['req']]==0))
										{
												$query = 'SELECT idSkillLearn, keybind, orden
												FROM skilllearn
												WHERE idRealSkill = "'.$ins['idRealSkill'].'" AND idPersonaje="'.$log->get("pjSelected").'" AND disable=0';
												$chksq = $db->sql_query($query);
												$chk = $db->sql_fetchrow($chksq);
												if($chk)
													$db->sql_query("UPDATE skilllearn SET disable=1 WHERE idSkillLearn  = '".$chk['idSkillLearn']."'");
												
												$db->sql_query('INSERT INTO skilllearn (idSkill,idPersonaje,nivel,idRealSkill,disable,keybind,orden) 
											VALUES("'.$ins['skill'].'", "'.$log->get("pjSelected").'","'.$ins['nivel'].'","'.$ins['idRealSkill'].'",0,"'.intval($chk['keybind']).'","'.intval($chk['orden']).'")');
											$something=1;
										}
						}
			}
			if(is_array($singleAura))
			{
				foreach ($singleAura as $aura)
				{
					$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$aura['idReal']."' AND idPersonaje = ".$pj['idPersonaje']);
					$acumulator=0;
					switch($aura['idReal'])
					{
						case 16:
							$acumulator=intval($stats['soulAcumulate']);
						break;
					}
					$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,acumuleitor) 
								VALUES("'.$log->get("pjSelected").'","'.$aura['id'].'","1",'.$aura['idReal'].','.$acumulator.')');
															
					$data['aura'][] = array("idSkill"=>$aura['idReal'],"lvl"=>$aura['lvl'],"auraTimeOut"=>$acumulator,"pasive"=>1);
					$data['auraCheck']=true;
				}
			}
				if($something==1)	
				{
					$data['msg'] = "Nueva habilidad aprendida.";
					$data['frozen'] = 1;	
					/// QUEST
				
				///////
				}
				else
					$data['msg'] = "No aprendiste nada";		
			}
			else
				$data['msg'] = "No tienes suficientes puntos.";		
}
else
{
	$data['msg'] = "Error: user not login";
}
 echo json_encode($data);
?> 