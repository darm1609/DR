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
        if(isset($headers["Authorization"]))
            $token = $headers["Authorization"];
        if(isset($token)) {
            $token=trim(str_replace("Bearer"," ",$token));
            if(@Auth::Check($token) !== null and @Auth::Check($token)) {
                switch($requestMethod) {
                    case "GET":
                        header('Content-Type: application/json');
                        if($_GET["id"])
                            $sql = "select u.Id, u.Login, p.Nombres, p.Apellidos from segusuario u inner join perpersona p on u.PersonaId=p.Id and p.ClienteId=".$clienteId." and u.Id=".$_GET["id"].";";
                        else
                            $sql = "select u.Id, u.Login, p.Nombres, p.Apellidos from segusuario u inner join perpersona p on u.PersonaId=p.Id and p.ClienteId=".$clienteId.";";
                        $resultado = $bd->ejecutarConsultaJson($sql);
                        echo $resultado;
                        return;
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
                        return;
                        break;
                    case "PUT":
                        header('Content-Type: application/json');
                        parse_str(file_get_contents("php://input"), $datosPUT);
                        if(isset($datosPUT["login"])) $login = trim($datosPUT["login"]);
                        if(isset($datosPUT["password"])) $password = trim($datosPUT["password"]);
                        if(isset($datosPUT["email"])) $email = trim($datosPUT["email"]);
                        if(isset($datosPUT["nombres"])) $nombres = trim($datosPUT["nombres"]);
                        if(isset($datosPUT["apellidos"])) $apellidos = trim($datosPUT["apellidos"]);
                        $resultado = array();
                        $resultado = Auth::GetData($token);
                        $id = $resultado->id;
                        if(isset($id) and (isset($email) or isset($nombres) or isset($apellidos))) {
                            $sql = "update perpersona set ";
                            if(isset($nombres) and !empty($nombres)) $sql .= "Email = '".$email."', "; else $sql .= "Email = Email, ";
                            if(isset($nombres) and !empty($nombres)) $sql .= "Nombres = '".$nombres."', "; else $sql .= "Nombres = Nombres, ";
                            if(isset($apellidos) and !empty($apellidos)) $sql .= "Apellidos='".$apellidos."', "; else $sql .= "Apellidos = Apellidos";
                            $sql .= " where ClienteId = ".$clienteId." and id = (select PersonaId from segusuario where Id=".$id.");";
                            $bd->ejecutarConsultaUpdate($sql);
                        }
                        if(isset($id) and (isset($login) or isset($password))) {
                            $sql = "update segusuario set ";
                            if(isset($login) and !empty($login)) $sql .= "Login = '".$login."', "; else $sql .= "Login = Login, "; 
                            if(isset($password) and !empty($password)) $sql .= "Password = '".$password."' "; else $sql .= "Password = Password"; 
                            $sql .= " where id = ".$id.";";
                            $bd->ejecutarConsultaUpdate($sql);
                        }
                        $sql = "select u.Id, u.Login, p.Nombres, p.Apellidos, p.Email from segusuario u inner join perpersona p on u.PersonaId=p.Id and p.ClienteId=".$clienteId." and u.Id=".$id.";";
                        $resultado = $bd->ejecutarConsultaJson($sql);
                        echo $resultado;
                        return;
                        break;
                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                        return;
                        break;
                }
            }
        }
        $resultado = array();
        echo json_encode($resultado);
    }
    else
        header("HTTP/1.1 404 Not Found");
?>