<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
							'content' => 'templates/sec/inventario.html' )
						);
				
						
					$_SESSION['ALLOW2Hand'] = $stats['Allow2Hand'];

					if($stats['Allow2Hand']) //Currency selector
					{ 
							$template->assign_var('CURRSINLE', ' <option id="op_arma" selected value="Wizq">Arma Izquierda</option>
                         <option value="Wder">Arma Derecha</option> ');
					}
					else
					{
						$template->assign_var('CURRSINLE', ' <option id="op_arma" selected value="W">Arma</option>');
					}

					$query = 'SELECT i.*, inv.*, cv.precio
						FROM compra_venta cv JOIN inventario inv USING ( idInventario ) JOIN item i USING ( idItem )
						WHERE cantidad>0  ORDER BY cv.precio';
					$itemsq = $db->sql_query($query);
					$arrow = array();
					$ventas = $db->sql_fetchrow($itemsq);

					$query = 'SELECT count(*) as CONTA
				FROM compra_venta
				WHERE idCuenta = '.$log->get("idCuenta").'';
				$ventas = $db->sql_fetchrow($db->sql_query($query));
				$template->assign_var('MYSELLCOUNT', $ventas['CONTA']);

				if($log->get("premium")==1)
				{
					$template->assign_var('MYSELLLIMIT', 10);
					$template->assign_var('MYINVLIIT', 400);
				}
				else	
				{
					$template->assign_var('MYINVLIIT', 200);
					$template->assign_var('MYSELLLIMIT', 5);
				}
					$query = 'SELECT i.armorset, i.Nombre, i.tipo, i.subtipo, i.imagen, i.tipo,inv.idInventario,i.hand,i.imagen,inv.manoDerecha ,inv.manoIzquierda, inv.potSlot
				FROM inventario inv JOIN item i USING ( idItem )
				WHERE inv.idCuenta = '.$log->get("idCuenta").' AND inv.usadoPor = '.$log->get("pjSelected").'';
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
					$template->assign_var('POTSLOT0',"Espacio vacio");
					$template->assign_var('POTSLOT1',"Espacio vacio");
					$template->assign_var('POTSLOT2',"Espacio vacio");
					$template->assign_var('POTSLOT3',"Espacio vacio");
					$template->assign_var('POTSLOT4',"Espacio vacio");
					$template->assign_var('POTSLOT5',"Espacio vacio");
					while($item = $db->sql_fetchrow($itemsq))
					{
						
						$slots[$item['tipo']]["box"] = "<a href='javascript:quitarItemStarted(".$item['idInventario'].");'>
						<img idItem='".$item['idInventario']."' class='showSetInfo' border='0' src='images/item/".$item['subtipo']."/".$item['imagen']."' title='".$item['Nombre']."' width='35' height='35' />
						</a>";
						$slots[$item['tipo']]["active"]=1;
						/*if($item['hand']==2)
						{
							$noshield=1;
							$noshieldimg= $item['subtipo']."/".$item['imagen'];	
						}*/
						if($item['tipo']=='pot')
						{
							$template->assign_var('POTSLOT'.$item['potSlot'],$item['Nombre']);
						}
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
?> 