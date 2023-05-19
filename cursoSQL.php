<!doctype html>
<htm1>
<head>
<meta charset="utf-8">
<title>Formulario de Registro SCIII</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body> 
<div class="group"> 
<form method="POST" action="">
<h2><em>Formulario de Registro</em></h2>
<label for="nombre">Nombre <span><em>(requerido)</em></span></label>
<input type="text" name="nombre" class="form-input" required/>

<label for="apellido">Apellido<span><em>(requerido)</em></span></label>

<input type="text" name="apellido" class="form-input" required/>

<label for="email">Email <span><em>(requerido)</em></span></label>
 <input type="email" name="email" class="form-input" /> 
 <input class="form-btn" name="submit" type="submit" value="Suscribirse" /> 
</form>

<?php 

if($_POST){
$nombre = $_POST ['nombre'];
$apellido = $_POST[ 'apellido'];
$email = $_POST [ 'email'];

//Conexión con PDO

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "cursosql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
$conn = new mysqli ($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die ("Connection failed: "  . $conn->connect_error);
}

$sql="INSERT INTO usuario (nombre,apellido, email)
VALUES ('$nombre', '$apellido', '$email')";
if ($conn->query($sql)=== TRUE){
echo "New record create successfuly";
}else{
	echo "Error: ".$sql. "<br>".$conn->error;
}
$conn->close();

}

?>

</from>
</div>
</body>
</html>