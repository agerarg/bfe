<?php
	switch($grade)
    {
        case 12:
            $skilltopPer=40;
           $elemtopPer=40;
           
           $maxSkill3 = 8;
           $maxSkill5 = 50;
            $maxSkill1 = 60;
           $maxSkill2 = 85;
           $maxSkill4 = 750;
        break;
        case 11:
            $skilltopPer=30;
           $elemtopPer=30;
           
           $maxSkill3 = 16;
           $maxSkill5 = 40;
            $maxSkill1 = 50;
           $maxSkill2 = 75;
           $maxSkill4 = 650;
        break;
        case 10:
            $skilltopPer=25;
           $elemtopPer=25;
           
           $maxSkill3 = 12;
           $maxSkill5 = 30;
            $maxSkill1 = 40;
           $maxSkill2 = 65;
           $maxSkill4 = 550;
        break;
         case 9:
            $skilltopPer=23;
			$elemtopPer=23;
			
			$maxSkill3 = 10;
			$maxSkill5 = 25;
		 	$maxSkill1 = 35;
			$maxSkill2 = 60;
			$maxSkill4 = 500;
        break;
         case 8:
            $skilltopPer=20;
           $elemtopPer=20;
           
           $maxSkill3 = 8;
           $maxSkill5 = 20;
            $maxSkill1 = 30;
           $maxSkill2 = 55;
           $maxSkill4 = 450;
        break;
        case 7:
            $skilltopPer=15;
           $elemtopPer=15;
           
           $maxSkill3 = 5;
           $maxSkill5 = 15;
            $maxSkill1 = 25;
           $maxSkill2 = 50;
           $maxSkill4 = 350;
        break;
        case 1:
            $skilltopPer=5;
           $elemtopPer=5;
           
           $maxSkill3 = 2;
           $maxSkill5 = 5;
            $maxSkill1 = 10;
           $maxSkill2 = 25;
           $maxSkill4 = 150;
        break;
        case 2:
            $skilltopPer=5;
           $elemtopPer=5;
           
           $maxSkill3 = 2;
           $maxSkill5 = 5;
            $maxSkill1 = 10;
           $maxSkill2 = 25;
           $maxSkill4 = 150;
        break;
        case 3:
            $skilltopPer=6;
           $elemtopPer=6;
           
           $maxSkill3 = 3;
           $maxSkill5 = 6;
            $maxSkill1 = 12;
           $maxSkill2 = 30;
           $maxSkill4 = 175;
        break;
        case 4:
            $skilltopPer=7;
           $elemtopPer=7;
           
           $maxSkill3 = 3;
           $maxSkill5 = 7;
            $maxSkill1 = 11;
           $maxSkill2 = 30;
           $maxSkill4 = 200;
        break;
        case 5:
            $skilltopPer=8;
           $elemtopPer=8;
           
           $maxSkill3 = 4;
           $maxSkill5 = 8;
            $maxSkill1 = 12;
           $maxSkill2 = 35;
           $maxSkill4 = 250;
        break;
        case 6:
            $skilltopPer=10;
           $elemtopPer=10;
           
           $maxSkill3 = 4;
           $maxSkill5 = 13;
            $maxSkill1 = 20;
           $maxSkill2 = 40;
           $maxSkill4 = 300;
        break;
    }
   $acumulate=0;
   $leyenda="";
  
           $skilltopPer=$skilltopPer*$value;
           $elemtopPer=$elemtopPer*$value;
           $maxSkill3 = $maxSkill3*$value;
           $maxSkill5 = $maxSkill5*$value;
            $maxSkill1 = $maxSkill1*$value;
           $maxSkill2 = $maxSkill2*$value;
           $maxSkill4 = $maxSkill4*$value;
   
   // VALUE
?>