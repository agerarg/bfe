<?php
$value=0;
switch($item['extraLevel'])
    {
        case 2:
            $value=2;
        break;
        case 3:
            $value=3;
        break;
        case 4:
            $value=4;
        break;
        case 5:
            $value=6;
        break;		
        case 6:
            $value=8;
        break;
        case 7:
            $value=10;
        break;	
        case 8:
            $value=12;
        break;
        case 9:
            $value=25;
        break;
        case 10:
            $value=30;
        break;					
    }
    $pj['cooldownReduction'] += $value;           
?>