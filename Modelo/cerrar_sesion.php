<?php
session_start();
unset ($SESSION['userName']);
unset ($SESSION['userId']);
unset ($SESSION['userUser']);
session_destroy();
header('Location: http://localhost/Noticias/index.html');
?>