<?php

/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////

/////////////////////////////////////////////////////////////////////////////////////

include('../system/conexion.php');

include('../system/login.php');

session_start();

$db = new sql_db;

$log = new LOGuser;

if($log->check())

{



		$id = intval($_GET['id']);

		$query = 'SELECT * FROM monster WHERE idMonster = "'.$id.'"';

		$monstersq = $db->sql_query($query);

		$monster = $db->sql_fetchrow($monstersq);



		switch($monster['hardOne'])

		{

			case 3:

				$query = 'SELECT *

						FROM item i

						WHERE tier = 0 AND (epic=1 OR forceStats=1)';

			break;

			case 2:

				$query = 'SELECT *

						FROM item i

						WHERE tier = 0 AND specialMat=1';

			break;

			case 1:

				$query = 'SELECT *

						FROM item i

			WHERE tier = 0 AND epic=0 AND grado = 7  AND droppeable=1 AND contable=0  AND specialMat=0 ';

			break;

			default:

				$query = 'SELECT *

					FROM item i

					WHERE tier = 0 AND epic=0 AND grado='.$monster['dropGrade'].' AND contable=0 AND droppeable=1  AND specialMat=0';

			break;

		}

		$data="";

		$itemsq = $db->sql_query($query);

		while($item = $db->sql_fetchrow($itemsq))

		{

			$item['lvlAstral']=$monster['dropGrade'];

			if($item['epic']==1)

				{

					$item['Ataque']=$item['Ataque']*($item['lvlAstral']*3);

					$item['AtaqueMagico']=$item['AtaqueMagico']*($item['lvlAstral']*3);

					$item['Defensa']=$item['Defensa']*$item['lvlAstral'];

					$item['DefensaMagica']=$item['DefensaMagica']*$item['lvlAstral'];

					$item['Critico']=$item['Critico']*$item['lvlAstral'];

					$item['PC']=$item['PC']*$item['lvlAstral'];

					$item['CriticoMagico']=$item['CriticoMagico']*$item['lvlAstral'];

					$item['PCMagico']=$item['PCMagico']*$item['lvlAstral'];

					$item['VidaLimit']=$item['VidaLimit']*$item['lvlAstral'];

					$item['ManaLimit']=$item['ManaLimit']*$item['lvlAstral'];

				}
				$item['Ataque']+=intval($item['Ataque']/4);
			$item['AtaqueMagico']+=intval($item['AtaqueMagico']/4);
			$item['Defensa']+=intval($item['Defensa']/4);
			$item['DefensaMagica']+=intval($item['DefensaMagica']/4);	
			$data["litem"][] = $item;

		}

		$data["error"] = "";

}

else

{

	$data['error'] = "Error: usuario no logeado";

}

 echo json_encode($data);

?> 