var descSkill = new Array();
function skillSetInfo(id,lvl,nombre,img,desc)
{	
	var yolo=new Array();
	yolo['nombre'] = nombre;
	yolo['img'] = img;
	yolo['desc'] = desc;
	descSkill[id+"_"+lvl]=yolo;
}
/////// RAIDS /////////////////
skillSetInfo(15,1,"Raid Silence","raidSilence.jpg","No puedes utilizar ninguna habilidad");

////// MOB /////////////////////////
skillSetInfo(71,1,"Ant Sickness","antSickness.jpg","Disminuye defensa, ataque y ataque magico 15%");
skillSetInfo(72,1,"Confusión","confuse.jpg","estas confundido, atacas tus amigos!");
////////// SHAMAN ///////////////
skillSetInfo(50,1,"Moh God (Red Shaman)","shaman/Moh.jpg","aumenta 1% el ataque magico por tributo  no es afectado por Chants");
skillSetInfo(51,1,"Kon God (Blue Shaman)","shaman/Kon.jpg","aumenta 1% vida y mana por cada tributo no es afectado por Chants");
skillSetInfo(52,1,"Nah God (Green Shaman)","shaman/Nah.jpg","aumenta 0,5% defensa y 0,5% defensa magica por cada tributo");
skillSetInfo(57,1,"Robe Guru","shaman/redRobe.jpg","aumenta 10% Critico Magico y 15% el Critico Magico cuando usas armadura tipo robe");
skillSetInfo(58,1,"Light Guru","shaman/light.jpg","suma 3% mana y 1 tributo a Kon en cada golpe basico cuando usas armadura tipo light");
skillSetInfo(59,1,"Dual Magic","shaman/dual.jpg","aumenta %10 del ataque magico en ataque y 10% del ataque en ataque magico");
skillSetInfo(62,1,"Heavy Guru","shaman/heavy.jpg","Gana 1 tributo a Nah en cada ataque basico cuando usas armadura tipo heavy");
skillSetInfo(63,1,"Chant of Protection","shaman/protection.jpg","Aumenta a todo el clan 15% defensa y defensa magica, gana 10 tributos a Nah");
skillSetInfo(64,1,"Chant of Fortitude","shaman/fortuite.jpg","Aumenta a todo el clan 20% vida y mana, gana 10 tributos a Nah");
skillSetInfo(65,1,"Chant of Might","shaman/might.jpg","Aumenta a todo el clan 15% ataque y ataque magico, gana 10 tributos a Nah");
skillSetInfo(66,1,"Chant of Senses","shaman/critico.jpg","Aumenta a todo el clan 10 critico magico y critico, gana 10 tributos a Nah");

////////// NINJA ///////////////
skillSetInfo(26,1,"Criticolo","ninja/criticolo.jpg","Aumenta el critico +2 y +10 CD cuando usas light");
skillSetInfo(26,2,"Criticolo 2","ninja/criticolo.jpg","Aumenta el critico +4 y +15 CD cuando usas light");
skillSetInfo(26,3,"Criticolo 3","ninja/criticolo.jpg","Aumenta el critico +6 y +20 CD cuando usas light");
skillSetInfo(26,4,"Criticolo 4","ninja/criticolo.jpg","Aumenta el critico +8 y +25 CD cuando usas light");
skillSetInfo(27,1,"Assassination","ninja/asesination.jpg","10% en golpes criticos de hacer un daño brutal. solo con daggers");
skillSetInfo(27,2,"Assassination 2","ninja/asesination.jpg","15% en golpes criticos de hacer un daño brutal. solo con daggers");
skillSetInfo(27,3,"Assassination 3","ninja/asesination.jpg","20% en golpes criticos de hacer un daño brutal. solo con daggers");
skillSetInfo(32,1,"Shadow Blow","ninja/shadowblow.jpg","evade el proximo golpe");
skillSetInfo(33,1,"Ninja Master","ninja/ninjamaster.jpg","10% chance de evadir cualquier tipo de ataque solo con armaduras tipo light");
skillSetInfo(33,2,"Ninja Master 2","ninja/ninjamaster.jpg","15% chance de evadir cualquier tipo de ataque solo con armaduras tipo light");
skillSetInfo(34,1,"Magic Barrier","ninja/magicbarrier.jpg","Aumenta +250 defensa magica");
skillSetInfo(35,1,"Focus","ninja/focus.jpg","Aumenta el critico +30");
skillSetInfo(35,2,"Focus 2","ninja/focus.jpg","Aumenta el critico +40");
skillSetInfo(69,1,"Skill Power","ninja/skillpower.jpg","Cuando usas ataques basicos esto da un daño extra a habilidades, daño aumentado 10% en cada golpe");
skillSetInfo(69,2,"Skill Power 2","ninja/skillpower.jpg","Cuando usas ataques basicos esto da un daño extra a habilidades, daño aumentado 20% en cada golpe");
skillSetInfo(69,3,"Skill Power 3","ninja/skillpower.jpg","Cuando usas ataques basicos esto da un daño extra a habilidades, daño aumentado 30% en cada golpe");
skillSetInfo(70,1,"Ninjutsu","ninja/ninjitsu.jpg","Aumenta la evasión 10% durante 2min");
skillSetInfo(70,2,"Ninjutsu 2","ninja/ninjitsu.jpg","Aumenta la evasión 20% durante 2min");

skillSetInfo(901,1,"Combo","ninja/combo.jpg","Aumenta el daño en el proximoo golpe acertado");
skillSetInfo(902,1,"Combo","ninja/combo1.jpg","Aumenta el daño en el proximoo golpe acertado");
skillSetInfo(903,1,"Combo","ninja/combo2.jpg","Aumenta el daño en el proximoo golpe acertado");
skillSetInfo(904,1,"Combo","ninja/Scombo.jpg","Aumenta el daño en el proximoo golpe acertado");
skillSetInfo(905,1,"Combo","ninja/Scombo1.jpg","Aumenta el daño en el proximoo golpe acertado");
skillSetInfo(906,1,"Combo","ninja/Scombo2.jpg","Aumenta el daño en el proximoo golpe acertado");

////////// ZOMBIE ///////////////
skillSetInfo(1,1,"Undead Stance","zombie/undead.jpg","Cura +2% de vida en cada hit, solo cuando tiene armadura tipo Heavy.");
skillSetInfo(1,2,"Undead Stance 2","zombie/undead.jpg","Cura +3% de vida en cada hit, solo cuando tiene armadura tipo Heavy.");
skillSetInfo(1,3,"Undead Stance 3","zombie/undead.jpg","Cura +4% de vida en cada hit, solo cuando tiene armadura tipo Heavy.");
skillSetInfo(2,1,"Blood Stance","zombie/bite.jpg","+20% ataque");
skillSetInfo(3,1,"Blade Master","zombie/blade.jpg","+ 10% de daño con arma tipo Sword.");
skillSetInfo(3,2,"Blade Master 2","zombie/blade.jpg","+ 14% de daño con arma tipo Sword.");
skillSetInfo(3,3,"Blade Master 3","zombie/blade.jpg","+ 18% de daño con arma tipo Sword.");
skillSetInfo(3,4,"Blade Master 4","zombie/blade.jpg","+ 25% de daño con arma tipo Sword.");
skillSetInfo(4,1,"Critical","zombie/critical.jpg","+ 2 critico con arma tipo Sword.");
skillSetInfo(4,2,"Critical 2","zombie/critical.jpg","+ 4 critico con arma tipo Sword.");
skillSetInfo(4,3,"Critical 3","zombie/critical.jpg","+ 6 critico con arma tipo Sword.");
skillSetInfo(5,1,"Critical Dmg","zombie/criticalpow.jpg","+ 25 daño critico con arma tipo Sword.");
skillSetInfo(7,1,"Swing Critical","zombie/swingcrit.jpg","aumenta tu critico + 8");
skillSetInfo(7,2,"Swing Critical 2","zombie/swingcrit.jpg","aumenta tu critico + 15");
skillSetInfo(8,1,"No Mana Swing","zombie/swingmana.jpg","La habilidad Swing Blade no cuesta mana");
skillSetInfo(9,1,"Shield Ratio","zombie/shield.jpg","+ 10% bloquear golpe. requiere usar escudo.");
skillSetInfo(9,2,"Shield Ratio 2","zombie/shield.jpg","+ 20% bloquear golpe. requiere usar escudo.");
skillSetInfo(10,1,"Return","zombie/espinas.jpg","Retorna 10% del daño a los atacantes");
skillSetInfo(10,2,"Return 2","zombie/espinas.jpg","Retorna 20% del daño a los atacantes");
skillSetInfo(11,1,"T-Virus Rage","zombie/tvirus.jpg","Aumenta 120% la Vida");
skillSetInfo(12,1,"Revive","revive.jpg","90 seg de espera cuando mueres");
skillSetInfo(14,1,"Swing Critical","zombie/swingcrit.jpg","aumenta tu critico + 8");
skillSetInfo(14,2,"Swing Critical 2","zombie/swingcrit.jpg","aumenta tu critico + 15");
skillSetInfo(68,1,"Inmortality","zombie/inmortality.jpg","Aumenta tu defensa 0.5% por cada 1% de vida perdida.");
skillSetInfo(68,2,"Inmortality 2","zombie/inmortality.jpg","Aumenta tu defensa 1% por cada 1% de vida perdida.");

skillSetInfo(13,1,"Hate","hate.jpg","Estas forzado a atacar solo un objetivo");

////////// Skeleton Mage ///////////////
skillSetInfo(16,1,"Soul Capsule","skeletal/soulcapsule.jpg","Puede capturar hasta 50 almas");
skillSetInfo(16,2,"Soul Capsule 2","skeletal/soulcapsule.jpg","Puede capturar hasta 100 almas");
skillSetInfo(16,3,"Soul Capsule 3","skeletal/soulcapsule.jpg","Puede capturar hasta 150 almas");
skillSetInfo(16,4,"Soul Capsule 4","skeletal/soulcapsule.jpg","Puede capturar hasta 200 almas");
skillSetInfo(17,1,"Mana x Soul","skeletal/manaxsoul.jpg","Por cada alma agrega 1.5 mana solo con armadura tipo robe");
skillSetInfo(17,2,"Mana x Soul 2","skeletal/manaxsoul.jpg","Por cada alma agrega 3 mana solo con armadura tipo robe");
skillSetInfo(18,1,"Life x Soul","skeletal/vidaxsoul.jpg","Por cada alma agrega 2 vida solo con armadura tipo robe");
skillSetInfo(18,2,"Life x Soul 2","skeletal/vidaxsoul.jpg","Por cada alma agrega 4 vida solo con armadura tipo robe");
skillSetInfo(19,1,"Magic x Soul","skeletal/magicxsoul.jpg","Por cada alma agrega 0.5 ataque magico solo con armadura tipo robe");
skillSetInfo(19,2,"Magic x Soul 2","skeletal/magicxsoul.jpg","Por cada alma agrega 1 ataque magico solo con armadura tipo robe");
skillSetInfo(22,1,"Dark Inside","skeletal/witgain.jpg","cada habilidada usada incrementa el daño a ese mismo objetivo, 15,25 y 35%");

////////// Marksman ///////////////
skillSetInfo(38,1,"Dexterity","marksman/dextery.jpg","Cuando usas light agrega 5% ataque y con bow +50 ataque");
skillSetInfo(38,2,"Dexterity 2","marksman/dextery.jpg","Cuando usas light agrega 10% ataque y con bow +100 ataque");
skillSetInfo(38,3,"Dexterity 3","marksman/dextery.jpg","Cuando usas light agrega 15% ataque y con bow +150 ataque");
skillSetInfo(38,4,"Dexterity 4","marksman/dextery.jpg","Cuando usas light agrega 20% ataque y con bow +200 ataque");
skillSetInfo(39,1,"Critical City","marksman/criticalcity.jpg","Cada 10 golpes basicos hace un super critico (afecta habilidades)");
skillSetInfo(39,2,"Critical City 2","marksman/criticalcity.jpg","Cada 8 golpes basicos hace un super critico (afecta habilidades)");
skillSetInfo(39,3,"Critical City 3","marksman/criticalcity.jpg","Cada 6 golpes basicos hace un super critico (afecta habilidades)");
skillSetInfo(39,4,"Critical City 4","marksman/criticalcity.jpg","Cada 4 golpes basicos hace un super critico (afecta habilidades)");
skillSetInfo(42,1,"Fury Shot","marksman/furyshot.jpg","aumenta +10 la Velocidad de Ataque");
skillSetInfo(45,1,"Skillish","marksman/smart.jpg","El daño de habilidades es aumentado en STR x 10");
skillSetInfo(48,1,"Mana Strike","marksman/manastrike.jpg","Cura 3% por ataque basico");
skillSetInfo(48,2,"Mana Strike 2","marksman/manastrike.jpg","Cura 5% por ataque basico");
skillSetInfo(49,1,"Arrow Allow","marksman/savearrow.jpg","Acumula flechas");
















