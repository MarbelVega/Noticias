<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="sweetalert.css">
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="sweetalert.min.js"></script>
    </head>
    <body>
    </body>
</html>
<?php
    session_start();
    $nombre_usuario = $_POST['c_nombre'];
    $password = $_POST['c_password'];

    $enlace = mysqli_connect("127.0.0.1", "root", "", "noticias");
    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        exit;
    }
    $query = "select idUsuario,nombre,usuario,estado from usuario where usuario='$nombre_usuario' and password = AES_ENCRYPT('$password','llave')";
    if($resultado = mysqli_query($enlace,$query)){
        if(mysqli_num_rows($resultado)>0){
            $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
            $_SESSION['loggedin'] = true;
            $_SESSION['userId'] = $fila['idUsuario'];
    	    $_SESSION['userName'] = $fila['nombre'];
            $_SESSION['userUser'] = $fila['usuario'];
            $estado = $fila['estado'];
            if($estado < 3){ ?>
                  <script type="text/javascript">
       		        swal({title: "Login",text: "Bienvenido al sistema",type: "success"},function(){
		    			window.location.href="../administracion/index.php";			  	
		    		 });
                  </script>
            <?php
            }else{  ?>
                  <script type="text/javascript">
                    swal({title: "Usuario bloqueado",text: "Ha excedido el limite de intentos permitidos, por favor consulte con el administrador",type: "error"},function(){
		    			window.location.href="../index.html";			  	
		    		 });
                  </script>      
            <?php
            }
        }else{
            $result = mysqli_query($enlace,"select usuario,estado from usuario where usuario='$nombre_usuario'");
            if(mysqli_num_rows($result)>0){
                $fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $cont = $fila['estado'];
                $cont = $cont + 1;
                mysqli_query($enlace,"update usuario set estado='$cont' where usuario = '$nombre_usuario'");
            }
            ?>
            <script type="text/javascript">
               swal({title: "Erro de autenticacion",text: "verifique su usuario y password",type: "error"},function(){
		    			window.location.href="../index.html";			  	
		    		 });
            </script>
            <?php
        }
    }
?>