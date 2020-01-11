<?php
    $query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.subtipo
    FROM item i
    WHERE i.tipo = "runa" ORDER BY RAND() LIMIT 0,1';
    $dropssq = $db->sql_query($query);
    $drop = $db->sql_fetchrow($dropssq);

    $db->sql_query('INSERT INTO inventario(idItem,idCuenta,value,atributos,extraLevel) 
			VALUES("'.$drop['idItem'].'",
			"'.$log->get("idCuenta").'",
			0,
			"",
            '.($dungeon['reto']+1).')');
    
    
    switch($dungeon['reto'])
    {
        case 4:
            $lvli=7;
            earnDropBox($lvli,5,$log->get("pjSelected"));
            systemLog("self","<div class=recompensaAstral>Conseguiste un cofre nivel ".$lvli."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
            systemLog("self","<div class=recompensaAstral>Felicidades completaste el reto ".$dungeon['reto']."!<br> Conseguiste ".$drop['Nombre']."!</div>") ;     
        break;
        case 5:
            $lvli=8;
            earnDropBox($lvli,5,$log->get("pjSelected"));
            systemLog("self","<div class=recompensaAstral>Conseguiste un cofre nivel ".$lvli."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
            systemLog("self","<div class=recompensaAstral>Felicidades completaste el reto ".$dungeon['reto']."!<br> Conseguiste ".$drop['Nombre']."!</div>") ;          
        break;
        case 6:
            $lvli=9;
            earnDropBox($lvli,1,$log->get("pjSelected"));
            systemLog("self","<div class=recompensaAstral>Conseguiste un cofre nivel ".$lvli."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
            systemLog("self","<div class=recompensaAstral>Felicidades completaste el reto ".$dungeon['reto']."!<br> Conseguiste ".$drop['Nombre']."!</div>") ;          
        break;
        default:
            systemLog("self","<div class=recompensaAstral>Felicidades completaste el reto ".$dungeon['reto']."!<br> Conseguiste ".$drop['Nombre']."!</div>") ;     
        break;
    }

?>