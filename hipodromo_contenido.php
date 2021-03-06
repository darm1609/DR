<script type="text/javascript">

	$(document).ready(function(){
		$("#agregar_hipodromo").click(function(){
			if($("#divfagregar").is(':visible'))
				$("#divfagregar").hide("linear");
			else
				$("#divfagregar").show("swing");
		});
	});

	function submit_hipodromo()
	{
		var valido=new Boolean(true);
		if(document.getElementById('nombre').value=='')
		{
			valido=false;
			alertify.alert("","EL NOMBRE NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
		}
		if(valido)
			document.getElementById('fagregar').submit();
	}

	function enviardatos_lista()
	{
		ajax=objetoAjax();
		$("#loader").show();
		$('#loader').html('<div style="display:block;width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","hipodromo_contenido_lista.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("hipodromo_contenido_lista.php",$("#flistah").serialize(),function(data)
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

	function eliminar_hipodromo(x,y)
	{
		document.getElementById("id_hipodromo_eliminar").value=x;
		alertify.confirm('','Eliminar el hipódromo: '+y, function(){ alertify.success('Sí');enviardatos_lista(); }, function(){ alertify.error('No')}).set('labels', {ok:'Sí', cancel:'No'});
	}

</script>
<header class="w3-container" style="padding-top:22px">
	<h5><b>Hip&oacute;dromo</b></h5>
</header>
<form id="flistah" name="flistah" method="post">
	<input type="hidden" id="id_hipodromo_eliminar" name="id_hipodromo_eliminar">
</form>
<?php

	function guardar($bd)
	{
		global $basedatos;
		if($bd->insertar_datos(1,$basedatos,"hipodromo","nombre",$_POST["nombre"]))
			return true;
		else
			return false;
	}

	function formulario_agregar_hipodromo()
	{
		?>
		<form class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin" id="fagregar" name="fagregar" method="post">
			<h2 class="w3-center">Nuevo Hip&oacute;dromo</h2>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="nombre"><i class="icon-pencil" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="nombre" name="nombre" type="text" placeholder="Nombre" maxlength="30">
				</div>
			</div>
			<div class="w3-row w3-section">
				<input type="button" class="w3-button w3-block w3-green" onclick="submit_hipodromo();" value="Guardar">
			</div>
		</form>
		<?php
	}

	global $servidor, $puerto, $usuario, $pass, $basedatos;
	$bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
		if(usuario_admin($_SESSION["login"]))
		{
			echo"<div id='loader'></div>";
			if(isset($_POST["nombre"]))
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
						alertify.alert("","NO SE PUDO GUARDAR EL HIP\u00D3DROMO").set('label', 'Aceptar');
					</script>
					<?php
				}
			}
			echo"<div id='divformulariolista'></div>";
			?>
			<div class="w3-container">
				<button id='agregar_hipodromo' class="w3-button w3-blue">Agregar Hip&oacute;dromo</button>
			</div>
			<?php
			echo"<div id='divfagregar' class='w3-container' style='display:none;'>";
			formulario_agregar_hipodromo();
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