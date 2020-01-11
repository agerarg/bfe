<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
		if(isset($_POST['nombre']))
					{
						$user = textIntoSql($_POST['nombre']);
						$mail = textIntoSql($_POST['mail']);
						$clave = textIntoSql($_POST['clave']);
						$reclave = textIntoSql($_POST['clave2']);
						$palabra=$_POST['palabra'];
						$data['ingresada']=textIntoSql($palabra);
						$data['registrada']=textIntoSql($_SESSION['captcha']);
						if(@!eregi("^[-_A-Z0-9]{0,20}$",$user,$trashed))
						{
							$data['eco'] = "El nombre tiene caracteres incorrectos!";
							$data['check']=0;
						}
						else if($data['ingresada']!=$data['registrada'] OR  strlen($data['registrada'])<2)
						{
							$data['eco'] = "El codigo es incorrecto!";
							unset($_SESSION['captcha']);
							$data['check']=0;
						}
						else if(strlen($user) <= 3 OR strlen($user) >= 25)
						{
							$data['eco'] = "El nombre tiene que tener entre 3 y 25 caracteres!";
							$data['check']=0;
						}
						else if($_POST['terms']==1)
						{
							$data['eco'] = "tenes que leer los terminos de uso!";
							$data['check']=0;
						}
						else if($clave!=$reclave)
						{
							$data['eco'] = "repeti la misma clave!";
							$data['check']=0;
						}
						else if(strlen($clave)<= 3 OR strlen($user) >= 50)
						{
							$data['eco'] = "La clave tiene que tener almenos 4 caracteres -.-";
							$data['check']=0;
						}
						else if(@!ereg("^[^@ ]+@[^@ ]+\.[^@ ]+$",$mail,$trashed))
						{
							$data['eco'] = "ese mail es cualqueira!";
							$data['check']=0;
						}
						else
						{
							$query = "SELECT count(*) as CONTA 
								  FROM cuenta
								  WHERE nombre = '".$user."'";
							$count = $db->sql_fetchrow($db->sql_query($query));
							if($count['CONTA'])
							{
								$data['eco'] = "El nombre de usuario ya esta en uso!";
								$data['check']=0;
							}
							else
							{
								$db->sql_query("UPDATE cuenta SET 
								nombre = '".$user."',
								clave = '".md5($clave)."',
								mail = '".$mail."',
								prueba = 0 WHERE idCuenta = ".$log->get("idCuenta"));
													
								$db->sql_query($query);	
								$data['check']=1;
								unset($_SESSION['ChekedCode']);
							}
						}
						$template->set_filenames(array(
						'content' => 'templates/error.html' )
						);
						if($data['check']==0)
						{
							$_SESSION['Cr_nombre'] = $user;
							$_SESSION['Cr_mail'] = $mail;
							$template->assign_var('INFO', "Error: ".$data['eco']." <br><br />
	<a href='index.php?sec=registerAccount'>Clic</a> to continue.");
						}
						else
						{
							unset($_SESSION['Cr_nombre']);
							unset($_SESSION['Cr_mail']);
							$template->assign_var('INFO', "Felicidades tu cuenta fue creada.<br><br />
	<a href='index.php'>Clic</a> para continuar.");
						}		
						
					}
					else
					{
						$template->assign_var('NOMBRE', $_SESSION['Cr_nombre']);
						$template->assign_var('MAIL', $_SESSION['Cr_mail']);
						
						if($_SESSION['ChekedCode'])
						{
							$template->assign_var('CODEDISP', "none");
							$template->assign_var('REGDISP', "");
							$template->assign_var('USEDCODE', $_SESSION['ChekedCode']);
						}
						else
						{
							$template->assign_var('CODEDISP', "");
							$template->assign_var('REGDISP', "none");
						}
						$template->set_filenames(array(
						'content' => 'templates/registro.html' )
						);
					}
				
				
?> 