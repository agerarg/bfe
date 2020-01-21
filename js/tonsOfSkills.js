var descSkill = new Array();
function skillSetInfo(id,lvl,nombre,img,desc)
{	
	var yolo=new Array();
	yolo['nombre'] = nombre;
	yolo['img'] = img;
	yolo['desc'] = desc;
	descSkill[id+"_"+lvl]=yolo;
}
// POTS
skillSetInfo(412,1,"Attack Pot Buff","pot/attackpot.jpg","Aumenta tu Ataque en 5000");
skillSetInfo(413,1,"Critical Pot Buff","pot/criticalpot.jpg","Aumenta tu Critico +50%");
skillSetInfo(414,1,"Defensa Pot Buff","pot/defensapot.jpg","Aumenta tu Defensa +1000");
skillSetInfo(415,1,"Papa Destroyer Pot Buff","pot/dobledanopot.jpg","Le haces doble da&ntilde;o a papas");
skillSetInfo(416,1,"Magic Critical Pot Buff","pot/magiccriticalpot.jpg","Aumenta tu Critico Magico +50%");
skillSetInfo(417,1,"Magic Pot Buff","pot/magicpot.jpg","Aumenta tu Ataque Magico +1000");
skillSetInfo(418,1,"Velocidad Pot Buff","pot/velatcpot.jpg","Aumenta tu Velocidad de Ataque +3");
skillSetInfo(419,1,"Casting Pot Buff","pot/velcastpot.jpg","Aumenta tu Velocidad de Casteo +3");
skillSetInfo(420,1,"Vida Limit Pot Buff","pot/vidalimipot.jpg","Aumenta tu Limite de Vida +3000");

skillSetInfo(433,1,"Bendición de Odin","odin.jpg","Aumenta tu Ataque en 10k, Ataque magico en 5k, Critico y Critico magico 100%, Defensas en 2k");

skillSetInfo(448,1,"Astral Pass","astral.jpg","Puedes acceder a mapas Astrales");
skillSetInfo(449,1,"Buff del Support","supportbuff.jpg","Aumenta 150% la experiencia");

//SUBCLASS
skillSetInfo(430,1,"Boost HP","subclass/boostHp.jpg","Aumenta tu vida en 20%.");
skillSetInfo(430,2,"Boost HP 2","subclass/boostHp.jpg","Aumenta tu vida en 40%.");
skillSetInfo(430,3,"Boost HP 3","subclass/boostHp.jpg","Aumenta tu vida en 60%.");

skillSetInfo(432,1,"Boost Def","subclass/boostDef.jpg","Aumenta 20% defensa y defensa magica.");
skillSetInfo(432,2,"Boost Def 2","subclass/boostDef.jpg","Aumenta 40% defensa y defensa magica.");
skillSetInfo(432,3,"Boost Def 3","subclass/boostDef.jpg","Aumenta 60% defensa y defensa magica.");

skillSetInfo(431,1,"Boost Dmg","subclass/boostDps.jpg","Aumenta tu Ataque y Ataque Magico en 5%.");
skillSetInfo(431,2,"Boost Dmg 2","subclass/boostDps.jpg","Aumenta tu Ataque y Ataque Magico en 10%.");
skillSetInfo(431,3,"Boost Dmg 3","subclass/boostDps.jpg","Aumenta tu Ataque y Ataque Magico en 15%.");

skillSetInfo(422,1,"Dark Protection","subclass/DarkProtection.jpg","Reduce el daño de Raid Boss un 50%.");
skillSetInfo(421,1,"Perseveroide","subclass/Fotresst.jpg","Cada ataque basico aumenta tu daño en basicos 5% hasta 10 veces.");
skillSetInfo(423,1,"LifeGet","subclass/LifeGet.jpg","Te curas 5% de tu vida total en cada golpe basico.");
skillSetInfo(424,1,"Combo","subclass/Assassination.jpg","Tus habilidades hacen combo aumenta 10% el Ataque y Ataque Magico hasta 5 golpes.");
skillSetInfo(425,1,"Exquisite","subclass/Exquisite.jpg","Aumenta el Ataque y Ataque Magico un 5% por cada item Legendario que uses.");
skillSetInfo(426,1,"HolyCast","subclass/HolyProtection.jpg","Tu velocidad de casteo siempre va ser 3.");
skillSetInfo(427,1,"BloodyKiller","subclass/HolyProtection.jpg","Aumenta el Poder Critico/Critico Magico 15% del total.");
skillSetInfo(428,1,"Brutality","subclass/HardSkin.jpg","Aumenta el daño de golpes basicos 50%.");
skillSetInfo(429,1,"Element Focus","subclass/BuffPack.jpg","Aumenta el elemento total en 25%.");

// SHARE
skillSetInfo(400,1,"Monster Hunter","madness.jpg","Disminuye 30% el daño de monstruos.");


/////// RECOMENDATION AURAS //////
skillSetInfo(102,1,"Recommendation boost","boost.jpg","incrementa 15% el oro adquirido<br>incrementa 25% el exp adquirido<br>incrementa el drop en 20%");
skillSetInfo(411,1,"Twitch Bonus","tw.jpg","incrementa 35% el oro adquirido!");


//////////////// DURMIENDING... ////
skillSetInfo(178,1,"Durmiendo","sleep.jpg","Estas durmiendo");


/////// DIMENCIONAL CRAP //////
skillSetInfo(100,1,"Infierno 1","hell.jpg","You are in hell. dificulty 1");
skillSetInfo(100,2,"Infierno 2","hell.jpg","You are in hell. dificulty 2");
skillSetInfo(100,3,"Infierno 3","hell.jpg","You are in hell. dificulty 3");
skillSetInfo(100,4,"Infierno 4","hell.jpg","You are in hell. dificulty 4");
skillSetInfo(100,5,"Infierno 5","hell.jpg","You are in hell. dificulty 5");
skillSetInfo(100,6,"Infierno 6","hell.jpg","You are in hell. dificulty 6");

skillSetInfo(147,1,"Dungeon","dungeon.jpg","Estas en un dungeon.<br>-Si se acaba el tiempo perdes.");

skillSetInfo(116,1,"Alien Dimension 6","alien.jpg","You are in Alien World.");

/////// RAIDS /////////////////
skillSetInfo(15,1,"Raid Silence","raidSilence.jpg","No puedes usar habilidades");

////// MOB /////////////////////////
skillSetInfo(71,1,"Ant Sickness","antSickness.jpg","Decreases defense, attack and magic attack 15%");
skillSetInfo(72,1,"Confusion","confuse.jpg","estas confundido, puede que ataques tus amigos!");

//// PETS /////
skillSetInfo(184,1,"Cat Skill","skillCat.jpg","Aumenta +10 Critico y Critico Magico!");
skillSetInfo(185,1,"Golem Skill","skillGolem.jpg","Aumenta +15% Defensa y Defensa Magica!");
///// CRAZY ITEMS ///////////////
skillSetInfo(98,1,"Politician Ring","poliring.jpg","incrementa el oro adquirido en 15%!");
skillSetInfo(99,1,"Shield of Shit","shitShield.jpg","Returna 10% del daño físico a tu atacante!");
skillSetInfo(101,1,"The Manijenz","theManijeitor.jpg","+50 Vampiric Aura!");
skillSetInfo(103,1,"DooM Necklace","doom.jpg","incrementa 10% Penetracion magica!");
skillSetInfo(148,1,"Anillo de la muerte","death.jpg","Probabilidad de curarse 25% de vida cuando recibes un golpe mortal de un monstruo.");
skillSetInfo(165,1,"Anillo del Goblin","goblinRing.jpg","Incrementa el oro 15%");
skillSetInfo(166,1,"Anillo de Agua","waterRing.jpg","Duplica el elemento water");
skillSetInfo(172,1,"Red Dragon Ring","redDrag.jpg","+25 de fire y +15% de fire");
skillSetInfo(173,1,"Blue Dragon Ring","blueDrag.jpg","+25 de water y +15% de water");
skillSetInfo(174,1,"Green Dragon Ring","greenDrag.jpg","+25 de earth y +15% de earth");


////// CLAN /////////////////////////
skillSetInfo(75,1,"Clan Exp Bonus","clan/exp.jpg","Incrementa la experiencia 25%");
skillSetInfo(75,2,"Clan Exp Bonus 2","clan/exp.jpg","Incrementa la experiencia 30%");

skillSetInfo(76,1,"Clan Gold Bonus","clan/gold.jpg","Incrementa el oro 10%");
skillSetInfo(76,2,"Clan Gold Bonus 2","clan/gold.jpg","Incrementa el oro 15%");
skillSetInfo(76,3,"Clan Gold Bonus 3","clan/gold.jpg","Incrementa el oro 100%");

skillSetInfo(77,1,"Clan Damage Bonus","clan/attack.jpg","Incrementa Ataque y Ataque Magico un 15%");
skillSetInfo(77,2,"Clan Damage Bonus 2","clan/attack.jpg","Incrementa Ataque y Ataque Magico un 20%");
skillSetInfo(77,3,"Clan Damage Bonus 3","clan/attack.jpg","Incrementa Ataque y Ataque Magico un 25%");

skillSetInfo(78,1,"Clan Defense Bonus","clan/defense.jpg","Incrementa la Defensa y Defensa Magica un 15%");
skillSetInfo(78,2,"Clan Defense Bonus 2","clan/defense.jpg","Incrementa la Defensa y Defensa Magica un 20%");
skillSetInfo(78,3,"Clan Defense Bonus 3","clan/defense.jpg","Incrementa la Defensa y Defensa Magica un 25%");

skillSetInfo(79,1,"Clan Life Bonus","clan/hp.jpg","Incrementa la vida un 10%");
skillSetInfo(79,2,"Clan Life Bonus 2","clan/hp.jpg","Incrementa la vida un 20%");
skillSetInfo(79,3,"Clan Life Bonus 3","clan/hp.jpg","Incrementa la vida un 30%");

skillSetInfo(80,1,"Clan Champion","clan/champion.jpg","You have been blessed with powers to defend your empire.");

skillSetInfo(81,1,"Clan King Crown","clan/king.jpg","Nobody messes with the King.");
///// PARAGON ///////////////////
skillSetInfo(149,1,"Damage","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 2%");
skillSetInfo(149,2,"Damage 2","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 4%");
skillSetInfo(149,3,"Damage 3","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 6%");
skillSetInfo(149,4,"Damage 4","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 8%");
skillSetInfo(149,5,"Damage 5","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 10%");
skillSetInfo(149,6,"Damage 6","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 12%");
skillSetInfo(149,7,"Damage 7","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 14%");
skillSetInfo(149,8,"Damage 8","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 16%");
skillSetInfo(149,9,"Damage 9","paragon/ataque.jpg","Aumenta ataque y ataque mágico en 20%");

skillSetInfo(150,1,"Defense","paragon/shield.jpg","Aumenta defensa y defensa magica 2%");
skillSetInfo(150,2,"Defense 2","paragon/shield.jpg","Aumenta defensa y defensa magica 4%");
skillSetInfo(150,3,"Defense 3","paragon/shield.jpg","Aumenta defensa y defensa magica 8%");
skillSetInfo(150,4,"Defense 4","paragon/shield.jpg","Aumenta defensa y defensa magica 12%");
skillSetInfo(150,5,"Defense 5","paragon/shield.jpg","Aumenta defensa y defensa magica 16%");
skillSetInfo(150,6,"Defense 6","paragon/shield.jpg","Aumenta defensa y defensa magica 20%");
skillSetInfo(150,7,"Defense 7","paragon/shield.jpg","Aumenta defensa y defensa magica 24%");
skillSetInfo(150,8,"Defense 8","paragon/shield.jpg","Aumenta defensa y defensa magica 28%");
skillSetInfo(150,9,"Defense 9","paragon/shield.jpg","Aumenta defensa y defensa magica 35%");

skillSetInfo(151,1,"Utility","paragon/utility.jpg","Aumenta la regeneración de vida y mana +5");
skillSetInfo(151,2,"Utility 2","paragon/utility.jpg","Aumenta la regeneración de vida y mana +10");
skillSetInfo(151,3,"Utility 3","paragon/utility.jpg","Aumenta la regeneración de vida y mana +15");
skillSetInfo(151,4,"Utility 4","paragon/utility.jpg","Aumenta la regeneración de vida y mana +20");
skillSetInfo(151,5,"Utility 5","paragon/utility.jpg","Aumenta la regeneración de vida y mana +25");
skillSetInfo(151,6,"Utility 6","paragon/utility.jpg","Aumenta la regeneración de vida y mana +30");
skillSetInfo(151,7,"Utility 7","paragon/utility.jpg","Aumenta la regeneración de vida y mana +35");
skillSetInfo(151,8,"Utility 8","paragon/utility.jpg","Aumenta la regeneración de vida y mana +40");
skillSetInfo(151,9,"Utility 9","paragon/utility.jpg","Aumenta la regeneración de vida y mana +50");

skillSetInfo(152,1,"Base Damage","paragon/ataque2.jpg","Aumenta el ataque y ataque magico +15");
skillSetInfo(152,2,"Base Damage 2","paragon/ataque2.jpg","Aumenta el ataque y ataque magico +30");
skillSetInfo(152,3,"Base Damage 3","paragon/ataque2.jpg","Aumenta el ataque y ataque magico +50");

skillSetInfo(153,1,"Berseker","paragon/zeker.jpg","Aumenta ataque y ataque magico 15% por 2min");

skillSetInfo(154,1,"Elemental","paragon/elemental.jpg","Aumenta 15% tu daño elemental");

skillSetInfo(155,1,"Maximus","paragon/maxim.jpg","Aumenta daño critico +25");

skillSetInfo(156,1,"Monster Hunter","paragon/monsthunt.jpg","Aumenta el daño contra bichos 10%");
skillSetInfo(156,2,"Monster Hunter 2","paragon/monsthunt.jpg","Aumenta el daño contra bichos 15%");
skillSetInfo(156,3,"Monster Hunter 3","paragon/monsthunt.jpg","Aumenta el daño contra bichos 20%");
skillSetInfo(156,4,"Monster Hunter 4","paragon/monsthunt.jpg","Aumenta el daño contra bichos 25%");

skillSetInfo(157,1,"Critical","paragon/critical.jpg","Aumenta el critico +5%");
skillSetInfo(157,2,"Critical 2","paragon/critical.jpg","Aumenta el critico +10%");

skillSetInfo(158,1,"Base Life","paragon/baselife.jpg","Aumenta la vida +200");
skillSetInfo(158,2,"Base Life","paragon/baselife.jpg","Aumenta la vida +500");
skillSetInfo(158,3,"Base Life","paragon/baselife.jpg","Aumenta la vida +1000");
skillSetInfo(158,4,"Base Life","paragon/baselife.jpg","Aumenta la vida +1500");
skillSetInfo(158,5,"Base Life","paragon/baselife.jpg","Aumenta la vida +2000");

skillSetInfo(159,1,"Monster Shield","paragon/monstershield.jpg","Aumenta resistencia a bichos 15%");
skillSetInfo(159,2,"Monster Shield 2","paragon/monstershield.jpg","Aumenta resistencia a bichos 20%");
skillSetInfo(159,3,"Monster Shield 3","paragon/monstershield.jpg","Aumenta resistencia a bichos 25%");
skillSetInfo(159,4,"Monster Shield 4","paragon/monstershield.jpg","Aumenta resistencia a bichos 30%");

skillSetInfo(160,1,"Life Regen","paragon/lifereg.jpg","Aumenta la reg de vida +10");
skillSetInfo(160,2,"Life Regen 2","paragon/lifereg.jpg","Aumenta la reg de vida +20");

skillSetInfo(161,1,"HP Power","paragon/hppower.jpg","Aumenta la vida 10%");

skillSetInfo(162,1,"Mini UD","paragon/ud.jpg","Aumenta la defensa y defensa magica +250 por 1min");

skillSetInfo(163,1,"Paragon Exp","paragon/exp.jpg","Aumenta la 10% la experiencia obtenida de monstruos a toda la party por 10min");

skillSetInfo(164,1,"Paragon Gold","paragon/gold.jpg","Aumenta +15% el oro obtenido de monstruos a toda la party por 10min");

skillSetInfo(364,1,"Mace Guard","pasivos/MaceGuard.jpg","Aumenta defensa +25");


// Quest Skills
skillSetInfo(206,1,"Cubrir Derecha","shieldDerecha.jpg","Cubre un golpe por la derecha");
skillSetInfo(207,1,"Cubrir Izquierda","shieldIzquierda.jpg","Cubre un golpe por la izquierda");
skillSetInfo(208,1,"Cubrir Arriba","shieldArriba.jpg","Cubre un golpe por arriba");
skillSetInfo(209,1,"Choripan","choripan.jpg","Aumenta ataque +25 ataque magico +25 critico +5 critico magico +5");
skillSetInfo(210,1,"Aura Oscura","darkness.jpg","Aumenta +15 dark");

////////// GARCA ///////////////
skillSetInfo(195,1,"Weapon Master","garca/weapon.jpg","Puedes utilizar dos armas una en cada mano,  si tus armas son distintas puedes utilizar cualquier habilidad que requiera otras para ser usadas.");
skillSetInfo(197,1,"Balanced Armor","garca/armor.jpg","+2 velocidad de casteo, +5 reg de mana, ataque basicos hacen 5% del total de mana como daño verdader con light");
skillSetInfo(197,2,"Balanced Armor 2","garca/armor.jpg","+4 velocidad de casteo, +10 reg de mana, ataque basicos hacen 10% del total de mana como daño verdadero con light");
skillSetInfo(200,1,"Alto Ataque","garca/altoataque2.jpg","El primero golpe aumenta nuestro daño base x1.5 usando duales.");
skillSetInfo(200,2,"Alto Ataque 2","garca/altoataque2.jpg","El primero golpe aumenta nuestro daño base x2 usando duales.");
skillSetInfo(200,3,"Alto Ataque 3","garca/altoataque2.jpg","El primero golpe aumenta nuestro daño base x2.5 usando duales.");
skillSetInfo(193,1,"Convencimiento","garca/convenc.jpg","Aumenta 15% mas de oro obtenido a toda la party.");
skillSetInfo(203,1,"Over Power","garca/overpower.jpg","Tu ataque y ataque mágico se duplica en la siguiente habilidad y es critico, no tiene efecto si se activa Alto Ataque.");
skillSetInfo(201,1,"Preparate","garca/prep.jpg","La próxima habilidad que utilices no va tener costo de mana ni tiempo de enfriamiento.");
skillSetInfo(198,1,"Garca Mode","garca/cagar.jpg","Los ataques en vez de hacerte daño te curan durante 30s, el efecto se pierde si estas con toda la vida.");
skillSetInfo(214,1,"Kappa","garca/kappa.jpg","Cuando haces un golpe critico aumenta +10 de critico y +20 poder critico por 20s");
skillSetInfo(215,1,"Kappa On","garca/kappaOn.gif","Aumenta +10 critico y +20 poder critico.");
skillSetInfo(365,1,"Hex","garca/hexx.jpg","Reduce 50% la armadura de mounstros afectados con esta habilidad.");
skillSetInfo(397,1,"Cirujeitor","garca/truchar.jpg","Aumenta tu Ataque 250% cuando usas arma Comun, 200% Magica,150% Rara, 100% Epica, 50% Legendaria.");

skillSetInfo(371,1,"Charge Focus","garca/charge.jpg","Cada habilidad usada te da 1 carga (hasta 2) en ataques basicos las cargas se consumen y golpeas 1 vez mas por cada carga.");
skillSetInfo(371,2,"Charge Focus 2","garca/charge.jpg","Cada habilidad usada te da 1 carga (hasta 3) en ataques basicos las cargas se consumen y golpeas 1 vez mas por cada carga.");
skillSetInfo(371,3,"Charge Focus 3","garca/charge.jpg","Cada habilidad usada te da 1 carga (hasta 4) en ataques basicos las cargas se consumen y golpeas 1 vez mas por cada carga.");
skillSetInfo(371,4,"Charge Focus 4","garca/charge.jpg","Cada habilidad usada te da 1 carga (hasta 5) en ataques basicos las cargas se consumen y golpeas 1 vez mas por cada carga.");
skillSetInfo(373,1,"Death Eye","garca/deatheye.jpg","Tus siguientes ataques son críticos.");
skillSetInfo(374,1,"Killer Instinct","garca/killerinstict.jpg","Aumenta el poder critico +25 a toda la party.");
skillSetInfo(375,1,"Garca Blessing","garca/blessing.jpg","Aumenta la experiencia obtenida +15% a toda la party.");
skillSetInfo(398,1,"Trankadura","garca/furyy.jpg","Tu Poder Critico se suma a tu Ataque cuando usas armaduras tipo light.");

////////// CLERICK ///////////////
skillSetInfo(126,1,"Robe Recovery","cleric/robe.jpg","Incrementa Ataque Magico en 20% cuando usas robe");
skillSetInfo(130,1,"BigBlunt Mastery","cleric/staff.jpg","Incrementa 0.03% Ataque magico por cada punto de Regeneracion de Mana usando bigblunt");
skillSetInfo(130,2,"BigBlunt Mastery","cleric/staff.jpg","Incrementa 0.06% Ataque magico por cada punto de Regeneracion de Mana usando bigblunt");
skillSetInfo(130,3,"BigBlunt Mastery","cleric/staff.jpg","Incrementa 0.1% Ataque magico por cada punto de Regeneracion de Mana usando bigblunt");
skillSetInfo(134,1,"Faith","cleric/faith.jpg","Cada Prey aumenta tu Faith.");
skillSetInfo(137,1,"Inner Fire","cleric/inferfire.jpg","Incrementa 100% la Defensa y Defensa Magica");
skillSetInfo(167,1,"Aura peronista","cleric/godBless.jpg","Self Heal no castea, +Ataque Magico X 1.5, +50 holy, +25% Defensa vs Bichos, +15 Critico Magico (Solo Main Cleric)");
skillSetInfo(366,1,"Ignore Death","cleric/ignoreDeath.jpg","Al recibir un daño letal de un monstruo quedas con 1 de vida en vez de morir");
skillSetInfo(396,1,"Fe","cleric/holyStaff.jpg","Aumenta 25% ataque y ataque magico");
skillSetInfo(401,1,"Sabio","cleric/wisdom.jpg","Aumenta la experiencia obtenida 70%");
skillSetInfo(139,1,"Pray of Clarity","cleric/cleansprey.jpg","Reduce 15% cooldown a toda la party");

skillSetInfo(440,1,"Prophecy of Hope","cleric/profecy1.jpg","Aumenta +4 velocidad casteo y cada Pray aumenta 10 de Faith y Aumenta +150 Holy, Holy Wrath siempre va ser critico y va hacer doble daño");
skillSetInfo(439,1,"Prophecy of Doom","cleric/profecy2.jpg","Aumenta +4 velocidad casteo y Aumenta Poder Critico Magico +250 y Aumenta, Holy Wrath siempre va ser critico y va hacer doble daño");
skillSetInfo(438,1,"Prophecy of Violence","cleric/profecy3.jpg","Aumenta +4 velocidad casteo y Chance de critico +50 y Aumenta +150 Dark, Holy Wrath siempre va ser critico y va hacer doble daño");
////////// DESTROYER ///////////////
skillSetInfo(104,1,"Anger","destroyer/anger.jpg","Aumenta tu Ataque 10% usando BigSword");
skillSetInfo(104,2,"Anger 2","destroyer/anger.jpg","Aumenta tu Ataque 30% usando BigSword");
skillSetInfo(104,3,"Anger 3","destroyer/anger.jpg","Aumenta tu Ataque 70% usando BigSword");
skillSetInfo(104,4,"Anger 4","destroyer/anger.jpg","Aumenta tu Ataque 100% usando BigSword");
skillSetInfo(106,1,"Rampage","destroyer/rampage.jpg","Incrementa +25 Ataque y +10 Critico");
skillSetInfo(106,2,"Rampage 2","destroyer/rampage.jpg","Incrementa +50 Ataque y +15 Critico");
skillSetInfo(107,1,"Destruction","destroyer/destruction.jpg","Incrementa el Ataque un 450% pero reduce la Vel Ataque 5 seg requiere BigSwords");
skillSetInfo(107,2,"Destruction 2","destroyer/destruction.jpg","Incrementa el Ataque un 850% pero reduce la Vel Ataque 5 seg requiere BigSwords");
skillSetInfo(111,1,"Activation","destroyer/activation.jpg","Incrementa +60% Ataque, +10 Critico, +25 Poder Critico.");
skillSetInfo(111,2,"Activation 2","destroyer/activation.jpg","Incrementa +120% Ataque, +15 Critico, +50 Poder Critico.");
skillSetInfo(111,3,"Activation 3","destroyer/activation.jpg","Incrementa +240% Ataque, +20 Critico, +100 Poder Critico.");
skillSetInfo(112,1,"Rage Armor","destroyer/rageArmor.jpg","Incrementa la vida (1 Ataque = 1 de Vida requiere heavy");
skillSetInfo(112,2,"Rage Armor 2","destroyer/rageArmor.jpg","Incrementa la vida (1 Ataque = 2 de Vida requiere heavy");
skillSetInfo(112,3,"Rage Armor 3","destroyer/rageArmor.jpg","Incrementa la vida (1 Ataque = 3 de Vida requiere heavy");
skillSetInfo(113,1,"Infinity Edge","destroyer/blade.jpg","Ataques basicos te dan +100 Ataque cada uno hasta 500. habilidades  consumen estas cargas. requiere bigswords");
skillSetInfo(113,2,"Infinity Edge 2","destroyer/blade.jpg","Ataques basicos te dan +100 Ataque cada uno hasta 1000. habilidades  consumen estas cargas. requiere bigswords");
skillSetInfo(114,1,"Skill Edge","destroyer/skilledge.jpg","Habilita a Death Blast sin consumir las cargas de Infinity Edge");
skillSetInfo(114,2,"Skill Edge 2","destroyer/skilledge2.jpg","Habilita a DooM Blast sin consumir las cargas de Infinity Edge");
skillSetInfo(175,1,"Inmortal","destroyer/eternalwarrior.jpg","Por 30 seg no puedes morir.");
skillSetInfo(176,1,"Swiftblade","destroyer/firenation.jpg","Tus siguientes 3 ataques basicos no tienen tiempo de espera.");
skillSetInfo(179,1,"DooM Crush","destroyer/doomcrush.jpg","Próximo ataque hace 3 veces mas daño.");
skillSetInfo(399,1,"Poder Intenso","destroyer/power.jpg","Aumenta tu ataque +25 (no escalable) por cada nivel del personaje cuando usas arma bigsword.");
skillSetInfo(405,1,"Rompe Ortos","destroyer/rompeortos.jpg","Mientras mas lento pegas mas aumenta tu Ataque.");
skillSetInfo(434,1,"Colossal Speed","destroyer/colossal.jpg","Ajusta la velocidad de Ataque a 5, sin reducir el efecto de [Rompe Ortos]. Si tienes menos de 100% de critico te aumenta a 100%.");
skillSetInfo(451,1,"Madness","destroyer/overpower.jpg"," Ignora los bonus de velocidad de ataque de items y buffs.");

////////// VAMPIRE ///////////////
skillSetInfo(82,1,"Blood Seeker","vampire/bloodseeker.jpg","Cada ataque basico te cura 50 de vida requiere");
skillSetInfo(82,2,"Blood Seeker 2","vampire/bloodseeker.jpg","Cada ataque basico te cura 100 de vida requiere fist");
skillSetInfo(82,3,"Blood Seeker 3","vampire/bloodseeker.jpg","Cada ataque basico te cura 200 de vida requiere fist");
skillSetInfo(82,4,"Blood Seeker 4","vampire/bloodseeker.jpg","Cada ataque basico te cura 300 de vida requiere fist");
skillSetInfo(82,5,"Blood Seeker 5","vampire/bloodseeker.jpg","Cada ataque basico te cura 500 de vida requiere fist");
skillSetInfo(84,1,"Black Blood","vampire/blackblood.jpg","Incrementa 50 + 25% de Ataque");
skillSetInfo(84,2,"Black Blood 2","vampire/blackblood.jpg","Incrementa 100 + 50% de Ataque");
skillSetInfo(86,1,"Magic Seal","vampire/magicseal.jpg","30% de tu Ataque Magico se convierte en Ataque");
skillSetInfo(87,1,"Mana Seal","vampire/manaseal.jpg","Tu mana total se agrega a la vida");
skillSetInfo(88,1,"Dark Pact","vampire/darkpact.jpg","+100 Vampire Aura");
skillSetInfo(89,1,"Pact with the devil","vampire/devilpact.jpg","20% chanse de despertar una aura demoniaca cuando haces ataques basicos");
skillSetInfo(146,1,"Blood Lord","vampire/bloodlord.jpg","Te conviertes en un Monstruo. los ataques basicos activan 100% auras demoniacas<br> Blood Blast se puede usar todo el tiempo.<br>Auras vampiricas dan doble efecto");
skillSetInfo(182,1,"Sangre","vampire/sangre.jpg","Acumula sangre. Cualquier habilidad que use sangre la va consumir toda sin importar cuanto requiera para usar dicha habilidad.");
skillSetInfo(183,1,"Darkness Time","vampire/darknesstime.jpg","Red Strike y Blood Blast no te hacen daño.");
skillSetInfo(382,1,"Night Stalker","vampire/stalker.jpg","Vampire Aura te da ataque pero reduce la velocidad de ataque en 5 por 1min. (solo vampire)");
skillSetInfo(404,1,"Life Force","vampire/attack.jpg","Aumenta 100 de Ataque por cada 500 de vida que tengas (no escalable)");

//DEMONIC AURAS//
skillSetInfo(90,1,"Demonic Fury","vampire/demonicFury.jpg","Incrementa la Vel de Ataque y la Vel de Casteo 2 seg.");
skillSetInfo(91,1,"Demonic Blood","vampire/demonicLife.jpg","Cada ataque basico te cura 100 de vida.");
skillSetInfo(92,1,"Demonic Protection","vampire/demonicProtect.jpg","Incrementa la Defensa +50.");
skillSetInfo(93,1,"Demonic Terror","vampire/demonicTerror.jpg","Incrementa +25 Todo Critico, +50 Todo Poder Critico.");
skillSetInfo(94,1,"Demonic Wisdom","vampire/demonicWisdom.jpg","Incrementa ataque magico 80%.");

skillSetInfo(367,1,"Shield Link","shieldlink.jpg","El daño que recibes se transfiere al TANK de la party.");
skillSetInfo(368,1,"Blood Armor","vampire/bloodarmor.jpg","Aumenta 25% de vida solo si usas armadura heavy");
skillSetInfo(376,1,"Ultimate Warrior","vampire/ultimatewarrior.jpg","Aumenta la defensa x2 pero reduce la velocidad de ataque en 5.");

////////// SHAMAN ///////////////
skillSetInfo(50,1,"Moh God (Red Shaman)","shaman/Moh.jpg","increases by 1% Magic Attack each tribute");
skillSetInfo(51,1,"Kon God (Blue Shaman)","shaman/Kon.jpg","increases by 1% Life and Mana each tribute");
skillSetInfo(52,1,"Nah God (Green Shaman)","shaman/Nah.jpg","increases by 0,5% defense and 0,5% Magic Defense each tribute");
skillSetInfo(57,1,"Magic Guru","shaman/redRobe.jpg","increases by 15% Magic Critical and 15% Magic Attack  when use light armor");
skillSetInfo(58,1,"Light Guru","shaman/light.jpg","earn 3% mana and 1 tribute for Kon each hit when use light armor");
skillSetInfo(59,1,"Dual Magic","shaman/dual.jpg","increases %10 Attack and Magic Attack when use Dual weapon");
skillSetInfo(62,1,"Guard Guru","shaman/heavy.jpg","Increases magic defense +100 and +25 defense only light armor");
skillSetInfo(63,1,"Chant of Protection","shaman/protection.jpg","Incrementa a toda la party 15% de Defensa y Defensa Magica");
skillSetInfo(64,1,"Chant of Fortitude","shaman/fortuite.jpg","Incrementa 20% de vida y mana a toda la party");
skillSetInfo(65,1,"Chant of Might","shaman/might.jpg","Incrementa a toda la party 15% de Ataque y Ataque Magico");
skillSetInfo(66,1,"Chant of Senses","shaman/critico.jpg","Incrementa +10 el critico y critico magico");
skillSetInfo(120,1,"Robe Mastery","shaman/light.jpg","Cuando haces ataques basicos habilita otra habilidad sin casteo (Solo Main Shaman)");
skillSetInfo(119,1,"Blunt Mastery","shaman/dual.jpg","Puedes usar una arma en cada mano, aumenta 30% el ataque cuando usas blunts");
skillSetInfo(119,2,"Blunt Mastery 2","shaman/dual.jpg","Puedes usar una arma en cada mano, aumenta 60% el ataque cuando usas blunts");
skillSetInfo(119,3,"Blunt Mastery 3","shaman/dual.jpg","Puedes usar una arma en cada mano, aumenta 90% el ataque cuando usas blunts");
skillSetInfo(122,1,"Stun","shaman/stun.jpg","No puedes atacar!");
skillSetInfo(124,1,"Chant of Victory","shaman/cov.jpg","Incrementa +10 Todo Critico, +15 Todo Poder Critico, +25% Todo Ataque");
skillSetInfo(140,1,"Spirit Totem","shaman/spirittotem.jpg","Aumenta +25 critico y 150 poder critico (solo shaman)");
skillSetInfo(141,1,"Puma Totem","shaman/pumatotem.jpg","Incrementa +2 Vel Ataque y +25 Ataque");
skillSetInfo(142,1,"Fire Totem","shaman/beartotem.jpg","Mezcla todos los elementos en fire y aumenta +100 fire.(solo shaman)");
skillSetInfo(143,1,"Soul Totem","shaman/soultotem.jpg","Aumenta +3 los golpes por turno.(solo shaman)");
skillSetInfo(144,1,"Ritual","shaman/ritual.jpg","Reduce Ataque Magico un 50%, convierte tu Ataque Magico en Ataque por 2 min");

skillSetInfo(370,1,"Wolf Spirit","shaman/wolfspirit.jpg","Incrementa +2 la velocidad de ataque y casteo de toda la party.");
skillSetInfo(369,1,"Spirit of Nature","shaman/spiritNature.jpg","Reduce cooldown de hablidades a un 50%, Aumenta earth 15%.");

skillSetInfo(169,1,"Free Life Drain","shaman/freedrain.jpg","Puedes usar Life Drain sin casteo.");
skillSetInfo(170,1,"Free Stun Strike","shaman/freestun.jpg","Puedes usar Stun Strike sin casteo.");
skillSetInfo(171,1,"Free Dark Spike","shaman/freespike.jpg","Puedes usar Dark Spike sin casteo.");
skillSetInfo(403,1,"Totem God","shaman/totemgod.jpg","Puedes usar todos los totems a la vez.");
skillSetInfo(407,1,"Magicus","shaman/buff.jpg","Cada aura (Chant) propia activa te aumenta 10% el Ataque, solo cuando usas armadura tipo robe.");
skillSetInfo(408,1,"Infinite Power","shaman/infinite.jpg","Obtienes el doble de bonus de tus propios buffs (Chant).");
skillSetInfo(123,1,"Orc Power","shaman/orcpower.jpg","Aumenta el ataque a todos los orcos de la party por 1min");

////////// NINJA ///////////////
skillSetInfo(26,1,"Criticolo","ninja/criticolo.jpg","Incrementa +20% de Ataque +2 Critico y +10 Poder Critico requiere light");
skillSetInfo(26,2,"Criticolo 2","ninja/criticolo.jpg","Incrementa +40% de Ataque +4 Critico y +15 Poder Critico requiere light");
skillSetInfo(26,3,"Criticolo 3","ninja/criticolo.jpg","Incrementa +80% de Ataque +6 Critico y +20 Poder Critico requiere light");
skillSetInfo(26,4,"Criticolo 4","ninja/criticolo.jpg","Incrementa +160% de Ataque +8 Critico y +25 Poder Critico requiere light");
skillSetInfo(27,1,"Assassination","ninja/asesination.jpg","10% de hacer un daño descomunal en criticos. requiere daggers");
skillSetInfo(27,2,"Assassination 2","ninja/asesination.jpg","15% de hacer un daño descomunal en criticos. requiere daggers");
skillSetInfo(27,3,"Assassination 3","ninja/asesination.jpg","20% de hacer un daño descomunal en criticos. requiere daggers");
skillSetInfo(32,1,"Shadow Blow","ninja/shadowblow.jpg","evades el proximo golpe");
skillSetInfo(33,1,"Ninja Master","ninja/ninjamaster.jpg","10% chanse de evadir cualquier ataque. requiere light");
skillSetInfo(33,2,"Ninja Master 2","ninja/ninjamaster.jpg","15% chanse de evadir cualquier ataque. requiere light");
skillSetInfo(34,1,"Magic Barrier","ninja/magicbarrier.jpg","Incrementa Defensa Magica un +250");
skillSetInfo(35,1,"Focus","ninja/focus.jpg","Incrementa Critico y Poder Critico +30");
skillSetInfo(35,2,"Focus 2","ninja/focus.jpg","Incrementa Critico y Poder Critico +60");
skillSetInfo(69,1,"Dagger Master","ninja/mastery.jpg","Incrementa el Ataque +15 y +50 de Poder Critico");
skillSetInfo(69,2,"Dagger Master 2","ninja/mastery.jpg","Incrementa el Ataque +25 y +150 de Poder Critico");
skillSetInfo(69,3,"Dagger Master 3","ninja/mastery.jpg","Incrementa el Ataque +50 y +250 de Poder Critico");
skillSetInfo(70,1,"Ninjutsu","ninja/ninjitsu.jpg","Incrementa la evasion 10%");
skillSetInfo(70,2,"Ninjutsu 2","ninja/ninjitsu.jpg","Incrementa la evasion 15%");

skillSetInfo(383,1,"Enemy Weakness","ninja/weakness.jpg","Cada habilidad conoce la debilidad del enemigo.");
skillSetInfo(384,1,"Blood Bath","ninja/blood.jpg","Cada habilidad te cura 2% de tu vida total.");
skillSetInfo(395,1,"Forgotten Mastery","ninja/fist.jpg","Puedes usar dos armas, una en cada mano.");
skillSetInfo(406,1,"Sorieketon","ninja/skill23.jpg","Cada punto de evasion te otorga 1000 de Ataque (no escalable)");

skillSetInfo(901,1,"Combo","ninja/combo.jpg","Incrementa el daño en el proximo golpe acertado");
skillSetInfo(902,1,"Combo","ninja/combo1.jpg","Incrementa el daño en el proximo golpe acertado");
skillSetInfo(903,1,"Combo","ninja/combo2.jpg","Incrementa el daño en el proximo golpe acertado");
skillSetInfo(904,1,"Combo","ninja/Scombo.jpg","Incrementa el daño en el proximo golpe acertado");
skillSetInfo(905,1,"Combo","ninja/Scombo1.jpg","Incrementa el daño en el proximo golpe acertado");
skillSetInfo(906,1,"Combo","ninja/Scombo2.jpg","Incrementa el daño en el proximo golpe acertado");

skillSetInfo(435,1,"Ultimate Focus","ninja/focusmaster.jpg","Aumenta tu poder critico en 1000.");
skillSetInfo(446,1,"Combo Mastery","ninja/comboMastery.jpg",
	"Cada combo satisfactorio aumenta +25% Ataque, +5 de Critico y +25 de Poder critico Acumulado hasta 10 veces, el efecto se pierde cuando fallas un combo. Requiere tener aprendido al menos 5 habilidades tipo Blow.");


////////// ZOMBIE ///////////////
skillSetInfo(1,1,"Undead Stance","zombie/undead.jpg","Cura +2% de Vida en cada golpe, requiere Heavy.");
skillSetInfo(1,2,"Undead Stance 2","zombie/undead.jpg","Cura +3% de Vida en cada golpe, requiere Heavy.");
skillSetInfo(1,3,"Undead Stance 3","zombie/undead.jpg","Cura +4% de Vida en cada golpe, requiere Heavy.");
skillSetInfo(2,1,"Blood Stance","zombie/bite.jpg","Incrementa +20% Ataque");
skillSetInfo(3,1,"Blade Master","zombie/blade.jpg","Incrementa +50 Ataque, +50% Ataque, +2 Critico requiere sword o blunt");
skillSetInfo(3,2,"Blade Master 2","zombie/blade.jpg","Incrementa +100 Ataque, +100% Ataque, +4 Critico requiere sword o blunt");
skillSetInfo(3,3,"Blade Master 3","zombie/blade.jpg","Incrementa +150 Ataque, +200% Ataque, +8 Critico requiere sword o blunt");
skillSetInfo(3,4,"Blade Master 4","zombie/blade.jpg","Incrementa +200 Ataque, +400% Ataque, +16 Critico requiere sword o blunt");
skillSetInfo(4,1,"Critical","zombie/critical.jpg","+ 2 Critical with Sword type weapon.");
skillSetInfo(4,2,"Critical 2","zombie/critical.jpg","+ 4 Critical with Sword type weapon.");
skillSetInfo(4,3,"Critical 3","zombie/critical.jpg","+ 6 Critical with Sword type weapon.");
skillSetInfo(5,1,"Critical Dmg","zombie/criticalpow.jpg","+ 25 Critical Damage with Sword type weapon.");
skillSetInfo(7,1,"Swing Critical","zombie/swingcrit.jpg","increases your Critical + 8");
skillSetInfo(7,2,"Swing Critical 2","zombie/swingcrit.jpg","increases your Critical + 15");
skillSetInfo(8,1,"No Mana Swing","zombie/swingmana.jpg","The ability Swing Blade does not cost mana");
skillSetInfo(9,1,"Doom Guard","zombie/shield.jpg","+200 Defensa y Defensa Magica cuando usas escudo.");
skillSetInfo(9,2,"Doom Guard 2","zombie/shield.jpg","+400 y 25% Defensa y Defensa Magica cuando usas escudo.");
skillSetInfo(10,1,"Return","zombie/espinas.jpg","Retorna 20% de ataques basicos");
skillSetInfo(10,2,"Return 2","zombie/espinas.jpg","Retorna 40% de ataques basicos");
skillSetInfo(11,1,"T-Virus Rage","zombie/tvirus.jpg","Incrementa la Vida un 50%");
skillSetInfo(12,1,"Muerte","revive.jpg","Solo esperas 90 seg cuando mueres y aumenta el elemento dark +15");
skillSetInfo(14,1,"Swing Critical","zombie/swingcrit.jpg","increases your Critical + 8");
skillSetInfo(14,2,"Swing Critical 2","zombie/swingcrit.jpg","increases your Critical + 15");
skillSetInfo(68,1,"Inmortality","zombie/inmortality.jpg","Incrementa tu defensa 1% por cada 1% de Vida perdida solo cuando usas Shield.");
skillSetInfo(68,2,"Inmortality 2","zombie/inmortality.jpg","Incrementa tu defensa 2% por cada 1% de Vida perdida solo cuando usas Shield.");
skillSetInfo(118,1,"Ultimate Defense","zombie/ud.jpg","Incrementa +10000 Toda Defensa");
skillSetInfo(118,2,"Ultimate Defense 2","zombie/ud.jpg","Incrementa +20000 Toda Defensa");

skillSetInfo(13,1,"Hate","hate.jpg","Forza a atacar un perosnaje");
skillSetInfo(177,1,"DarkLord","zombie/darkshield.jpg","Aumenta el ataque (Defensa + Defensa Magica), si tu elemento es dark aumenta tu ataque (dark*4)");
skillSetInfo(192,1,"Perseverancia","zombie/persever.jpg","Los ataques básicos acumulan daño al mismo objetivo hasta 10 veces.");
skillSetInfo(402,1,"Bluntieitor","zombie/mazing.jpg","Aumenta 1 el limite de Perseverancia por cada 1000 de vida que tengas, ganas 5 de Perseverancia por golpe cuando usas armas tipo blunt.");

skillSetInfo(410,1,"Fire Sword","zombie/firesword.jpg","Agrega tu Vida a tu Ataque cuando usas arma tipo Sword y no usas Escudo.");
skillSetInfo(444,1,"Sword Pike","zombie/swordBrick.jpg","Cada golpe no critico te da una carga que aumenta +50 tu Poder Critico, Cada critco disminuye una carga. requiere una arma tipo Sword");

skillSetInfo(447,1,"The Sith","zombie/dual.jpg","Puedes usar una arma en cada mano.");

////////// Skeleton Mage ///////////////
skillSetInfo(16,1,"Soul Capsule","skeletal/soulcapsule.jpg","Puedes capturar hasta 50 almas");
skillSetInfo(16,2,"Soul Capsule 2","skeletal/soulcapsule.jpg","Puedes capturar hasta 100 almas");
skillSetInfo(16,3,"Soul Capsule 3","skeletal/soulcapsule.jpg","Puedes capturar hasta 150 almas");
skillSetInfo(16,4,"Soul Capsule","skeletal/soulcapsule.jpg","Puedes capturar hasta 200 almas");
skillSetInfo(17,1,"Mana x Soul","skeletal/manaxsoul.jpg","Por cada alma obtienes 1.5 Mana requiere robe");
skillSetInfo(17,2,"Mana x Soul 2","skeletal/manaxsoul.jpg","Por cada alma obtienes 3 Mana requiere robe");
skillSetInfo(18,1,"Life x Soul","skeletal/vidaxsoul.jpg","Por cada alma obtienes 2 Vida requiere robe");
skillSetInfo(18,2,"Life x Soul 2","skeletal/vidaxsoul.jpg","Por cada alma obtienes 4 Vida requiere robe");
skillSetInfo(19,1,"Magic x Soul","skeletal/magicxsoul.jpg","Por cada alma obtienes 10 Ataque Magico requiere robe");
skillSetInfo(19,2,"Magic x Soul 2","skeletal/magicxsoul.jpg","Por cada alma obtienes 50 Ataque Magico requiere robe");
skillSetInfo(22,1,"Dark Inside","skeletal/witgain.jpg","Cada habilidad usada aumenta el daño al mismo objetivo (15%,25%,35%)");
skillSetInfo(181,1,"Dark Explode","skeletal/explode.jpg","Aumenta +10 Critico Magico");
skillSetInfo(95,1,"Awakening of evil","skeletal/darkMather.jpg","Cuando haces un Critico incrementa el Poder Critico Magico en un 10, 20 y 30");
skillSetInfo(95,2,"Awakening of evil 2","skeletal/darkMather.jpg","Cuando haces un Critico incrementa el Poder Critico Magico en un 20, 30 y 40");
skillSetInfo(216,1,"Robe Mastery","skeletal/robe.jpg","Incrementa velocidad de casteo +3 cuando usas armaduras robe.");

skillSetInfo(380,1,"Dark Lord","skeletal/darklord.jpg","Cada vez que te curas aumenta el poder critico x2 en el siguiente golpe.");
skillSetInfo(381,1,"Sword Push","skeletal/sword.jpg","Suma tu ataque a tu ataque magico.");
skillSetInfo(443,1,"FastCast","skeletal/fastcast.jpg","Aumenta tu Vel. de Casteo aumenta 50% pero reduce tu Defensa 20% por 5min.");
skillSetInfo(450,1,"The Darkness","skeletal/manaup.jpg","Aumenta 2 de elemento Dark por Nivel de Personaje.");

//THE EVIL
skillSetInfo(96,1,"The evil stage 1","skeletal/darkMather2.jpg","Incrementa el Poder Critico Magico un 10");
skillSetInfo(96,2,"The evil stage 2","skeletal/darkMather3.jpg","Incrementa el Poder Critico Magico un 20");
skillSetInfo(96,3,"The evil stage 3","skeletal/darkMather4.jpg","Incrementa el Poder Critico Magico un 30");
skillSetInfo(97,1,"The evil stage 1","skeletal/darkMather2.jpg","Incrementa el Poder Critico Magico un 20");
skillSetInfo(97,2,"The evil stage 2","skeletal/darkMather3.jpg","Incrementa el Poder Critico Magico un 30");
skillSetInfo(97,3,"The evil stage 3","skeletal/darkMather4.jpg","Incrementa el Poder Critico Magico un 40");
// Counts
skillSetInfo(20,1,"Soul Cannon","skeletal/soulcanon.jpg","Cuenta cuantas veces usaste Soul Cannon");
skillSetInfo(180,1,"Soul Impact","skeletal/soulImp.jpg","Cuenta cuantas veces usaste Soul Impact");


////////// Marksman ///////////////
skillSetInfo(38,1,"Dexterity","marksman/dextery.jpg","Cuando usas light y bow aumenta el ataque dependiendo del nivel");
skillSetInfo(38,2,"Dexterity 2","marksman/dextery.jpg","Cuando usas light incrementa 10% de Ataque y +100 Atauqye cuando usas bow");
skillSetInfo(38,3,"Dexterity 3","marksman/dextery.jpg","Cuando usas light incrementa 15% de Ataque y +150 Atauqye cuando usas bow");
skillSetInfo(38,4,"Dexterity 4","marksman/dextery.jpg","Cuando usas light incrementa 20% de Ataque y +200 Atauqye cuando usas bow");
skillSetInfo(39,1,"Force Critical","marksman/criticalcity.jpg","Cada 10 golpes basicos hace un super critico (afecta habilidades)");
skillSetInfo(39,2,"Force Critical 2","marksman/criticalcity.jpg","Cada 8 golpes basicos hace un super critico (afecta habilidades)");
skillSetInfo(39,3,"Force Critical 3","marksman/criticalcity.jpg","Cada 6 golpes basicos hace un super critico (afecta habilidades)");
skillSetInfo(39,4,"Force Critical 4","marksman/criticalcity.jpg","Cada 4 golpes basicos hace un super critico (afecta habilidades)");
skillSetInfo(41,1,"Hit & Run","marksman/hitrun.jpg","Evade el proximo ataque.");
skillSetInfo(42,1,"Fury Shot","marksman/furyshot.jpg","Incrementa la Vel Ataque ​​+10");
skillSetInfo(45,1,"Skillish","marksman/smart.jpg","Incrementa (Vel Ataque²)% de Ataque");
skillSetInfo(48,1,"Mana Strike","marksman/manastrike.jpg","Cada ataque basico te cura 3% de Mana");
skillSetInfo(48,2,"Mana Strike 2","marksman/manastrike.jpg","Cada ataque basico te cura 5% de Mana");
skillSetInfo(49,1,"Arrow Allow","marksman/savearrow.jpg","Acumula flechas, cada ataque basico hace (Ataque X 1.5 +100) de daño y reduce tiempo de espera en 50%.");
skillSetInfo(125,1,"Hunter Aura","marksman/hunter.jpg","Incrementa a toda la party +5 Critico y +15 Poder Critico por 20 min");
skillSetInfo(212,1,"Manija Mode","marksman/ManijaMode.jpg","Tus ataques basicos son criticos");
skillSetInfo(213,1,"Sobrevivir","marksman/sovrevivir.jpg","Al recibir un golpe fatal te deja en 1 de vida.");
skillSetInfo(218,1,"Firebat","marksman/firebat.jpg","Aumenta tu velocidad de ataque +2 y tenes 10% de hacer stun de 1s a monstruos en un ataque basico");
skillSetInfo(378,1,"Position Absolute","marksman/arrowcharge.jpg","Tu velocidad de ataque es de 6.<br>Tu daño se aumenta 300% solo con armas Bow");
skillSetInfo(379,1,"Nndeah","marksman/smart.jpg","Aumenta tu poder critico en [Tu Nivel]");
skillSetInfo(385,1,"Focus Mind","marksman/focusMind.jpg","Se activa [Focus Mind] tenes que usar el Shot que usaste hace 3 habilidades. Hace stun de 1s y daño extra.");
skillSetInfo(386,1,"Simple Life","marksman/arrowsome.jpg","Cada punto de de habilidad no usado te da +1000 de Ataque (no escalable), cuando usas arma tipo bow.");
skillSetInfo(392,1,"Combo Power","marksman/comboPow.jpg","Cada combo de Shots aumenta el poder critico en +25");
skillSetInfo(393,1,"Combo Strength","marksman/comboStr.jpg","Cada combo de Shots aumenta el ataque 10%");
skillSetInfo(394,1,"Combo Splash","marksman/comboSplash.jpg","Combos de numeros pares tienen 100% critico y +50 poder critico");
skillSetInfo(409,1,"Exquisite","marksman/ex.jpg","Aumenta el Ataque por cada item Legendario que uses.");
skillSetInfo(445,1,"IQ 300","marksman/iq300.jpg","Aumenta poder critico en 500");
