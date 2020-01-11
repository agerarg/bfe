<?php 



function addItemToInv($item)
{
	global $log, $db;

	if($item['contable'])
	{
		add_item($item['idItem'],1,$log->get("idCuenta"),0);
	}
	else
	{
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta,value,atributos,extraLevel) 
			VALUES("'.$item['idItem'].'",
			"'.$log->get("idCuenta").'",
			'.$item['nivel'].',
			"'.$item['text_legend'].'",
			'.$item['extraLevel'].')');

		$query = 'SELECT max(idInventario) AS ID FROM inventario';	
		$itemsq = $db->sql_query($query);
		$maxId = $db->sql_fetchrow($itemsq);
		$maxId = $maxId['ID'];
		
		if($item['nivel']>=4)
		{
			$_SESSION['LEG']=true;
			$_SESSION['LEG_ID']=$maxId;
			$_SESSION['LEG_NAME']=$item['Nombre'];
		}

		$query = 'SELECT *
		FROM boxes_attr
		WHERE idBoxDrop = '.$item['idBoxDrop'].'';
		$query = $db->sql_query($query);
		while($dropStat = $db->sql_fetchrow($query))
		{
			$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,maxVal) 
				VALUES("'.$maxId.'",
				"'.$dropStat['attrb'].'",
				"'.$dropStat['valor'].'",
				"'.$dropStat['maxVal'].'")');
		}
	}	


}




?>