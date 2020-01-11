<?PHP
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
session_start();
switch($_GET['op'])
{
	case 'get':
		if(isset($_SESSION['ChatAuth']))
		{
			$data['error']=0;
			$data['auth']=$_SESSION['ChatAuth'];
		}
		else
			$data['error']=1;
	break;
	case 'set':
		$_SESSION['ChatAuth']=$_GET['id'];
		$data['auth']=$_SESSION['ChatAuth'];
		$data['error']=0;
	break;

}

 echo json_encode($data);
?> 