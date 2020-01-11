<?php
//Bite
$data['animation']=0;
$fisicalCoolDown = 1;

switch($check['tipo'])
		{
			default:
				$data['info'] .= $skill['nombre']." objetivo incorrecto.";
			break;
			case 1:
				$query = 'SELECT idClase
					FROM personaje
					WHERE  idPersonaje = '.$monster['PJID'];
				$playersq = $db->sql_query($query);
				$player = $db->sql_fetchrow($playersq);
				if($player['idClase']==10)
				{
					$data['info'] .= $skill['nombre']." no funciona con garcas";
					$pvpInfo .= $skill['nombre']."  no funciona con garcas";
				}
				else
				{
					
						$query = 'SELECT i.idItem, i.Nombre
							FROM item i JOIN inventario inv USING ( idItem )
							WHERE usadoPor = '.$monster['PJID'].' ORDER BY RAND() LIMIT 0,1';
						$itemsq = $db->sql_query($query);
						$item = $db->sql_fetchrow($itemsq);
					
					if($item)
					{
						$db->sql_query('INSERT INTO inventario(idItem,idCuenta,cantidad,intradeable,trucho) VALUES("'.$item['idItem'].'","'.$log->get("idCuenta").'",1,1,1)');
						$data['info'] .= $skill['nombre']." truchaste ".$item['Nombre'];
						$pvpInfo .= "Trucho ".$item['Nombre'];
					}
					else
					{
						$data['info'] .= $skill['nombre']." no encontro ningun item";
						$pvpInfo .= $skill['nombre']." no encontro ningun item";
					}
				}
		}

$MonsterAttackAproval=false;
?>
