<?php

    function getActive($action){
       if ($_GET['action'] == $action){
        return "active";
        }
        
    }
   
?>

<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon-menu h4"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-center text-uppercase" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a href="index.php?action=dashboard" class="nav-link custom-link <?php echo getActive('dashboard')?>">Mi cuenta</a>
        </li>
        <li class="nav-item">
            <a href="index.php?action=comoparticipar" class="nav-link custom-link <?php echo getActive('comoparticipar')?>">Cómo participar</a>
        </li>
        <li class="nav-item">
            <a href="index.php?action=premios" class="nav-link custom-link <?php echo getActive('premios')?>">Premios</a>
        </li>
        
        </ul>

        <ul class="navbar-nav">
        <li class="nav-item">
            <a href="index.php?action=ranking" class="nav-link custom-link <?php echo getActive('ranking')?>">Ranking</a>
        </li>
        <li class="nav-item">
            <a href="#" data-toggle="modal" data-target="#terminosModal <?php echo getActive('terminosmodal')?>" class="nav-link custom-link">Términos & Condiciones</a>
        </li>
        <li class="nav-item">
            <a href="index.php?action=logout" class="nav-link custom-link <?php echo getActive('logout')?>">Cerrar Sesión</a>
        </li>
        </ul>

    </div>
    <!--end nav collapse-->
</nav>
