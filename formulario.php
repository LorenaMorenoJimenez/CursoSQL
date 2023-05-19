<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Usuarios</title>
</head>
<body>
    <?php
    // Establecer la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cursoSQL";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Función para limpiar los datos enviados por el formulario
    function limpiarDatos($datos) {
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);
        return $datos;
    }

    // Agregar usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["agregar"])) {
        $nombre = limpiarDatos($_POST["nombre"]);
        $apellido = limpiarDatos($_POST["apellido"]);
        $email = limpiarDatos($_POST["email"]);

        $sql = "INSERT INTO usuario (nombre, apellido, email) VALUES ('$nombre', '$apellido', '$email')";

        if ($conn->query($sql) === true) {
            echo "Usuario agregado correctamente.";
        } else {
            echo "Error al agregar el usuario: " . $conn->error;
        }
    }

    // Editar usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar"])) {
        $id = limpiarDatos($_POST["id"]);
        $nombre = limpiarDatos($_POST["nombre"]);
        $apellido = limpiarDatos($_POST["apellido"]);
        $email = limpiarDatos($_POST["email"]);

        $sql = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', email='$email' WHERE id='$id'";

        if ($conn->query($sql) === true) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error al actualizar el usuario: " . $conn->error;
        }
    }

    // Eliminar usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
        $id = limpiarDatos($_POST["id"]);

        $sql = "DELETE FROM usuario WHERE id='$id'";

        if ($conn->query($sql) === true) {
            echo "Usuario eliminado correctamente.";
        } else {
            echo "Error al eliminar el usuario: " . $conn->error;
        }
    }
    ?>

    <h2>Agregar Usuario</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido"><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email"><br><br>
        <input type="submit" name="agregar" value="Agregar Usuario">
    </form>

<h2>Listado de usuarios</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Acciones</th>
    </tr>

    <?php
    // Obtener los usuarios de la base de datos
    $sql = "SELECT * FROM usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            $apellido = $row["apellido"];
            $email = $row["email"];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$nombre</td>";
            echo "<td>$apellido</td>";
            echo "<td>$email</td>";
            echo "<td>
                <form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                    <input type='hidden' name='id' value='$id'>
                    <input type='hidden' name='nombre' value='$nombre'>
                    <input type='hidden' name='apellido' value='$apellido'>
                    <input type='hidden' name='email' value='$email'>
                    <input type='submit' name='editar' value='Editar'>
                    <input type='submit' name='eliminar' value='Eliminar'>
                </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No se encontraron usuarios.</td></tr>";
    }
    ?>

</table>

