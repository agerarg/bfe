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
		$id = intval($_GET['box']);
		$query = 'SELECT *
			FROM boxes_player
			WHERE idBox = "'.$id.'" AND opened=1 AND idPersonaje = '.$log->get("pjSelected");
		$boxsq = $db->sql_query($query);
		$box = $db->sql_fetchrow($boxsq);
		if($box)
		{
			include("../system/dropInToInv.php");
			$limitItems=1;
			$itemIdI=1;
			$query = 'SELECT i.*,inv.*, inv.nivel AS value, inv.text_legend AS atributos
			FROM item i JOIN boxes_drop inv USING ( idItem )
			WHERE inv.idBox = '.$box['idBox'].'';
			$itemsq = $db->sql_query($query);
			while($item = $db->sql_fetchrow($itemsq))
			{
				if($limitItems<=3)
				{
					if($item['idBoxDrop']==$_GET['item'.$itemIdI])
					{
						addItemToInv($item);
						$limitItems++;
					}
				}
				$itemIdI++;
			}
			if(isset($_SESSION['LEG']))
			{
				$data['leg']=$_SESSION['LEG_ID'];
				$data['legName']=$_SESSION['LEG_NAME'];
				unset($_SESSION['LEG']);
			}
			$db->sql_query("DELETE FROM boxes_drop WHERE idBox = ".$box['idBox']."");
			$db->sql_query("DELETE FROM boxes_player WHERE idBox = ".$box['idBox']."");
			$db->sql_query("DELETE FROM boxes_attr WHERE idBox = ".$box['idBox']."");
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