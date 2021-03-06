<!DOCTYPE html>
<html>
<head>
<title>Noticias del Puerto </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="assets/css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<!--[if lt IE 9]> ULISES GARCIA RAMOS
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<?php
session_start();
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		
		} else {
		?>
		<script>
			swal({
		    			title: "Acceso restringido!",
		    			text: "Esta pagina es exclusiva para usuarios registrados",
		    			type: "error",
		    			showCancelButton:true,
		    			confirmButtonColor: "#DD6B55",
		    			confirmButtonText: "Registrarse",
		    			cancelButtonText: "Salir",
		    			closeOnConfirm: false,
		    			closeOnCancel: false},
		    			function(isConfirm){
		    				if(isConfirm){
		    					swal({title: "Redireccionando",text: "registro de usuarios",type: "success"},function(){
		    							window.location.href = '../alta_usuario.html';		  	
		    						  });	
		    				}else{
		    					window.location.href = '../index.html';
		    				}
		    			});
		</script>
		<?php
	}
    ?>
<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="padding:35px 50px;">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4><span class="glyphicon glyphicon-lock"></span> Perfil</h4>
			</div>
			<div class="modal-body" style="padding:40px 50px;">
			<form role="form">
				<div class="form-group">
				<label for="usrname"><span class="glyphicon glyphicon-user"></span>Nombre</label>
				<input type="text" class="form-control" id="nombre" placeholder="Nombre" required>
				</div>
				<div class="form-group">
				<label for="usrname"><span class="glyphicon glyphicon-user"></span> Apellidos</label>
				<input type="text" class="form-control" id="apellidos" placeholder="Apellidos" required>
				</div>
				<div class="form-group">
				<label for="usrname"><span class="glyphicon glyphicon-user"></span> Nombre de usuario</label>
				<input type="text" class="form-control" id="usuario" placeholder="Usuario" required>
				</div>
				<div class="form-group">
				<label for="usrname"><span class="glyphicon glyphicon-user"></span>Correo electronico</label>
				<input type="text" class="form-control" id="email" placeholder="email" required>
				</div>
				<div class="form-group">
				<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
				<input type="password" class="form-control" id="password" placeholder="********" required>
				</div>
				<div class="form-group">
				<label for="psw"><span class="glyphicon glyphicon-eye-open"></span>Confirmar password</label>
				<input type="password" class="form-control" id="password2" placeholder="********" required>
				</div>
				<button type="submit" class="btn btn-success btn-block" id="enviar_datos"><span class="glyphicon glyphicon-off"></span>Aceptar</button>
			</form>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
			</div>
		</div>
		
		</div>
	</div> 
	
	<script>
		$(document).ready(function(){
      $("#myBtn").click(function(){
        $.ajax({
					data: {"idUsuario" : <?php echo "{$_SESSION['userId']}";?>,"op":'1'},
					dataType: "json",
					url: "http://localhost/Noticias/administracion/perfil.php",
					type: "POST",
					success:  function (response) {
						$("#nombre").val(response.usuario.nombre);
						$("#apellidos").val(response.usuario.apellidos);
						$("#usuario").val(response.usuario.usuario);
						$("#email").val(response.usuario.email);
						$("#password").val(response.usuario.password);
						$("#password2").val(response.usuario.password);
					}
				});
        $("#myModal").modal();
			});

      $("#enviar_datos").click(function(){
				if($("#password").val() === $("#password2").val()){
					
					var nombre = $("#nombre").val();
					var apellidos = $("#apellidos").val();
					var usuario = $("#usuario").val();
					var email = $("#email").val();
					var password = $("#password").val();
					$.ajax({
					data: {"idUsuario" : <?php echo "{$_SESSION['userId']}";?>,"op":'2',"nombre":nombre,"apellidos":apellidos,"usuario":usuario,"email":email,"password":password},
					url: "http://localhost/Noticias/administracion/perfil.php",
					type: "POST",
					success:  function (response) {
						console.log(response);
						swal({title: "Usuario",text: "Datos actualizados correctamente",type: "success"});
					},
					error: function(response){
						console.log(response);
					}
				});
				}else{
					swal({title: "Password",text: "Las contraseñas no coinciden",type: "warning"});
				}
			});

		});
	</script>






<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <div class="box_wrapper">
    <header id="header">
      <div class="header_top">
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav custom_nav">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="#">Archivo</a></li>
                <li><a href="#">Contacto</a></li>


								<li>
									<a id="myBtn" href="#">
										<i class="ace-icon fa fa-user" id="myBtn"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="../Modelo/cerrar_sesion.php">
										<i class="ace-icon fa fa-power-off"></i>
										Cerrar Sesión
									</a>
								</li>
							</ul>
              
            </div>
          </div>
        </nav>
        <div class="header_search">
          <button id="searchIcon"><i class="fa fa-search"></i></button>
          <div id="shide">
            <div id="search-hide">
              <form action="#">
                <input type="text" size="40" placeholder="Search here ...">
              </form>
              <button class="remove"><span><i class="fa fa-times"></i></span></button>
            </div>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="logo_area"><a class="logo" href="#"><b>S</b>Extras <span>Noticias internacionales</span></a></div>
        
      </div>
    </header>
    <div class="latest_newsarea"> <span>Ultimas noticias</span>
      <ul id="ticker01" class="news_sticker">
        <li><a href="#">Noticia 1</a></li>
        <li><a href="#">Noticia 2</a></li>
        <li><a href="#">Noticia 3</a></li>
        <li><a href="#">Noticia 4</a></li>
        <li><a href="#">Noticia 5</a></li>
        <li><a href="#">Noticia 6</a></li>
        <li><a href="#">Noticia 7</a></li>
        <li><a href="#">Noticia 8</a></li>
        <li><a href="#">Noticia 9</a></li>
      </ul>
    </div>

     
    <div class="thumbnail_slider_area">
      <div class="owl-carousel">
        <div class="signle_iteam"> <img src="images/umar.jpg" alt="" width:"200px" height:"399px">
          <div class="sing_commentbox slider_comntbox">
            <p><i class="fa fa-calendar"></i>06 abril de 2017</p>
            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
          <a class="slider_tittle" href="#">Universidad del mar descubre cura del cancer</a></div>
        <div class="signle_iteam"> <img src="images/umar1.jpg" alt="" width:"200px" height:"399px">
          
          <div class="sing_commentbox slider_comntbox">
            <p><i class="fa fa-calendar"></i>05 abril de 2017</p>
            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
          <a class="slider_tittle" href="#">Noticia 3... </a></div>
        <div class="signle_iteam"> <img src="images/umar3.jpg" alt="" width:"200px" height:"399px">
          <div class="sing_commentbox slider_comntbox">
            <p><i class="fa fa-calendar"></i>05 abril de 2017</p>
            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
          <a class="slider_tittle" href="#">Noticias 4... </a></div>
        <div class="signle_iteam"> <img src="images/umar4.jpg" alt="" width:"200px" height:"399px">
          <div class="sing_commentbox slider_comntbox">
            <p><i class="fa fa-calendar"></i>05 abril de 2017</p>
            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
          <a class="slider_tittle" href="#">Hayan cocodrilo nadando en el mar la vida es mas sabrosa </a></div>
        <div class="signle_iteam"> <img src="images/umar5.jpg" alt="" width:"200px" height:"399px">
          <div class="sing_commentbox slider_comntbox">
            <p><i class="fa fa-calendar"></i>05 abril de 2017</p>
            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
          <a class="slider_tittle" href="#">Aqui nomas viendo que pasa</a></div>
      </div>
    </div>
    <section id="contentbody">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
          <div class="row">
            <div class="left_bar">
              <div class="single_leftbar">
                <h2><span>Noticias recientes</span></h2>
                <div class="singleleft_inner">
                  <ul class="recentpost_nav wow fadeInDown">
                    <li><a href="#"><img src="images/internacional/internacional1.jpg" alt="" with="200px" height:"80px"></a> <a class="recent_title" href="#"> Noticias internacionales 1</a></li>
                    <li><a href="#"><img src="images/internacional/internacional2.jpg" alt=""></a> <a class="recent_title" href="#"> Noticias internacionales 2</a></li>
                    <li><a href="#"><img src="images/internacional/internacional3.jpg" alt=""></a> <a class="recent_title" href="#"> Noticias internacionales 3</a></li>
                  </ul>
                </div>
              </div>
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Publicidad</span></h2>
                <div class="singleleft_inner"> <a href="#"><img src="images/150x600.jpg" alt=""></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
          <div class="row">
            <div class="middle_bar">
              <div class="featured_sliderarea">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                  </ol>
                  <div class="carousel-inner" role="listbox">
                    <div class="item active"> <img src="images/slide/onu.jpg" alt="" width='668px' height='625'>
                      <div class="carousel-caption">
                        <h1><a href="#">En busca de la paz </a></h1>
                      </div>
                    </div>
                    <div class="item"> <img src="images/slide/siria.jpg" alt="" width='668' height='328'>
                      <div class="carousel-caption">
                        <h1><a href="#">Borbadeo en Siria, ultimas noticias</a></h1>
                      </div>
                    </div>
                    <div class="item"> <img src="images/slide/ejercito.jpg" alt="" width='668' height='328'>
                      <div class="carousel-caption">
                        <h1><a href="#"> Ejercito Mexicano le declara la guerra al narcotrafico</a></h1>
                      </div>
                    </div>
                    <div class="item"> <img src="images/slide/otan.jpg" width='668' height='328'>
                      <div class="carousel-caption">
                        <h1><a href="#"> La OTAN evalua intervencion militar en Ucrania</a></h1>
                      </div>
                    </div>
                  </div>
                  <a class="left left_slide" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> </a> <a class="right right_slide" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> </a></div>
              </div>
              <div class="single_category wow fadeInDown">
                <div class="category_title"> <a href="pages/category-archive.html">Nacional</a></div>
                <div class="single_category_inner">
                  <ul class="catg_nav">
                    <li>
                      <div class="catgimg_container"> <a class="catg1_img" href="pages/single_page.html"> <img src="images/chapo.jpg" alt=""> </a></div>
                      <a class="catg_title" href="#"> Capturan al CHAPO GUZMAN</a>
                      <div class="sing_commentbox">
                        <p><i class="fa fa-calendar"></i>5 Abril 2017</p>
                        <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                   </li>
                    <li>
                      <div class="catgimg_container"> <a class="catg1_img" href="pages/single_page.html"> <img src="images/h1n1.jpg" alt=""> </a></div>
                      <a class="catg_title" href="pages/single_page.html">H1N1, ¿la gran mentira?</a>
                      <div class="sing_commentbox">
                        <p><i class="fa fa-calendar"></i>5 Abril 2017</p>
                        <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                   </li>
                    <li>
                      <div class="catgimg_container"> <a class="catg1_img" href="pages/single_page.html"> <img src="images/cnte.jpg" alt=""> </a></div>
                      <a class="catg_title" href="pages/single_page.html"> CNTE sin clases en el estado de Oax.</a>
                      <div class="sing_commentbox">
                        <p><i class="fa fa-calendar"></i>5 Abril 2017</p>
                        <a href="pages/single_page.html"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                   </li>
                    <li>
                      <div class="catgimg_container"> <a class="catg1_img" href="#"> <img src="images/aves.jpg" alt=""> </a></div>
                      <a class="catg_title" href="#">Descubre las aves del paraiso de nuestro pais</a>
                      <div class="sing_commentbox">
                        <p><i class="fa fa-calendar"></i>5 Abril 2017</p>
                        <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                   </li>
                  </ul>
                </div>
              </div>
              <div class="single_category  wow fadeInDown">
                <div class="category_title"> <a href="pages/category-archive.html">Deportes</a></div>
                <div class="single_category_inner">
                  <ul class="catg_nav catg_nav2">
                    <li>
                      <div class="catgimg_container"> <a class="catg1_img" href="#"> <img src="images/mundial.jpg" alt=""> </a></div>
                      <a class="catg_title" href="#"> Rumbo al mundial 2018 </a>
                      <div class="sing_commentbox">
                        <p><i class="fa fa-calendar"></i>28 de noviembre</p>
                        <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                      <p class="post-summary">Todo listo para el gran evento de la FIFA</p>
                   </li>
                    <li>
                      <div class="catgimg_container"> <a class="catg1_img" href="#"> <img src="images/cristiano.jpg" alt=""> </a></div>
                      <a class="catg_title" href="#">Me gusta hacer felices a mis fans...</a>
                      <div class="sing_commentbox">
                        <p><i class="fa fa-calendar"></i>28 de septiembre</p>
                        <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                      <p class="post-summary">Todo un don JUAN</p>
                   </li>
                  </ul>
                </div>
              </div>
              <div class="single_category wow fadeInDown">
                <div class="category_title"> <a href="#">Sección aun no definida</a></div>
                <div class="single_category_inner">
                  <ul class="catg3_snav catg5_nav">
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/umarx.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Noticias </a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i>4 Abril 2017</p>
                            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                        </div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/umarx.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Noticias</a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i>4 Abril 2017</p>
                            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                        </div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/umarx.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Noticias</a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i>4 Abril 2017</p>
                            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                        </div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/umarx.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Noticias</a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i>4 Abril 2017</p>
                            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                        </div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/umarx.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title">Noticias</a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i>4 Abril 2017</p>
                            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                        </div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/umarx.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Noticias</a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i>4 Abril 2017</p>
                            <a href="#"><i class="fa fa-comments"></i>20 Comentarios</a></div>
                        </div>
                      </div>
                   </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="row">
            <div class="right_bar">
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Noticias populares</span></h2>
                <div class="singleleft_inner">
                  <ul class="catg3_snav ppost_nav wow fadeInDown">
                    <li>
                      <div class="media"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="images/noticias populares/chevrolet.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> La nueva Pick Up de Chevrolet</a></div>
                      </div>
                   </li>
                 
                    <li>
                      <div class="media"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="images/noticias populares/pena.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Peña Nieto, lanza advertencia a E.U</a></div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/noticias populares/mujer.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title">Es considerada la mujer mas hermosa del mundo</a></div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/noticias populares/siria.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Armas quimicas en Siria</a></div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/noticias populares/maduro.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title">Nicolas Maduro culpa a Spiderman de la mala educacion</a></div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/noticias populares/venezuela.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Venezuela presenta crisis financiera</a></div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/noticias populares/malvinas.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Argentina en disputa por islas malvinas</a></div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/noticias populares/putin.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title"> Vladimir Putin dice, "Ya no más"</a></div>
                      </div>
                   </li>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="images/noticias populares/messi.jpg"> </a>
                        <div class="media-body"> <a href="#" class="catg_title">¿Messi el mejor jugador del mundo?</a></div>
                      </div>
                   </li>
                  </ul>
                </div>
              </div>
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Publicidad</span></h2>
                <div class="singleleft_inner"> <a href="#"><img alt="" src="images/262x218.jpg"></a></div>
              </div>
              <div class="single_leftbar wow fadeInDown">
                <ul class="nav nav-tabs custom-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mas populares</a></li>
                  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Mas leidos</a></li>
                  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Recientes</a></li>
                </ul>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home">
                    <ul class="catg3_snav ppost_nav wow fadeInDown">
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                    </ul>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile">
                    <ul class="catg3_snav ppost_nav wow fadeInDown">
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                    </ul>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="messages">
                    <ul class="catg3_snav ppost_nav wow fadeInDown">
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                      <li>
                        <div class="media"> <a class="media-left" href="#"> <img src="images/umarx.jpg" alt=""> </a>
                          <div class="media-body"> <a class="catg_title" href="#"> Mas noticias de ...</a></div>
                        </div>
                     </li>
                     
                    </ul>
                  </div>
                </div>
              </div>
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Archivo</span></h2>
                <div class="singleleft_inner">
                  <div class="blog_archive">
                    <form action="#">
                      <select>
                        <option value="">Archivo de blog</option>
                        <option value="">Octubre(20)</option>
                      </select>
                    </form>
                  </div>
                </div>
              </div>
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Etiquetas</span></h2>
                <div class="singleleft_inner">
                  <ul class="label_nav">
                    <li><a href="#">Arte</a></li>
                    <li><a href="#">Cinema</a></li>
                    <li><a href="#">Comedia</a></li>
                    <li><a href="#">Deportes</a></li>
                    <li><a href="#">Turismo</a></li>
                    <li><a href="#">Videos</a></li>
                    <li><a href="#">Naturaleza</a></li>
                  </ul>
                </div>
              </div>
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Links</span></h2>
                <div class="singleleft_inner">
                  <ul class="link_nav">
                    <li><a href="#">Nuestro Blog</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Errores</a></li>
                    <li><a href="#">Troyanos</a></li>
                    <li><a href="#">Registrate en Facebook</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer id="footer">
      <div class="footer_top">
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="single_footer_top wow fadeInLeft">
            <h2>Seguir por correo electronico</h2>
            <div class="subscribe_area">
              <p>"Suscribete aqui para estar siempre informado, al escribir tu correo electronico se te enviará un link para suscribirte"</p>
              <form action="#">
                <div class="subscribe_mail">
                  <input class="form-control" type="email" placeholder="Email Address">
                  <i class="fa fa-envelope"></i></div>
                <input class="submit_btn" type="submit" value="Suscribir">
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="single_footer_top wow fadeInLeft">
            <h2>Noticias populares</h2>
            <ul class="catg3_snav ppost_nav">
              <li>
                <div class="media"> <a class="media-left" href="pages/single_page.html"> <img src="images/hotel.jpg" alt=""> </a>
                  <div class="media-body"> <a class="catg_title" href="#"> Se suicida lanzandose de un hotel</a></div>
                </div>
             </li>
              <li>
                <div class="media"> <a class="media-left" href="pages/single_page.html"> <img src="images/mar.jpg" alt=""> </a>
                  <div class="media-body"> <a class="catg_title" href="#"> En el mar, la vida es mas sabrosa dicen los expertos</a></div>
                </div>
             </li>
              <li>
                <div class="media"> <a class="media-left" href="#"> <img src="images/tiburon.jpg" alt=""> </a>
                  <div class="media-body"> <a class="catg_title" href="#"> Tiburon tiburon, tiburon a la vista</a></div>
                </div>
             </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="single_footer_top wow fadeInRight">
            <h2>Etiquetas</h2>
            <ul class="footer_labels">
              <li><a href="#">Comedia</a></li>
              <li><a href="#">Artes</a></li>
              <li><a href="#">Cinema</a></li>
              <li><a href="#">Naturaleza</a></li>
              <li><a href="#">Deportes</a></li>
              <li><a href="#">Turismo</a></li>
              <li><a href="#">Videos</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="single_footer_top wow fadeInRight">
            <h2>Formulario de contacto</h2>
            <form action="#" class="contact_form">
              <label>Nombre</label>
              <input class="form-control" type="text">
              <label>Email*</label>
              <input class="form-control" type="email">
              <label>Mensaje*</label>
              <textarea class="form-control" cols="30" rows="10"></textarea>
              <input class="send_btn" type="submit" value="Enviar">
            </form>
          </div>
        </div>
      </div>
      <div class="footer_bottom">
        <div class="footer_bottom_left">
          <p>Copyright &copy; 2017</p>
        </div>
        <div class="footer_bottom_right">
          <ul>
            <li><a class="tootlip" data-toggle="tooltip" data-placement="top" title="Twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="tootlip" data-toggle="tooltip" data-placement="top" title="Facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="tootlip" data-toggle="tooltip" data-placement="top" title="Googel+" href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="tootlip" data-toggle="tooltip" data-placement="top" title="Youtube" href="#"><i class="fa fa-youtube"></i></a></li>
            <li><a class="tootlip" data-toggle="tooltip" data-placement="top" title="Rss" href="#"><i class="fa fa-rss"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/jquery.li-scroller.1.0.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>