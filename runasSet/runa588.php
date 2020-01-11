<?php
$value=0;
switch($item['extraLevel'])
    {
        case 2:
            $value=2;
        break;
        case 3:
            $value=5;
        break;
        case 4:
            $value=10;
        break;
        case 5:
            $value=15;
        break;		
        case 6:
            $value=20;
        break;
        case 7:
            $value=25;
        break;	
        case 8:
            $value=30;
        break;
        case 9:
            $value=40;
        break;
        case 10:
            $value=50;
        break;									
    }
    $pj['RpEarth']+= $value;           
?>