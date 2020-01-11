<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
						'body' => 'templates/main.html' )
					);
unset($_SESSION['secure_section']);
$query = 'SELECT p . * , c.dicho, c.nombre AS CLASE, c.imagen, c.STR, c.CON, c.DEX, c.WIT, c.INTEL, c.MEN, c.STYLE, m.nombre AS LOC, m.id AS LOCID
				FROM personaje p JOIN clase c USING ( idClase ) LEFT JOIN mundo m ON p.location = m.id
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").' AND p.desactivada=0';
$pj = $db->sql_fetchrow($db->sql_query($query));

if(!$pj['LOC'])
	$db->sql_query("UPDATE personaje SET location = 20 WHERE idPersonaje = ".$log->get("pjSelected"));

 $template->assign_var('RANKEDSRC', 0);
$template->assign_var('AUTOCLOSE_P', 0);	

// GUERRA TIEMR
 $template->assign_var('TIEMPOGUERRA', 0);

if($gameCore['war']==0 && $gameCore['warTime']>time() && $pj['clan']>0)
{
	 $template->assign_var('TIEMPOGUERRA', $gameCore['warTime']-time()+30);
}

/*
$defensa=3000;
$monster['nivel']=90;
$monster['Ataque']=160000;
$monster['Ataque']=bigintval($monster['Ataque']*($monster['nivel']/15));

echo "totalAtaque:".$monster['Ataque']." dmg: ". defensa($monster['Ataque'],$defensa);
*/

/*
function experience($L) {
 $a=2;
  for($x=1; $x<$L; $x++) {
	 $a += floor($x+300*pow(2, ($x/6)));
  }
 return floor($a/20);
}
for($i=100;$i<250;$i++)
	echo "Level ".$i.": ".experience($i)."<br>";
*/
	/*
$query = 'SELECT * FROM monster ORDER BY nivel';

$mobber = $db->sql_query($query);
								
while($mob = $db->sql_fetchrow($mobber))
{
	echo $mob['nombre']." Lvl: ".$mob['nivel']." Exp: ".Monster_experience($mob['nivel'],$mob['VidaLimit'])."<br>";			
}	*/					
if($gameCore['twitchon'])
	$template->assign_var('TWITCHON', '<div class="twitchLink"><a target="_blank" href="https://www.twitch.tv/agerarg"> <img src="images/twitch.png" /></a></div>');

if($pj)
{
	$query = 'SELECT *
					FROM logros WHERE idPersonaje = '.$log->get("pjSelected").'';
	$logosq = $db->sql_query($query);
	$logros = $db->sql_fetchrow($logosq);
	if($logros['arabia']>=3)
	{
		$mapAllow[]=22;
		$template->assign_var('LOGRO_ALLOW1', "");
	}
	else 
		$template->assign_var('LOGRO_ALLOW1', "GTFO");
	if($logros['shika']>=3)
	{
		$mapAllow[]=6;
		$mapAllow[]=23;
		$template->assign_var('LOGRO_ALLOW2', "");
	}
	else 
		$template->assign_var('LOGRO_ALLOW2', "GTFO");
	if($logros['slajim']>=3)
	{
		$mapAllow[]=7;
		$mapAllow[]=24;
		$mapAllow[]=107;
		$template->assign_var('LOGRO_ALLOW3', "");
	}
	else 
		$template->assign_var('LOGRO_ALLOW3', "GTFO");
	if($logros['piwik']>=3)
	{
		$mapAllow[]=16;
		$mapAllow[]=25;
		$template->assign_var('LOGRO_ALLOW4', "");
	}
	else 
		$template->assign_var('LOGRO_ALLOW4', "GTFO");
	if($logros['moosh']>=3)
	{
		$mapAllow[]=17;
		$mapAllow[]=26;
		$template->assign_var('LOGRO_ALLOW5', "");
	}
	else 
		$template->assign_var('LOGRO_ALLOW5', "GTFO");
	if($logros['forgottenground']>=3)
	{
		$mapAllow[]=10;
		$mapAllow[]=27;
		$template->assign_var('LOGRO_ALLOW6', "");
	}
	else 
		$template->assign_var('LOGRO_ALLOW6', "GTFO");
	if($logros['kunkawa']>=3)
	{
		$mapAllow[]=11;
		$mapAllow[]=30;
		$mapAllow[]=28;
		$template->assign_var('LOGRO_ALLOW7', "");
	}
	else 
		$template->assign_var('LOGRO_ALLOW7', "GTFO");
	if($logros['glaciar1']>=3)
	{
		$mapAllow[]=31;
	}
	if($logros['glaciar2']>=3)
	{
		$mapAllow[]=29;
		$mapAllow[]=32;
	}
	if($logros['lairofcabrium']>=3)
	{
		$mapAllow[]=93;
	}
	if($logros['enchantedvalley']>=3)
	{
		$mapAllow[]=94;
	}
	if($logros['doomtemple']>=3)
	{
		$mapAllow[]=111;
		$mapAllow[]=145;
		$mapAllow[]=123;
	}


	$_SESSION["idClase"]= $pj["idClase"];
		 $template->assign_var('CHAT_GEN', "GTFO");
			  $template->assign_var('CHAT_PRIV', "GTFO");
			   $template->assign_var('CHAT_CLAN', "GTFO");
			    $template->assign_var('CHAT_PARTY', "GTFO");
				$template->assign_var('CHAT_SEND', "GTFO");
				 $template->assign_var('CHAT_SENDPRIV', "GTFO");
	switch($_COOKIE['CHAT_DEFAULT'])
	{
		case 'chat_party':
			 $template->assign_var('CHAT_DEF', "chat_party");
			 $template->assign_var('CHAT_PARTY', "");
			 $template->assign_var('CHAT_SEND', "");
		break;
		case 'chat_clan':
			 $template->assign_var('CHAT_DEF', "chat_clan");
			 $template->assign_var('CHAT_CLAN', "");
			 $template->assign_var('CHAT_SEND', "");
		break;
		case 'chat_privado':
			$template->assign_var('CHAT_DEF', "chat_privado");
			 $template->assign_var('CHAT_PRIV', "");
			  $template->assign_var('CHAT_SENDPRIV', "");
		break;
		default:
			 $template->assign_var('CHAT_DEF', "chat_general");
			 $template->assign_var('CHAT_GEN', "");
			 $template->assign_var('CHAT_SEND', "");
		break;
	}
		
       /// ONLINEs

	$dia = date("z");
	//// BOLUDO IS COMING...
	$pj['boludo']=0;
	$template->assign_var('BLDID', 0);
	/// ONLINEs
	$query = 'SELECT count(*) as CONTA
				FROM personaje
				WHERE online > '.($now-600).'';
	$onlines = $db->sql_fetchrow($db->sql_query($query));
	 $template->assign_var('ONLINE', $onlines['CONTA']);
	if($log->get("prueba")==1)
		 $template->assign_var('ADVSHOW', '$("#advPrueba").show();');
	//// PARTY ////////////////
	if($pj['party']>0)
	{
		if($pj['party']==$log->get("pjSelected"))
			$template->assign_var('PARTYINVITES', "");
			else
			$template->assign_var('PARTYINVITES', "GTFO");
	 	$template->assign_var('PARTYID', $pj['party']);
		 $template->assign_var('SHOWCREATEPARTY',"GTFO");
	}
	else
	{
		$template->assign_var('PARTYID', 0);
		$template->assign_var('SHOWPARTY',"GTFO");
		$template->assign_var('SHOWPARTYBUTON',"");
		$template->assign_var('SHOWCREATEPARTY',"");
	}
	
	if($pj['inDungeon'])
			$template->assign_var('SALIRDUNGEON', "");
		else
			$template->assign_var('SALIRDUNGEON', "GTFO");
	//RAID ALLOWS
	if($pj['nivel']>=20)
	{
		$mapAllow[]=146; //reto 20
		$mapAllow[]=155; // BANKO
	}
	if($pj['nivel']>=40)
	{
		$mapAllow[]=139;
		$mapAllow[]=147;  //reto 40
		$mapAllow[]=151; // catacumba 1
	}
	if($pj['nivel']>=50)
	{
		$mapAllow[]=140;
		$mapAllow[]=148; // reto 50
	}
	if($pj['nivel']>=60)
	{
		$mapAllow[]=141;
		$mapAllow[]=149; // reto 60		
	}
	if($pj['nivel']>=70)
	{
		$mapAllow[]=142;
		$mapAllow[]=150;// reto 70
		$mapAllow[]=152; // Catacumba 2
	}
	if($pj['nivel']>=80)
	{
		$mapAllow[]=153; // Catacumba 3
		$mapAllow[]=143;
		$mapAllow[]=154;// reto 80
		$mapAllow[]=156;// Conquista 1
		$mapAllow[]=157;// Conquista 1
		$mapAllow[]=158;// Conquista 1
	}
	if($pj['nivel']>=90)
	{
		$mapAllow[]=166; // Epico 1
	}
	if($pj['nivel']>=100)
	{
		$mapAllow[]=167; // Epico 1
	}
//WARZONE
if($gameCore['war'] && $pj['clan']>0)
{
	$mapAllow[]=159;
	$mapAllow[]=160;
	$mapAllow[]=161;
	$mapAllow[]=162;
	$mapAllow[]=163;
	$mapAllow[]=164;
	$mapAllow[]=165;
}
	if($pj['nivel']>=90)
		$mapAllow[]=144;	
		if($pj['nivel']>=80)
			$template->assign_var('PARAGON_OPEN', "");
		else
			$template->assign_var('PARAGON_OPEN', "GTFO");

	
		if(isset($_COOKIE['PARTY_TOP']))
			$template->assign_var('PARTY_TOP', $_COOKIE['PARTY_TOP']);
		else
			$template->assign_var('PARTY_TOP', 100);
		
		if(isset($_COOKIE['PARTY_LEFT']))
			$template->assign_var('PARTY_LEFT', $_COOKIE['PARTY_LEFT']);
		else
			$template->assign_var('PARTY_LEFT', 200);
	////////////////////////////////////////////////////////
	if(isset($_GET['chat']))
	{
		if($_GET['chat']==1)
		{
			$db->sql_query("UPDATE personaje SET openChat=1 WHERE idPersonaje = ".$log->get("pjSelected"));
			$pj['openChat']=1;
		}
		else
		{
			$db->sql_query("UPDATE personaje SET openChat=0 WHERE idPersonaje = ".$log->get("pjSelected"));
			$pj['openChat']=0;
		}
	}
	if($pj['openChat']==1)
	{
		if(isset($_COOKIE['CHAT_TOP']))
			$template->assign_var('CHAT_TOP', $_COOKIE['CHAT_TOP']);
		else
			$template->assign_var('CHAT_TOP', 100);
		$template->assign_var('CHAT_OPEN', "GTFO");
	
		$template->assign_var('CHAT_LEFT',  $_COOKIE['CHAT_LEFT']);
		$template->assign_var('CHATBOX', '<div id="chatTittle" align="center">- Mover Chat-</div>
<script id="sid0020000048180303027">(function() {function async_load(){s.id="cid0020000048180303027";s.src='."'".'http://st.chatango.com/js/gz/emb.js'."'".';s.style.cssText="width:263px;height:479px;";s.async=true;s.text='."'".'{"handle":"swordon","arch":"js","styles":{"a":"383838","b":100,"c":"FFFFFF","d":"FFFFFF","k":"383838","l":"383838","m":"383838","n":"FFFFFF","q":"383838","r":100,"usricon":0.92,"cnrs":"1"}}'."'".';var ss = document.getElementsByTagName('."'".'script'."'".');for (var i=0, l=ss.length; i < l; i++){if (ss[i].id=='."'".'sid0020000048180303027'."'".'){ss[i].id +='."'".'_'."'".';ss[i].parentNode.insertBefore(s, ss[i]);break;}}}var s=document.createElement('."'".'script'."'".');if (s.async==undefined){if (window.addEventListener) {addEventListener('."'".'load'."'".',async_load,false);}else if (window.attachEvent) {attachEvent('."'".'onload'."'".',async_load);}}else {async_load();}})();</script>');
	}
	else
	{
		$template->assign_var('CHATCLOSED', 'GTFO');
		$template->assign_var('CHAT_CLOSE', "GTFO");
	}
	
	$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
	
	$pj['imagen'] = $pj['imagen'].'_'.$pj['sexo'].'.jpg';
	if($stats['nameWeapon']==1)
		$template->assign_var('WNAME', "");
	else
		$template->assign_var('WNAME', "GTFO");
	 if($stats['PjAvatar'])
           $template->assign_var('AVATARCHANGER', '$("#pj_img").text(""); $("#pj_img").append("<img src='."'images/clases/".$stats['PjAvatar'].".jpg'".' />");');

	$_SESSION['dualThing']='';
	///DIMENCIONAL THING
	$dimencion = $stats['dimension'];
	switch($dimencion)
	{
		case 3:
		$template->assign_var('MAIN_LOGO', "logo_alien.jpg");
		break;
		case 2:
		$template->assign_var('MAIN_LOGO', "logo_granhan.jpg");
		break;
		default:
			$template->assign_var('MAIN_LOGO', "logo2.jpg");
		break;
	}
	
	//LIFE REGEN
	$regGoing=false;
	$VIDA = $pj['Vida'];
	$MANA = $pj['Mana'];
	if($pj['regenTime']>0)
		{
			while($now>$pj['regenTime'])
			{
				$regGoing=true;
				$regCount++;
				if($regCount>100)
					break;
				$VIDA+=$stats['HpRegen'];
				$MANA+=$stats['MpRegen'];
				$pj['regenTime']+=10;
				if($VIDA>$stats['VidaLimit'] AND $MANA>$stats['ManaLimit'])
					break;
			}
		}
	if($VIDA>$stats['VidaLimit'])
		$VIDA=$stats['VidaLimit'];
	if($MANA>$stats['ManaLimit'])
		$MANA=$stats['ManaLimit'];
	
	// SHOW ONLINE
	if($regGoing AND $pj['Vida']>0)	
	$db->sql_query("UPDATE personaje SET online='".$now."', regenTime='".($now+10)."', Vida='".$VIDA."', Mana='".$MANA."'  WHERE idPersonaje = '".$pj['idPersonaje']."'");
	
	
	if(is_array($stats['SET_UP']))
		{
			$arrayset="";
			foreach ($stats['SET_UP'] as &$value) {
					if($value['nombre'])
				$arrayset .= ' setArmor('.$value['id'].',"'.$value['nombre'].'","'.$value['img'].'");';
			}
			
		$template->assign_var('SET_ARMOR',$arrayset);	
			}
				
	$cleanbrlocation = explode("<br>",$pj['LOC']);
	$pj['LOC'] = $cleanbrlocation[0];
	
	 $template->assign_vars(array(
				 'P_ORO' => $log->get("oro"),
				 'PVP' => $pj['PVP'],
				 'SEXO_P' => $pj['sexo'],
				 'LFP_P' => intval($_SESSION['LFP']),
				 'ROL_P' =>  $pj['STYLE'],
				  'REALDPS_P' => $pj['realDPS'],
				 'USR_LOCATION' => $pj['LOC'],
				 'ATKSPEED' => $stats['PSpeed'],
				 'CASTSPEED' => $stats['CSpeed'],
				 'PK' => $pj['PK'],
				 'P_RUPIAS' => $log->get("rupias"),
				 'ID_P' => $pj['idPersonaje'],
			  'CLASE_P' => $pj['dicho'],
			   'CLASE_P_INFO' => $pj['CLASE'],
			   'BASEDPS' => $stats['baseDPS'],
			  'IMG_P' => $pj['imagen'],
			  'NOMBRE_P' => $pj['nombre'],
			   'ILVL' => $stats['ItemLevel'],
				'LVL_P' => $pj['nivel'],
				'HPREGEN_P' => $stats['HpRegen'],
				'VIDA_P' => $VIDA,
				'VIDA_L_P' => $stats['VidaLimit'],
				'MPREGEN_P' => $stats['MpRegen'],
				'MANA_P' => $MANA,
				'MANA_L_P' => $stats['ManaLimit'],
				'EXP_P' => $pj['exp'],
				'EXP_L_P' => $pj['expUp'],
				'ATA_P' => $stats['Ataque'],
				'ATA_M_P' => $stats['AtaqueMagico'],
				'DEF_P' => $stats['Defensa'],
				'DEF_M_P' => $stats['DefensaMagica'],
				'CR_P' => $stats['Critico'],
				'CR_M_P' => $stats['CriticoMagico'],
				'PC_P' => $stats['PC'],
				'PC_M_P' => $stats['PCMagico'],
				'ELEMENTO' => $stats['elemAttack'],
				'ELEMENTODMG' => $stats['elemDmg'],
				'CON' => $stats['CON'],
				'STR' => $stats['STR'],
				'DEX' => $stats['DEX'],
				'INT' => $stats['INT'],
				'WIT' => $stats['WIT'],
				'MEN' => $stats['MEN']
				));
				$now = time();	
				$realGold = $log->realGold();
				$template->assign_var('REALGOLD', $realGold);
				//CLAN CHECK
				$clan=false;
				if($pj['clan']>0)
				{
					$query = 'SELECT *
					FROM clan WHERE idClan = '.$pj['clan'].'';
					$clansq = $db->sql_query($query);
					$clan = $db->sql_fetchrow($clansq);
				}
				if($clan)
				{
					$template->assign_var('CLANOPTIONS', "");
					$template->assign_var('NOCLAN', "none");
				}
				else
				{
					$template->assign_var('CLANOPTIONS', "none");
					$template->assign_var('NOCLAN', "");
				}
				//MISION CHEK
				$query = 'SELECT count(*) as CONTA
				FROM misiononplayer
				WHERE idPersonaje = '.$log->get("pjSelected").' AND finalizado = 0 OR idClan="'.$pj['clan'].'" AND  idClan>0 AND finalizado = 0 ';
				$qst = $db->sql_fetchrow($db->sql_query($query));
				if($qst['CONTA']!=0)
					$template->assign_var('MISIONS', "");
				else
					$template->assign_var('MISIONS', "none");
				///where tfk im em
				if($pj['location']==0)
					$pj['location']=20;
				$query = 'SELECT *
										FROM mundo
										WHERE id = '.$pj['location'].'';
				$locsq = $db->sql_query($query);
				$location = $db->sql_fetchrow($locsq);
				$template->assign_var('PJ_XLOC', $location['pos_x']);
				$template->assign_var('PJ_YLOC', $location['pos_y']);
				$template->assign_var('PJ_MUND', $location['id']);
				$template->assign_var('PJ_MUNDPLACE', $location['nombre']);
				$log->set("oro",$realGold);
				// chat
						$query = 'SELECT c.*
					FROM chat c
					WHERE (('.$log->get("pjSelected").' = c.idPersonaje) 
					OR ('.$pj['clan'].' = c.clan AND c.clan!=0) OR ('.$pj['party'].' = c.party AND c.party!=0) OR global=1)
					 ORDER BY c.id DESC LIMIT 30';
						$chatsq = $db->sql_query($query);
						while($chat = $db->sql_fetchrow($chatsq))
						{
							if($chat['pvpTarget']>0)
								$addon = "<a href='index.php?sec=mundo&mundo=".$chat['mundo']."&target=".$chat['pvpTarget']."'>".$chat['nombre']."</a>  ";
							else
								$addon="";
							$template->assign_block_vars('C', array(
									'ID' => $chat['id'],
									'NAME' => $chat['nombre'],
									'MSG' =>  $addon.$chat['mensaje']));	
						}			
			//
					if($pj['Vida']<=0 OR $pj['deathTime']>$now)
					{
						if($pj['Vida']>0)
							$db->sql_query("UPDATE personaje SET Vida=0 WHERE idPersonaje = '".$pj['idPersonaje']."'");
						$template->assign_var('VIDA_P',0);
						if(intval($pj['deathTime']-$now)>260)
						{
							$pj['deathTime']=$now+120;
							$db->sql_query("UPDATE personaje SET deathTime='".($now+120)."' WHERE idPersonaje = '".$pj['idPersonaje']."'");
						}
						
						
						if($pj['deathTime']<=$now AND isset($_GET['revivir']))
						{
							if(isset($_GET['nomerompanloshuevos']) AND $pj['pvpKilledTime']>$now)
							{
								$db->sql_query("UPDATE personaje SET pvpKilledTime=0, peaceShield=".($now+3600).", 
								Vida=".$stats['VidaLimit'].", Mana=".$stats['ManaLimit'].",
								location = ".$location['area']." WHERE idPersonaje = '".$pj['idPersonaje']."'");
							}
							else
							{
								$db->sql_query("UPDATE personaje SET pvpKilledTime=0, Vida=".$stats['VidaLimit'].", Mana=".$stats['ManaLimit'].",
								location = ".$location['area']." WHERE idPersonaje = '".$pj['idPersonaje']."'");
							}
								if($stats['inmortalityShitOn'])
						$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['inmortalityAuraId']."'");	
								
								/*if($stats['soulShitOn'])
						$db->sql_query("UPDATE aura SET acumuleitor = ".($stats['soulAcumulate']/2)."  WHERE idAura = '".$stats['soulAuraId']."'");
								*/
								header("Location: index.php");
								die();
						}
						////
						
						switch($_GET['sec'])
						{
							case 'news':
								include('includes/section/news.php');
							break;
							case 'clanShop':
								include('includes/section/clanShop.php');
							break;
							case 'runas':
							include('includes/section/runas.php');
						break;
							case 'partyInvite':
							include('includes/section/party_invite.php');
							break;
							case 'party':
								include('includes/section/party.php');
							break;
							case 'recompensas':
								include('includes/section/recompensas.php');
							break;
							case 'mascotas':
								include('includes/section/misMascotas.php');
							break;
							case 'cambiarPj':
								$db->sql_query("UPDATE cuenta SET pjSelected = '0' 
										WHERE idCuenta  = '".$log->get("idCuenta")."'");
								$log->set("pjSelected",0);
								unset($_SESSION['PJITEM']);
								unset($_SESSION['MADVSKILL']);		
								unset($_SESSION["dimension"]);
								header("Location: index.php?sec=cambiarPj");
							break;
							case 'top':
							include('includes/section/tops.php');
							break;
							
							case 'deslog':
								$log->salir();
							break;		
							case 'craft':
								include('includes/section/craft.php');
							break;
							case 'ReRoll':
							include('includes/section/reRoll.php');
						break;
							case 'inventario':
								include('includes/section/inventario.php');
							break;
							case 'tienda':
							$template->set_filenames(array(
									'content' => 'templates/sec/tienda.html' )
								);
							break;
							case 'habilidades':
								include('includes/section/habilidades.php');
							break;
							
							case 'compra_venta':
							include('includes/section/compraVenta.php');
						break;
						case 'ver':
							include('includes/section/ver.php');
						break;
						case 'salirDungeon':
								if($pj['inDungeon']==1)
								{
								$db->sql_query("UPDATE personaje SET
											 inDungeon = 0, inRunz=0, location = 20 WHERE idPersonaje = '".$pj['idPersonaje']."'");
								$db->sql_query("DELETE FROM aura WHERE idSkillReal = 147 AND idPersonaje=".$pj['idPersonaje']."");
								
									$msg = '<div class=questMeta>Saliste del dungeon.</div>';
									systemLog("self",$msg);
								}
								header("Location: index.php");
						break;
							default:
$_SESSION['soulShitUsed']=0;
$_SESSION['soulImpactUsed']=0;

								$template->set_filenames(array(
										'content' => 'templates/sec/muerto.html' )
									);
									
									if($pj['pvpKilledTime']>$now)
									{
										$template->assign_var('OPTION','<a   href="index.php?revivir">Revivir</a><br><br>
										<a  href="index.php?revivir&nomerompanloshuevos=1">Revivir como cobarde</a><br>
										Nadie te va poder pegar durante 1 hora, pero si atacas a alguien vas a poder ser atacado.');
									}
									else
									{
										$template->assign_var('OPTION','<a   href="index.php?revivir">Revivir</a><br>');	
									}
								
								
								if(intval($pj['deathTime']-$now)>0)
								{
									$template->assign_var('HIDETEMPO', "");
									$template->assign_var('TIEMPO', intval($pj['deathTime']-$now));
								}
								else
								{
									$template->assign_var('SHOWTHEMUER', "$('#MuertoRevivir').show(100);");
									$template->assign_var('HIDETEMPO', "GTFO");
									$template->assign_var('TIEMPO', 1);
								}
								if($stats['deathRise']==1)
									if(intval($pj['deathTime']-$now)>90 AND $pj['pkTime']<$now)
										{
											$db->sql_query("UPDATE personaje SET deathTime=".($now+89)." WHERE idPersonaje = '".$pj['idPersonaje']."'");
											$template->assign_var('TIEMPO', 90);
										}
								
								$template->assign_var('KILLER',$pj['killer']);
								
								
							break;
						}
					}
					else
					{
						
							switch($_GET['sec'])
							{
								case 'salirDungeon':
									if($pj['inDungeon']==1)
									{
									$db->sql_query("UPDATE personaje SET
												inDungeon = 0, inRunz=0, location = 20 WHERE idPersonaje = '".$pj['idPersonaje']."'");
									$db->sql_query("DELETE FROM aura WHERE idSkillReal = 147 AND idPersonaje=".$pj['idPersonaje']."");
									
										$msg = '<div class=questMeta>Saliste del dungeon.</div>';
										systemLog("self",$msg);
									}
									header("Location: index.php");
							break;
							case 'deslog':
								$log->salir();
							break;
							case 'clanShop':
								include('includes/section/clanShop.php');
							break;
							case 'runas':
							include('includes/section/runas.php');
						break;
							case 'party':
							include('includes/section/party.php');
						break;
							case 'partyInvite':
							include('includes/section/party_invite.php');
							break;
							case 'recompensas':
								include('includes/section/recompensas.php');
							break;
							case 'news':
								include('includes/section/news.php');
							break;
							case 'mascotas':
								include('includes/section/misMascotas.php');
							break;
                            case 'drops':
								include('includes/section/drops.php');
							break;
							case 'craft':
								include('includes/section/craft.php');
							break;
							case 'compra_auras':
								include('includes/section/auras.php');
							break;
							case 'inventario':
								include('includes/section/inventario.php');
							break;
							case 'cambiarPj':
								$db->sql_query("UPDATE cuenta SET pjSelected = '0' 
										WHERE idCuenta  = '".$log->get("idCuenta")."'");
								$log->set("pjSelected",0);		
								unset($_SESSION['PJITEM']);
								unset($_SESSION['MADVSKILL']);	
								header("Location: index.php?sec=cambiarPj");
							break;
							case 'compra_venta':
								include('includes/section/compraVenta.php');
						break;							
							case 'listamision':
									$template->set_filenames(array(
											'content' => 'templates/sec/misionlist.html' )
										);
										$query = 'SELECT m.nombre, mp.idMision, part.descr AS DOTHAT, part.partNum, part.cantidad, mp.acumulating
													FROM mision m LEFT JOIN misiononplayer mp ON mp.idMision = m.id LEFT JOIN mision_parte part ON part.idParte = mp.follow
													WHERE (mp.idPersonaje = '.$log->get("pjSelected").' OR mp.idClan='.$pj['clan'].' AND mp.idClan>0) 
													AND mp.finalizado = 0';
										$misionsq = $db->sql_query($query);
				
										while($mision = $db->sql_fetchrow($misionsq))
										{
											$mision['DOTHAT'] = str_replace("*",'('.$mision['acumulating'].'/'.$mision['cantidad'].')',$mision['DOTHAT']);
											$template->assign_block_vars('QUESTING', array(
																'NOMBRE' => $mision['nombre'],
																'PART' => $mision['partNum'],
																'DO' =>  $mision['DOTHAT']
																));		
										}
										
							break;
							case 'misiones':
								include('includes/section/mision.php');
							break;
							
							case 'ver':
								include('includes/section/ver.php');
							break;
								
							break;
							case 'tienda':
								$template->set_filenames(array(
										'content' => 'templates/sec/tienda.html' )
									);
							break;
							case 'verItems':
								include('includes/section/verItems.php');
							break;
							/*case 'trade':
									include('includes/section/trade.php');
								break;*/
							case 'verOnlines':
								include('includes/section/verOnlines.php');
							break;	
							case 'ReRoll':
								include('includes/section/reRoll.php');
							break;
							case 'edungeon':
								include('includes/section/Edungeon.php');
							break;
							case 'habilidades':
								include('includes/section/habilidades.php');
							break;
							case 'Wname':
								include('includes/section/Wname.php');
							break;
							
							case 'descansar':
							if($pj['descanso']==0)
							{
								if(isset($_GET['dalelpm']))
								{
									insertBuff($pj['idPersonaje'],315,178,60);
									$db->sql_query("UPDATE personaje SET descanso=1 WHERE idPersonaje = ".$log->get("pjSelected"));
									show_message("Ahora ".$pj['nombre']." esta durmiendo...","index.php?sec=inicio");
								}
								else
									show_message("Deseas descansar? <br> en este estado eres vulnerable a que te maten,<br>
								después de esperar 1 min estarás con toda la vida y mana! Tambien olvidaras las cosas del log-system<br>
								<a href='index.php?sec=descansar&dalelpm=1'>SI DESCANSAR</a>","index.php?sec=inicio");
							}
							else
							{
								if($stats['durmiendo'])
									show_message("".$pj['nombre']." dice: zzzZZZZZ","index.php?sec=inicio");
								else
								{
								$db->sql_query("UPDATE personaje SET attackCooldown=0, descanso=0, Vida=".$stats['VidaLimit'].", Mana=".$stats['ManaLimit']." WHERE idPersonaje = '".$pj['idPersonaje']."'");
								$db->sql_query("DELETE FROM chat WHERE idPersonaje = ".$pj['idPersonaje']." OR party = ".$pj['idPersonaje']."");
								header("Location: index.php?sec=mundo");
								die();
								}
							}
						break;
							case 'crearclan':
								if($clan = textIntoSql($_POST['clan']))
								{
									$cost = 1000;
									$currGold = $log->realGold();
									if($cost<=$currGold)
									{
										$query = "SELECT count(*) as CONTA 
										  FROM clan
										  WHERE nombre = '".$clan."'";
										$count = $db->sql_fetchrow($db->sql_query($query));
										if(strlen($clan) < 3 OR strlen($clan) > 9)
										{
					show_error("El nombre del clan (".$clan.") tiene que tener entre 3 y 9 caracteres","index.php?sec=crearclan");
										}else
										if(@!eregi("^[-_A-Z0-9]{0,20}$",$user,$trashed))
										{
											show_error("El nombre (".$clan.") tiene caracteres invalidos!","index.php?sec=crearclan");
										}
										else
										if(!$count['CONTA'])
										{
										//
											$query = "SELECT MAX( idClan) AS ID FROM  clan";
											$toAdd = $db->sql_fetchrow($db->sql_query($query));
										
											$query = "INSERT INTO clan (nombre,idLeader,activo) 
													VALUES('".$clan."','".$log->get("pjSelected")."',1)";		
											$db->sql_query($query);			
													
											$log->set("oro",($currGold-$cost));
											$db->sql_query("UPDATE cuenta SET oro = (oro-".$cost.") 
											WHERE idCuenta = ".$log->get("idCuenta"));
											
											$db->sql_query("UPDATE personaje SET clan = ".($toAdd['ID']+1).", inviteRight=1
											WHERE idPersonaje = ".$log->get("pjSelected"));
											
											$db->sql_query("DELETE FROM clan_request WHERE idPersonaje = '".$log->get("pjSelected")."'");
										
											show_message("El clan ".$clan." fue creado","index.php?sec=clan");
										//
										}
										else
											show_error("El nombre (".$clan.") ya existe!","index.php?sec=clan");
									}
									else
										show_error("No hay suficiente oro","index.php?sec=crearclan");
								}
								else
								{
									$template->set_filenames(array(
											'content' => 'templates/sec/createclan.html' )
										);
								}
							break;
							case 'ResetSkills':
								if($pj['attackCooldown']<$now-120)
								{
								  	if($pj['nivel']>120)
										$pj['nivel']=120;
									   $skillPoints = 1+intval($pj['nivel']/5)+ $pj['newSkillPoints'];

									   $parPerLv = $pj['paragonAcc'];
											
									$db->sql_query("UPDATE personaje SET
										skillPoints = '".$skillPoints."',
										paragonNow = '".$parPerLv."'
										  WHERE idPersonaje  = '".$pj['idPersonaje']."'");
									
									$db->sql_query("DELETE FROM skilllearn WHERE idPersonaje = '".$pj['idPersonaje']."' AND idRealSkill != 74 AND noRecet = 0 AND aventura = 0");
									$db->sql_query("DELETE FROM skilllearn WHERE garcados = 1 AND idPersonaje = '".$pj['idPersonaje']."' ");
									$db->sql_query("DELETE FROM aura WHERE idPersonaje = '".$pj['idPersonaje']."' AND aventura = 0");
									show_message("Habilidades restablecidas","index.php?sec=habilidades");
									unset($_SESSION['PJITEM']);
								}
								else
								{
									show_error("Podes hacer reset despues de 2 minutos sin pelear.","index.php?sec=nada");
								}
							break;
							case 'opciones':
								include('includes/section/opciones.php');
							break;
							
							case 'paragon':
								include('includes/section/paragon.php');
							break;
							case 'verItems':
								include('includes/section/verItems.php');
							break;
							case 'verOnlines':
								include('includes/section/verOnlines.php');
							break;
							case 'paragonStats':
								include('includes/section/paragonStats.php');
							break;
							case 'clan':
								include('includes/section/clan.php');
							break;
							case 'Wname':
								include('includes/section/Wname.php');
							break;
							case 'clanmanage':
								include('includes/section/clanmanage.php');
							break;
							case 'mundo':
								include('includes/section/mundo.php');
							break;
							case 'compra_auras':
								include('includes/section/auras.php');
							break;
							case 'keyconfig':
								$template->set_filenames(array(
										'content' => 'templates/sec/keyconfig.html' )
									);
								
									function sksort(&$array, $subkey="id", $sort_ascending=false) {
	
		if (count($array))
			$temp_array[key($array)] = array_shift($array);
	
		foreach($array as $key => $val){
			$offset = 0;
			$found = false;
			foreach($temp_array as $tmp_key => $tmp_val)
			{
				if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
				{
					$temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
												array($key => $val),
												array_slice($temp_array,$offset)
											  );
					$found = true;
				}
				$offset++;
			}
			if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
		}
	
		if ($sort_ascending) $array = array_reverse($temp_array);
	
		else $array = $temp_array;
	}
	function unichr($u) {
		return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
	}
													$query = 'SELECT sl.idSkillLearn, sl.cooldownCurrent, s.idRealSkill, s.idSkill, s.desc, s.costomp, s.nombre, sl.orden, s.cooldown, s.imagen, sl.keybind
													FROM skill s JOIN skilllearn sl USING ( idSkill ) WHERE 
													sl.idPersonaje = '.$log->get("pjSelected").' AND s.active = 1 ORDER BY s.nivel DESC';
													$skillsq = $db->sql_query($query);
													
													$template->assign_block_vars('S', array(
																'ID' => 0,
																'NOMBRE' => "Ataque Basico|Hace daño basado en el Ataque",
																'CD' =>  5,	
																'IMG' => "basicAttack.jpg"
																));
													$norder=false;
													while($skill = $db->sql_fetchrow($skillsq))
													{
	
															if(!$skillburn[$skill['idRealSkill']])
															{
																$skillburn[$skill['idRealSkill']]=true;
																	if($skill['orden']==0)
																		$saverSkill[$skill['idRealSkill']]=$skill;
																	else
																		$saverSkill[$skill['orden']]=$skill;
															}
	
													}
													if(is_array($saverSkill))
													{
														sksort($saverSkill, "orden", true);
														foreach( $saverSkill as $skill)
														{
															
															$template->assign_block_vars('SKILLS', array(
																	'ID' => $skill['idSkillLearn'],
																	'KEY' => unichr( $skill['keybind']),
																	'IMG' =>  $skill['imagen']
																	));				
														}
													}
									
										
									
									
							break;
							case 'skillconfig':
									$template->set_filenames(array(
										'content' => 'templates/sec/skillConfig.html' )
									);
									
									
									
									function sksort(&$array, $subkey="id", $sort_ascending=false) {
	
		if (count($array))
			$temp_array[key($array)] = array_shift($array);
	
		foreach($array as $key => $val){
			$offset = 0;
			$found = false;
			foreach($temp_array as $tmp_key => $tmp_val)
			{
				if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
				{
					$temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
												array($key => $val),
												array_slice($temp_array,$offset)
											  );
					$found = true;
				}
				$offset++;
			}
			if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
		}
	
		if ($sort_ascending) $array = array_reverse($temp_array);
	
		else $array = $temp_array;
	}
													$query = 'SELECT sl.idSkillLearn, sl.cooldownCurrent, s.idRealSkill, s.idSkill, s.desc, s.costomp, s.nombre, sl.orden, s.cooldown, s.imagen
													FROM skill s JOIN skilllearn sl USING ( idSkill ) WHERE 
													sl.idPersonaje = '.$log->get("pjSelected").' AND s.active = 1 ORDER BY s.nivel DESC';
													$skillsq = $db->sql_query($query);
													
													$template->assign_block_vars('S', array(
																'ID' => 0,
																'NOMBRE' => "Ataque Basico|Hace daño basado en el Ataque",
																'CD' =>  5,	
																'IMG' => "basicAttack.jpg"
																));
													$norder=false;
													while($skill = $db->sql_fetchrow($skillsq))
													{
	
															if(!$skillburn[$skill['idRealSkill']])
															{
																$skillburn[$skill['idRealSkill']]=true;
																	if($skill['orden']==0)
																		$saverSkill[$skill['idRealSkill']]=$skill;
																	else
																		$saverSkill[$skill['orden']]=$skill;
															}
	
													}
													if(is_array($saverSkill))
													{
														sksort($saverSkill, "orden", true);
														foreach( $saverSkill as $skill)
														{
															$template->assign_block_vars('SKILLS', array(
																	'ID' => $skill['idSkillLearn'],
																	'IMG' =>  $skill['imagen']
																	));				
														}
													}
									
									
									
									
									
									
									
							break;
							case 'top':
								include('includes/section/tops.php');
								break;
						case 'free':
							include('includes/section/openWorld.php');
						break;
						case 'arma':
								include('includes/section/arma.php');
						break;
						default:
								$today = date("z");
								if($today!=$gameCore['chatReset'])
								{
									$db->sql_query("TRUNCATE TABLE chat");
									$db->sql_query("TRUNCATE TABLE chatreal");
									//$db->sql_query("TRUNCATE TABLE chatreal");
									$db->sql_query("UPDATE gameactive SET chatReset = ".$today."");
								}
							
								include('includes/section/news.php');
						break;
					}
					}
				
}
else
{
	$db->sql_query("UPDATE cuenta SET pjSelected = 0 
	WHERE idCuenta  = '".$log->get("idCuenta")."'");
	$log->salir();
}
?> 