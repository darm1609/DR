<?php
	session_start();
	require("head.php");
	require("config.php");
	require("librerias/basedatos.php");
	require("funciones_generales.php");
?>
<?php
	global $servidor, $clienteId, $puerto, $usuario, $pass, $basedatos;
	//require("superior.php");
	//require("menu_lateral.php");
	//require("login.php");
	//kRGysYCkha

	function validar_login($clienteId,$bd)
	{
		$cadSql="select * from perpersona p inner join segusuario u on p.Id=u.PersonaId where p.ClienteId=".$clienteId." and u.Login='".$_POST["login"]."' and u.Password='".$_POST["pass"]."';" ;
		if($bd->ejecutarConsultaExiste($cadSql)) {
			$_SESSION["login"] = $_POST["login"];
			return true;
		}
		return false;
	}

	function login_form()
	{
		?>
		<div class="w3-container w3-cell">
			<form class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin" id="flogin" id="flogin" name="flogin" method="post">
				<div class="w3-row w3-section">
					<label>
						<h4>Login</h4>
						<input class="w3-input w3-border" type="text" id="login" name="login" value="">
					</label>
				</div>
				<div class="w3-row w3-section">
					<label>
						<h4>Contrase&ntilde;a</h4>
						<input class="w3-input w3-border" type="password" id="pass" name="pass" value="">
					</label>
				</div>
				<div class="w3-row w3-section">
					<input class="w3-button w3-block w3-blue" type="submit" id="enviar" name="enviar" value="Entrar" onclick="if(this.form.pass.value!='') this.form.pass.value=CryptoJS.SHA3(this.form.pass.value);">
				</div>
			</form>
		</div>
		<?php
	}

	
	$bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
		if(!isset($_POST["enviar"]) and !isset($_SESSION["login"]) or isset($_POST["cerrar"]))
		{
			login_form();
		}
		else
		{
			if(isset($_POST["enviar"]))
			{
				if(!empty($_POST["login"]) and !empty($_POST["pass"]))
				{
					if(validar_login($clienteId,$bd))
					{
						if(usuario_admin($_POST["login"]))
						{
							require("superior.php");
							require_once("menu_lateral.php");
						}
						else
						{
							require("superior.php");
							require("tabla_activa.php");
						}
					}
					else
					{
						$error_2=true;
						login_form();
					}
				}
				else
				{
					$error_1=true;
					login_form();
				}
			}
			elseif(isset($_SESSION["login"]))
			{
				require("superior.php");
				if(usuario_admin($_SESSION["login"]))
					require_once("menu_lateral.php");
				else
					require("tabla_activa.php");
			}
		}
	}
	else
	{
		echo"error bd";
	}

	if(isset($_POST["cerrar"]))
	{
		session_destroy();
	}
?>
<?php
	require("pie.php");
?>
