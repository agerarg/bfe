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
	$now = time();
	$data=[];
	$potSlot = (int)$_GET['pot'];
	$query = 'SELECT idInventario, idItem
	FROM inventario 
	WHERE 
	potCooldown <= '.$now.' AND 
	potSlot = '.$potSlot.' AND
	idCuenta = '.$log->get("idCuenta").' AND
	usadoPor = '.$log->get("pjSelected").' AND (idItem IN (637,638,639,640,641,642,643,644,644,645,646,647))';
	$pot = $db->sql_fetchrow($db->sql_query($query));
			if($pot)
			{
				//systemLog("self","ise:".$pot['idItem']);
				$potBuff=30;
				switch($pot['idItem'])
				{
					case 641: // Vida Potion
						$db->sql_query("UPDATE personaje 
						SET Vida=(Vida+5000)
						WHERE idPersonaje = '".$log->get("pjSelected")."'");
						$data['vida']=5000;
						systemLog("self","Usaste Vida Pot.");
					break;
					case 644: // Mana Potion
						$db->sql_query("UPDATE personaje 
						SET Mana=(Mana+5000)
						WHERE idPersonaje = '".$log->get("pjSelected")."'");
						$data['mana']=5000;
						systemLog("self","Usaste Mana Pot.");
					break;	

					case 637: //Attack Potion
						$idAura=562;
						$idReal=412;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,$potBuff);
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>$potBuff);
					break;

					case 638: //Critical Potion
						$idAura=563;
						$idReal=413;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,$potBuff);
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>$potBuff);
					break;

					case 639: //Defensa Potion
						$idAura=564;
						$idReal=414;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,$potBuff);
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>$potBuff);
					break;

					case 640: //Papa destroyer Potion
						$idAura=565;
						$idReal=415;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,$potBuff);
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>$potBuff);
					break;

					case 642: //Magic Critical Potion
						$idAura=566;
						$idReal=416;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,$potBuff);
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>$potBuff);
					break;
					case 643: //Magic Potion
						$idAura=567;
						$idReal=417;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,$potBuff);
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>$potBuff);
					break;
					case 645: //Velocidad Potion
						$idAura=568;
						$idReal=418;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,$potBuff);
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>$potBuff);
					break;
					case 646: //Casting Potion
						$idAura=569;
						$idReal=419;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,$potBuff);
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>$potBuff);
					break;
					case 647: //VidaLimit Potion
						$idAura=570;
						$idReal=420;
						insertBuff($log->get("pjSelected"),$idAura,$idReal,300);
						$data['vidaLimit']=3000;
						$data['auraCheck']=true;
						$data['aura'] = array("idSkill"=>$idReal,"lvl"=>1,"auraTimeOut"=>300);
					break;


				}
				$db->sql_query("UPDATE inventario 
						SET potCooldown=(".($now+60).")
						WHERE idInventario = ".$pot['idInventario']);
			}
			else
			$data['error']="error";
}
echo json_encode($data);
?> 