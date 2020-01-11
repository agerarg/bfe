<?php
 $query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.subtipo
 FROM item i
 WHERE i.tipo = "stone" ORDER BY RAND() LIMIT 0,1';
 $dropssq = $db->sql_query($query);
 $drop = $db->sql_fetchrow($dropssq);

$StoneTier = 11;

if($StoneTier)
{
    $db->sql_query('INSERT INTO inventario(idItem,idCuenta,value,atributos,extraLevel) 
			VALUES("'.$drop['idItem'].'",
			"'.$targets["idCuenta"].'",
			0,
			"",
            '.$StoneTier.')');
     systemLog("party","<div class=recompensaAstral>".$targets['nombre']." gano ".$drop['Nombre']." Lvl: ".$StoneTier."</div>") ;        
}

?>