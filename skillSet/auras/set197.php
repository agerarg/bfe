<?php
switch($aura['nivel'])
	{
		case 1:
			$pj['CSpeed']-=2;
			$pj['MpRegen']+=5;
			$pj['trueDmgPerMana']=5;
		break;
		case 2:
			$pj['CSpeed']-=4;
			$pj['MpRegen']+=10;
			$pj['trueDmgPerMana']=10;
		break;

	}

?>
