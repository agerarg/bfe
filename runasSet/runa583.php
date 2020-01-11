<?php
$value=0;
switch($item['extraLevel'])
    {
        case 2:
            $value=20;
        break;
        case 3:
            $value=25;
        break;  
        case 4:
            $value=50;
        break;
        case 5:
            $value=100;
        break;		
        case 6:
            $value=150;
        break;
        case 7:
            $value=200;
        break;	
        case 8:
            $value=250;
        break;
        case 9:
            $value=300;
        break;
        case 10:
            $value=400;
        break;								
    }
    $pj['runa_mascotaDmg'] += $value;           
?>