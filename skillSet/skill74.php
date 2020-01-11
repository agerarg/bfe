<?php
//Crystal soul
$ataque_player=1;
$fisicalCoolDown = $stats['CSpeed'];

$mixedid = intval($check['idInMundo']);
if($_SESSION['MonsterSoulGET']!=$mixedid)
{
	$_SESSION['MonsterSoulGET']=$mixedid;
	$query = 'SELECT inv.idInventario, i.idItem
						FROM item i, inventario inv
						WHERE i.idItem = inv.idItem AND i.tipo = "crystal" AND inv.idCuenta="'.$log->get("idCuenta").'"';
					
	$itemsq = $db->sql_query($query);
	$crystal = $db->sql_fetchrow($itemsq);
	
	switch($crystal['idItem'])
	{
		case 300: // Nivel 1
			if($monster['idMonster']==66 OR $monster['idMonster']==74 )
			{
				$rand = mt_rand(1,100);
				if($rand<50)
				{
					delete_item($crystal['idInventario']);
					add_item(301,1,$log->get("idCuenta"),1);
					$data['info'] .= "Crystal went level up!";
				}
				else
				$data['info'] .= "Crystal failed to extract the soul!";	
			}
			else
				$data['info'] .= "Wrong target!";	
		break;
		case 301: // Nivel 2
			if($monster['idMonster']==74 )
			{
				$rand = mt_rand(1,100);
				if($rand<50)
				{
					delete_item($crystal['idInventario']);
					add_item(302,1,$log->get("idCuenta"),1);
					$data['info'] .= "Crystal went level up!";
				}
				else
				$data['info'] .= "Crystal failed to extract the soul!";	
			}
			else
					$data['info'] .= "Wrong target!";
		break;
		case 302: // Nivel 3
			/*if($monster['idMonster']==41 OR $monster['idMonster']==42 OR $monster['idMonster']==40)
			{
				$rand = mt_rand(1,100);
				if($rand<5)
				{
					delete_item($crystal['idInventario']);
					add_item(303,1,$log->get("idCuenta"),1);
					$data['info'] .= "Crystal went level up!";
				}
				else
				$data['info'] .= "Crystal failed to extract the soul!";	
			}
			else*/
				$data['info'] .= "Wrong target!";
		break;
		case 303:
			$data['info'] .= "The crystal is the maximum!";
		break;
	}
}
else
	$data['info'] .= "You can not use the crystal in the same monster!";
//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
