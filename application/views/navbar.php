  <style>
    .navbar .nav > li > a {
        padding: 15px 10px;
    }
  </style>

  <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper" role="navigation">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">

        <div class="navbar navbar-inverse">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?=base_url()?>">MeNut</a>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav navbar-nav" id="top-nav">
                <li <?php
                	if(isset($main)){
                		echo 'class="active"';
                	}
                ?>><a href="<?=base_url()?>">Inicio</a></li>


                <?php if($this->session->userdata("is_logged")==true){ ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dietas<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Ver dietas recomendadas</a></li>
                      <li><a href="#">Ver dietas personalizadas</a></li>
                      <li><a href="#">Ver recomendaciones nutrimentales</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Agendar consulta</a></li>
                      <li><a href="#">Ver historial de consultas</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="<?=base_url()?>#contacto">Publicaciones</a>
                  </li>
                <?php 
                    if($this->session->userdata('perfil')==2){ ?>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catálogos<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a onclick="window.location='<?=site_url("admin/catalogoPerfiles")?>'" href="<?=site_url("admin/catalogoPerfiles")?>">Administrar perfiles</a></li>
                          <li><a onclick="window.location='<?=site_url("admin/catalogoGrupos")?>'" href="<?=site_url("admin/catalogoGrupos")?>">Administrar grupos alimenticios</a></li>
                          <li><a onclick="window.location='<?=site_url("admin/catalogoAlimentos")?>'" href="<?=site_url("admin/catalogoAlimentos")?>">Administrar alimentos</a></li>
                          <li><a onclick="window.location='<?=site_url("admin/catalogoMedidas")?>'" href="<?=site_url("admin/catalogoMedidas")?>">Administrar medidas</a></li>
                          <li><a onclick="window.location='<?=site_url("admin/catalogoDietas")?>'" href="<?=site_url("admin/catalogoDietas")?>">Administrar dietas</a></li>
                          <li><a onclick="window.location='<?=site_url("admin/catalogoRecetas")?>'" href="<?=site_url("admin/catalogoRecetas")?>">Administrar recetas</a></li>
                          <li><a onclick="window.location='<?=site_url("admin/catalogoCategorias")?>'" href="<?=site_url("admin/catalogoCategorias")?>">Administrar categorias de recetas</a></li>
                          <li><a onclick="window.location='<?=site_url("admin/catalogoHorarios")?>'" href="<?=site_url("admin/catalogoHorarios")?>">Administrar horarios</a></li>
                          <li><a onclick="window.location='<?=site_url("admin/catalogoPublicaciones")?>'" href="<?=site_url("admin/catalogoPublicaciones")?>">Administrar publicaciones</a></li>
                        </ul>
                      </li>
                <?php  }
                } else { ?>
                    <li><a href="<?=base_url()?>#cursos">Cursos</a></li>
                    <li><a href="<?=base_url()?>#productos">Productos</a></li>
                    <li><a href="<?=base_url()?>#contacto">Contacto</a></li>
                <?php } ?>
              </ul>
              <?php if($this->session->userdata("is_logged")==false){ ?>
            	<form class="navbar-form pull-right form-inline " method="post" action="<?=site_url('usuario/iniciarSesion')?>">
	                <input class="span2 input-small" type="text" placeholder="Correo" name="correo">
	                <input class="span2 input-small" type="password" placeholder="Contraseña" name="contrasena">
	                <input type="hidden" name="iniciarSesion" id="iniciarSesion" value="true">

	                <button type="submit" class="btn btn-small">Iniciar Sesión</button>
	                <button type="submit" class="btn btn-info btn-small" id="btn-registro" url="<?=site_url('usuario/registro')?>">Registro</button>
	            </form>
              <?php } else { ?>
					<ul class="nav navbar-nav navbar-right">
				      <li class="dropdown">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario <b class="caret"></b></a>
				        <ul class="dropdown-menu">
				          <li><a href="#">Editar perfil</a></li>
				          <li><a href="#"></a></li>
				          <li><a href="#">Something else here</a></li>
				          <li class="divider"></li>
				          <li><a href="<?=site_url('usuario/cerrarSesion')?>">Cerrar Sesión</a></li>
				        </ul>
				      </li>
				    </ul>

              <?php	} ?>

            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->
