<?php
//Critical
if($pj['Wtipo']=="sword" OR $pj['Wtipo']=="bigsword" )
	{	
		switch($aura['nivel'])
		{
			case 1:
				$pj['Critico'] = $pj['Critico'] + 4;
			break;
			case 2:
				$pj['Critico'] = $pj['Critico'] + 8;
			break;
			case 3:
				$pj['Critico'] = $pj['Critico'] + 16;	
			break;
		}
	}
?>
