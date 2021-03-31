<?php
  function mostrar_nombre_usuario()
  {
    global $clienteId, $servidor, $puerto, $usuario, $pass, $basedatos;
    $bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
    if($bd->conectado)
    {
      $sql = "select p.Nombres from segusuario u inner join perpersona p on u.PersonaId=p.Id and p.ClienteId=".$clienteId." where Login='".$_SESSION["login"]."';";
      $resultado=json_decode($bd->ejecutarConsultaJson($sql));
      echo $resultado[0]->Nombres;
    }
  }
?>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <br>
    <div class="w3-col s4">
      <img src="imagenes/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Bienvenido, <strong><?php mostrar_nombre_usuario(); ?></strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="icon-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="icon-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>MENU</h5>
  </div>
  <div class="w3-bar-block">
    <!--<a href="#" class="w3-bar-item w3-button w3-padding" onclick="w3_close()" title="close menu"></a>-->
    <a href="usuario.php" class="w3-bar-item w3-button w3-padding <?php if(isset($u)) echo "w3-blue"; ?>"><i class="icon-user"></i>&nbsp;Usuario</a>
    <!-- <a href="hipodromo.php" class="w3-bar-item w3-button w3-padding <?php if(isset($h)) echo "w3-blue"; ?>">Hip&oacute;dromo</a> -->
    <!-- <a href="tabla.php" class="w3-bar-item w3-button w3-padding <?php if(isset($t)) echo "w3-blue"; ?>">Tablas</a> -->
    <!--<a href="#" class="w3-bar-item w3-button w3-padding">Agregar&nbsp;Tablas</a>-->
    <!--<a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Views</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Traffic</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Geo</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Orders</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  News</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  General</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a><br><br>-->
  </div>
</nav>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>