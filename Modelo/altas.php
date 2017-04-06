<?php
$nombreU = $_POST['nombre'];
$apeU = $_POST['apellidos'];
$usuarioU = $_POST['usuario'];
$emailU = $_POST['email'];
$passwU = $_POST['password'];
$operacion = $_POST['op'];

$enlace = mysqli_connect("127.0.0.1", "root", "", "noticias");
if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    exit;
}

    if($operacion == "1"){
            mysqli_query($enlace, "insert into usuario(nombre,apellidos,usuario,email,password,estado,rol) values('$nombreU',
                        '$apeU','$usuarioU','$emailU',AES_ENCRYPT('$passwU','llave'),'0','admin')");
    
        }elseif($operacion == "2"){
           mysqli_query($enlace, "insert into usuario(nombre,apellidos,usuario,email,password,estado,rol) values('$nombreU',
                        '$apeU','$usuarioU','$emailU',AES_ENCRYPT('$passwU','llave'),'0','cliente')");
        }
?>