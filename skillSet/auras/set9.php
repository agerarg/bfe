<?php
//Shield Ratio
if($pj['shieldDef']>0)
{
	switch($aura['nivel'])
	{
		case 1:
			$pj['Defensa'] +=200;
			$pj['DefensaMagica'] +=200;
		break;
		case 2:
			$pj['Defensa'] +=400;
			$pj['DefensaMagica'] +=400;
			$pj['ZT_DoomGuard']=true;
		break;
	}
}
?>
