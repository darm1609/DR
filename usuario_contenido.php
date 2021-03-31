<script type="text/javascript">
	
	$(document).ready(function(){
		$("#agregar_usuario").click(function(){
			if($("#divfagregar").is(':visible'))
				$("#divfagregar").hide("linear");
			else
				$("#divfagregar").show("swing");
		});
	});

	function submit_usuario()
	{
		var valido=new Boolean(true);
		if(document.getElementById('loginu').value=='')
		{
			valido=false;
			alertify.alert("","EL LOGIN NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
		}
		if(valido)
		{
			if(document.getElementById('nombre').value=='')
			{
				valido=false;
				alertify.alert("","EL NOMBRE NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
			}
			if(valido)
			{
				if(document.getElementById('apellido').value=='')
				{
					valido=false;
					alertify.alert("","EL APELLIDO NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
				}
			}
		}
		if(valido)
		{
			if(document.getElementById('pass1').value=='' || document.getElementById('pass2').value=='')
			{
				valido=false;
				alertify.alert("","LA CONTRASE\u00d1A NO PUEDE ESTAR VACIA").set('label', 'Aceptar');
			}
			if(valido)
			{
				if(document.getElementById('pass1').value!=document.getElementById('pass1').value)
				{
					valido=false;
					alertify.alert("","LAS CONTRASE\u00d1AS NO COINCIDEN").set('label', 'Aceptar');
				}
				if(valido)
				{
					document.getElementById('pass1').value=CryptoJS.SHA3(document.getElementById('pass1').value);
					document.getElementById('pass2').value=CryptoJS.SHA3(document.getElementById('pass2').value);
				}
			}
		}
		if(valido)
			document.getElementById('fagregar').submit();
	}

	function enviardatos_lista()
	{
		ajax=objetoAjax();
		$("#loader").show();
		$('#loader').html('<div style="display:block;width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","usuario_contenido_lista.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("usuario_contenido_lista.php",$("#flistau").serialize(),function(data)
			    {
			    	$("#divformulariolista").show();
					$("#divformulariolista").html(data);
			    	$("#loader").hide();
			    });
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

	enviardatos_lista();

	function eliminar_usuario(x)
	{
		document.getElementById("login_correo_eliminar").value=x;
		alertify.confirm('','Eliminar el usuario: '+x, function(){ alertify.success('Sí');enviardatos_lista(); }, function(){ alertify.error('No')}).set('labels', {ok:'Sí', cancel:'No'});
	}

</script>
<header class="w3-container" style="padding-top:22px">
	<h5><b>Administraci&oacute;n de Usuarios</b></h5>
</header>
<?php
	function guardar($bd)
	{
		global $basedatos;
		if($bd->insertar_datos(7,$basedatos,"usuario","login_correo","pass","fecha_registro_num","fecha_registro","admin","nombre","apellido",$_POST["loginu"],$_POST["pass1"],time(),date("Y-m-d",time()),$_POST["admin"],$_POST["nombre"],$_POST["apellido"]))
			return true;
		else
			return false;
	}

	function validar_exite($bd)
	{
		if($bd->existe(1,"usuario","login_correo",$_POST["loginu"]))
			return true;
		else
			return false;
	}

	function formulario_agregar_usuario()
	{
		?>
		<form class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin" id="fagregar" name="fagregar" method="post">
			<h2 class="w3-center">Nuevo Usuario</h2>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="loginu"><i class="icon-pencil" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="loginu" name="loginu" type="text" placeholder="Login" maxlength="200">
				</div>
			</div>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="pass1"><i class="icon-lock" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="pass1" name="pass1" type="password" placeholder="Contrase&ntilde;a">
				</div>
			</div>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="pass2"><i class="icon-lock" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="pass2" name="pass2" type="password" placeholder="Repite la Contrase&ntilde;a">
				</div>
			</div>			
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="email"><i class="icon-mail22" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="email" name="email" type="text" placeholder="E-Mail" maxlength="500">
				</div>
			</div>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="nombres"><i class="icon-pencil" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="nombres" name="nombres" type="text" placeholder="Nombres" maxlength="200">
				</div>
			</div>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="apellidos"><i class="icon-pencil" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="apellidos" name="apellidos" type="text" placeholder="Apellidos" maxlength="200">
				</div>
			</div>
			<!-- <div class="w3-row w3-section">
				<label>
				<input class="w3-radio" type="radio" id="admin" name="admin" value="t">
				Administrador
				</label>
				<label>
				<input class="w3-radio" type="radio" id="admin" name="admin" value="f" checked>
				No&nbsp;Administrador
				</label>
			</div> -->
			<div class="w3-row w3-section">
				<input type="button" class="w3-button w3-block w3-green" onclick="submit_usuario();" value="Guardar">
			</div>
		</form>
		<?php
	}

	?>
	<form id="flistau" name="flistau" method="post">
	<input type="hidden" id="login_correo_eliminar" name="login_correo_eliminar">
	</form>
	<?php

	global $servidor, $puerto, $usuario, $pass, $basedatos;
	$bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
		if(usuario_admin($_SESSION["login"]))
		{
			echo"<div id='loader'></div>";
			if(isset($_POST["loginu"]))
			{
				if(!validar_exite($bd))
				{
					if(guardar($bd))
					{
						?>
						<script language='JavaScript' type='text/JavaScript'>
							alertify.alert("","GUARDADO SATISFACTORIAMENTE").set('label', 'Aceptar');
						</script>
						<?php
					}
					else
					{
						?>
						<script language='JavaScript' type='text/JavaScript'>
							alertify.alert("","NO SE PUDO GUARDAR EL USUARIO").set('label', 'Aceptar');
						</script>
						<?php
					}
				}
				else
				{
					?>
					<script language='JavaScript' type='text/JavaScript'>
						alertify.alert("","USUARIO YA EXISTE").set('label', 'Aceptar');
					</script>
					<?php
				}
			}
			echo"<div id='divformulariolista'>";
			echo"</div>";
			?>
			<div class="w3-container">
				<button id='agregar_usuario' class="w3-button w3-blue"><i class='icon-user-plus'>&nbsp;</i>Agregar Usuario</button>
			</div>
			<?php
			echo"<div id='divfagregar' class='w3-container' style='display:none;'>";
			formulario_agregar_usuario();
			echo"</div>";
		}
		else
		{
			?>
			<div class="w3-panel w3-yellow">
				<h3>Advertencia</h3>
				<p>Acceso Restringido</p>
			</div> 
			<?php
		}
	}
?>