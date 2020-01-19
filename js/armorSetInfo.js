var descArmor = new Array();
function armorSetInfo(id,requiere,desc)
{	
	var armIntro=new Array();
	armIntro['req'] = requiere;
	armIntro['desc'] = desc;
	descArmor[id]=armIntro;
}
//////// NOMBRE DE COSAS //////////////
commonSay = new Array();
commonSay['atkSpeed'] = " sec Vel Ataque";
commonSay['castSpeed'] = " sec Vel Casteo";
commonSay['hp'] = " Vida";
commonSay['mp'] = " Mana";
commonSay['magicAttack'] = " Ataque Magico";
commonSay['magicPen'] = " Penetracion Magica";
commonSay['attack'] = " Ataque";
commonSay['def'] = " Defensa";
commonSay['mDef'] = " Defensa Magica";
commonSay['allDef'] = " Defensas";
commonSay['crit'] = " Critico";
commonSay['critMagico'] = " Critico Magico";
commonSay['critMagicoPow'] = " Poder Critico Magico";
commonSay['critoPow'] = " Poder Critico";
commonSay['shieldRate'] = " Chanse de Bloqueo";
commonSay['shieldDef'] = " Defensa de Bloqueo";
commonSay['VampireStance'] = " Aura Vampirica";
commonSay['manaHealStr'] = " Aura de recuperar Mana";

commonSay['baseDmg'] = " Ataque";
commonSay['defBase'] = " Defensa";
commonSay['defMBase'] = " Defensa Magica";
commonSay['baseDmgMagic'] = " Ataque Magico Base";

commonSay['bigblunt']= " (usando arma bigblunt)";
commonSay['blunt'] = " (usando arma blunt)";
commonSay['bluntorsword'] = " (usando arma blunt o sword)";
commonSay['dual'] = " (usando arma dual)";
commonSay['dagger'] = " (usando arma dagger)";
commonSay['sword'] = " (usando arma sword)";
commonSay['bow'] = " (usando arma bow)";
commonSay['bigsword'] = " (usando arma bigsword)";
commonSay['resistShock'] = " Resistencia a Stun";
commonSay['wtf1'] = " de tu Ataque Magico como Ataque";
commonSay['wtf2'] = " de tu Ataque como Ataque Magico";
commonSay['wtf3'] = " de vida";
commonSay['wtf4'] = " de tu Defensa como Ataque";
commonSay['exp']="% de experiencia";
commonSay['gold']="% de oro";
////////// SETS ///////////////
armorSetInfo(0,"ERROR!","-Error-");

armorSetInfo(70,"Corpio Helmet","+1"+commonSay['atkSpeed']+"<br>+100"+commonSay['hp']);

armorSetInfo(1,"Wooden Helmet","+4"+commonSay['baseDmg']+"<br>+1"+commonSay['atkSpeed']+"<br>+50"+commonSay['hp']);
armorSetInfo(2,"Devotion Circlet","+4"+commonSay['castSpeed']);
armorSetInfo(3,
"Mithril Helmet<br>Elven Mithril Gloves<br>Elven Mithril Boots",
"+2"+commonSay['castSpeed']+"<br>+2"+commonSay['critMagico']+"");

armorSetInfo(4,
"Helmet Of Knowledge<br>Gloves Of Knowledge<br>Boots Of Knowledge","+12"+commonSay['baseDmgMagic']+"<br>+1"+commonSay['castSpeed']);

armorSetInfo(5,
"Manticore Helmet<br>Manticore Gloves<br>Manticore Boots","+5"+commonSay['baseDmg']+"<br>+100"+commonSay['mp']+"");

armorSetInfo(6,
"Reinforced Helmet<br>Reinforced Gloves<br>Reinforced Boots","+2"+commonSay['atkSpeed']+"");

armorSetInfo(7,
"Brigandine Helmet<br>Brigandine Gloves<br>Brigandine Boots",
"+15"+commonSay['defBase']+"<br>+100"+commonSay['hp']+" (Brigandine Shield)");

armorSetInfo(8,
"Mithril Helmet<br>Mithril Heavy Gloves<br>Mithril Heavy Boots",
"+14"+commonSay['defBase']+"<br>+125"+commonSay['hp']+" (Hoplon)");

armorSetInfo(9,
"Karmian Helmet<br>Karmian Gloves<br>Karmian Shoes",
"+4"+commonSay['castSpeed']);

armorSetInfo(10,
"Demon Helmet<br>Demon Gloves<br>Demon Shoes",
"+20"+commonSay['baseDmgMagic']+"<br>+5"+commonSay['critMagico']);

armorSetInfo(11,
"Drake Helmet<br>Drake Gloves<br>Drake Boots",
"+5"+commonSay['baseDmg']+"<br>+2"+commonSay['atkSpeed']+"<br>+12"+commonSay['defMBase']+"");

armorSetInfo(12,
"Plated Leather Gloves<br>Plated Leather Boots",
"+15 "+commonSay['baseDmg']+"");

armorSetInfo(13,
"Mithril Light Helmet<br>Mithril Light Gloves<br>Mithril Light Boots",
"+1"+commonSay['atkSpeed']+"<br>+2"+commonSay['crit']+"<br>+5%"+commonSay['critoPow']+"");

armorSetInfo(14,
"Composite Helmet<br>Composite Gloves<br>Composite Boots",
"+15"+commonSay['defBase']+"<br>+50 "+commonSay['hp']+"<br>+15"+commonSay['baseDmg']+" "+commonSay['blunt']+"<br>+10%"+commonSay['defMBase']+" (Composite Shield)");

armorSetInfo(15,
"Chain Mail Helmet<br>Chain Mail Gloves<br>Chain Mail Boots",
"+20"+commonSay['defBase']+"<br>+200"+commonSay['hp']+" (Chain Shield)");

armorSetInfo(16,
"Full Plate Helmet<br>Full Plate Gloves<br>Full Plate Boots",
"+1"+commonSay['atkSpeed']+"<br>+250"+commonSay['hp']+"<br>+15"+commonSay['defBase']+" (Full Plate Shield)<br>+15"+commonSay['defMBase']+" (Full Plate Shield)");
armorSetInfo(17,
"Divine Helmet<br>Divine Gloves<br>Divine Shoes",
"+5"+commonSay['defBase']+"<br>+250"+commonSay['mp']+"<br>+4"+commonSay['castSpeed']+"");
armorSetInfo(18,
"Theca Helmet<br>Theca Gloves<br>Theca Boots",
"+1"+commonSay['atkSpeed']+"<br>+15"+commonSay['baseDmg']+"");

armorSetInfo(19,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+4"+commonSay['castSpeed']+"<br>+25"+commonSay['exp']+"<br>+10"+commonSay['baseDmgMagic']+" (Avadon Shield)");

armorSetInfo(20,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+2"+commonSay['castSpeed']+"<br>+25"+commonSay['magicAttack']+"<br>+25"+commonSay['gold']);

armorSetInfo(21,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+1"+commonSay['atkSpeed']+"<br>+10"+commonSay['critoPow']+"<br>+5"+commonSay['crit']+commonSay['dagger']+"<br>+25"+commonSay['gold']);

armorSetInfo(22,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+1"+commonSay['atkSpeed']+"<br>+250"+commonSay['mp']+"<br>+25"+commonSay['baseDmg']+commonSay['bow']+"<br>+25"+commonSay['exp']);

armorSetInfo(23,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+20"+commonSay['defBase']+"<br>+300"+commonSay['hp']+"<br>+25"+commonSay['baseDmg']+commonSay['blunt']+"<br>+25"+commonSay['exp']+"<br>+5"+commonSay['def']+" (Avadon Shield)");

armorSetInfo(24,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+1"+commonSay['atkSpeed']+"<br>+10"+commonSay['baseDmg']+"<br>+5"+commonSay['crit']+commonSay['bigsword']+"<br>+25"+commonSay['gold']);

armorSetInfo(25,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+5"+commonSay['crit']+"<br>+40"+commonSay['baseDmg']+"");

armorSetInfo(26,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+30"+commonSay['baseDmgMagic']+"<br>+3"+commonSay['castSpeed']+"");

armorSetInfo(27,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+500"+commonSay['hp']+"<br>+30"+commonSay['defBase']+"<br>"+commonSay['blunt']+"<br>+35"+commonSay['baseDmg']+"<br>+25%"+commonSay['shieldRate']+" (Doom Shield)");

armorSetInfo(28,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+10"+commonSay['baseDmgMagic']+"<br>+800"+commonSay['mp']+"<br>+3"+commonSay['castSpeed']+"<br>+5"+commonSay['critMagico']+commonSay['bigblunt']+"<br>+1"+commonSay['castSpeed']+commonSay['blunt']);
armorSetInfo(29,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+2"+commonSay['atkSpeed']+"<br>+500"+commonSay['mp']+"<br>+30"+commonSay['baseDmg']);
armorSetInfo(30,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+1"+commonSay['atkSpeed']+"<br>+8"+commonSay['crit']+"<br>+30"+commonSay['baseDmg']+"<br>+8"+commonSay['attack']+commonSay['bigsword']);

armorSetInfo(31,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+50"+commonSay['baseDmg']+"<br>+2"+commonSay['atkSpeed']+"<br>+15"+commonSay['critoPow']+commonSay['dagger']);
armorSetInfo(32,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+2"+commonSay['castSpeed']+"<br>+50"+commonSay['baseDmgMagic']+"<br>+2"+commonSay['castSpeed']+"(Dark Crystal Shield)");
armorSetInfo(33,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+50"+commonSay['defBase']+"<br>+800"+commonSay['hp']+"<br>+45"+commonSay['baseDmg']+commonSay['blunt']+"<br>+25%"+commonSay['shieldRate']+" (Dark Crystal Shield)");

armorSetInfo(34,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+40"+commonSay['baseDmg']+"<br>+500"+commonSay['mp']+"<br>+35"+commonSay['baseDmg']+commonSay['bow']);
armorSetInfo(35,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+2"+commonSay['atkSpeed']+"<br>+30"+commonSay['baseDmg']+"<br>+15"+commonSay['defBase']+"<br>+500"+commonSay['hp']);
armorSetInfo(36,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+4"+commonSay['castSpeed']+"<br>+65"+commonSay['baseDmgMagic']+"<br>+500"+commonSay['mp']+"");

armorSetInfo(37,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"+80"+commonSay['defBase']+"<br>+1000"+commonSay['hp']+"<br>+65"+commonSay['baseDmg']+commonSay['blunt']+"<br>+25%"+commonSay['shieldRate']+"(Shield Of Nightmare)");
armorSetInfo(38,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"+3"+commonSay['atkSpeed']+"<br>+20"+commonSay['critoPow']+"<br>+65"+commonSay['baseDmg']+"");
armorSetInfo(39,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"+125"+commonSay['baseDmgMagic']+"<br>+4"+commonSay['castSpeed']+"");

armorSetInfo(40,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+2"+commonSay['atkSpeed']+"<br>+20"+commonSay['defBase']+"<br>+50"+commonSay['baseDmg']+"<br>+250"+commonSay['hp']+"<br>+8"+commonSay['crit']+commonSay['bigsword']);
armorSetInfo(41,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+500"+commonSay['mp']+"<br>+70"+commonSay['baseDmg']+"<br>+30"+commonSay['baseDmg']+commonSay['bow']);
armorSetInfo(42,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+4"+commonSay['castSpeed']+"<br>+1000"+commonSay['mp']+"<br>+80"+commonSay['baseDmgMagic']+"<br>+5"+commonSay['critMagico']+"");

armorSetInfo(43,
"Imperial Helmet<br>Imperial Gloves<br>Imperial Boots",
"+1000"+commonSay['hp']+"<br>+1"+commonSay['atkSpeed']+"<br>+100"+commonSay['defBase']+"<br>+50"+commonSay['defBase']+" (Imperial Shield)<br>+100"+commonSay['defMBase']+" (Imperial Shield)<br>+100"+commonSay['baseDmg']+" (NO Imperial Shield)<br>+1"+commonSay['atkSpeed']+" (NO Imperial Shield)");

armorSetInfo(44,
"Arcana Helmet<br>Arcana Gloves<br>Arcana Boots",
"+1000"+commonSay['mp']+"<br>+4"+commonSay['castSpeed']+"<br>+150"+commonSay['baseDmgMagic']+"<br>+5"+commonSay['critMagico']);

armorSetInfo(45,
"Draconic Helmet<br>Draconic Gloves<br>Draconic Boots",
"+1000"+commonSay['mp']+"<br>+100"+commonSay['baseDmg']+"<br>+5"+commonSay['crit']+"<br>+3"+commonSay['atkSpeed']+"<br>+30"+commonSay['baseDmg']+commonSay['bow']+"<br>+15%"+commonSay['critoPow']+commonSay['dagger']+" o "+commonSay['dual']);

armorSetInfo(52,
"Casco Demonic<br>Botas Demonic<br>Guantes Demonic",
"+500"+commonSay['mp']+"<br>+4"+commonSay['castSpeed']+"<br>+150"+commonSay['baseDmgMagic']+"<br>+5"+commonSay['critMagico']+"<br>+15 dark");

armorSetInfo(53,
"Casco Fulminar<br>Botas Fulminar<br>Guantes Fulminar",
"<br>+4"+commonSay['castSpeed']+"<br>+200"+commonSay['baseDmgMagic']+"<br>+5"+commonSay['critMagico']+"<br>+50"+commonSay['baseDmgMagic']+commonSay['blunt']);

armorSetInfo(61,
"Casco Assassin<br>Botas Assassin<br>Guantes Assassin",
"+150"+commonSay['baseDmg']+"<br>+8"+commonSay['crit']+"<br>+3"+commonSay['atkSpeed']+"<br>+15%"+commonSay['critoPow']+commonSay['dagger']+" o "+commonSay['dual']);

armorSetInfo(63,
"Casco Maurulio<br>Botas Maurulio<br>Guantes Maurulio",
"+1000"+commonSay['mp']+"<br>+165"+commonSay['baseDmg']+"<br>+35"+commonSay['baseDmg']+commonSay['bow']);

armorSetInfo(57,
"Casco Destructor<br>Botas Destructor<br>Guantes Destructor",
"+1000"+commonSay['hp']+"<br>+150"+commonSay['baseDmg']+"<br>+2"+commonSay['atkSpeed']+"<br>+125"+commonSay['defBase']+"<br>+8"+commonSay['crit']+commonSay['bigsword']);

armorSetInfo(55,
"Casco Tankoso<br>Botas Tankoso<br>Guantes Tankoso",
"+2000"+commonSay['hp']+"<br>+1"+commonSay['atkSpeed']+"<br>+300"+commonSay['defBase']+"<br>+200"+commonSay['baseDmg']+commonSay['blunt']);


armorSetInfo(68,
"Casco Radamante<br>Guantes Radamante<br>Botas Radamante",
"+2000"+commonSay['hp']+"<br>+300"+commonSay['defBase']+"<br>+3"+commonSay['atkSpeed']+"<br>+200"+commonSay['attack']+"<br>+8"+commonSay['crit']+"<br>+15"+commonSay['critoPow']+"");

armorSetInfo(67,
"Casco Radamante<br>Guantes Radamante<br>Botas Radamante",
"+2000"+commonSay['mp']+"<br>+100"+commonSay['defBase']+"<br>+4"+commonSay['castSpeed']+"<br>+250"+commonSay['baseDmgMagic']+"<br>+5"+commonSay['critMagico']);

armorSetInfo(69,
"Casco Radamante<br>Guantes Radamante<br>Botas Radamante",
"+1000"+commonSay['mp']+"<br>+100"+commonSay['defBase']+"<br>+5"+commonSay['crit']+"<br>+250"+commonSay['attack']+"<br>+3"+commonSay['atkSpeed']+"<br>+15"+commonSay['critoPow']);

armorSetInfo(70,
	"Casco Solador<br>Guantes Solador<br>Botas Solador",
	"+10000"+commonSay['hp']+
	"<br>+600"+commonSay['defBase']+
	"<br>+800"+commonSay['defMBase']+
	"<br>+1"+commonSay['atkSpeed']+
	"<br>+350"+commonSay['attack']+
	"<br>+10"+commonSay['crit']+
	"<br>+30"+commonSay['critoPow']+"");
	
armorSetInfo(71,
"Casco Solador<br>Guantes Solador<br>Botas Solador",
"+10000"+commonSay['hp']+
"<br>+600"+commonSay['defBase']+
"<br>+800"+commonSay['defMBase']+
"<br>+5"+commonSay['castSpeed']+
"<br>+350"+commonSay['baseDmgMagic']+
"<br>+10"+commonSay['critMagico']);

armorSetInfo(72,
"Casco Solador<br>Guantes Solador<br>Botas Solador",
"+10000"+commonSay['hp']+
"<br>+600"+commonSay['defBase']+
"<br>+800"+commonSay['defMBase']+
"<br>+10"+commonSay['crit']+
"<br>+400"+commonSay['attack']+
"<br>+5"+commonSay['atkSpeed']+
"<br>+100"+commonSay['critoPow']);
	
armorSetInfo(73,
"Casco Corpio",
"+25"+commonSay['defBase']+
"<br>+10"+commonSay['attack']+
"<br>+1"+commonSay['atkSpeed']);

armorSetInfo(93,
	"Casco Astral<br>Guantes Astral<br>Botas Astral",
	"Aumenta el limite de resistencias 1%"+
	"<br>1 o 2 Bonus de Runa Aleatorio"+
	"<br>(Con Arma Astral) Tu Critico excedente (mas de 100%) aumenta tu Ataque"+
	"<br>+15000"+commonSay['hp']+
	"<br>+700"+commonSay['defBase']+
	"<br>+900"+commonSay['defMBase']+
	"<br>+2"+commonSay['atkSpeed']+
	"<br>+450"+commonSay['attack']+
	"<br>+20"+commonSay['crit']+
	"<br>+60"+commonSay['critoPow']+"");
	
armorSetInfo(92,
"Casco Astral<br>Guantes Astral<br>Botas Astral",
"Aumenta el limite de resistencias 1%"+
"<br>1 o 2 Bonus de Runa Aleatorio"+
"<br>(Con Arma Astral) Tu Critico Magico excedente (mas de 100%) aumenta tu Ataque Magico"+
"<br>+15000"+commonSay['hp']+
"<br>+700"+commonSay['defBase']+
"<br>+900"+commonSay['defMBase']+
"<br>+5"+commonSay['castSpeed']+
"<br>+450"+commonSay['baseDmgMagic']+
"<br>+20"+commonSay['critMagico']);

armorSetInfo(91,
"Casco Astral<br>Guantes Astral<br>Botas Astral",
"Aumenta el limite de resistencias 1%"+
"<br>(Con Arma Astral) Tu Critico excedente (mas de 100%) aumenta tu Ataque"+
"<br>1 o 2 Bonus de Runa Aleatorio"+
"<br>+15000"+commonSay['hp']+
"<br>+700"+commonSay['defBase']+
"<br>+900"+commonSay['defMBase']+
"<br>+25"+commonSay['crit']+
"<br>+450"+commonSay['attack']+
"<br>+5"+commonSay['atkSpeed']+
"<br>+150"+commonSay['critoPow']);


function enchantion(base,enchants)
{
	var baseN = parseInt(base);
	if(enchants>0)
	{
		var n= baseN + ((baseN/100)*(10*enchants));
		base = n.toFixed();
	}
	return base;//n.toFixed();
	
}
function gradoString(sd)
{
	var grade="NG";
	sd=parseInt(sd);
	switch(sd)
	{
		case 2:
			grade="D";
		break;
		case 3:
			grade="C";
		break;
		case 4:
			grade="C";
		break;
		case 5:
			grade="B";
		break;
		case 6:
			grade="B";
		break;
		case 7:
			grade="A";
		break;
		case 8:
			grade="S";
		break;
		case 9:
			grade="X";
		break;
		case 10:
			grade="Y";
		break;
		case 11:
			grade="Z";
		break;
		case 12:
			grade="Astral";
		break;
	}
	return grade;
}
function itemGrade(lvl)
{
	var grade="NG";
	if(lvl>=2)
		grade="D";
	if(lvl>=3)
		grade="C";
	if(lvl>=5)
		grade="B";
	if(lvl>=7)
		grade="A";
	if(lvl>=8)
		grade="S";
	if(lvl>=9)
		grade="X";
	if(lvl>=10)
		grade="Y";
	if(lvl>=11)
		grade="Z";	
		if(lvl>=12)
		grade="Astral";		
	return grade;
}
///////////////
saThings = new Array();
saThings["AttackDmg_C"]="+100"+commonSay['attack'];
saThings["AttackDmg_B"]="+150"+commonSay['attack']+"<br>+1%"+commonSay['crit'];
saThings["AttackDmg_A"]="+220"+commonSay['attack']+"<br>+2%"+commonSay['crit'];
saThings["AttackDmg_S"]="+300"+commonSay['attack']+"<br>+3%"+commonSay['crit'];
saThings["AttackDmg_S80"]="+300"+commonSay['attack']+"<br>+3%"+commonSay['crit'];
saThings["AttackDmg_X"]="+350"+commonSay['attack']+"<br>+5%"+commonSay['crit'];
saThings["AttackDmg_Y"]="+400"+commonSay['attack']+"<br>+5%"+commonSay['crit'];
saThings["AttackDmg_Z"]="+450"+commonSay['attack']+"<br>+5%"+commonSay['crit'];

saThings["Heal_C"]="+600"+commonSay['hp'];
saThings["Heal_B"]="+1200"+commonSay['hp']+"<br>+10"+commonSay['def']+"<br>+20"+commonSay['VampireStance'];
saThings["Heal_A"]="+1800"+commonSay['hp']+"<br>+20"+commonSay['def']+"<br>+30"+commonSay['VampireStance'];
saThings["Heal_S"]="+2500"+commonSay['hp']+"<br>+35"+commonSay['def']+"<br>+35"+commonSay['VampireStance'];
saThings["Heal_S80"]="+3000"+commonSay['hp']+"<br>+40"+commonSay['def']+"<br>+40"+commonSay['VampireStance'];
saThings["Heal_X"]="+4000"+commonSay['hp']+"<br>+50"+commonSay['def']+"<br>+50"+commonSay['VampireStance'];
saThings["Heal_Y"]="+5000"+commonSay['hp']+"<br>+60"+commonSay['def']+"<br>+60"+commonSay['VampireStance'];
saThings["Heal_Z"]="+6000"+commonSay['hp']+"<br>+70"+commonSay['def']+"<br>+70"+commonSay['VampireStance'];


saThings["Defense_C"]="+50"+commonSay['def'];
saThings["Defense_B"]="+100"+commonSay['def']+"<br>+10%"+commonSay['shieldRate']+"";
saThings["Defense_A"]="+100"+commonSay['def']+"<br>+15%"+commonSay['shieldRate']+"";
saThings["Defense_S"]="+150"+commonSay['def']+"<br>+20%"+commonSay['shieldRate']+"";
saThings["Defense_S80"]="+200"+commonSay['def']+"<br>+25%"+commonSay['shieldRate']+"";
saThings["Defense_X"]="+250"+commonSay['def']+"<br>+30%"+commonSay['shieldRate']+"";
saThings["Defense_Y"]="+300"+commonSay['def']+"<br>+35%"+commonSay['shieldRate']+"";
saThings["Defense_Z"]="+350"+commonSay['def']+"<br>+40%"+commonSay['shieldRate']+"";


saThings["Acumen_C"]="+1"+commonSay['castSpeed'];
saThings["Acumen_B"]="+2"+commonSay['castSpeed'];
saThings["Acumen_A"]="+2"+commonSay['castSpeed']+"<br>+20"+commonSay['magicAttack'];
saThings["Acumen_S"]="+2"+commonSay['castSpeed']+"<br>+50"+commonSay['magicAttack'];
saThings["Acumen_S80"]="+2"+commonSay['castSpeed']+"<br>+75"+commonSay['magicAttack'];
saThings["Acumen_X"]="+2"+commonSay['castSpeed']+"<br>+150"+commonSay['magicAttack'];
saThings["Acumen_Y"]="+2"+commonSay['castSpeed']+"<br>+200"+commonSay['magicAttack'];
saThings["Acumen_Z"]="+2"+commonSay['castSpeed']+"<br>+250"+commonSay['magicAttack'];

saThings["Empower_C"]="+70"+commonSay['magicAttack'];
saThings["Empower_B"]="+100"+commonSay['magicAttack']+"<br>+1%"+commonSay['critMagico'];
saThings["Empower_A"]="+150"+commonSay['magicAttack']+"<br>+2%"+commonSay['critMagico'];
saThings["Empower_S"]="+200"+commonSay['magicAttack']+"<br>+3%"+commonSay['critMagico'];
saThings["Empower_S80"]="+250"+commonSay['magicAttack']+"<br>+4%"+commonSay['critMagico'];
saThings["Empower_X"]="+300"+commonSay['magicAttack']+"<br>+5%"+commonSay['critMagico'];
saThings["Empower_Y"]="+400"+commonSay['magicAttack']+"<br>+5%"+commonSay['critMagico'];
saThings["Empower_Z"]="+500"+commonSay['magicAttack']+"<br>+5%"+commonSay['critMagico'];

saThings["WildMagic_C"]="+5%"+commonSay['critMagico'];
saThings["WildMagic_B"]="+8%"+commonSay['critMagico'];
saThings["WildMagic_A"]="+10%"+commonSay['critMagico'];
saThings["WildMagic_S"]="+13%"+commonSay['critMagico'];
saThings["WildMagic_S80"]="+15%"+commonSay['critMagico'];
saThings["WildMagic_X"]="+16%"+commonSay['critMagico'];
saThings["WildMagic_Y"]="+17%"+commonSay['critMagico'];
saThings["WildMagic_Z"]="+18%"+commonSay['critMagico'];

saThings["Haste_C"]="+2"+commonSay['atkSpeed'];
saThings["Haste_B"]="+3"+commonSay['atkSpeed'];
saThings["Haste_A"]="+4"+commonSay['atkSpeed'];
saThings["Haste_S"]="+5"+commonSay['atkSpeed'];
saThings["Haste_S80"]="+5"+commonSay['atkSpeed'];
saThings["Haste_X"]="+5"+commonSay['atkSpeed'];
saThings["Haste_Y"]="+5"+commonSay['atkSpeed'];
saThings["Haste_Z"]="+5"+commonSay['atkSpeed'];

saThings["Focus_C"]="+5%"+commonSay['crit'];
saThings["Focus_B"]="+8%"+commonSay['crit'];
saThings["Focus_A"]="+10%"+commonSay['crit'];
saThings["Focus_S"]="+13%"+commonSay['crit']+"<br>+70"+commonSay['attack'];
saThings["Focus_S80"]="+15%"+commonSay['crit']+"<br>+80"+commonSay['attack'];
saThings["Focus_X"]="+15%"+commonSay['crit']+"<br>+100"+commonSay['attack'];
saThings["Focus_Y"]="+15%"+commonSay['crit']+"<br>+200"+commonSay['attack'];
saThings["Focus_Z"]="+15%"+commonSay['crit']+"<br>+300"+commonSay['attack'];

saThings["Vampire_C"]="+50"+commonSay['VampireStance'];
saThings["Vampire_B"]="+80"+commonSay['VampireStance'];
saThings["Vampire_A"]="+120"+commonSay['VampireStance'];
saThings["Vampire_S"]="+160"+commonSay['VampireStance'];
saThings["Vampire_S80"]="+180"+commonSay['VampireStance'];
saThings["Vampire_X"]="+200"+commonSay['VampireStance'];
saThings["Vampire_Y"]="+250"+commonSay['VampireStance'];
saThings["Vampire_Z"]="+300"+commonSay['VampireStance'];


saThings["Cost_C"]="-30% mp cost on skills";
saThings["Cost_B"]="-40% mp cost on skills";
saThings["Cost_A"]="-50% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_S"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_S80"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_X"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_Y"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_X"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];

saThings["Destruction_C"]="+25%"+commonSay['critoPow'];
saThings["Destruction_B"]="+30%"+commonSay['critoPow'];
saThings["Destruction_A"]="+35%"+commonSay['critoPow'];
saThings["Destruction_S"]="+40%"+commonSay['critoPow'];
saThings["Destruction_S80"]="+50%"+commonSay['critoPow'];
saThings["Destruction_X"]="+60%"+commonSay['critoPow'];
saThings["Destruction_Y"]="+70%"+commonSay['critoPow'];
saThings["Destruction_Z"]="+80%"+commonSay['critoPow'];

saThings["CheapShot_C"]="Basic attack has no mp cost on bows";
saThings["CheapShot_B"]="Basic attack has no mp cost on bows<br>+20% Doble Shot Damage";
saThings["CheapShot_A"]="Basic attack has no mp cost on bows<br>+30% Doble Shot Damage";
saThings["CheapShot_S"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";
saThings["CheapShot_S80"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";
saThings["CheapShot_X"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";
saThings["CheapShot_Y"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";
saThings["CheapShot_Z"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";

function saText(sa,grade)
{
	var texto="";
	texto=saThings[sa+"_"+grade];
	if(!texto)
		texto="Sa info: no found";
	return texto;
}
function makeDesc(cosasLocas,extra)
{
	var desc="";

	
	if(cosasLocas['masterWork']==1)
	{
		desc+= "<div class=ITEMMASTERWORK>Obra Maestra</div>";	
	}	

	if(cosasLocas['tipo']=="card")
	{
		desc+= '<div class="deckTitle blackborder">'+cosasLocas['cantidad']+'/'+cosasLocas['cantReq']+'</div><div><img width="100%" src="images/cards/'+cosasLocas['idItem']+'.png"></div>';	
	}
	else
	{
	if(extra == "<br>" && cosasLocas['contable']=="0" && cosasLocas['tipo']!="pot")
	{
		if(cosasLocas['value']==0)
			 desc+= "<div class=ITEMCOMUN>Item Comun</div>";	 
		if(cosasLocas['value']==1)
			 desc+= "<div class=ITEMMAGIC>Item Magico</div>";	 
		if(cosasLocas['value']==2)
			 desc+= "<div class=ITEMRARO>Item Raro</div>";
		if(cosasLocas['value']==3)
			 desc+= "<div class=ITEMEPIC>Item Epico</div>";
		if(cosasLocas['value']==4)
			 desc+= "<div class=ITEMLEG>Item Legendario</div>";	 	 
	}
	if(cosasLocas['tipo']==="runa")
	{
		desc+= "<div class=ITEMMONEDA>Runa</div>";	
		 desc+= "<div class=SA>Al equipar en runa:<br>"+runaText(cosasLocas['idItem'],cosasLocas['extraLevel'])+"</div>";
	}	
	if(cosasLocas['corrupted']==="1")
	   desc+= "<div class=ITEMCORRUPTED>Corrupto!</div>";	 
	 if(cosasLocas['tipo']==="currency")
	 {
		desc+= "<div class=ITEMMONEDA>Moneda</div>";	 
	 switch(parseInt(cosasLocas['idItem']))
		{
			case 614://chaos 
				desc+= "<div class=SA>Al usarlo recrea el item manteniendo la misma rareza</div>";
			break;
			case 616://Exodimo
				desc+= "<div class=SA>Al usarlo agrega un atributo aleatorio solo una vez</div>";
			break;
			case 617: //Alquimist
				desc+= "<div class=SA>A un item comun lo transforma en Raro, Epico o Legendario</div>";
			break;
			case 618: //Corruption
				desc+= "<div class=SA>Corrompe un item, puede obtener el doble de atributos</div>";
			break;
			case 615: //Upulus
				desc+= "<div class=SA>Al usar aumenta un punto de habilidad de forma permanente.</div>";
			break;
			case 613: //ReRoll
				desc+= "<div class=SA>Requerido para hacer reroll a un item.</div>";
			break;
		}
	 }	 
	
	if(cosasLocas['tipo']==="stone")
	{
		desc+= "<div class=ITEMMONEDA>Stone</div>";	
		desc+= "<div class=SA>Al usar tiene chance de aumentar +10 de "+cosasLocas['textoLoco']+" a tu arma.</div>";
	}
	if(cosasLocas['Ataque']>0)
		 desc+= "+"+enchantion(cosasLocas['Ataque'],cosasLocas['enchant'])+commonSay['attack']+extra;
	if(cosasLocas['AtaqueMagico']>0)
		 desc+= "+"+enchantion(cosasLocas['AtaqueMagico'],cosasLocas['enchant'])+commonSay['magicAttack']+extra;
		 
	if(cosasLocas['Defensa']>0)
		 desc+= "+"+enchantion(cosasLocas['Defensa'],cosasLocas['enchant'])+commonSay['def']+extra;	
		 
	if(cosasLocas['DefensaMagica']>0)
		 desc+= "+"+enchantion(cosasLocas['DefensaMagica'],cosasLocas['enchant'])+commonSay['mDef']+extra; 
	if(cosasLocas['shieldDef']>0)
		 desc+= "+"+enchantion(cosasLocas['shieldDef'],cosasLocas['enchant'])+commonSay['shieldDef']+extra;
	if(cosasLocas['VidaLimit']>0)
		 desc+= "+"+cosasLocas['VidaLimit']+commonSay['hp']+extra;
	if(cosasLocas['ManaLimit']>0)
		 desc+= "+"+cosasLocas['ManaLimit']+commonSay['mp']+extra;	 
	if(cosasLocas['Critico']>0)
		 desc+= "+"+cosasLocas['Critico']+commonSay['crit']+extra;	
	if(cosasLocas['PC']>0)
		 desc+= "+"+cosasLocas['PC']+commonSay['critoPow']+extra;	
	if(cosasLocas['CriticoMagico']>0)
		 desc+= "+"+cosasLocas['CriticoMagico']+commonSay['critMagico'];	
	if(cosasLocas['PCMagico']>0)
		 desc+= "+"+cosasLocas['PCMagico']+commonSay['critMagicoPow']+extra;	
	if(cosasLocas['tipo']=="buff" || cosasLocas['tipo']=="pot")
		desc+="<div class=epicItm>"+cosasLocas['textoLoco']+"</div>";	
	if(cosasLocas['conNombre']==1 && extra == "<br>")
		 desc+= "<div class=WNAME>Nombre: "+cosasLocas['nameWeapon']+"</div>";
	if(cosasLocas['atributos'] && extra == "<br>" && cosasLocas['tipo']!="crystal" && cosasLocas['tipo']!="egg" && cosasLocas['tipo']!="pot")
		desc+="Attr:<div class=legdesc>"+cosasLocas['atributos']+"</div>";
if(cosasLocas['grado']==12)
{
		if(cosasLocas['bonusRuna1']>0)
		 desc+= "<div class=legdesc>Bonus: "+runaText(cosasLocas['bonusRuna1'],10)+"</div>";
		if(cosasLocas['bonusRuna2']>0)
		 desc+= "<div class=legdesc>Bonus: "+runaText(cosasLocas['bonusRuna2'],10)+"</div>";
		if(cosasLocas['bonusRuna3']>0)
		 desc+= "<div class=legdesc>Bonus: "+runaText(cosasLocas['bonusRuna3'],10)+"</div>";
}
	if(cosasLocas['grado']>2 && extra == "<br>" && cosasLocas['contable']==0 && cosasLocas['tipo']!="crystal" && cosasLocas['tipo']!="egg")
	{
		var craft=0;
		switch(parseInt(cosasLocas['value']))
		{
			case 4:
				if(cosasLocas['tipo']=="W")
					craft=25;
				else
					craft=15;
			break;
			case 3:
				if(cosasLocas['tipo']=="W")
					craft=15;
				else
					craft=8;
			break;
			case 2:
				if(cosasLocas['tipo']=="W")
					craft=8;
				else
					craft=3;
			break;
			default:
				if(cosasLocas['tipo']=="W")
					craft=3;
				else
					craft=1;
			break;
		}
		desc+="<div class=romperItem>Romper te da "+craft+" Craft  "+gradoString(cosasLocas['grado'])+"</div>";
		if(cosasLocas['ReRoll'])
		desc+= " <div class=reRollItem>ReRolls: "+cosasLocas['ReRoll']+" </div>";
		
	}
	
	if(cosasLocas['tipo']==="runa" || cosasLocas['tipo']==="stone")
	{
		cosasLocas['grado']=cosasLocas['extraLevel'];
		cosasLocas['Nivel']=cosasLocas['extraLevel'];
	}
	desc+= "<div class=requiere>";
				desc+= "Tipo: "+cosasLocas['tipo']+"";
				if(cosasLocas['subtipo'])
					desc+= "("+cosasLocas['subtipo']+")"+extra;
				if(cosasLocas['epic']==1)
					desc+= " Nivel: "+cosasLocas['Nivel']+" "+extra;
				else
					desc+= " Grado: "+itemGrade(cosasLocas['grado'])+" Nivel: "+cosasLocas['Nivel']+" "+extra;
				if(cosasLocas['ClaseReq']>0)
					 desc+= "Clase: "+cosasLocas['txtClaseReq']+" "+extra;	 
				if(cosasLocas['tipo']=="W")
				{
					desc+= " Manos: "+cosasLocas['hand']+" "+extra;

					var limitElem=(cosasLocas['grado']*40);
					if(cosasLocas['hand']==1)
						limitElem = parseInt(limitElem/2);
					if(cosasLocas['grado']>=2)
						desc+= " Limite de Elemento: "+limitElem+" "+extra;
				}
	}
		return desc;			 
}
