<?php
$data['animation']=1;
$skill_id=0;
$data['info'] .= "Uso ".$skill['nombre'];
$_SESSION['BOWCOMBO'] = 1;

if($stats['FocusMind'])
{
	$_SESSION['BOWFOLOW'].="1";
	$_SESSION['BOWFOLOW']=substr($_SESSION['BOWFOLOW'], -3); 
	if($_SESSION['FOCUSMINDAV']==1)
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
		if(mt_rand(1,10)==5)
		{
			$data['info'] .= " [FOCUS MIND] ";
			$_SESSION['FOCUSMINDAV']=intval($_SESSION['BOWFOLOW'][0]);
		}
	}
}
include("include/fightManage.php");

?>
