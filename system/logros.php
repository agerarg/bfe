<?php 
	function mapReveal($id)
	{
		global $db,$log,$logros;
		$name="";
		switch($id)
		{
			case 20:
				$name="arabia";
			break;
			case 22:
				$name="shika";
			break;
			case 23:
				$name="slajim";
			break;
			case 24:
				$name="piwik";
			break;
			case 25:
				$name="moosh";
			break;
			case 26:
				$name="forgottenground";
			break;
			case 27:
				$name="kunkawa";
			break;
			case 30:
				$name="glaciar1";
			break;
			case 31:
				$name="glaciar2";
			break;
			case 32:
				$name="lairofcabrium";
			break;
			case 93:
				$name="enchantedvalley";
			break;
			case 94:
				$name="doomtemple";
			break;
		}

		$db->sql_query("UPDATE logros SET ".$name." = (".$name."+3)  WHERE idPersonaje = '".$log->get("pjSelected")."'");	
		if($logros[$name]==2)
		{
			return true;
		}
		return false;
	}
?>