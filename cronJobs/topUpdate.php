<?php
  if(SWORDON != 1)
      die();
    $query = 'SELECT * FROM gameactive';
    $gamesq = $db->sql_query($query);
    $game = $db->sql_fetchrow($gamesq);
    $dia = date('j');
if(  $game['topUdateTime']!=$dia)
{
    
    function dpsTop($id)
    {
        global $db;
        $db->sql_query("DELETE FROM topplayer WHERE tipo = 'DPS".$id."'");
        $query = 'SELECT p.idPersonaje, p.nombre, p.maxDPSEver 
        FROM personaje p 
        WHERE maxDPSEver > 0 AND idClase = '.$id.' AND SubClassFrom = 0 AND idCuenta!=1 
        ORDER by p.maxDPSEver DESC limit 0,50';

        $topsq = $db->sql_query($query);
        $sameAcc=0;
        $TOPNUM=1;                                
        while($player = $db->sql_fetchrow($topsq))
        {
                $query = "INSERT INTO topplayer (idPersonaje,tipo,valor,topn) 
                VALUES('".$player['idPersonaje']."',
                'DPS".$id."',
                '".$player['maxDPSEver']."',
                '.$TOPNUM.')";
                $db->sql_query($query);
                $TOPNUM++;
        }
        $query = 'UPDATE gameactive SET
        topPart = (topPart+1)';
        $db->sql_query($query);
    }
echo $game['topPart'];
    switch($game['topPart'])
    {
        case 0: // TOP ORO
        $db->sql_query("DELETE FROM topplayer WHERE tipo = 'GOLD'");
            $query = 'SELECT c.idCuenta,p.idPersonaje, p.nombre, c.oro, p.nivel 
            FROM cuenta c JOIN personaje p 
            USING (idCuenta) WHERE 
            idCuenta!=1  ORDER by oro DESC, nivel DESC';

            $topsq = $db->sql_query($query);
            $sameAcc=0;
            $TOPNUM=1;                                
            while($player = $db->sql_fetchrow($topsq))
            {
                if($TOPNUM<=50)
                if($sameAcc!=$player['idCuenta'])
                {
                    $sameAcc=$player['idCuenta'];
                    $query = "INSERT INTO topplayer (idPersonaje,tipo,valor,topn) 
                    VALUES('".$player['idPersonaje']."',
                    'GOLD',
                    '".$player['oro']."',
                    '.$TOPNUM.')";
                    $db->sql_query($query);
                    $TOPNUM++;
                }
            
            }
            $query = 'UPDATE gameactive SET
            topPart = 1';
            $db->sql_query($query);
        break;
        case 1: // TOP LVL
            $db->sql_query("DELETE FROM topplayer WHERE tipo = 'LVL'");
            $query = 'SELECT p.idPersonaje, p.nombre, p.nivel, p.godLevel
            FROM personaje p WHERE SubClassFrom = 0 AND idCuenta!=1 
            ORDER by p.nivel DESC,p.godLevel DESC limit 0,50
';

            $topsq = $db->sql_query($query);
            $sameAcc=0;
            $TOPNUM=1;                                
            while($player = $db->sql_fetchrow($topsq))
            {
                    $query = "INSERT INTO topplayer (idPersonaje,tipo,valor,topn) 
                    VALUES('".$player['idPersonaje']."',
                    'LVL',
                    '".($player['nivel']+$player['godLevel'])."',
                    '.$TOPNUM.')";
                    $db->sql_query($query);
                    $TOPNUM++;
            }
            $query = 'UPDATE gameactive SET
            topPart = 2';
            $db->sql_query($query);
        break;
        case 2: // TOP PVP
            $db->sql_query("DELETE FROM topplayer WHERE tipo = 'PVP'");
            $query = 'SELECT p.idPersonaje, p.nombre, p.PVP 
            FROM personaje p 
            WHERE PVP > 0 AND SubClassFrom = 0 AND idCuenta!=1 
            ORDER by p.PVP DESC limit 0,50';

            $topsq = $db->sql_query($query);
            $sameAcc=0;
            $TOPNUM=1;                                
            while($player = $db->sql_fetchrow($topsq))
            {
                    $query = "INSERT INTO topplayer (idPersonaje,tipo,valor,topn) 
                    VALUES('".$player['idPersonaje']."',
                    'PVP',
                    '".$player['PVP']."',
                    '.$TOPNUM.')";
                    $db->sql_query($query);
                    $TOPNUM++;
            }
            $query = 'UPDATE gameactive SET
            topPart = 3';
            $db->sql_query($query);
        break;
        case 3: // TOP PK
            $db->sql_query("DELETE FROM topplayer WHERE tipo = 'PK'");
            $query = 'SELECT p.idPersonaje, p.nombre, p.PK 
            FROM personaje p 
            WHERE PK > 0 AND SubClassFrom = 0 AND idCuenta!=1 
            ORDER by p.PK DESC limit 0,50';

            $topsq = $db->sql_query($query);
            $sameAcc=0;
            $TOPNUM=1;                                
            while($player = $db->sql_fetchrow($topsq))
            {
                    $query = "INSERT INTO topplayer (idPersonaje,tipo,valor,topn) 
                    VALUES('".$player['idPersonaje']."',
                    'PK',
                    '".$player['PK']."',
                    '.$TOPNUM.')";
                    $db->sql_query($query);
                    $TOPNUM++;
            }
            $query = 'UPDATE gameactive SET
            topPart = 4';
            $db->sql_query($query);
    break;
    case 4: // TOP Zombie Tank
        dpsTop(1);
    break;
    case 5: // TOP Dark Mage
        dpsTop(2);
    break;
    case 6: // TOP Ninja
        dpsTop(3);
    break;
    case 7: // TOP Marksman
        dpsTop(4);
    break;
    case 8: // TOP Shaman
        dpsTop(5);
    break;
    case 9: // TOP Vampire
         dpsTop(6);
    break;
    case 10: // TOP Destroyer
         dpsTop(7);
    break;
    case 11: // TOP Cleric
         dpsTop(8);
    break;
    case 12: // TOP Garca
         dpsTop(10);
    break;
    case 13: // TOP GEAR
        $db->sql_query("DELETE FROM topplayer WHERE tipo = 'GEAR'");
        $query = 'SELECT p.idPersonaje, p.nombre, p.baseDPS 
        FROM personaje p 
        WHERE baseDPS > 0 AND SubClassFrom = 0 AND idCuenta!=1 
        ORDER by p.baseDPS DESC limit 0,50';

        $topsq = $db->sql_query($query);
        $sameAcc=0;
        $TOPNUM=1;                                
        while($player = $db->sql_fetchrow($topsq))
        {
                $query = "INSERT INTO topplayer (idPersonaje,tipo,valor,topn) 
                VALUES('".$player['idPersonaje']."',
                'GEAR',
                '".$player['baseDPS']."',
                '.$TOPNUM.')";
                $db->sql_query($query);
                $TOPNUM++;
        }
    $query = 'UPDATE gameactive SET
     topPart=14';
    $db->sql_query($query);
break;
 case 14: // TOP PARAGON RIFT
        $db->sql_query("DELETE FROM topplayer WHERE tipo = 'RIFT'");
        $query = 'SELECT p.idPersonaje, p.nombre, p.paragonAcc 
        FROM personaje p 
        WHERE SubClassFrom = 0 AND idCuenta!=1 
        ORDER by p.paragonAcc DESC limit 0,50';

        $topsq = $db->sql_query($query);
        $sameAcc=0;
        $TOPNUM=1;                                
        while($player = $db->sql_fetchrow($topsq))
        {
                $query = "INSERT INTO topplayer (idPersonaje,tipo,valor,topn) 
                VALUES('".$player['idPersonaje']."',
                'RIFT',
                '".$player['paragonAcc']."',
                '.$TOPNUM.')";
                $db->sql_query($query);
                $TOPNUM++;
        }
    $query = 'UPDATE gameactive SET
    topUdateTime = '.$dia.', topPart=0';
    $db->sql_query($query);
break;
    }
echo "upd";
    die();
}

?>