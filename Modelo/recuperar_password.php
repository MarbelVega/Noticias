<?php
$para      = $_POST['email'];
$titulo    = 'Recuperacion de contraseña';
$mensaje   = 'Su contraseña es la siguiente: ';
$cabeceras = 'From: noticiasUmar@noticias' . "\r\n" .
    'Reply-To: noticiasUmar@noticias' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

 $enlace = mysqli_connect("127.0.0.1", "root", "", "noticias");
    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        exit;
    }
    $query = "select AES_DECRYPT(password,'llave') as password from usuario where email = '$para'";
    if($resultado = mysqli_query($enlace,$query)){
        if(mysqli_num_rows($resultado)>0){
            $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
            $passw = $fila['password'];
            //mysqli_query($enlace,"update usuario set estado='5'");
            mail($para, $titulo, $mensaje.$passw, $cabeceras);    
            echo "enviado";   
        }
    }
?>