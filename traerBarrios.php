<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Barrios</title>
    <link rel="stylesheet" href="style/barrios.css">
    <link rel="shortcut icon" href="images/ieslogo.png" type="image/x-icon">
</head>
<body>
    <div>
        <img id="back" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAs0lEQVRIS+WU0Q2DMAwFjw3YhI7QjsAkrNBuxAZ0BNiEEZAlqKwohJiYjwq+ozs/27ji4q+6mM99BDXQAR9rS3NaJPABeKyCt0VyJNDwCXgCs5egGC6F7CVwge8J3OAxgSs8FGi4ZY6xt7/W6xmI4As0pXQ923DIWjICL+tahsXFtshVklrTrV1FSVJ/skuSnFNRlORIIDPTSVqgt2xZjmCTyKEzwVO3yFJk8m1ugtPC/xcsChkmGdr4XvMAAAAASUVORK5CYII="/>
        <?php echo '<h1>Barrio: ' . $_REQUEST['barrios'] . '</h1>' ?>
    </div>
    <hr>
    <table class="data_table" >
        <tr>
            <th>N°Inmueble</th>
            <th>Domicilio</th>
            <th>Barrio</th>
            <th>Propietario</th>
            <th>Teléfono del propietario</th>
            <th>Tipo de Inmueble</th>
            <th>Situación del Inmueble</th>
            <th>Importe</th>
        </tr>
        
        <?php
            include("connection.php");
            $barrioSeleccionado = $_REQUEST['barrios'];
            $inmueble = $_REQUEST['inmueble'];

            if(($barrioSeleccionado != 'Seleccione el barrio') AND ($inmueble != '')){

                $connection = mysqli_connect($servername, $username, $password, $dbname);

                if(isset($_REQUEST['venta'])) {

                    $query = "SELECT 
                                    i.inmueble,
                                    i.domicilio,
                                    b.nombre,
                                    p.nombre as 'propietario',
                                    p.telefono,
                                    i.tipo, 
                                    i.situacion, 
                                    i.importe 
                                FROM 
                                    inmuebles i
                                    INNER JOIN barrios b ON b.barrio = i.barrio
                                    INNER JOIN propietarios p ON p.propietario = i.propietario
                                WHERE
                                    b.nombre = '$barrioSeleccionado'
                                    AND i.tipo = '$inmueble'
                                    AND i.situacion = 'V'";
                    
                    $barrio = mysqli_query($connection, $query);

                    if(!$barrio) {
                        var_dump(mysqli_error($connection));
                        exit;
                    }

                    while ($row = mysqli_fetch_assoc($barrio)) {
                        echo "<tr>";
                        echo "<td>" .$row["inmueble"] ."</td>";
                        echo "<td>" . $row["domicilio"] ."</td>";
                        echo "<td>" . $row["nombre"] ."</td>";
                        echo "<td>" . $row["propietario"] ."</td>";
                        echo "<td>" . $row["telefono"] ."</td>";
                        switch ($row["tipo"]) {
                            case "C":
                                echo "<td>" ."CASA" ."</td>";
                                break;
                            case "D":
                                echo "<td>" ."DEPTO" ."</td>";
                                break;
                            case "L":
                                echo "<td>" ."LOCAL" ."</td>";
                                break;
                        }
        
                        switch($row["situacion"]){
                            case "V":
                                echo "<td>" . "VENTA" ."</td>";
                            break;                        
                        }
                        
                        echo "<td>" . $row["importe"] ."</td>";
                        echo "</tr>";
                        
                    }

                } else {

                    $query = "SELECT 
                                    i.inmueble,
                                    i.domicilio,
                                    b.nombre,
                                    p.nombre as 'propietario',
                                    p.telefono,
                                    i.tipo, 
                                    i.situacion, 
                                    i.importe 
                                FROM 
                                    inmuebles i
                                    INNER JOIN barrios b ON b.barrio = i.barrio
                                    INNER JOIN propietarios p ON p.propietario = i.propietario
                                WHERE
                                    b.nombre = '$barrioSeleccionado'
                                    AND i.tipo = '$inmueble'
                                    AND i.situacion = 'A'";

                    $barrio = mysqli_query($connection, $query);

                    if(!$barrio) {
                        var_dump(mysqli_error($connection));
                        exit;
                    }

                    while ($row = mysqli_fetch_assoc($barrio)) {
                        echo "<tr>";
                        echo "<td>" .$row["inmueble"] ."</td>";
                        echo "<td>" . $row["domicilio"] ."</td>";
                        echo "<td>" . $row["nombre"] ."</td>";
                        echo "<td>" . $row["propietario"] ."</td>";
                        echo "<td>" . $row["telefono"] ."</td>";
                        switch ($row["tipo"]) {
                            case "C":
                                echo "<td>" ."CASA" ."</td>";
                                break;
                            case "D":
                                echo "<td>" ."DEPTO" ."</td>";
                                break;
                            case "L":
                                echo "<td>" ."LOCAL" ."</td>";
                                break;
                        }
        
                        switch($row["situacion"]){

                            case "A":
                                echo "<td>" . "ALQUILER" ."</td>";
                            break;
                            
                        }
                        
                        echo "<td>" . $row["importe"] ."</td>";
                        echo "</tr>";
                    }
                    
                }
                
                mysqli_close($connection);


            } else {

                echo '<script language="javascript">';
                echo 'alert("Por favor, complete la selección de datos")';
                echo '</script>';
                
                header("Refresh: 0; url=index.php");
                exit;

            }
            
        ?>
</table >
<a class="button"href="./index.php">REGRESAR</a>

<script src="script/index.js"></script>
</body>


</html>