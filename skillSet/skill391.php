<?php
$data['animation']=1;
$skill_id=0;
$data['info'] .= "Uso ".$skill['nombre'];
if($_SESSION['BOWCOMBO']==4 OR $_SESSION['FOCUSMINDAV']==5)
{
	if($stats['FocusMind'])
	{
		$_SESSION['BOWFOLOW'].="5";
		$_SESSION['BOWFOLOW']=substr($_SESSION['BOWFOLOW'], -3); 
		if($_SESSION['FOCUSMINDAV']==5)
		{
			$stats['Ataque']=$stats['Ataque']*3;
			$stunGoingOn=1;
			$_SESSION['FOCUSMINDAV']=0;
			$_SESSION['BOWFOLOW']="";
		$duration=60;
		insertBuff($pj['idPersonaje'],601,445,$duration);
		$data['aura'][] = array("idSkill"=>445,"lvl"=>1,"auraTimeOut"=>$duration,"pasive"=>0);
		$data['auraRowCheck']=true;	
		}
		else
		{
			if(mt_rand(1,2)==2)
			{
				$data['info'] .= " [FOCUS MIND] ";
				$_SESSION['FOCUSMINDAV']=intval($_SESSION['BOWFOLOW'][0]);
			}
		}
	}
	if($stats['CStr'])
		$stats['Ataque']+= intval($_SESSION['BOWCOMBO'] * ($stats['Ataque']/10));
	if($stats['ComPower'])
		$stats['PC']+= intval($_SESSION['BOWCOMBO'] * 25);
	include("include/fightManage.php");
}
else
{
	$data['info'] .= " FALLO";
	$_SESSION['BOWCOMBO'] = 0;
}
?>
