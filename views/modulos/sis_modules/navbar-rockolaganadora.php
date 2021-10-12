<?php

    function getActive($action){
       if ($_GET['action'] == $action){
        return "active";
        }
        
    }
   
?>

<div class="navbar-container">
    <div class="navbar-dark" data-sticky="top" style="background-color:#a20303">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand">
                <img alt="logo" src="assets/img/MOMENTOS-UNICOS-NUTRESA.png" style="width:125px"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="icon-menu h4"></i>Menú
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="?action=inicio" class="nav-link  <?php echo getActive('inicio')?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="?action=larockolaganadora" class="nav-link <?php echo getActive('larockolaganadora')?>">Mecánica</a>
                </li>
                <li class="nav-item">
                    <a href="#" data-toggle="modal" data-target="#terminosModal" class="nav-link">Términos & Condiciones</a>
                </li>
                <li class="nav-item">
                    <a href="?action=premios-rockola" class="nav-link <?php echo getActive('premios-rockola')?>">Premios</a>
                </li>
                <li class="nav-item">
                    <a href="?action=evento-rockola" class="nav-link <?php echo getActive('evento-rockola')?>">Evento</a>
                </li>
               
                </ul>

            

            </div>
            <!--end nav collapse-->
            </nav>
        </div>
    <!--end of container-->
    </div>
</div>