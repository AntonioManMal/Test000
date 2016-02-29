<?php
//Antonio Manilla Maldonado	A01098506
//Desarrollo de aplicaciones web

	//Parte del código para evitar mostrar los errores en la conexión en la base de datos
	//así como las adevertencias 
	ini_set('display_errors', 'off');
	ini_set('display_startup_errors', 'off');
	error_reporting(0);
	
	//Declaración de variables
	$usuario = $_POST[usuario];
	$contrasena = $_POST[contrasena];

	//función utilizada para establecer la conexión con el servidor, así como cargar 
	//la base de datos a utilizar
	function Conectarse()
	{
		if(!($link=mysql_connect("localhost", "root", "")))
		{
			echo "Error conectando a la base de datos";
			exit();
		}
		if(!mysql_select_db("login", $link))
		{
			echo "Error seleccionando la base de datos";
			exit();
		}
		return $link;
	}//End of Conectarse
	
	//validación de un usuario así como de su password.
	//mediante una consulta, query, se extraen todos los datos de la tabla y se guardan dentro
	//de una variable, dicha  variable es comparada, de tal forma que se consulta si ambos datos,
	//usuario y contrasena se encuentran validados dentro de la tabla
	$con = Conectarse();
	$query = "SELECT * FROM usuario WHERE user='".$usuario."' AND password = '".$contrasena."';";
	$q = mysql_query($query, $con);
	
	try
	{
		if(mysql_result($q,0))
		{
			$result = mysql_result($q,0);
			header('Location:index.html');
		}
		else
		{
			echo "Usuario o password incorrectos";
		}	
	}
	catch(Exception $error){}
	
	mysql_close($con);
	
?>