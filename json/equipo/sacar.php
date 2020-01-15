<?php

$error=false;
						if($item['usadoPor']==$log->get("pjSelected"))
						{
							// chekeando pasivos "sacar"
							if(!$error)
							{			
										if($item['tipo']=="armor")
											$armor = $item['subtipo'];
										if($item['tipo']=="W")
											$Wtipo = $item['subtipo'];
										if($item['tipo']=="shield")
											$shield = 1;
										
										$query = 'SELECT s.*, sl.idskilllearn
										FROM skill s JOIN skilllearn sl USING ( idSkill )
										WHERE s.active = 0 AND sl.idPersonaje = '.$log->get("pjSelected").'
										ORDER BY sl.nivel DESC';
										$skillsq = $db->sql_query($query);
										$newskills=0;
										while($skill = $db->sql_fetchrow($skillsq))
										{
											$aurpass=false;
											switch($skill['requiere_tipo'])
											{
												case 'armor':
													if($armor==$skill['requiere'])
														$aurpass=true;
												break;
												case 'W':
													if(strlen($skill['requiere'])>1 AND strpos('asd,'.$skill['requiere'].',asd', $Wtipo))
														$aurpass=true;
												break;
												case 'shield':
													if($shield==1)
														$aurpass=true;
												break;
											}
											if($aurpass AND !$quemado[$skill['idRealSkill']])
											{
												$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$skill['idRealSkill']."' AND idPersonaje = '".$log->get("pjSelected")."'");

												$quemado[$skill['idRealSkill']]=true;
												$data['aura'][] = array("idSkill"=>$skill['idRealSkill']);
												$data['auraCheck']=true;
											}
											
										}
										//
										if($item['idSkillReal']>0)
										{
											$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$item['idSkillReal']."' AND idPersonaje = '".$log->get("pjSelected")."'");

											$data['aura'][] = array("idSkill"=>$item['idSkillReal']);
											$data['auraCheck']=true;
										}
										///// SKILL ITEM
										if($item['newSkill']>0)
										{
											$db->sql_query("DELETE FROM skilllearn WHERE idRealSkill = '".$item['newSkill']."' AND idPersonaje = '".$log->get("pjSelected")."' ");
										}
										//ITEM BALANCE
										switch($item['idItem'])
										{
											case 540:
												 $db->sql_query('DELETE FROM aura WHERE idSkillReal = 107 AND idPersonaje = '.$log->get("pjSelected"));
										            $data['aura'][] = array("idSkill"=>107,"lvl"=>2,"auraTimeOut"=>0,"pasive"=>0);
											   $data['auraCheck']=true;
											break;
											case 574:
												 $db->sql_query('DELETE FROM aura WHERE 
												 	(idSkillReal = 146 OR idSkillReal = 382) 
												 	AND idPersonaje = '.$log->get("pjSelected"));
										            $data['aura'][] = array("idSkill"=>146,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
										              $data['aura'][] = array("idSkill"=>382,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
											   $data['auraCheck']=true;
											break;
										}


							$db->sql_query("UPDATE inventario SET
											usadoPor = 0, manoIzquierda = 0, manoDerecha = 0
											WHERE idInventario = ".$item['idInventario']);
							
							
							$data["manoDerecha"] = $item['manoDerecha'];
							
							
							$data["error"] = 0;
							unset($_SESSION['PJITEM']);
							$data['newstats'] = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
							}
							else
								$data["error"] = $error;
						}
						else
							$data["error"] = "No esta en uso";

?>