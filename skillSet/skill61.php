<?php
switch($skill['nivel'])
{
	case 1:
		$healmount = $stats['KonAcumulate']*6;
	break;
	case 2:
		$healmount = $stats['KonAcumulate']*12;
	break;
}
if($pj['party']>0)
{
	$db->sql_query("UPDATE personaje SET 
							Vida=(Vida+".$healmount.")
							WHERE party = '".$pj['party']."' AND Vida > 0");	
	$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." curo ".$healmount." de vida!</spam>!";
	$db->sql_query('INSERT INTO  chat(party,mensaje) 
					VALUES("'.$pj['party'].'","'.$msgs.'")');
	$data['info'] .= textoAtaque(7,$skill['nombre'],$healmount);
	$vidaModifier = $vidaModifier+$healmount;			
}
else
{
	$vidaModifier = $vidaModifier+$healmount;
	$data['info'] .= textoAtaque(7,$skill['nombre'],$healmount);
}
?>
