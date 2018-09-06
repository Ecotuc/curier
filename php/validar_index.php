<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Index</title>
		<link rel="stylesheet" type="text/css" href="../css/e.css">
		<link rel="icon" type="imgage/png" href="../images/tab_logo.png" sizes="32x32">
	</head>

<?php

	session_start();
	error_reporting(0);

	$usuario=$_POST['usuario'];
	$_SESSION['usuario'] = $usuario;
	$contraseña=$_POST['contraseña'];
echo "Usuario: ",$usuario, " contra: ", $contraseña;
	$f1=0;
	$f2=0;

	if(isset($_POST['submit'])){
		if(!empty($usuario)){
			$f1=1;
		}
		if(!empty($contraseña)){
			$f2=1;
		}
		if(($f1==1)&&($f2==1)){
			$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998")
				or die('Could not connect: ' . pg_last_error());

			$query = "SELECT * FROM users WHERE '$usuario'=username AND '$contraseña'=password";
			$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

			$rows = pg_num_rows($result);

			if($rows>0){
				pg_free_result($result);
				pg_close($dbconn);
				header("location:welcome.php");
			} else {
				pg_free_result($result);
				pg_close($dbconn);
				echo "<body class='fondo'>";
				echo "<h2 class='form-titulo'>Contraseña o usuario incorrecto</h2>";
    			echo "<script>
            		setTimeout(function() {
                    location.href = 'index.html';
            		}, 2000);
        			</script>";
			}

			pg_free_result($result);
			pg_close($dbconn);

		}
	}
?>

</html>
