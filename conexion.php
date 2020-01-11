
<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
$mysqli;
class sql_db
{
	var $num_queries;
	function sql_db()
	{
		global $mysqli;
		$host = "localhost";
		$user = "root";
		$password = "";
		$db = "ball";		
		$mysqliSq = new mysqli($host, $user, $password,$db);

		if ($mysqliSq->connect_errno) {
		    printf("Connect failed: %s\n", $mysqliSq->connect_error);
		    exit();
		}
		$mysqli=$mysqliSq;
		
	} 	
	function sql_query($query)
	{
		global $mysqli;
	   $this->num_queries++;

	   	if($result = mysqli_query($mysqli, $query))
	   		return $result;
	   	else
	   	{
	   		printf("Error query: %s\n", $mysqli->error);
	   		echo "<br>QUERY:".$query;
	   		//die("DB ERROR! por favor avise al administrador.");
	   		die();
	   	} 
	}
	function sql_fetchrow($row)
	{
		return mysqli_fetch_array($row);
	}
	function consultas()
	{
		return $this->num_queries;
	}
	
}

function textIntoSql($text)
{
	global $mysqli;
	$text = htmlspecialchars($text);
	$text = $mysqli->real_escape_string($text);
	return $text;
}
?>