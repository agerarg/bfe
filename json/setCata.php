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
		$tier = intval($_GET['tier']);
		if($tier>5)
			die();
		$itemsTrash=$_GET['it'];

		$itemsTrash=explode(",",$itemsTrash);
		$i=0;
		$sqlAdds="";
		$or="";
			while($itemsTrash[$i])
			{
				$itemid = intval($itemsTrash[$i]);
				if($itemid>0)
				{
					$sqlAdds.=" ".$or." idInventario = ".$itemid;
					$or=" OR ";
				}
				$i++;
			}
			$data['back']=$sqlAdds;
			//TODO ELIMINA ITEMS CON SUS ATRIBUTOS.

			switch($tier)
			{
				case 1:
					$sqlSrc=' (inv.extraLevel = 2 OR inv.extraLevel = 3 OR inv.extraLevel = 4)';
				break;
				case 2:
					$sqlSrc=' (inv.extraLevel = 5 OR inv.extraLevel = 6)';
				break;
				case 3:
					$sqlSrc=' (inv.extraLevel = 7 OR inv.extraLevel = 8)';
				break;
			}	

			$query = 'SELECT idInventario 
			FROM inventario inv JOIN item i USING ( idItem )
			WHERE ('.$sqlAdds.') 
			AND usadoPor = 0 
			AND enVenta = 0
			AND i.tipo = "runa"
			AND '.$sqlSrc;
			$checkitemsq = $db->sql_query($query);
			$cta=0;
			while($checkitems = $db->sql_fetchrow($checkitemsq))
			{
					$cta++;
			}
			if($cta==5)
			{


				switch($tier)
				{
					default:
						die("Reto critical error!");
					break;
					case 1:
						$monsterStart=195;
						$cantidadMonst=1;
						$waves=1;
					break;
					case 2:
						$monsterStart=196;
						$cantidadMonst=1;
						$waves=1;
					break;
					case 3:
						$monsterStart=197;
						$cantidadMonst=1;
						$waves=1;
					break;
				}	
						$db->sql_query("DELETE FROM inventario 
						WHERE ".$sqlAdds );
						$i=0;
						while($itemsTrash[$i])
						{
							$itemid = intval($itemsTrash[$i]);
							if($itemid>0)
							{
								$db->sql_query("DELETE FROM item_attr 
						WHERE idInventario = ".$itemid);
							}
							$i++;
						}
						$data['back']=1;


					///// NEW RETO
					$query = 'SELECT *
							FROM personaje
							WHERE idCuenta = '.$log->get("idCuenta").' 
							AND idPersonaje = '.$log->get("pjSelected").'';
							$pj = $db->sql_fetchrow($db->sql_query($query));
						insertBuff($pj['idPersonaje'],246,147,600);	
						$query = 'SELECT idInstance FROM dungeon_instance WHERE idPersonaje='.$pj['idPersonaje'].'';
					
						$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					$db->sql_query('INSERT INTO  dungeon_instance(idPersonaje,nivel,waves,waveCurr,itemGrado,dificultad,idParty,cata) 
					VALUES("'.$pj['idPersonaje'].'",1,'.$waves.',1,1,1,0,'.$tier.')');
					
					$query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
								$itemsq = $db->sql_query($query);
								$maxId = $db->sql_fetchrow($itemsq);
									
					/// MONSTER IN THE INTANCE CREATION
					$query = 'SELECT *
							FROM monster
							WHERE idMonster = '.$monsterStart;
						$monstersq = $db->sql_query($query);
						$mob = $db->sql_fetchrow($monstersq);		

						for($i=0;$i<$cantidadMonst;$i++)
						{
							$db->sql_query('INSERT INTO  
								inmundo(idMonster,tipo,mundo,
								currentLife,dificulty,
								idInstance,deQuien) 
							VALUES("'.$mob['idMonster'].'","2",
								1,"'.$mob['VidaLimit'].'",1,'.$maxId['ID'].',
								'.$pj['idPersonaje'].')');
						}		

					
					$db->sql_query("UPDATE personaje SET
							inDungeon = 1, dungeonInstance=".$maxId['ID']."
							WHERE  idPersonaje = '".$pj['idPersonaje']."'");		
							

			}
			else
			{
				$data['back']=0;
			}

}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 