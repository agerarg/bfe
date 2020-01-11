<?php
$data['animation']=2;
$fisicalCoolDown = 3;
$Duration=120;
 $result = intval($stats['sangreAcumulate']-100);
if($result>=0)
{
  $db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['sangreAuraId']."'");
  $data['aura'][] = array("idSkill"=>182,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
          
 insertBuff($pj['idPersonaje'],$skill['idSkill'],183,$Duration);
 $vidaModifier = $vidaModifier+intval($stats['VidaLimit']/2);
 if($vidaModifier>$stats['VidaLimit'])
    $vidaModifier =  $stats['VidaLimit'];

$data['aura'][] = array("idSkill"=>183,"lvl"=>$skill['nivel'],"auraTimeOut"=>$Duration,"pasive"=>0);
	$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);
}
else
{
 $data['info'] .= "No hay suficiente sangre...";
$data['animation']=0;
}
$MonsterAttackAproval=false;

?>