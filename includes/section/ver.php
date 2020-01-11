<?php
$nombre = textIntoSql($_GET['pj']);
								$query = 'SELECT p.*,c.imagenBig, c.dicho, c.nombre AS CLASE ,c.imagen, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN
									FROM personaje p JOIN clase c USING ( idClase )
									WHERE p.nombre LIKE "'.$nombre.'" AND p.desactivada=0';
							$pj = $db->sql_fetchrow($db->sql_query($query));


							if($pj['SubClassFrom']>0){
								$query = 'SELECT p.*,c.imagenBig, c.dicho, c.nombre AS CLASE ,c.imagen, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN
									FROM personaje p JOIN clase c USING ( idClase )
									WHERE idPersonaje = "'.$pj['SubClassFrom'].'" AND p.desactivada=0';
									unset($pj);
							$pj = $db->sql_fetchrow($db->sql_query($query));
							}

							//$pj['imagen'] = $pj['imagen'].'_'.$pj['sexo'].'.jpg';
							$pj['imagen'] = $pj['imagen'].'_'.$pj['sexo'].'.jpg';
						if($pj['idPersonaje']>0)	
						{
							
							
							
								/// RANKEDS
								$query = 'SELECT * FROM `topplayer` 
								WHERE idPersonaje = '.$pj['idPersonaje'].' 
								ORDER BY topn  limit 0,4
								';
						$rakedsq = $db->sql_query($query);
	
						while($ranked = $db->sql_fetchrow($rakedsq))
						{
							if($ranked['topn']<=10)
								$rankImg="RankDiamante";
							else if($ranked['topn']<=20)	
								$rankImg="RankPlatino";
							else if($ranked['topn']<=40)	
								$rankImg="RankGold";
							else if($ranked['topn']<=70)	
								$rankImg="RankSilver";
							else
								$rankImg="RankBronce";
						
							if (strpos($ranked['tipo'], 'DPS') !== false) {
								$ranked['tipo']="DPS";
							}
								
							$template->assign_block_vars('RANK', array(
												'NOMBRE' => $ranked['tipo'],
												'NRO' => $ranked['topn'],
												'RANK' => $rankImg
												));		
						}	
							
							
							
							 $template->assign_vars(array(
							 	'BASEIMAGE' => $pj['imagenBig'],
							 	'SEXO' => $pj['sexo']));
							
							
							$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
							
							
					$template->assign_var('NOMASCOTA', "GTFO");

					$lvlShow="";
					if($pj['godLevel']>0)
					$lvlShow='<span class=" godLevelLvl">Nivel: '.($pj['nivel']+$pj['godLevel']).'</span>';
				else
					$lvlShow='<span class="">Nivel: '.$pj['nivel'].'</span>';


							 $template->assign_vars(array(
							  'ELO' => $pj['mmr'],
							  'ELOIMG' => $rangImg,
							  'ELOTITLE' => $rangTitulo,
				 'PVP2' => $pj['PVP'],
				 'ATKSPEED2' => $stats['PSpeed'],
				 'CASTSPEED2' => $stats['CSpeed'],
				 'PK2' => $pj['PK'],
				  'IDPJ2' => $pj['idPersonaje'],
			  'CLASE_P2' => $pj['dicho'],
			   'CLASE_P_INFO2' => $pj['CLASE'],
			  'IMG_P2' => $pj['imagen'],
			  'NOMBRE_P2' => $pj['nombre'],
			   'ILVL2' => $stats['ItemLevel'],
				'LVL_P2' => $lvlShow,
				'VIDA_P2' => $pj['Vida'],
				'VIDA_L_P2' => $stats['VidaLimit'],
				'MANA_P2' => $pj['Mana'],
				'MANA_L_P2' => $stats['ManaLimit'],
				'EXP_P2' => $pj['exp'],
				'EXP_L_P2' => $pj['expUp'],
				'ATA_P2' => $stats['Ataque'],
				'ATA_M_P2' => $stats['AtaqueMagico'],
				'DEF_P2' => $stats['Defensa'],
				'DEF_M_P2' => $stats['DefensaMagica'],
				'CR_P2' => $stats['Critico'],
				'CR_M_P2' => $stats['CriticoMagico'],
				'PC_P2' => $stats['PC'],
				'PC_M_P2' => $stats['PCMagico'],
				'ELEMENTO2' => $stats['elemAttack'],
				'ELEMENTODMG2' => $stats['elemDmg'],
				'BASEDPS2' => $stats['baseDPS'],
				'CON2' => $stats['CON'],
				'STR2' => $stats['STR'],
				'DEX2' => $stats['DEX'],
				'INT2' => $stats['INT'],
				'WIT2' => $stats['WIT'],
				'MEN2' => $stats['MEN']
				));
						
							$query = 'SELECT i.armorset, i.Nombre, i.subtipo, i.imagen, i.tipo,inv.idInventario,i.hand,i.imagen,inv.manoDerecha ,inv.manoIzquierda
					FROM inventario inv JOIN item i USING ( idItem ) 
					WHERE inv.usadoPor = "'.intval($pj['idPersonaje']).'"';
					$itemsq = $db->sql_query($query);
					$slots["arma"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["botas"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["armadura"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["escudo"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["guantes"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["head"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["necklace"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["head"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["rings"]["box"]="<img src='images/blank.gif' width='35' height='35' />";
					$slots["armadura"]["active"]=0;
					$slots["arma"]["active"]=0;
					$slots["botas"]["active"]=0;
					$slots["rings"]["active"]=0;
					$slots["escudo"]["active"]=0;
					$slots["guantes"]["active"]=0;
					$slots["head"]["active"]=0;
					$slots["necklace"]["active"]=0;
					$slots["head"]["active"]=0;
					while($item = $db->sql_fetchrow($itemsq))
					{
						if($item['manoIzquierda'])
						{
							$item['tipo']='shield';
							$item['hand']=1;
							$ExtraWeapon=1;
						}
						if($item['manoDerecha'] AND $ExtraWeapon)
							$item['hand']=1;
						$slots[$item['tipo']]["box"] = "<a href='javascript:quitarItemStarted(".$item['idInventario'].");'>
						<img idItem='".$item['idInventario']."' class='showSetInfo' border='0' src='images/item/".$item['subtipo']."/".$item['imagen']."' title='".$item['Nombre']."' width='35' height='35' />
						</a>";
						$slots[$item['tipo']]["active"]=1;
					/*	if($item['hand']==2)
						{
							$noshield=1;
							$noshieldimg= $item['subtipo']."/".$item['imagen'];	
						}*/
					}
					if($noshield)
					{
						$slots["shield"]["box"]="<img  class='selectedImg' src='images/item/".$noshieldimg."' width='35' height='35' />";
					}
					 $template->assign_vars(array(
					  'S_ARMA' => $slots["W"]["box"],
					   'S_ARMADURA' => $slots["armor"]["box"],
						'S_BOTAS' => $slots["foots"]["box"],
						 'S_RINGS' => $slots["rings"]["box"],
						  'S_ESCUDO' => $slots["shield"]["box"],
						   'S_GUANTES' => $slots["gloves"]["box"],
							'S_HEAD' => $slots["head"]["box"],
							'S_ERRINGS' => $slots["necklace"]["box"],
							'AS_ARMA' => $slots["W"]["active"],
					   'AS_ARMADURA' => $slots["armor"]["active"],
						'AS_BOTAS' => $slots["foots"]["active"],
						 'AS_RINGS' => $slots["rings"]["active"],
						  'AS_ESCUDO' => $slots["shield"]["active"],
						   'AS_GUANTES' => $slots["gloves"]["active"],
							'AS_HEAD' => $slots["head"]["active"],
							'AS_ERRINGS' => $slots["necklace"]["active"]
			));
			$template->set_filenames(array(
									'content' => 'templates/sec/verPj.html' )
								);




			switch($pj['idClase'])
					{	
						case 1:
						$template->assign_var('FONDIMAG',"zombie_warrior.jpg");	
						break;
						case 2:
						$template->assign_var('FONDIMAG',"skeleton_mage.jpg");	
						break;
						case 3:
						$template->assign_var('FONDIMAG',"ninja.jpg");	
						break;
						case 4:
						$template->assign_var('FONDIMAG',"marksman.jpg");	
						break;
						case 5:
						$template->assign_var('FONDIMAG',"shaman.jpg");	
						break;
						case 6:
						$template->assign_var('FONDIMAG',"vampire.jpg");	
						break;
						case 7:
						$template->assign_var('FONDIMAG',"destroyer.jpg");	
						break;
						case 8:
						$template->assign_var('FONDIMAG',"cleric.jpg?1");	
						break;
						case 10:
						$template->assign_var('FONDIMAG',"garca.jpg?1");	
						break;
						
					}

					$template->assign_var('PUNTOS',1);	

					$query = 'SELECT s.*, sl.idskilllearn
					FROM clase_skill cs JOIN skill s USING ( idSkill ) LEFT JOIN skilllearn sl on sl.idSkill = s.idSkill AND sl.idPersonaje = '.$pj['idPersonaje'].'
					WHERE cs.idClase='.$pj['idClase'];
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













						}
						else
						{
							show_error("No existe este personaje!","index.php");
						}