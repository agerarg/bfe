<?php
$value=0;
switch($item['extraLevel'])
    {
        case 2:
            $value=10;
        break;
        case 3:
            $value=12;
        break;
        case 4:
            $value=14;
        break;
        case 5:
            $value=16;
        break;		
        case 6:
            $value=18;
        break;
        case 7:
            $value=20;
        break;	
        case 8:
            $value=22;
        break;
        case 9:
            $value=25;
        break;
        case 10:
            $value=30;
        break;			
    }
    $pj['ResFire'] += $value;           
?>