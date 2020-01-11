<?php
$value=0;
switch($item['extraLevel'])
    {
        case 2:
            $value=15;
        break;
        case 3:
            $value=20;
        break;  
        case 4:
            $value=25;
        break;
        case 5:
            $value=50;
        break;		
        case 6:
            $value=75;
        break;
        case 7:
            $value=100;
        break;	
        case 8:
            $value=125;
        break;
        case 9:
            $value=150;
        break;
        case 10:
            $value=200;
        break;	
    }
    $pj['MpRegen'] += $value;     
?>