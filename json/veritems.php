<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
		$data="";
		$tier = intval($_GET['tier']);
		$query = 'SELECT *
			FROM item 
			WHERE tier = '.$tier.' AND (epic=1 OR forceStats=1) ';
		$itemsq = $db->sql_query($query);
		$arrow = array();
		while($item = $db->sql_fetchrow($itemsq))
		{
			$item['lvlAstral']=10;
			if($item['epic']==1)
				{
					$item['Ataque']=$item['Ataque']*($item['lvlAstral']*3);
					$item['AtaqueMagico']=$item['AtaqueMagico']*($item['lvlAstral']*3);
					$item['Defensa']=$item['Defensa']*$item['lvlAstral'];
					$item['DefensaMagica']=$item['DefensaMagica']*$item['lvlAstral'];
					$item['Critico']=$item['Critico']*$item['lvlAstral'];
					$item['PC']=$item['PC']*$item['lvlAstral'];
					$item['CriticoMagico']=$item['CriticoMagico']*$item['lvlAstral'];
					$item['PCMagico']=$item['PCMagico']*$item['lvlAstral'];
					$item['VidaLimit']=$item['VidaLimit']*$item['lvlAstral'];
					$item['ManaLimit']=$item['ManaLimit']*$item['lvlAstral'];
				}
				$item['Ataque']+=intval($item['Ataque']/4);
			$item['AtaqueMagico']+=intval($item['AtaqueMagico']/4);
			$item['Defensa']+=intval($item['Defensa']/4);
			$item['DefensaMagica']+=intval($item['DefensaMagica']/4);	
			$data["litem"][] = $item;
		}
		$data["error"] = "";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 