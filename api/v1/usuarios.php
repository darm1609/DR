<?php
    require_once("vendor/autoload.php");
    require_once("auth.php");
    require_once("config.php");
    require_once("librerias/basedatos.php");

    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $headers=array();
    foreach (getallheaders() as $name => $value) {
        $headers[$name] = $value;
    }
    
    global $clienteId, $servidor, $puerto, $usuario, $pass, $basedatos;

    $bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
        switch($requestMethod) {
            case "GET":
                header('Content-Type: application/json');
                if($_GET["id"])
                    $sql = "select u.Id, u.Login, p.Nombres, p.Apellidos from segusuario u inner join perpersona p on u.PersonaId=p.Id and p.ClienteId=".$clienteId." and u.Id=".$_GET["id"].";";
                else
                    $sql = "select u.Id, u.Login, p.Nombres, p.Apellidos from segusuario u inner join perpersona p on u.PersonaId=p.Id and p.ClienteId=".$clienteId.";";
                $resultado = $bd->ejecutarConsultaJson($sql);
		        echo $resultado;
                break;
            case "POST":
                header('Content-Type: application/json');
                $resultado = array();
                if(isset($_POST["Nombres"])) $nombres = $_POST["Nombres"];
                if(isset($_POST["Apellidos"])) $apellidos = $_POST["Apellidos"];
                if(isset($_POST["Email"])) $email = $_POST["Email"];
                if(isset($_POST["login"])) $login = $_POST["login"];
                if(isset($_POST["password"])) $password = $_POST["password"];
                if(isset($nombres) and isset($apellidos) and isset($email) and isset($login) and isset($password)) {
                    $sql="insert into perpersona (ClienteId, Email, Nombres, Apellidos) values (".$clienteId.", '".$email."', '".$nombres."', '".$apellidos."');";
                    if($bd->ejecutarConsulta($sql)) {
                        $id =  $bd->ultimo_result;
                        $sql = "insert into segusuario (PersonaId, Login, Password) values (".$id.", '".$login."', '".$password."');";
                        if($bd->ejecutarConsulta($sql)) {
                            $resultado["id"] = $id;
                            echo json_encode($resultado);
                            return;
                        }
                    }
                }
                echo json_encode($resultado);
                break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }
    else
        header("HTTP/1.1 404 Not Found");
?>