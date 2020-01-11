<?php
$value=0;
switch($item['extraLevel'])
    {
        case 2:
            $value=1;
        break;
        case 3:
            $value=1;
        break;
        case 4:
            $value=2;
        break;
        case 5:
            $value=2;
        break;		
        case 6:
            $value=3;
        break;
        case 7:
            $value=4;
        break;	
        case 8:
            $value=5;
        break;
        case 9:
            $value=6;
        break;
        case 10:
            $value=7;
        break;			
    }
    $pj['runa_velAttack'] = $value;           
?>