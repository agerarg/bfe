<?php
$data['animation']=2;
$fisicalCoolDown = 3;
$bloodlordDuration=120;
if($stats['BloodLordDuration'] OR $stats['SET_counttunic'])
      $bloodlordDuration=600;    
 $result = intval($stats['sangreAcumulate']-100);
if($result>=0)
{
  $db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['sangreAuraId']."'");
  $data['aura'][] = array("idSkill"=>182,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
          
 insertBuff($pj['idPersonaje'],$skill['idSkill'],146,$bloodlordDuration);


$data['aura'][] = array("idSkill"=>146,"lvl"=>$skill['nivel'],"auraTimeOut"=>$bloodlordDuration,"pasive"=>0);
	$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);

$data['changeAvatar']='bloodlordAvatar'; 
}
else
{
 $data['info'] .= "No hay suficiente sangre...";
$data['animation']=0;
}
$MonsterAttackAproval=false;

?>