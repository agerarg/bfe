<?php 
//error_reporting(0);
date_default_timezone_set("America/Argentina/Buenos_Aires");
define("LVLLIMIT",200);
define("DEATHTIME",120);
class LOGuser
{
	var $data;
	function LOGuser()
	{
		if(!isset($_SESSION['loged']))
			{
				 if(isset($_COOKIE['cookpass']))
				 {
					 		global $db;
							$password =  $_COOKIE['cookpass'];
							
							$regquery = "SELECT *
										  FROM cuenta
										  WHERE securePass = '".$password."' 
										  AND ip='".$_SERVER['REMOTE_ADDR']."'";
							$srchuser = $db->sql_fetchrow($db->sql_query($regquery));
						
							if(intval($srchuser['idCuenta']) > 0)
							{
									$_SESSION['loged'] = 1;
									$this->entrar($srchuser);
									$this->save($usuario,$password);
							}
							else
							{
								setcookie("cookpass","x",time()-3600); 
							}
				}	
			}
			else
			{
				global $db;
				$this->data = $_SESSION['user'];
				$regquery = "SELECT *
										  FROM cuenta
										  WHERE idCuenta = '".$this->data['idCuenta']."'";
				$srchuser = $db->sql_fetchrow($db->sql_query($regquery));
				
				$this->entrar($srchuser);
			}
	}
	function logear($clave)
	{
		global $db;

		 $regquery = "SELECT * FROM cuenta WHERE mainId = '".$clave."'";
		$srchuser = $db->sql_fetchrow($db->sql_query($regquery));
	
			if($srchuser)
				{
					$_SESSION['loged'] = 1;
					$this->entrar($srchuser);
					$usuario=$srchuser['idCuenta'];
					$password = md5($srchuser['idCuenta'].time());
					$db->sql_query("UPDATE  cuenta SET securePass = '".$password."', ip = '".$_SERVER['REMOTE_ADDR']."' WHERE idCuenta  = '".$srchuser['idCuenta']."'");
					$this->save($usuario,$password);
					return true;
				}
				else
				{
					return false;
				}
	}
	function save($usuario,$password)
	{
		 setcookie("cookname", $usuario, time()+60*60*24*100, "/");
		 setcookie("cookpass", $password, time()+60*60*24*100, "/");
	}
	function borrar()
	{
		setcookie("cookname","x",time()-3600); 
		setcookie("cookpass","x",time()-3600); 
	}
	function entrar($usuario)
	{
		$this->data = $usuario;
		$_SESSION['user'] = $usuario;
	}
	function salir()
	{
		if($_SESSION['loged'])
		{
			session_destroy();
			setcookie("cookname", "", time()-60*60*24*100, "/");
			setcookie("cookpass", "", time()-60*60*24*100, "/");
			header("Location: index.php");
		}
	}
	function realGold()
	{
		global $db;
		 $regquery = "SELECT oro FROM cuenta WHERE idCuenta	= ".$this->data["idCuenta"];
		 $srchuser = $db->sql_fetchrow($db->sql_query($regquery));
		return $srchuser['oro'];
	}
	function realRupy()
	{
		global $db;
		 $regquery = "SELECT rupias FROM cuenta WHERE idCuenta	= ".$this->data["idCuenta"];
		 $srchuser = $db->sql_fetchrow($db->sql_query($regquery));
		return $srchuser['rupias'];
	}
	function set($que,$datos)
	{
		 $this->data[$que] = $datos;
		 $_SESSION['user'][$que] = $datos;
	}
	function get($que)
	{
		 return  $this->data[$que];
	}
	function check()
	{
		if(isset($_SESSION['loged']))
			return true;
		else
			return false;
	}
}
function tiempoReal()
{
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	return time();
}
?>