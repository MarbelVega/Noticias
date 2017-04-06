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
$nombreU = $_POST['c_nombre'];
$apeU = $_POST['c_apellido'];
$usuarioU = $_POST['c_usuario'];
$emailU = $_POST['c_email'];
$passwU = $_POST['c_password'];

$enlace = mysqli_connect("127.0.0.1", "root", "", "noticias");
if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    exit;
}
mysqli_query($enlace, "insert into usuario(nombre,apellidos,usuario,email,password,estado,rol) values('$nombreU',
                        '$apeU','$usuarioU','$emailU',AES_ENCRYPT('$passwU','llave'),'0','cliente')");
                        ?>
                        <script type="text/javascript">
       		        swal({title: "Registro",text: "Usuario registrado",type: "success"},function(){
		    			window.location.href="../index.html";			  	
		    		 });
                  </script>
                        <?php
                    
?>