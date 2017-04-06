<?php
$idUser = $_POST['idUsuario'];
$operacion = $_POST['op'];

 $enlace = mysqli_connect("127.0.0.1", "root", "", "noticias");
    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        exit;
    }
        if($operacion == "1"){
            $query = "select nombre,apellidos,usuario,AES_DECRYPT(password,'llave') as password,email from usuario where idUsuario='$idUser'";
            if($resultado = mysqli_query($enlace,$query)){
                if(mysqli_num_rows($resultado)>0){
                        $usuario = "";
                    if ($fila = mysqli_fetch_assoc($resultado)) {
                        $usuario .= '{"nombre":"'.$fila["nombre"].'",';
                        $usuario .= '"apellidos":"'.$fila["apellidos"].'",';
                        $usuario .= '"usuario":"'.$fila["usuario"].'",';
                        $usuario .= '"password":"'.$fila["password"].'",';
                        $usuario .= '"email":"'.$fila["email"].'"}';     
                    }
                    $usuario = '{"usuario":'.$usuario.'}';
                    echo $usuario;
                }
            }else{
                echo "Error en la consulta";
            }
            
        }elseif($operacion == "2"){
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $query = "update usuario set nombre = '$nombre',apellidos='$apellidos',usuario='$usuario',password=AES_ENCRYPT('$password','llave'),email='$email' where idUsuario='$idUser'";
            mysqli_query($enlace,$query);
        }


?>