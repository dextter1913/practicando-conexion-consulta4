<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>practicando conexion con consultas</title>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

            <!-- Latest compiled and minified JavaScript -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
    <center><h1>practica conexion a bases de datos</h1></center>
    <div class="col-md-2"></div>
    <div class="col-md-4">    
        <form action="index.php" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" id="id" class="form-control" placeholder="Documento"><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre"><br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido"  class="form-control" placeholder="Apellido"><br>
        <label for="telefono">Telfono:</label>
        <input type="text" name="telefono" id="telefono"  class="form-control" placeholder="Telefono"><br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo"  class="form-control" placeholder="Correo"><br>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario"  class="form-control" placeholder="Usuario"><br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" id="contraseña"  class="form-control" placeholder="Contraseña"><br>
        <label for="contraseña2">Repetir:</label>
        <input type="password" name="contraseña2" id="contraseña2"  class="form-control" placeholder="Contraseña"><br><br>
        <input type="submit" value="Ingresar" class="btn btn-primary" name="btningresar">
        
    </form>
        <?php 
            if (isset($_POST['btningresar'])) {
                $_id = $_POST['id'];
                $_nombre = $_POST['nombre'];
                $_apellido = $_POST['apellido'];
                $_telefono = $_POST['telefono'];
                $_correo = $_POST['correo'];
                $_usuario = $_POST['usuario'];
                $_contraseña = $_POST['contraseña'];
                $_contraseña2 = $_POST['contraseña2'];

                if ($_contraseña === $_contraseña2) {
                    include("./clases/abrirconexion.php");

                    $conexion->query("INSERT INTO $tb1(user, pass) VALUES('$_usuario','$_contraseña')");
                    $conexion->query("INSERT INTO $tb2(id, nombre, apellido, telefono, correo, user) 
                    VALUES('$_id','$_nombre','$_apellido','$_telefono','$_correo','$_usuario')");
                    include("./clases/cerrarconexion.php");
                } else {
                   echo "Error, las contraseñas no coinciden";
                }
                

            }
        ?>
    
    </div>
    <div class="col-md-5">
            <form action="index.php" method="post">
            <label for="id">Ingrese el ID:</label>
            <input type="search" name="id" id="id" placeholder="Ingrese ID" class="form-control"><br>
            <input type="submit" value="Buscar" class="btn btn-success" name="btnbuscar"><br><br>
            </form>
            <?php 
            
            if (isset($_POST['btnbuscar'])) {
                $_id = $_POST['id'];
                include("./clases/abrirconexion.php");
                $resultados = mysqli_query($conexion, ("SELECT * FROM $tb2 WHERE id = $_id"));
                    while ($consulta = mysqli_fetch_array($resultados)) {
                        echo "
                        <table class=\"table\">
                        <tr>
                            <td><center><b>ID</b></center></td>
                            <td><center><b>Nombre</b></center></td>
                            <td><center><b>Apellido</b></center></td>
                            <td><center><b>Telefono</b></center></td>
                            <td><center><b>Correo</b></center></td>
                            <td><center><b>Usuario</b></center></td>
                        </tr>
                        <tr>
                            <td><center><b>".$consulta['id']."</b></center></td>
                            <td><center><b>".$consulta['nombre']."</b></center></td>
                            <td><center><b>".$consulta['apellido']."</b></center></td>
                            <td><center><b>".$consulta['telefono']."</b></center></td>
                            <td><center><b>".$consulta['correo']."</b></center></td>
                            <td><center><b>".$consulta['user']."</b></center></td>
                        </tr>
                    </table>
                        
                            ";
                    }


                include("./clases/cerrarconexion.php");
            }
            ?>
    
    </div>
    <div class="col-md-1"></div>
</body>
</html>