<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$goFight=0;
		if($mundo['nivel']>$pj['nivel'])
	{
		show_message("Solo pueden ingresar personajes con nivel mayor a ".$mundo['nivel']."!",
							"index.php?sec=mundo");	
	}
	else
	{
		$uniName="";
		switch($mundo['id'])
		{
			case 133:
					$uniName="Granhan";
					$_SESSION["dimension"]=2;
			break;
			case 134:
					$uniName="Embolia";
					$_SESSION["dimension"]=1;
			break;

		}
		show_message("Ah ingresado al universo de ".$uniName."!",
							"index.php?sec=mundo");	
	}
																		
?> 