<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
							'content' => 'templates/sec/paragon.html' )
						);
						$text =  "".$pj['paragonNow'];
						$template->assign_var('PUNTOS',$text);	
						$template->assign_var('PARAGONEXTRA',$pj['paragonDmg']);	
						
						$template->assign_var('FONDIMAG',"paragon.jpg");	

					$query = 'SELECT s.*, sl.idskilllearn
					FROM clase_skill cs JOIN skill s USING ( idSkill ) LEFT JOIN skilllearn sl on sl.idSkill = s.idSkill AND sl.idPersonaje = '.$pj['idPersonaje'].'
					WHERE cs.idClase=9';
					$skillsq = $db->sql_query($query);
					while($skill = $db->sql_fetchrow($skillsq))
					{	
						$i = $skill['idSkill'];
						$habilita = explode(',',$skill['skill_habilita']);
						if(is_array($habilita))
								foreach ($habilita as $id) {
									$habilitadopor[$id][] =  $i;
									$habilitadoa[$i][] =  $id;
							}
						$arrayskill[$i] = $skill;
						if($skill['idskilllearn']>0)
							$arrayskill[$i]['aprender']=1;
						else
							$arrayskill[$i]['aprender']=0;
					}
					if(is_array($arrayskill))
					foreach ($arrayskill as $skill) {
						$able=1;
						$upscripting="";
						$downscripting="";
						$id = $skill['idSkill'];
						//alble
						
						//requiere
						if(is_array($habilitadoa[$id]))
							{
								foreach ($habilitadoa[$id] as $habil) {
									$downscripting.=" slotNoAble(".$habil.");";
								}
								$require = explode(',',$skill['skill_requiere']);
								foreach ($require as $ids) {
									$idhabiliteitor = $ids;
									if($arrayskill[$ids]['aprender']==0 AND $ids!=0)
										$able=0;
								}
								$habiliteitor = explode(',',$arrayskill[$idhabiliteitor]['skill_habilita']);
									if(count($habiliteitor)>1)
									{
										$downscripting.= "if(";
										foreach ($habiliteitor as $idq) {
											if($idq!=$id)
												$downscripting.= "slotState[".$idq."]==0 && ";
										}
										$downscripting.= "1==1";
										$downscripting.= "){";
										$downscripting.= " slotAble(".$idhabiliteitor."); ";
										$downscripting.= "}";
									}
									else
										$downscripting.=" slotAble(".$idhabiliteitor."); ";
							}
						$template->assign_block_vars('SDOWNSLOT', array(
												'ID' => $skill['idSkill'],
												'DO' => $downscripting
												));
						//
						// habilita							
							if(is_array($habilitadopor[$id]))
							{
								foreach ($habilitadopor[$id] as $habil) {
									$upscripting.=" slotNoAble(".$habil.");";
								}
							}
							$habilita = explode(',',$skill['skill_habilita']);
								foreach ($habilita as $idc) {
									$upscripting.=" slotAble(".$idc."); ";
									
							}
						
						$template->assign_block_vars('SUPSLOT', array(
												'ID' => $skill['idSkill'],
												'DO' => $upscripting
												));
						//
						if($skill['lvl_requiere']<=$pj['nivel'])
							$cango=1;
						else
							$cango=0;
						$cadena = utf8_encode($skill['desc']);
						$cadena = @eregi_replace("/\r\n+|\r+|\n+|\t+/i",  ' ', $cadena);

	
						$template->assign_block_vars('S', array(
												'ID' => $skill['idSkill'],
												'SPOT' => $skill['slotPlacet'],
												'NAME' => $skill['nombre'],
												'IMG' => $skill['imagen'],
												'NEW' => $skill['aprender'],
												'CANDO' => $cango,
												'DESC' => $cadena,
												'ABLE' => $able
												));
					}
?> 