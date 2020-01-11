<?php
  if(SWORDON != 1)
      die();
    $query = 'SELECT * FROM monedas';
    $monedasq = $db->sql_query($query);
    $moneda = $db->sql_fetchrow($monedasq);
$dia = date('j');
if( $moneda['day']!=$dia)
{
    function getPercentageChange($oldNumber, $newNumber){
        $decreaseValue = $oldNumber - $newNumber;
        return round(($decreaseValue / $oldNumber) * 100, 2);
    }
    function getTotalof($id)
    {
        global $db;
        $query = 'SELECT SUM(cantidad) as total FROM inventario WHERE idItem = '.$id;
        $matsq = $db->sql_query($query);
        $ma = $db->sql_fetchrow($matsq);
        return (int)($ma['total']);
    }
    function cotizacion($moneda,$gold)
    {
        if($moneda==0)
        $moneda=1;
        return (int)($gold/$moneda)/10;
    }
    // GUARDANDO PRECIO ANTERIOR
        
    // TOTAL MONEY
    $query = 'SELECT SUM(oro) as totalgold FROM cuenta';
    $goldsq = $db->sql_query($query);
    $gold = $db->sql_fetchrow($goldsq);
    $gold = (int)($gold['totalgold']);

    $rerrol = getTotalof(613);
    $chaos = getTotalof(614);
    $upulus = getTotalof(615);
    $exodimo = getTotalof(616);
    $alchemist = getTotalof(617);
    $corruption = getTotalof(618);

    

    $rerrolPrice = cotizacion($rerrol,$gold);
    $rerrolPrice+=25000;
    $chaosPrice = cotizacion($chaos,$gold);
    $chaosPrice+=100000;
    $upulusPrice = cotizacion($upulus,$gold);
    $upulusPrice+=1000000;
    $exodimoPrice = cotizacion($exodimo,$gold);
    $exodimoPrice+=50000;
    $alchemistPrice = cotizacion($alchemist,$gold);
    $alchemistPrice+=200000;
    $corruptionPrice = cotizacion($corruption,$gold);
    $corruptionPrice+=200000;

    $rerollPerChange = getPercentageChange($moneda['reroll'],$rerrolPrice);
    $chaosPerChange = getPercentageChange($moneda['chaos'],$chaosPrice);
    $upulusPerChange = getPercentageChange($moneda['upulus'],$upulusPrice);
    $exodimoPerChange = getPercentageChange($moneda['exodimo'],$exodimoPrice);
    $alchemistPerChange = getPercentageChange($moneda['alchemist'],$alchemistPrice);
    $corruptionPerChange = getPercentageChange($moneda['corruption'],$corruptionPrice);

    echo "totalGold:". $gold." <br>";
    echo "totalreroll:". $rerrol." [". $rerrolPrice."]<br>";
    echo "totalchaos:". $chaos." [". $chaosPrice."]<br>";
    echo "totalupulus:". $upulus." [". $upulusPrice."]<br>";
    echo "totalexodimo:". $exodimo." [". $exodimoPrice."]<br>";
    echo "totalalchemist:". $alchemist." [". $alchemistPrice."]<br>";
    echo "totalalCorruption:". $corruption." [". $corruptionPrice."]<br>";


    $query = 'UPDATE monedas SET
        reroll_last = reroll,
        chaos_last = chaos,
        upulus_last = upulus,
        exodimo_last = exodimo,
        alchemist_last = alchemist,
        corruption_last = corruption,

        reroll = '.$rerrolPrice.',
        chaos = '.$chaosPrice.',
        upulus = '.$upulusPrice.',
        exodimo = '.$exodimoPrice.',
        alchemist = '.$alchemistPrice.',
        corruption = '.$corruptionPrice.',

        rerollChange = '.$rerollPerChange.',
        chaosChange = '.$chaosPerChange.',
        upulusChange = '.$upulusPerChange.',
        exodimoChange = '.$exodimoPerChange.',
        alchemistChange = '.$alchemistPerChange.',
        corruptionChange = '.$corruptionPerChange.',


        day = "'.$dia.'"
        ';
    $db->sql_query($query);
    die();
}

?>