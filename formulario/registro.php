<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta DB</title>
    <style>
        table {
            border: solid 2px #7e7c7c;
            border-collapse: collapse;
        }
        th, h1 {
            background-color: #edf797;
        }
        td, th {
            border: solid 1px #7e7c7c;
            padding: 2px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php
// Validamos datos del servidor
$user = "root";
$pass = "";
$host = "localhost";

// Conectamos a la base de datos
$connection = mysqli_connect($host, $user, $pass);

// Verificamos la conexión a la base de datos
if (!$connection) {
    die("No se ha podido conectar con el servidor: " . mysqli_error($connection));
} else {
    echo "<b><h3>Hemos conectado al servidor</h3></b>";
}

// Indicamos el nombre de la base de datos
$datab = "dbformulario";
$db = mysqli_select_db($connection, $datab);

// Verificamos si la base de datos fue seleccionada correctamente
if (!$db) {
    die("No se ha podido encontrar la Tabla: " . mysqli_error($connection));
} else {
    echo "<h3>Tabla seleccionada:</h3>";
}

// Función para limpiar los datos de entrada
function limpiar_datos($dato) {
    global $connection;
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return mysqli_real_escape_string($connection, $dato);
}

// Manejo del formulario de edición
if (isset($_POST['editar'])) {
    $id = limpiar_datos($_POST['id']);
    $nombre = limpiar_datos($_POST["nombre"]);
    $apellido_paterno = limpiar_datos($_POST["apellido_paterno"]);
    $apellido_materno = limpiar_datos($_POST["apellido_materno"]);
    $correo = limpiar_datos($_POST["correo"]);
    $edad = limpiar_datos($_POST["edad"]);
    $sexo = limpiar_datos($_POST["sexo"]);
    $altura = limpiar_datos($_POST["altura"]);
    $peso = limpiar_datos($_POST["peso"]);

    $update_sql = "UPDATE tabla_form SET nombre='$nombre', apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno', correo='$correo', edad='$edad', sexo='$sexo', altura='$altura', peso='$peso' WHERE id='$id'";
    $resultado = mysqli_query($connection, $update_sql);

    if (!$resultado) {
        die("No se ha podido actualizar el registro: " . mysqli_error($connection));
    } else {
        echo "<h3>Registro actualizado correctamente</h3>";
    }
}

// Manejo del formulario de eliminación
if (isset($_POST['eliminar'])) {
    $id = limpiar_datos($_POST['id']);
    $delete_sql = "DELETE FROM tabla_form WHERE id='$id'";
    $resultado = mysqli_query($connection, $delete_sql);

    if (!$resultado) {
        die("No se ha podido eliminar el registro: " . mysqli_error($connection));
    } else {
        echo "<h3>Registro eliminado correctamente</h3>";
    }
}

// Manejo del formulario de inserción
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['editar']) && !isset($_POST['eliminar'])) {
    $nombre = limpiar_datos($_POST["nombre"]);
    $apellido_paterno = limpiar_datos($_POST["apellido_paterno"]);
    $apellido_materno = limpiar_datos($_POST["apellido_materno"]);
    $correo = limpiar_datos($_POST["correo"]);
    $edad = limpiar_datos($_POST["edad"]);
    $sexo = limpiar_datos($_POST["sexo"]);
    $altura = limpiar_datos($_POST["altura"]);
    $peso = limpiar_datos($_POST["peso"]);

    $instruccion_SQL = "INSERT INTO tabla_form (nombre, apellido_paterno, apellido_materno, correo, edad, sexo, altura, peso)
                        VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$correo', '$edad', '$sexo', '$altura', '$peso')";

    $resultado = mysqli_query($connection, $instruccion_SQL);

    if (!$resultado) {
        die("No se ha podido insertar el registro: " . mysqli_error($connection));
    } else {
        echo "<h3>Datos insertados correctamente</h3>";
    }
}

// Realizamos la consulta para mostrar los registros
$consulta = "SELECT * FROM tabla_form";
$result = mysqli_query($connection, $consulta);

if (!$result) {
    die("No se ha podido realizar la consulta: " . mysqli_error($connection));
}

echo "<table>";
echo "<tr>";
echo "<th><h1>ID</th></h1>";
echo "<th><h1>Nombre</th></h1>";
echo "<th><h1>Apellido Paterno</th></h1>";
echo "<th><h1>Apellido Materno</th></h1>";
echo "<th><h1>Correo</th></h1>";
echo "<th><h1>Edad</th></h1>";
echo "<th><h1>Sexo</th></h1>";
echo "<th><h1>Altura</th></h1>";
echo "<th><h1>Peso</th></h1>";
echo "<th><h1>Acciones</th></h1>";
echo "</tr>";

while ($colum = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td><h2>" . $colum['id'] . "</td></h2>";
    echo "<td><h2>" . $colum['nombre'] . "</td></h2>";
    echo "<td><h2>" . $colum['apellido_paterno'] . "</td></h2>";
    echo "<td><h2>" . $colum['apellido_materno'] . "</td></h2>";
    echo "<td><h2>" . $colum['correo'] . "</td></h2>";
    echo "<td><h2>" . $colum['edad'] . "</td></h2>";
    echo "<td><h2>" . $colum['sexo'] . "</td></h2>";
    echo "<td><h2>" . $colum['altura'] . "</td></h2>";
    echo "<td><h2>" . $colum['peso'] . "</td></h2>";
    echo "<td>
            <form method='post' style='display:inline-block;'>
                <input type='hidden' name='id' value='" . $colum['id'] . "'>
                <input type='submit' name='eliminar' value='Eliminar' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este registro?');\">
            </form>
            <form method='post' action='#' style='display:inline-block;'>
                <input type='hidden' name='id' value='" . $colum['id'] . "'>
                <input type='hidden' name='nombre' value='" . $colum['nombre'] . "'>
                <input type='hidden' name='apellido_paterno' value='" . $colum['apellido_paterno'] . "'>
                <input type='hidden' name='apellido_materno' value='" . $colum['apellido_materno'] . "'>
                <input type='hidden' name='correo' value='" . $colum['correo'] . "'>
                <input type='hidden' name='edad' value='" . $colum['edad'] . "'>
                <input type='hidden' name='sexo' value='" . $colum['sexo'] . "'>
                <input type='hidden' name='altura' value='" . $colum['altura'] . "'>
                <input type='hidden' name='peso' value='" . $colum['peso'] . "'>
                <input type='submit' name='editar' value='Editar'>
            </form>
          </td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($connection);
?>

<h2>Formulario de Registro</h2>
<form action="" method="POST">
    Nombre: <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>"><br>
    Apellido Paterno: <input type="text" name="apellido_paterno" value="<?php echo isset($_POST['apellido_paterno']) ? $_POST['apellido_paterno'] : ''; ?>"><br>
    Apellido Materno: <input type="text" name="apellido_materno" value="<?php echo isset($_POST['apellido_materno']) ? $_POST['apellido_materno'] : ''; ?>"><br>
    Correo: <input type="email" name="correo" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : ''; ?>"><br>
    Edad: <input type="number" name="edad" value="<?php echo isset($_POST['edad']) ? $_POST['edad'] : ''; ?>"><br>
    Sexo: <input type="text" name="sexo" value="<?php echo isset($_POST['sexo']) ? $_POST['sexo'] : ''; ?>"><br>
    Altura: <input type="text" name="altura" value="<?php echo isset($_POST['altura']) ? $_POST['altura'] : ''; ?>"><br>
    Peso: <input type="text" name="peso" value="<?php echo isset($_POST['peso']) ? $_POST['peso'] : ''; ?>"><br>
    <input type="submit" value="Registrar">
</form>

<a href="index.html">Volver Atrás</a>
</body>
</html>
