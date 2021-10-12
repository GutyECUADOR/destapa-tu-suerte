<?php

  use App\Controllers\routeController;
  $routeController = new routeController();

?>

<!DOCTYPE html>
<html lang="es">

  <head>
      <!-- Disable cache -->
      <meta http-equiv="Expires" content="0">
      <meta http-equiv="Last-Modified" content="0">
      <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
      <meta http-equiv="Pragma" content="no-cache">

      <meta charset="utf-8">
      <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
      <link rel="icon" href="assets/img/favicon.ico" type="image/gif">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="prepárate para la mega promo">
      <link href="assets/css/socicon.css" rel="stylesheet" type="text/css" media="all" />
      <link href="assets/css/fonts.css" rel="stylesheet" type="text/css" media="all" />
      <link href="assets/css/theme.css" rel="stylesheet" type="text/css" media="all" />
      <link href="assets/css/jquery.flipTimer.css" rel="stylesheet" type="text/css" media="all" />
      <link href="assets/css/custom.css?<?php echo date('Ymdhiiss')?>" rel="stylesheet" type="text/css" media="all" />
  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="assets/css/bootstrap-social.css" rel="stylesheet" type="text/css" media="all" />
      <link href="assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css" media="all" />
     
      <title><?php echo APP_NAME; ?></title>
      
  </head>

  <body>
     
    <?php
        $routeController->actionCatcherController();
    ?>
     
  </body>
</html>


