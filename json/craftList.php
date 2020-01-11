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
                $runz =intval($_GET['runz']) ;
                     $query = 'SELECT c.runz, p.clan
				FROM personaje p LEFT JOIN clan c ON c.idClan = p.clan
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
                     $pj = $db->sql_fetchrow($db->sql_query($query));
				   
						 $query = 'SELECT i.*, c.cost, c.idCraft, c.astralLvl, c.masterWork 
									FROM craft c JOIN item i  USING ( idItem ) 
									WHERE c.runz = '.$runz.' ORDER BY c.cost';
				
		$itemsq = $db->sql_query($query);
		while($item = $db->sql_fetchrow($itemsq))
		{
			if($item["cost"]>999999)
				$item["cost"]= intval($item["cost"]/1000000).".".intval(($item["cost"]-(intval($item["cost"]/1000000)*1000000))/100000)."kk";	
			else
				if($item["cost"]>999)
					$item["cost"]= round($item["cost"]/1000)."k";	
			
				//$item["Nombre"]="(".$item["idCraft"].")".$item["Nombre"];
			if($item['epic']==1)
				{
					$item['Ataque']=$item['Ataque']*($item['astralLvl']*3);
					$item['AtaqueMagico']=$item['AtaqueMagico']*($item['astralLvl']*3);
					$item['Defensa']=$item['Defensa']*$item['astralLvl'];
					$item['DefensaMagica']=$item['DefensaMagica']*$item['astralLvl'];
					$item['Critico']=$item['Critico']*$item['astralLvl'];
					$item['PC']=$item['PC']*$item['astralLvl'];
					$item['CriticoMagico']=$item['CriticoMagico']*$item['astralLvl'];
					$item['PCMagico']=$item['PCMagico']*$item['astralLvl'];
					$item['VidaLimit']=$item['VidaLimit']*$item['astralLvl'];
					$item['ManaLimit']=$item['ManaLimit']*$item['astralLvl'];
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