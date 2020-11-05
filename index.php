<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctico Aplicaciones Web 1: Inmobiliaria</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="shortcut icon" href="images/ieslogo.png" type="image/x-icon">
</head>
<body >
    <h1>Inmobiliaria</h1>

    <form class="busqueda" action="traerBarrios.php" method="POST">
        <div class="barrios_container">
            <h3>Barrios</h3>
            <div>
                <select name="barrios">
                    <optgroup>
                        <option>Seleccione el barrio</option>
                        <?php

                            include("connection.php");
                            $connection = mysqli_connect($servername, $username, $password, $dbname);
                            $query = "SELECT barrio, nombre FROM  barrios ORDER BY barrio";
                            $barrio = mysqli_query($connection, $query);
                            while ($option = mysqli_fetch_assoc($barrio)) {
                                echo "<option>" .$option["nombre"] ."</option>";
                            }
                            mysqli_close($connection);

                        ?>
                    </optgroup>     
                    
                </select>
                <input type="checkbox" name="venta" value="V"> Venta
            </div>
        </div>
        <div class="type_container">
            <h3>Tipo de inmueble</h3>
            <input type="radio" value="C" name="inmueble"> Casa
            <input type="radio" value="D" name="inmueble"> Departamento
            <input type="radio" value="L" name="inmueble"> Local
        </div>
        <input type="submit" value="Buscar">
    </form>
    
</body>
</html>