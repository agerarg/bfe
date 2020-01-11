<?php
    switch($dungeon['reto'])
    {
        case 1:
            switch($dungeon['waveCurr'])
            {
                case 1:
                    $idMOb= 179;
                    $cantidul=5;
                break;	
                case 2:
                     $idMOb= 180;
                     $cantidul=1;
                break;	
            }
        break;
        case 2:
            switch($dungeon['waveCurr'])
            {
                case 1:
                    $idMOb= 182;
                    $cantidul=3;
                break;	
                case 2:
                    $idMOb= 183;
                    $cantidul=1;
                break;	
            }
        break;
        case 3:
            switch($dungeon['waveCurr'])
            {
                case 1:
                    $idMOb= 185;
                    $cantidul=5;
                break;	
                case 2:
                    $idMOb= 186;
                    $cantidul=8;
                break;	
                case 3:
                    $idMOb= 187;
                    $cantidul=5;
                break;
                case 4:
                    $idMOb= 188;
                    $cantidul=1;
                break;
            }
        break;
        case 4:
            switch($dungeon['waveCurr'])
            {
                case 1:
                    $idMOb= 190;
                    $cantidul=10;
                break;	
                case 2:
                    $idMOb= 191;
                    $cantidul=1;
                break;	
            }
        break;
        case 5:
            switch($dungeon['waveCurr'])
            {
                case 1:
                    $idMOb= 193;
                    $cantidul=10;
                break;	
                case 2:
                    $idMOb= 194;
                    $cantidul=1;
                break;	
            }
        break;
        case 6:
        switch($dungeon['waveCurr'])
        {
            case 1:
                $idMOb= 199;
                $cantidul=5;
            break;	
            case 2:
                $idMOb= 200;
                $cantidul=1;
            break;	
        }
    break;
    }    
    $query = 'SELECT *
                    FROM monster
                    WHERE idMonster = '.$idMOb;
    $monstersq = $db->sql_query($query);
        $mob = $db->sql_fetchrow($monstersq);		

        for($i=0;$i<$cantidul;$i++)
        {
            $db->sql_query('INSERT INTO  
                inmundo(idMonster,tipo,mundo,
                currentLife,dificulty,
                idInstance,deQuien) 
            VALUES("'.$mob['idMonster'].'","2",
                1,"'.$mob['VidaLimit'].'",1,'.$dungeon['idInstance'].',
                '.$log->get("pjSelected").')');
        }	
?>