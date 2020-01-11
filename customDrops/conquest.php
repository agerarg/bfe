<?php
 $query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.subtipo
 FROM item i
 WHERE i.tipo = "stone" ORDER BY RAND() LIMIT 0,1';
 $dropssq = $db->sql_query($query);
 $drop = $db->sql_fetchrow($dropssq);
switch($dungeon['conquest'])
{
    case 156:
        $StoneTier = 8;
    break;
    case 157:
        $StoneTier = 9;
    break;
    case 158:
        $StoneTier = 10;
    break;
}
if($StoneTier)
{
    add_item($drop['idItem'],1,$targets["idCuenta"]);
    systemLog("party","<div class=recompensaAstral>".$targets['nombre']." gano ".$drop['Nombre']."</div>") ;        
}

?>