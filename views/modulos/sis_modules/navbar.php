<?php

    function getActive($action){
       if (isset($_GET['action']) == $action){
        return "active";
        }
        
    }
   
?>

<div class="navbar-container">
    <div class="navbar-dark" data-sticky="top" style="background-color:#024093">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand">
                <img alt="logo" src="assets/img/logo.png" style="width:100px"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="icon-menu h4"></i>Menú
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="?action=inicio" class="nav-link  <?php echo getActive('inicio');?>">Canjea tu Premio</a>
                    </li>
                    <li class="nav-item">
                        <a href="?action=mecanica" class="nav-link  <?php echo getActive('mecanica');?>">Cómo participar</a>
                    </li>
                    <li class="nav-item">
                        <a href="?action=buscarPremio" class="nav-link  <?php echo getActive('buscarPremio');?>">Tu perfil</a>
                    </li>
                    <li class="nav-item">
                        <a href="?action=productos" class="nav-link  <?php echo getActive('productos');?>">Productos Participantes</a>
                    </li>
                    <li class="nav-item">
                        <a href="?action=premios" class="nav-link  <?php echo getActive('premios');?>">Premios</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#terminosModal" class="nav-link">Términos & Condiciones</a>
                    </li>
                </ul>
            </div>
            <!--end nav collapse-->
            </nav>
        </div>
    <!--end of container-->
    </div>
</div>