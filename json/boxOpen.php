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
		$id = intval($_GET['id']);
		$query = 'SELECT *
			FROM boxes_player
			WHERE idBox = "'.$id.'" AND idPersonaje = '.$log->get("pjSelected");
		$boxsq = $db->sql_query($query);
		$box = $db->sql_fetchrow($boxsq);
		if($box)
		{

			$data['boxTier']=$box['tier'];
			$data['special']=$box['especial'];
			if($box['opened']==0)
			{
				include("../system/dropBoxInner.php");
				generateBoxItem($box['tier'],$box['idBox'],$box['nivel'],$box['especial']);
				generateBoxItem($box['tier'],$box['idBox'],$box['nivel'],$box['especial']);
				generateBoxItem($box['tier'],$box['idBox'],$box['nivel'],$box['especial']);
				generateBoxItem($box['tier'],$box['idBox'],$box['nivel'],$box['especial']);
				generateBoxItem($box['tier'],$box['idBox'],$box['nivel'],$box['especial']);
				$db->sql_query("UPDATE boxes_player SET opened = 1
		WHERE idBox	 = '".$box['idBox']."'");
				unset($_SESSION['gotConsum']);
			}


			$query = 'SELECT i.*,inv.*, inv.nivel AS value, inv.text_legend AS atributos
			FROM item i JOIN boxes_drop inv USING ( idItem )
			WHERE inv.idBox = '.$box['idBox'].'';
			
		$itemsq = $db->sql_query($query);
		while($item = $db->sql_fetchrow($itemsq))
		{
			switch($item['value'])
				{
					case 1:
						$item['Ataque']+=intval($item['Ataque']/4);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/4);
						$item['Defensa']+=intval($item['Defensa']/4);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/4);
					break;
					case 2:
						$item['Ataque']+=intval($item['Ataque']/3);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/3);
						$item['Defensa']+=intval($item['Defensa']/3);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/3);
					break;
					case 3:
						$item['Ataque']+=intval($item['Ataque']/2);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/2);
						$item['Defensa']+=intval($item['Defensa']/2);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/2);
					break;
					case 4:
						$item['Ataque']+=intval($item['Ataque']);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']);
						$item['Defensa']+=intval($item['Defensa']);
						$item['DefensaMagica']+=intval($item['DefensaMagica']);
					break;
				}

			$data["litem"][] = $item;
		}

		}
		else
		{
			$data['error']=1;
		}
}
else
{
	$data['error']=1;
}		
 echo json_encode($data);
?> 